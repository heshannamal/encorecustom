<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MasterStock;
use App\Models\TempOrderBillingDetail;
use App\Services\CartApiService;
use App\Services\PaymentApiService;
use App\Services\ProfileApiService;
use App\Traits\PaymentHelper;
use domain\Facades\ShippingFacade\ShippingFacade;
use domain\Facades\UserFacade\CustomerFacade;
use domain\Facades\ShippingFacade\USPShippingFacade;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class PaymentController extends Controller
{
    use PaymentHelper;
    protected $cartApiService;
    protected $profileApiService;
    protected $paymentApiService;

    public function __construct(CartApiService $cartApiService, ProfileApiService $profileApiService, PaymentApiService $paymentApiService)
    {
        $this->cartApiService = $cartApiService;
        $this->profileApiService = $profileApiService;
        $this->paymentApiService = $paymentApiService;
    }

    public function proceedToCheckout(Request $request)
    {
        $items = $request->items;
        $notifyArr = [];
        foreach($items as $item){
            $cartId = $item['cart_id'];
            $cartItem = Cart::find($cartId);
            $stockQuery = MasterStock::where('sub_product_id', $cartItem->sub_product_id)
                ->where('size_id', $cartItem->size_id);
                if($cartItem->color_id){
                    $stockQuery->where('color_master_id', $cartItem->color_id);
                } else {
                    $stockQuery->whereNull('color_master_id');
                }
            $stock = $stockQuery->first();
            if($cartItem->quantity >$stock->stock_qty){
                $notifyArr[] = [
                    'cart_id' => $cartId,
                    'product' => $stock->subProduct->product_name ?? '',
                    'size' => $stock->size->size_name,
                    'color' => $stock->color->color_hex,
                    'color_name' => $stock->color->color_name,
                    'available_quantity' => $stock->stock_qty,
                ];
            }

            if(!$cartItem->user_id){
                $cartItem->update(['user_id'=>auth()->user()->id]);
            }
        }

        if(!empty($notifyArr)){
            return response()->json([
                'status' => 'error',
                'title' => 'No Available Stock!',
                'message' => $this->notAvailableStockItemNotification($notifyArr)
            ], 400);
        } else {
            return response()->json([
                'status' => 'success',
                'title' => 'Success',
                'message' => 'You can proceed with the payment.',
            ]);
        }
    }

    public function cartPayment(){
        $apiResponse = $this->cartApiService->getCartItemIds();
        if(isset($apiResponse['success']) && $apiResponse['success']){
            $cartItemIds = json_encode($apiResponse['cart_item_ids']);
        } else {
            $cartItemIds = '';
        }

        $months = array(1 => '01', 2 => '02', 3 => '03', 4 => '04', 5 => '05', 6 => '06', 7 => '07', 8 => '08', 9 => '09', 10 => '10', 11 => '11', 12 => '12');
        return view('pages.customer_end.payment.index', compact('cartItemIds', 'months'));
    }

    public function getCustomerDetails(){
        $apiResponse = $this->profileApiService->getCustomerDetails();
        return response()->json($apiResponse);
    }

    public function getPaymentDetails(){
        $apiResponse = $this->paymentApiService->getPaymentDetails();
        return response()->json($apiResponse);
    }

    public function updateBillingDetails(Request $request){
        $formData = $request->all();
        $cartIds = json_decode($request->cart_ids);

        $formData['user_id'] = auth()->user()->id;
        $formData['is_shipping_address_available'] = isset($request->use_same_as_billing_address) ? 0 : 1;

        $apiResponse = $this->paymentApiService->updateBillingDetails($formData);
        return response()->json($apiResponse);
    }
}
