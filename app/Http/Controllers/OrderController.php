<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderApiService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderApiService;

    public function __construct(OrderApiService $orderApiService)
    {
        $this->orderApiService = $orderApiService;
    }

    public function storeOrder(Request $request){
        $formData = $request->all();
        $formData['order_payment_description'] = 'Encore Custom E-commerce Website';
        $apiResponse = $this->orderApiService->storeOrder($formData);
        if(isset($apiResponse['success']) && $apiResponse['success']){
            return redirect()->route('encorecustom_com')->with('success', 'Order placed successfully!');
        }else{
            return redirect()->back()->with('error', $apiResponse['message'] ?? 'Failed to place order!');
        }
    }
}
