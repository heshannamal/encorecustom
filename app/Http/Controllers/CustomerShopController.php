<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Filter dropdown models
use App\Models\MainCategoryDbModel;
use App\Models\SportDbModel;
use App\Models\ProductCategoryDbModel;

// Product related models (SECOND DB)
use App\Models\ProductDbModel;
use App\Models\SubProductDbModel;
use App\Models\ProductMainCategoryDbModel;
use App\Models\ProductSportDbModel;
use App\Models\ProductCategoryListDbModel;
use App\Models\ProductImageDbModel;
use App\Models\ProductEmbellishmentTypeDbModel;
use App\Models\SubProductImageDbModel;
use App\Models\SizeDbModel;
use App\Models\ProductAttributeDbModel;
use App\Models\SubProductColorDbModel;
use App\Models\ColorMasterDbModel;
use App\Models\FabricDbModel;
use App\Models\AttributeDbModel;
use App\Models\EmbellishmentTypeDbModel;
use App\Models\ProductTaglineListDbModel;
use App\Models\ProductTaglineDbModel;
use App\Models\ProductFitDbModel;
use App\Models\MasterFitDbModel;
use App\Models\MasterStock;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\SalesChannelSubProduct;
use App\Models\SubProduct;
use App\Models\SubProductImage;
use App\Services\ProductApiService;

class CustomerShopController extends Controller
{
    protected $productApiService;

    public function __construct(ProductApiService $productApiService)
    {
        $this->productApiService = $productApiService;
    }

    public function customer_shop(Request $request)
    {
        $mainCategories = $this->productApiService->getMainCategories();
        $sports = $this->productApiService->getSports();
        $productCategories = $this->productApiService->getProductCategories();
        return view('pages/customer_end/customer_shop/index', [
            'main_categories'      => $mainCategories,
            'sports'               => $sports,
            'productCategories'    => $productCategories,
        ]);
    }


    public function productFilter(Request $request)
    {
        $selectedCategory = $request->input('selectedCategory');
        $selectedGender   = $request->input('selectedGender');
        $selectedSport    = $request->input('selectedSport');
        $selectedStyle    = $request->input('selectedStyle');
        $search           = $request->input('search');

        if ($selectedCategory == '6') {
            $selectedCategory = '3';
        }

        $filters = [
            'selectedCategory' => $selectedCategory,
            'selectedGender'   => $selectedGender,
            'selectedSport'    => $selectedSport,
            'selectedStyle'    => $selectedStyle,
            'search'           => $search,
        ];

        $apiResponse = $this->productApiService->getProducts($filters);
        $alldata     = $this->productApiService->formatMatchingData($apiResponse);

        return response()->json($alldata);
    }

    public function productSearch(Request $request)
    {
        $searchValue = trim(strtolower($request->input('search')));

        /*
        |--------------------------------------------------------------------------
        | FILTER DETECTION (redirect if match)
        |--------------------------------------------------------------------------
        */
        $searchValue = strtolower($searchValue);

        $selectedCategory = MainCategoryDbModel::where(strtolower('category_name'), 'like', $searchValue)->first()->id ?? 5;
        $selectedSport = SportDbModel::where(strtolower('sport_name'), 'like', $searchValue)->first()->id ?? 18;
        $selectedStyle = ProductCategory::where(strtolower('product_category_name'), 'like', $searchValue)->first()->id ?? 0;
        $selectedGender = $searchValue == 'men' || $searchValue == 'women' || $searchValue == 'uni' ? $searchValue : 'All';

        if($selectedCategory != 5 || $selectedSport != 18 || $selectedStyle != 0 || $selectedGender != 'All'){
            return redirect()->route('product_filter1', [
                'selectedCategory' => $selectedCategory,
                'selectedSport' => $selectedSport,
                'selectedStyle' => $selectedStyle,
                'selectedGender' => $selectedGender
            ]);
        }

        $allowedSubProductIds = SalesChannelSubProduct::where('sales_channel_id', 1)
            ->where('is_active', 1)
            ->whereHas('masterStock', function ($query) {
                $query->where('stock_qty', '>', 0);
            })
            ->pluck('sub_product_id')
            ->toArray();

        $regex = '[[:<:]]' . $searchValue . '[[:>:]]';
        $keywords = explode(' ',  $searchValue);
        $searchValueTerms = implode('|', array_map('strtolower', $keywords));
        // dump($searchValueTerms);
        // dump($regex);

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */
        // $products = Product::with(['productCategories'])
        //     ->where('active', 1)
        //     ->where(function ($query) use ($searchValue, $regex, $searchValueTerms) {

        //         $query->whereRaw('LOWER(gender) = ?', [$searchValue])

        //             ->orWhereRaw('LOWER(product_no) REGEXP ?', [$regex])

        //             ->orWhere(function ($q) use ($searchValueTerms) {
        //                 $q->whereNotNull('show_in_catalog_name')
        //                 ->whereRaw('LOWER(show_in_catalog_name) REGEXP ?', [$searchValueTerms]);
        //             })

        //             ->orWhere(function ($q) use ($searchValueTerms) {
        //                 $q->whereNull('show_in_catalog_name')
        //                 ->whereRaw('LOWER(product_name) REGEXP ?', [$searchValueTerms]);
        //             });
        //     })
        //     ->get();

        /*
        |--------------------------------------------------------------------------
        | SUB PRODUCTS
        |--------------------------------------------------------------------------
        */
        $subProducts = SubProductDbModel::with(['productDetails.productCategories'])
            ->where('active', 1)
            ->whereIn('id', $allowedSubProductIds)
            ->where(function ($query) use ($searchValue, $regex, $searchValueTerms) {

                $query->whereHas('productDetails', function ($q) use ($searchValue) {
                    $q->whereRaw('LOWER(gender) = ?', [$searchValue]);
                })

                ->orWhereRaw('LOWER(sub_product_no) REGEXP ?', [$regex])

                ->orWhere(function ($q) use ($searchValueTerms) {
                    $q->whereNotNull('show_in_catalog_name')
                    ->whereRaw('LOWER(show_in_catalog_name) REGEXP ?', [$searchValueTerms]);
                })

                ->orWhere(function ($q) use ($searchValueTerms) {
                    $q->whereNull('show_in_catalog_name')
                    ->whereRaw('LOWER(product_name) REGEXP ?', [$searchValueTerms]);
                });
            })
            ->get();

        /*
        |--------------------------------------------------------------------------
        | EXTRA MATCHES (SPORT / CATEGORY / STYLE)
        |--------------------------------------------------------------------------
        */
        // $sportsMatch = Product::join('product_sports', 'products.id', '=', 'product_sports.product_id')
        //     ->join('sports', 'product_sports.sport_id', '=', 'sports.id')
        //     ->whereRaw('LOWER(sports.sport_name) REGEXP ?', [$searchValueTerms])
        //     ->whereNull('product_sports.deleted_at')
        //     ->where('products.active', '!=', 3)
        //     ->select('products.*')
        //     ->get();

        // $categoryMatch = Product::join('product_main_categories', 'products.id', '=', 'product_main_categories.product_id')
        //     ->join('main_categories', 'product_main_categories.main_category_id', '=', 'main_categories.id')
        //     ->whereRaw('LOWER(main_categories.category_name) REGEXP ?', [$searchValueTerms])
        //     ->whereNull('product_main_categories.deleted_at')
        //     ->where('products.active', '!=', 3)
        //     ->select('products.*')
        //     ->get();

        // $styleMatch = Product::join('product_category_lists', 'products.id', '=', 'product_category_lists.product_id')
        //     ->join('product_categories', 'product_category_lists.product_category_id', '=', 'product_categories.id')
        //     ->whereRaw('LOWER(product_categories.product_category_name) REGEXP ?', [$searchValueTerms])
        //     ->whereNull('product_category_lists.deleted_at')
        //     ->where('products.active', '!=', 3)
        //     ->select('products.*')
        //     ->get();

        /*
        |--------------------------------------------------------------------------
        | MERGE + UNIQUE
        |--------------------------------------------------------------------------
        */
        // $products = $products
        //     ->merge($sportsMatch)
        //     ->merge($categoryMatch)
        //     ->merge($styleMatch)
        //     ->unique('id')
        //     ->values();

        $subProducts = $subProducts->unique('id')->values();

        /*
        |--------------------------------------------------------------------------
        | BUILD FINAL DATA (IMPORTANT 🔴 FIX)
        |--------------------------------------------------------------------------
        */
        $alldata = [];

        foreach ($subProducts as $data) {

            $studio_images = SubProductImage::where('active', 1)
                ->where('sub_product_no', $data->sub_product_no)
                ->whereIn('image_type', [5, 2])
                ->get();

            $relatedFabric = $this->getRelatedFabrics($data->id, 'sub_product');

            $alldata[] = [
                'type' => 'sub_product',
                'category' => optional($data->productDetails->productCategories)->pluck('product_category_id')->toArray() ?? [],
                'data' => $data,
                'studio_images' => $studio_images,
                'relatedFabric' => $relatedFabric,
                'relatedEmbellishments' => []
            ];
        }

        shuffle($alldata);

        /*
        |--------------------------------------------------------------------------
        | FILTER DATA (UI REQUIREMENT)
        |--------------------------------------------------------------------------
        */
        $mainCategory = MainCategoryDbModel::orderBy('category_name')->get();
        $sports = SportDbModel::where('active', 1)->orderBy('sport_name')->get();
        $productCategories = ProductCategory::where('active', 1)->orderBy('product_category_name')->get();

        /*
        |--------------------------------------------------------------------------
        | FINAL RETURN ✅
        |--------------------------------------------------------------------------
        */
        // dd($alldata);
        return view('pages/customer_end/customer_shop/index', [
            'matchingData' => $alldata,
            'searchValue' => $searchValue,
            'main_categories' => $mainCategory,
            'sports' => $sports,
            'productCategories' => $productCategories
        ]);
    }

    private function getRelatedFabrics($productId, $type = 'product')
    {
        if ($type == 'sub_product') {
            $fabricProducts = SubProduct::where('id', $productId)
                ->where('active', 1)
                ->select('id', 'fabric_id')
                ->get();
        } else {
            $fabricProducts = SubProduct::where('parent_product_id', $productId)
                ->where('active', 1)
                ->select('id', 'fabric_id')
                ->get();
        }

        $fabricDetails = FabricDbModel::get();
        $relatedFabric = [];

        foreach ($fabricProducts as $fabricProduct) {
            foreach ($fabricDetails as $fabricDetail) {
                if ($fabricProduct->fabric_id == $fabricDetail->id) {
                    $relatedFabric[] = [
                        'subproduct_id' => $fabricProduct->id,
                        'fabric_detail' => $fabricDetail,
                    ];
                }
            }
        }

        return $relatedFabric;
    }

    public function productDetails($id, Request $request){

        $searchValue = $request->query('search', null);
        $selectedGender = $request->query('selectedGender', null);
        $selectedCategory = $request->query('selectedCategory', null);
        $selectedSport = $request->query('selectedSport', null);
        $selectedStyle = $request->query('selectedStyle', null);

        $type = $request->query('type', null);

        $availableSizeIds = [];

        if ($type == 'product') {

            $product = ProductDbModel::find($id);
            $product->size_chart = $product->size_chart ? 'assets'.$product->size_chart : null;

            $fabricIDs = SubProductDbModel::where('parent_product_id', $id)
            ->where('active', 1)
            ->pluck('standard_fabric')
            ->toArray();

            $lifestyleImages = ProductImageDbModel::where('product_id', $id)->where('image_type', 1)->pluck('image_link');
            $Images3D = ProductImageDbModel::where('product_id', $id)->where('image_type', 2)->pluck('image_link');

            $images_3d = ProductImageDbModel::where('active', 1)
                    ->where('product_id', $id)
                    ->where('image_type', 1)
                    ->get();

            $lifeStyle_images = ProductImageDbModel::where('active', 1)
                    ->where('product_id', $id)
                    ->where('image_type', 2)
                    ->get();

            $closeUp_images = ProductImageDbModel::where('active', 1)
                    ->where('product_id', $id)
                    ->where('image_type', 3)
                    ->get();

            $branding_images = ProductImageDbModel::where('active', 1)
                    ->where('product_id', $id)
                    ->where('image_type', 4)
                    ->get();
            $studio_images = ProductImageDbModel::where('active', 1)
                    ->where('product_id', $id)
                    ->where('image_type', 5)
                    ->get();

            $EmbellishmentsFiltered = ProductEmbellishmentTypeDbModel::where('product_id' , $id)->pluck('embellishment_type_id')->toArray();
            $embellishmentProducts = SubProductDbModel::where('parent_product_id', $id)
            ->where('active', 1)
            ->pluck('type_of_embellishment')
            ->toArray();

            $availableSizeIds = MasterStock::where('product_id', $id)
            ->where('stock_qty', '>', 0)
            ->where('is_active', 1)
            ->pluck('size_id')->toArray();

            $productType = 'product';
            $sub_product_found = collect();

        }elseif($type == 'sub_product'){

            $sub_product_found = SubProductDbModel::find($id);
            $product = ProductDbModel::find($sub_product_found->parent_product_id);

            $product->product_no = $sub_product_found->sub_product_no;
            $product->show_in_catalog_name = $sub_product_found->show_in_catalog_name ?? NULL;
            $product->product_name = $sub_product_found->product_name;
            $product->pattern_code = $sub_product_found->pattern_code;
            $product->default_price = $sub_product_found->default_price;
            $product->standard_fabric = $sub_product_found->standard_fabric;
            $product->description = $sub_product_found->description;
            $product->who_we_made_this_for = $sub_product_found->who_we_made_this_for;
            $product->product_features = $sub_product_found->product_features;
            $product->notes = $sub_product_found->notes;
            $product->mockup_img_1 = $sub_product_found->mockup_img_1;
            $product->mockup_img_2 = $sub_product_found->mockup_img_2;
            $product->mockup_img_3 = $sub_product_found->mockup_img_3;
            $product->size_chart = $sub_product_found->size_chart ?? ($product->size_chart ? 'assets'.$product->size_chart : null);

            $fabricIDs = SubProductDbModel::where('id', $id)
            ->where('active', 1)
            ->pluck('standard_fabric')
            ->toArray();

            $lifestyleImages = SubProductImageDbModel::where('sub_product_no', $sub_product_found->sub_product_no)->where('image_type', 1)->pluck('image_link');
            $Images3D = SubProductImageDbModel::where('sub_product_no', $sub_product_found->sub_product_no)->where('image_type', 2)->pluck('image_link');

            $images_3d = SubProductImageDbModel::where('active', 1)
                    ->where('sub_product_no', $sub_product_found->sub_product_no)
                    ->where('image_type', 1)
                    ->get();

            $lifeStyle_images = SubProductImageDbModel::where('active', 1)
                    ->where('sub_product_no', $sub_product_found->sub_product_no)
                    ->where('image_type', 2)
                    ->get();

            $closeUp_images = SubProductImageDbModel::where('active', 1)
                    ->where('sub_product_no', $sub_product_found->sub_product_no)
                    ->where('image_type', 3)
                    ->get();

            $branding_images = SubProductImageDbModel::where('active', 1)
                    ->where('sub_product_no', $sub_product_found->sub_product_no)
                    ->where('image_type', 4)
                    ->get();
            $studio_images = SubProductImageDbModel::where('active', 1)
                    ->where('sub_product_no', $sub_product_found->sub_product_no)
                    ->where('image_type', 5)
                    ->get();

            $EmbellishmentsFiltered = SubProductDbModel::where('id' , $id)->where('active' , 1)->pluck('type_of_embellishment')->toArray();
            $embellishmentProducts = SubProductDbModel::where('id', $id)
            ->where('active', 1)
            ->pluck('type_of_embellishment')
            ->toArray();

            $availableSizeIds = MasterStock::where('sub_product_id', $id)
            ->where('stock_qty', '>', 0)
            ->where('is_active', 1)
            ->pluck('size_id')->toArray();

            $productType = 'sub_product';

        }

        $fabricIDs = array_unique($fabricIDs);

        if (count($fabricIDs) > 0) {
            $productFabric = implode(' | ', $fabricIDs);
        } else {
            $productFabric = "No fabrics";
        }

        if (!$product) {
            return redirect()->route('error.page');
        }
        $product_main_cat = ProductMainCategoryDbModel::where('product_id' , $product->id)->first();
        $product->main_category_id = $product_main_cat->main_category_id;

        $categoryID = $product->product_category_id;

        $randomProducts = ProductDbModel::inRandomOrder()
            ->where('product_category_id', $categoryID)
            ->take(4)
            ->get();

        $size = SizeDbModel::select('id', 'size_name', 'size_type')
            ->where('size_name', 'not like', 'Extra%')
            ->whereIn('id', $availableSizeIds)
            ->get();

        $mainCategory = MainCategoryDbModel::select('id', 'category_name')->get();


        if(count($EmbellishmentsFiltered) > 0){
            $productEmblishment = $EmbellishmentsFiltered[0];
        }else{
            $productEmblishment = "No available";
        }

        $productAttributes = ProductAttributeDbModel::where('product_id', $product->id)
            ->whereIn('attribute_id', [3, 4, 5])
            ->whereNull('deleted_at')
            ->with('attribute')
            ->get();

        if ($productAttributes->isNotEmpty()) {
            $attributeNames = [];

            foreach ($productAttributes as $productAttribute) {
                if ($productAttribute->attribute) {
                    $attributeNames[] = $productAttribute->attribute->attribute_name;
                }
            }

            $displayedAttributes = implode(' | ', $attributeNames);
        } else {
            $displayedAttributes = "";
        }


        $selectedMainCategory = MainCategoryDbModel::where('id', $selectedCategory)->get();

        $mainCategories = MainCategoryDbModel::orderBy('category_name')->get();

        $sports = SportDbModel::orderBy('sport_name')->where('active', 1)->get();

        $productCategories = ProductCategoryDbModel::orderBy('product_category_name')->where('active', 1)->get();

        $productColors = SubProductColorDbModel::where('id', $product->id)->get();

        $masterColors = ColorMasterDbModel::get();

        $relatedColors = [];

        foreach ($productColors as $productColor) {
            foreach ($masterColors as $masterColor) {
                if ($productColor->color_master_id == $masterColor->id) {
                    $relatedColors[] = $masterColor;
                }
            }
        }

        if ($type == 'sub_product') {
            $fabricProducts = SubProductDbModel::where('id', $id)
            ->where('active', 1)
            ->select('id', 'fabric_id')
            ->get();
        }else{
            $fabricProducts = SubProductDbModel::where('parent_product_id', $id)
            ->where('active', 1)
            ->select('id', 'fabric_id')
            ->get();
        }

        $fabricDetails = FabricDbModel::get();

        $relatedFabric = [];

        foreach ($fabricProducts as $fabricProduct) {
            foreach ($fabricDetails as $fabricDetail) {
                if ($fabricProduct->fabric_id == $fabricDetail->id) {
                    $relatedFabric[] = [
                        'subproduct_id' => $fabricProduct->id,
                        'fabric_detail' => $fabricDetail,
                    ];
                }
            }
        }

        $attributeProducts = ProductAttributeDbModel::where('product_id', $id)
            ->where('deleted_at', null)
            ->get();

        $attributes = AttributeDbModel::get();

        $relatedAttributes = [];

        foreach ($attributeProducts as $attributeProduct) {
            foreach ($attributes as $attribute) {
                if ($attributeProduct->attribute_id == $attribute->id &&
                    $attribute->attribute_name != 'Player #' &&
                    $attribute->attribute_name != 'Player Name') {
                    $relatedAttributes[] = $attribute;
                }
            }
        }

        $embellishmentTypes = EmbellishmentTypeDbModel::get();

        $relatedEmbellishments = [];

        foreach ($embellishmentProducts as $embellishmentProduct) {
            $separatedEmbellishments = explode(' / ', $embellishmentProduct);

            foreach ($separatedEmbellishments as $embellishment) {
                foreach ($embellishmentTypes as $embellishmentType) {
                    if (trim($embellishment) == $embellishmentType->embellishment_name) {
                        if (!in_array($embellishmentType, $relatedEmbellishments)) {
                            $relatedEmbellishments[] = $embellishmentType;
                        }
                    }
                }
            }
        }

       $productTaglineLists = ProductTaglineListDbModel::where('product_id', $product->id)->get();

       $masterTaglines = ProductTaglineDbModel::get();

        $relatedTaglines = [];

        foreach ($productTaglineLists as $productTaglineList) {
            foreach ($masterTaglines as $masterTagline) {
                if ($productTaglineList->tagline_id == $masterTagline->id) {
                    $relatedTaglines[] = $masterTagline;
                }
            }
        }

        $productFits = ProductFitDbModel::where('product_id', $product->id)->get();

        $masterFits = MasterFitDbModel::get();

        $relatedFits = [];

        foreach ($productFits as $productFit) {
            foreach ($masterFits as $masterFit) {
                if ($productFit->fit_id == $masterFit->id) {
                    $relatedFits[] = $masterFit;
                }
            }
        }

        if ($searchValue !== null) {
            return view('pages.customer_end.customer_shop.product_view', [
                'searchValue'=> $searchValue,
                'product' => $product,
                'sub_product' => $sub_product_found,
                'lifestyleImages' => $lifestyleImages,
                'Images3D' => $Images3D,
                'randomProducts' => $randomProducts,
                'size' => $size,
                'mainCategory' => $mainCategory,
                'productFabric'=> $productFabric,
                'selectedSport'=>$selectedSport,
                'productEmblishment'=>$productEmblishment,
                'productAttributes'=>$productAttributes,
                'displayedAttributes'=>$displayedAttributes,
                'mainCategories'=>$mainCategories,
                'selectedCategory'=>$selectedCategory,
                'selectedGender' =>$selectedGender,
                'sports'=>$sports,
                'selectedStyle'=>$selectedStyle,
                'productCategories'=>$productCategories,
                'relatedColors'=>$relatedColors,
                'relatedFabric'=>$relatedFabric,
                'relatedAttributes'=>$relatedAttributes,
                'relatedEmbellishments'=>$relatedEmbellishments,
                'images_3d'=>$images_3d,
                'lifeStyle_images'=>$lifeStyle_images,
                'studio_images'=>$studio_images,
                'relatedTaglines'=>$relatedTaglines,
                'relatedFits'=>$relatedFits,
                'closeUp_images'=>$closeUp_images,
                'branding_images'=>$branding_images,
                'productType'=>$productType
            ]);
        } else {
            return view('pages.customer_end.customer_shop.product_view', [
                'product' => $product,
                'sub_product' => $sub_product_found,
                'lifestyleImages' => $lifestyleImages,
                'Images3D' => $Images3D,
                'randomProducts' => $randomProducts,
                'size' => $size,
                'mainCategory' => $mainCategory,
                'productFabric'=> $productFabric,
                'selectedGender' =>$selectedGender,
                'selectedCategory'=>$selectedCategory,
                'selectedSport'=>$selectedSport,
                'selectedStyle'=>$selectedStyle,
                'productEmblishment'=>$productEmblishment,
                'productAttributes'=>$productAttributes,
                'displayedAttributes'=>$displayedAttributes,
                'selectedMainCategory'=>$selectedMainCategory,
                'mainCategories'=>$mainCategories,
                'sports'=>$sports,
                'productCategories'=>$productCategories,
                'relatedColors'=>$relatedColors,
                'relatedFabric'=>$relatedFabric,
                'relatedAttributes'=>$relatedAttributes,
                'relatedEmbellishments'=>$relatedEmbellishments,
                'images_3d'=>$images_3d,
                'lifeStyle_images'=>$lifeStyle_images,
                'studio_images'=>$studio_images,
                'relatedTaglines'=>$relatedTaglines,
                'relatedFits'=>$relatedFits,
                'closeUp_images'=>$closeUp_images,
                'branding_images'=>$branding_images,
                'productType'=>$productType
            ]);
        }
    }


    public function filterEmbellishment(Request $request)
    {
        $subProductId = $request->input('subProductId');
        $productType  = $request->input('productType');

        /* ===============================
        Get Sub Product
        =============================== */
        $subProduct = SubProductDbModel::where('id', $subProductId)
            ->where('active', 1)
            ->first();

        if (!$subProduct) {
            return response()->json([
                'relatedEmbellishments' => [],
                'relatedColors' => []
            ]);
        }

        /* ===============================
        Get Related Colors (Optimized)
        =============================== */
        $colorIds = SubProductColorDbModel::where('sub_product_no', $subProduct->sub_product_no)
            ->pluck('color_master_id');

        $relatedColors = ColorMasterDbModel::whereIn('id', $colorIds)->get();

        /* ===============================
        Get Related Embellishments
        =============================== */
        $relatedEmbellishments = [];

        if ($productType === 'sub_product') {

            $subProductWithRelations = SubProductDbModel::with(
                'embellishmentTypes.embellishmentDetails'
            )->where('id', $subProductId)
            ->where('active', 1)
            ->first();

            if ($subProductWithRelations) {
                foreach ($subProductWithRelations->embellishmentTypes as $embellishment) {

                    if (
                        $embellishment->embellishmentDetails &&
                        $embellishment->embellishmentDetails->active == 1
                    ) {
                        $relatedEmbellishments[
                            $embellishment->embellishmentDetails->id
                        ] = $embellishment->embellishmentDetails;
                    }
                }
            }

        } else {

            $product = ProductDbModel::with(
                'productEmbellishmentTypes.embellishmentTypes'
            )->where('id', $subProduct->parent_product_id)
            ->where('active', 1)
            ->first();

            if ($product) {
                foreach ($product->productEmbellishmentTypes as $embellishment) {

                    if (
                        isset($embellishment->embellishmentTypes[0]) &&
                        $embellishment->embellishmentTypes[0]->active == 1
                    ) {
                        $relatedEmbellishments[
                            $embellishment->embellishmentTypes[0]->id
                        ] = $embellishment->embellishmentTypes[0];
                    }
                }
            }
        }

        $relatedEmbellishments = array_values($relatedEmbellishments);

        /* ===============================
        Return JSON
        =============================== */
        return response()->json([
            'relatedEmbellishments' => $relatedEmbellishments,
            'relatedColors' => $relatedColors
        ]);
    }


    public function getEmbellishmentDetails(Request $request){

        $selectedEmbellishmentId = $request->input('selectedEmbellishmentId');

        $embellishmentTypes = EmbellishmentTypeDbModel::where('id', $selectedEmbellishmentId)->first();

        $subProductId = $request->input('subProductId');

        $subProduct = SubProductDbModel::where('id', $subProductId)->first();

        $masterColors = ColorMasterDbModel::get();

        $productColors = SubProductColorDbModel::where('sub_product_no', $subProduct->sub_product_no)->get();

        $relatedColors = [];

        foreach ($productColors as $productColor) {
            foreach ($masterColors as $masterColor) {
                if ($productColor->color_master_id == $masterColor->id) {
                    $relatedColors[] = $masterColor;
                }
            }
        }

        return response()->json([
            'embellishmentTypes'=>$embellishmentTypes, 'relatedColors'=>$relatedColors
        ]);
    }

    public function getFabricDetails(Request $request){

        $subProductId = $request->input('subProductId');

        $subProduct = SubProductDbModel::where('id', $subProductId)
            ->where('active', 1)
            ->with('fabric')
            ->first();


        return response()->json([
            'subProduct'=>$subProduct
        ]);
    }

    public function getTaglineDetails(Request $request){

        $taglineId = $request->input('taglineId');

        $productTaglines = ProductTaglineDbModel::where('id', $taglineId)->first();

        return response()->json([
            'productTaglines'=>$productTaglines
        ]);
    }

    /**
     * Get available colors from master_stocks for a given product + size combination.
     * Used by the product view page AJAX call when a size button is clicked.
     *
     * Query params:
     *   product_id   – the product/sub-product ID
     *   size_id      – the selected size ID
     *   product_type – 'product' | 'sub_product'
     */
    public function getColorsBySize(Request $request)
    {
        $productId   = $request->input('product_id');
        $sizeId      = $request->input('size_id');
        $productType = $request->input('product_type', 'sub_product');

        $stockQuery = MasterStock::where('size_id', $sizeId)
            ->where('stock_qty', '>', 0)
            ->where('is_active', 1)
            ->whereNotNull('color_master_id');

        if ($productType === 'sub_product') {
            $stockQuery->where('sub_product_id', $productId);
        } else {
            $stockQuery->where('product_id', $productId);
        }

        $colorIds = $stockQuery->pluck('color_master_id')->unique()->values();

        $colors = ColorMasterDbModel::whereIn('id', $colorIds)->get();

        return response()->json([
            'colors' => $colors,
        ]);
    }

}
