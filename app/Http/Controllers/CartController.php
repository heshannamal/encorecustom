<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\SubProduct;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\MasterStock;
use App\Models\ColorMaster;
use App\Services\CartApiService;
use App\Services\ProductApiService;

class CartController extends Controller
{
    protected $productApiService;
    protected $cartApiService;

    public function __construct(ProductApiService $productApiService, CartApiService $cartApiService)
    {
        $this->productApiService = $productApiService;
        $this->cartApiService = $cartApiService;
    }

    public function addToCart(Request $request)
    {
        // ✅ Validate required fields
        $request->validate([
            'product_id' => 'required|integer',
            'size_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'color_id' => 'required|integer'
        ]);

        if(session()->has('temp_id')) {
            $tempId = session('temp_id');
        } else {
            $tempId = Str::uuid();
            session(['temp_id' => $tempId]);
        }

        if(auth()->check()){
            $userId = auth()->id();
        } else {
            $userId = null;
        }

        $data = $request->all();
        $data['user_id'] = $userId;
        $data['temp_id'] = $tempId;

        $apiResponse = $this->cartApiService->addToCart($data);

        return response()->json($apiResponse);
    }

    public function getGlobalCartCount()
    {
        try {
            $tempId = session('temp_id');
            $data['temp_id'] = $tempId;

            $apiResponse = $this->cartApiService->getGlobalCartCount($data);

            return response()->json($apiResponse);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function cart_page()
    {
        return view('pages/customer_end/cart/index');
    }

    public function get_cart_items()
    {
        $tempId = session('temp_id');
        $data['temp_id'] = $tempId;

        $apiResponse = $this->cartApiService->getCartItems($data);

        return response()->json($apiResponse);
    }

    public function edit($id)
    {
        $apiResponse = $this->cartApiService->getCartItemById($id);
        if(!$apiResponse && $apiResponse['cart_item']){
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found'
            ], 404);
        }
        $productDetails = $this->getOptions($apiResponse['cart_item']['sub_product_id'])->getData(true);

        return response()->json([
            'status' => true,
            'cart_item' => $apiResponse['cart_item'],
            'product_details' => $productDetails,
        ]);
    }

    public function updateCartById(Request $request, $id)
    {
        try {
            $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'product_id' => 'required|integer',
                'size_id' => 'required|integer',
                'quantity' => 'required|integer|min:1',
                'color_id' => 'required|integer'
            ]);

            if($validate->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first(),
                ], 422);
            }
            
            $tempId = session('temp_id');

            $data = $request->all();
            $data['temp_id'] = $tempId;

            $apiResponse = $this->cartApiService->updateCartById($data, $id);

            return response()->json($apiResponse);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function remove($id)
    {
        try {
            $apiResponse = $this->cartApiService->removeCartItemById($id);

            return response()->json($apiResponse);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try{
            $tempId = session('temp_id');
            
            $data = $request->all();
            $data['temp_id'] = $tempId;
            $apiResponse = $this->cartApiService->updateCart($data, $id);
            return response()->json($apiResponse);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    public function getOptions($id)
    {
        $options = $this->productApiService->getProductOptions($id);
        return response()->json($options);
    }

    public function global_cart_items()
    {
        $tempId = session('temp_id');
        $data['temp_id'] = $tempId;
        $cartProducts = $this->cartApiService->globalCartItems($data);
        return response()->json($cartProducts);
    }
}
