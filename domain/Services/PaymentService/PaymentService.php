<?php

namespace domain\Services\PaymentService;

use App\Models\Order;
use App\Models\OrderBillingDetail;
use App\Models\OrderPaymentDetail;
use App\Models\SalesChannel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PaymentService
{
    protected $order;
    protected $order_billing_detail;
    protected $order_payment_detail;

    public function __construct()
    {
        $this->order = new Order();
        $this->order_billing_detail = new OrderBillingDetail();
        $this->order_payment_detail = new OrderPaymentDetail();
    }

    public function checkCardAvailability($payment_details)
    {
        $gateway = getPaymentGatewayConfig();

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($gateway['login_id']);
        $merchantAuthentication->setTransactionKey($gateway['transaction_key']); 

        $cardNumber = preg_replace('/\s+/', '', $payment_details['card_number']);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($payment_details['card_expiry_year'] . "-" . $payment_details['card_expiry_month']);
        $creditCard->setCardCode($payment_details['card_csv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType for an Auth Only transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authOnlyTransaction");
        
        $amount = $payment_details['amount_to_pay'];
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId('ref' . time());
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse($gateway['environment']);

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();

            if ($response->getMessages()->getResultCode() == "Ok") {
                if ($tresponse != null && $tresponse->getMessages() != null) {
                    return [
                        'status' => 'success', 
                        'message' => 'Card is valid and has sufficient balance.', 
                        'transaction_id' => $tresponse->getTransId()
                    ];
                } else {
                    $error_message = 'Transaction Failed';
                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $error_message = $tresponse->getErrors()[0]->getErrorText();
                    }
                    return ['status' => 'error', 'message' => $error_message];
                }
            } else {
                $error_message = 'Card validation failed.';
                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $error_message = $tresponse->getErrors()[0]->getErrorText();
                } else {
                    if ($response->getMessages() != null && $response->getMessages()->getMessage() != null) {
                        $error_message = $response->getMessages()->getMessage()[0]->getText();
                    }
                }
                return ['status' => 'error', 'message' => $error_message];
            }
        } else {
            return ['status' => 'error', 'message' => 'No response received from the payment gateway.'];
        }
    }

    public function proceedOnlinePayment($payment_details, $order_detail)
    {
        $gateway = getPaymentGatewayConfig();

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($gateway['login_id']);
        $merchantAuthentication->setTransactionKey($gateway['transaction_key']);

        /* Sandbox Payment Gateway Credentials (Commented out)
        $merchantAuthentication->setName('8pB92xhZck');
        $merchantAuthentication->setTransactionKey('3473R69RQj3f3UnV');
*/
        /* Live Payment Gateway Credentials (Commented out) */
        // $merchantAuthentication->setName('2gEXK4Vvt54');
        // $merchantAuthentication->setTransactionKey('9X8bxT5z9U45uDCT');


        // Set transaction reference ID
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $payment_details['card_number']);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($payment_details['card_expiry_year'] . "-" . $payment_details['card_expiry_month']);
        $creditCard->setCardCode($payment_details['card_csv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($order_detail->id);
        $order->setDescription("Online Order #".$order_detail->id." Payment");

        // Fetch customer details
        $orderBilling = $this->order_billing_detail->where('order_id', $order_detail->id)->first();

        if (!$orderBilling) {
            return response()->json(['message' => 'Customer billing details not found.', 'status' => 'error']);
        }

        // Set Billing Address
        $orderBillingAddress = new AnetAPI\CustomerAddressType();
        $orderBillingAddress->setFirstName($orderBilling->first_name);
        $orderBillingAddress->setLastName($orderBilling->last_name);
        $orderBillingAddress->setAddress($orderBilling->street ? $orderBilling->address.', '.$orderBilling->street : $orderBilling->address);
        $orderBillingAddress->setCity($orderBilling->city);
        $orderBillingAddress->setState($orderBilling->state);
        $orderBillingAddress->setZip($orderBilling->postal_code);
        $orderBillingAddress->setCountry($orderBilling->country);
        $orderBillingAddress->setPhoneNumber($orderBilling->phone_number);

        if($orderBilling->is_shipping_address_available == 1){
            $shippingDetails['first_name'] = $orderBilling->shipping_first_name ?? null;
            $shippingDetails['last_name'] = $orderBilling->shipping_last_name ?? null;
            $shippingDetails['address'] = $orderBilling->shipping_street ? $orderBilling->shipping_address.', '.$orderBilling->shipping_street : $orderBilling->shipping_address;
            $shippingDetails['city'] = $orderBilling->shipping_city ?? null;
            $shippingDetails['state'] = $orderBilling->shipping_state ?? null;
            $shippingDetails['country'] = $orderBilling->shipping_country ?? null;
            $shippingDetails['postal_code'] = $orderBilling->shipping_postal_code ?? null;
            $shippingDetails['phone_number'] = $orderBilling->shipping_phone_number ?? null;
        } else {
            $shippingDetails['first_name'] = $orderBilling->first_name ?? null;
            $shippingDetails['last_name'] = $orderBilling->last_name ?? null;
            $shippingDetails['address'] = $orderBilling->street ? $orderBilling->address.', '.$orderBilling->street : $orderBilling->address;
            $shippingDetails['city'] = $orderBilling->city ?? null;
            $shippingDetails['state'] = $orderBilling->state ?? null;
            $shippingDetails['country'] = $orderBilling->country ?? null;
            $shippingDetails['postal_code'] = $orderBilling->postal_code ?? null;
            $shippingDetails['phone_number'] = $orderBilling->phone_number ?? null;
        }

        // Set Shipping Address
        $customerShipping = new AnetAPI\CustomerAddressType();
        $customerShipping->setFirstName($shippingDetails['first_name']);
        $customerShipping->setLastName($shippingDetails['last_name']);
        $customerShipping->setAddress($shippingDetails['address']);
        $customerShipping->setCity($shippingDetails['city']);
        $customerShipping->setState($shippingDetails['state']);
        $customerShipping->setZip($shippingDetails['postal_code']);
        $customerShipping->setCountry($shippingDetails['country']);
        $customerShipping->setPhoneNumber($shippingDetails['phone_number']);

        // Customer Data
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId(auth()->user()->id);
        $customerData->setEmail(auth()->user()->email);

        // Create Transaction Request
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($payment_details['amount_to_pay']);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($orderBillingAddress);
        $transactionRequestType->setShipTo($customerShipping);
        $transactionRequestType->setCustomer($customerData);

        // Assemble Transaction Request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Execute API Call
        $controller = new AnetController\CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse($gateway['environment']); // SANDBOX PRODUCTION

        $order_payment = $this->order_payment_detail;

        $order_payment->order_id = $order_detail->id;
        $order_payment->order_billing_detail_id = $orderBilling->id;
        $order_payment->card_type_id = $payment_details['card_type'];
        $order_payment->card_holder_name = $payment_details['card_holder_name'];
        $order_payment->card_number = Hash::make($payment_details['card_number']);
        $order_payment->card_last_four_digit = substr($payment_details['card_number'], -4);
        $order_payment->card_expiry_month = $payment_details['card_expiry_month'];
        $order_payment->card_expiry_year = $payment_details['card_expiry_year'];
        $order_payment->card_csv = Hash::make($payment_details['card_csv']);
        $order_payment->sub_total = $payment_details['sub_total'];
        $order_payment->shipping_fee = $payment_details['shipping_fee'];
        $order_payment->invoice_total = $payment_details['invoice_total'];
        $order_payment->processing_fee = $payment_details['processing_fee'];
        $order_payment->paid_amount = $payment_details['amount_to_pay'];
        $order_payment->transaction_response_code = 0;
        $order_payment->save();

        $paymentReceiptData = [
            'order_id' => $order_detail->id,
            'customer_id' => $orderBilling->id,
            'transaction_record_id' => $order_payment->id,
        ];


        if ($response != null) {
            if ($response->getMessages()->getResultCode() == "Ok") {
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    // Payment Success
                    $message_text = $tresponse->getMessages()[0]->getDescription() . "Order #: " . $order_detail->id;

                    $order_payment->transaction_id = $tresponse->getTransId();
                    $order_payment->transaction_account_number = $tresponse->getAccountNumber();
                    $order_payment->transaction_account_type = $tresponse->getAccountType();
                    $order_payment->transaction_response_code = $tresponse->getResponseCode();
                    $order_payment->update();

                    $order_detail->update(['payment_status' => 1]);

                    // $this->emailPaymentReceipt($paymentReceiptData);

                    // return response()->json(['message' => $message_text, 'status' => 'success']);
                    return ['message' => $message_text, 'status' => 'success'];

                } else {
                    $order_payment->transaction_id = $tresponse->getTransId();
                    $order_payment->transaction_response_code = $tresponse->getResponseCode();
                    $order_payment->update();

                    // Failed Transaction
                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                    }
                    // return response()->json(['message' => $message_text, 'status' => 'error']);
                    return ['message' => $message_text, 'status' => 'error'];

                }
            } else {
                // API Error
                $message_text = 'Payment gateway error, please try again.';
                $tresponse = $response->getTransactionResponse();

                $order_payment->transaction_id = $tresponse->getTransId();
                $order_payment->transaction_response_code = $tresponse->getResponseCode();
                $order_payment->update();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                }
                // return response()->json(['message' => $message_text, 'status' => 'error']);
                return ['message' => $message_text, 'status' => 'error'];
            }
        } else {
            // No Response from API
            $message_text = "No response from payment gateway.";
            // return response()->json(['message' => $message_text, 'status' => 'error']);
            return ['message' => $message_text, 'status' => 'error'];
        }
    }
}

