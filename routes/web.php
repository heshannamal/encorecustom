<?php

use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::post('ajax-login', [App\Http\Controllers\Auth\CustomerAuthController::class, 'ajaxLogin'])->name('customer.login');
Route::post('ajax-register', [App\Http\Controllers\Auth\CustomerAuthController::class, 'ajaxRegister'])->name('customer.register');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::group(['middleware' => ['auth']], function () {
    Route::post('proceed_to_checkout', [App\Http\Controllers\PaymentController::class, 'proceedToCheckout'])->name('proceed_to_checkout');
    Route::get('cartPayment', [App\Http\Controllers\PaymentController::class, 'cartPayment'])->name('cartPayment');
    Route::get('payment/get_customer_details', [App\Http\Controllers\PaymentController::class, 'getCustomerDetails'])->name('payment.get_customer_details');
    Route::get('payment/get_payment_details', [App\Http\Controllers\PaymentController::class, 'getPaymentDetails'])->name('payment.get_payment_details');
    Route::post('payment/update_billing_details', [App\Http\Controllers\PaymentController::class, 'updateBillingDetails'])->name('payment.update_billing_details');

    Route::get('/profile_view', [App\Http\Controllers\ProfileController::class, 'profile_view'])->name('profile_view');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/get_customer_details', [App\Http\Controllers\ProfileController::class, 'get_customer_details'])->name('profile.get_customer_details');
    Route::get('/profile/order-history', [App\Http\Controllers\ProfileController::class, 'order_history'])->name('profile.order_history');
    Route::get('profile/get_order_history_data', [App\Http\Controllers\ProfileController::class, 'get_order_history_data'])->name('profile.get_order_history_data');
    Route::get('/profile/billing-payments', [App\Http\Controllers\ProfileController::class, 'billing_payments'])->name('profile.billing_payments');
    Route::get('/profile/get_order_payment_details', [App\Http\Controllers\ProfileController::class, 'get_order_payment_details'])->name('profile.get_order_payment_details');
    Route::get('/profile/gift-cards', [App\Http\Controllers\ProfileController::class, 'gift_cards'])->name('profile.gift_cards');
    Route::get('profile/get_order_by_id/{id}', [App\Http\Controllers\ProfileController::class, 'getOrderById'])->name('profile.get_order_by_id');
    Route::get('profile/get_receipt_details/{id}', [App\Http\Controllers\ProfileController::class, 'getReceiptDetails'])->name('profile.get_receipt_details');

    // Encore Custom Order - Store
    Route::post('store_order', [App\Http\Controllers\OrderController::class, 'storeOrder'])->name('store_order');
});

Route::get('countries/search', [App\Http\Controllers\CountryController::class, 'search'])->name('countries.search');

Route::get('/', [App\Http\Controllers\CustomerEndController::class, 'encorecustom_com'])->name('encorecustom_com');

Route::get('/team_page', [App\Http\Controllers\TeamPageController::class, 'team_page'])->name('team_page');
Route::get('/soccer', [App\Http\Controllers\TeamPageController::class, 'soccer'])->name('soccer');
Route::get('/basketball', [App\Http\Controllers\TeamPageController::class, 'basketball'])->name('basketball');
Route::get('/volleyball', [App\Http\Controllers\TeamPageController::class, 'volleyball'])->name('volleyball');
Route::get('/thai_mma', [App\Http\Controllers\TeamPageController::class, 'thai_mma'])->name('thai_mma');
Route::get('/baseball', [App\Http\Controllers\TeamPageController::class, 'baseball'])->name('baseball');
Route::get('/disc_golf', [App\Http\Controllers\TeamPageController::class, 'disc_golf'])->name('disc_golf');
Route::get('/water_sport', [App\Http\Controllers\TeamPageController::class, 'water_sport'])->name('water_sport');
Route::get('/gym', [App\Http\Controllers\TeamPageController::class, 'gym'])->name('gym');
Route::get('/yoga', [App\Http\Controllers\TeamPageController::class, 'yoga'])->name('yoga');

Route::get('/lifestyle_page', [App\Http\Controllers\LifestylePageController::class, 'lifestyle_page'])->name('lifestyle_page');

Route::get('/mens_page', [App\Http\Controllers\MensPageController::class, 'mens_page'])->name('mens_page');

Route::get('/mens_top_page', [App\Http\Controllers\MensPageController::class, 'mens_top_page'])->name('mens_top_page');
Route::get('/mens_bottom_page', [App\Http\Controllers\MensPageController::class, 'mens_bottom_page'])->name('mens_bottom_page');
Route::get('/mens_accessories_page', [App\Http\Controllers\MensPageController::class, 'mens_accessories_page'])->name('mens_accessories_page');

Route::get('/custom_apparel', [App\Http\Controllers\CustomApparelController::class, 'custom_apparel'])->name('custom_apparel');
Route::get('/design_concept', [App\Http\Controllers\CustomApparelController::class, 'design_concept'])->name('design_concept');

Route::get('customer_shop', [App\Http\Controllers\CustomerShopController::class, 'customer_shop'])->name('customer_shop');
Route::match(['get', 'post'],'product_filter', [App\Http\Controllers\CustomerShopController::class, 'productFilter'])->name('product_filter1');
Route::match(['get', 'post'], 'search', [App\Http\Controllers\CustomerShopController::class, 'productSearch'])->name('search.products');
Route::get('productDetails/{id}', [App\Http\Controllers\CustomerShopController::class, 'productDetails'])->name('product.show');
Route::get('filterEmbellishment', [App\Http\Controllers\CustomerShopController::class, 'filterEmbellishment'])->name('filterEmbellishment');
Route::get('getEmbellishmentDetails', [App\Http\Controllers\CustomerShopController::class, 'getEmbellishmentDetails'])->name('getEmbellishmentDetails');
Route::get('getFabricDetails', [App\Http\Controllers\CustomerShopController::class, 'getFabricDetails'])->name('getFabricDetails');
Route::get('getTaglineDetails', [App\Http\Controllers\CustomerShopController::class, 'getTaglineDetails'])->name('getTaglineDetails');
Route::get('getColorsBySize', [App\Http\Controllers\CustomerShopController::class, 'getColorsBySize'])->name('getColorsBySize');

Route::get('get_base64_image', [App\Http\Controllers\TestingController::class,'get_base64_image'])->name('get_base64_image');

Route::post('addToCart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart_page'])->name('cart_page');
Route::get('get_cart_items', [App\Http\Controllers\CartController::class, 'get_cart_items'])->name('get_cart_items');
Route::get('cart/edit/{id}', [App\Http\Controllers\CartController::class, 'edit'])->name('cart.edit');
Route::get('cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('cart/update_item/{id}', [App\Http\Controllers\CartController::class, 'updateCartById'])->name('cart.update_item');
Route::get('product/options/{id}', [App\Http\Controllers\CartController::class, 'getOptions'])->name('product.options');

Route::get('get_global_cart_count', [App\Http\Controllers\CartController::class, 'getGlobalCartCount'])->name('get_global_cart_count');
Route::get('global-cart-items', [App\Http\Controllers\CartController::class, 'global_cart_items'])->name('global.cart.items');

// Testing Routes
Route::get('/usps-test', function () {

    $response = Http::asForm()->post(
        config('services.usps.base_url').'/oauth2/v3/token',
        [
            'grant_type' => 'client_credentials',
            'client_id' => config('services.usps.consumer_key'),
            'client_secret' => config('services.usps.consumer_secret'),
        ]
    );

    dd(
        $response->status(),
        $response->body()
    );
});

Route::get('test_order_customer_mail/{orderId}', [App\Http\Controllers\TestingController::class, 'test_order_customer_mail']);
