<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderPaymentDetail;
use App\Models\Order;
use Carbon\Carbon;
use App\Traits\OrderHelper;

class PaymentsController extends Controller
{
    use OrderHelper;

    public function payments(){
        if (auth()->user()->can('manage payments')) {
            $paymentMethods = OrderPaymentDetail::select('transaction_account_type')
                ->distinct()
                ->whereNotNull('transaction_account_type')
                ->pluck('transaction_account_type');
            return view('pages.payments.index', compact('paymentMethods'));
        } else {
            return redirect()->back()->with('error', 'Permission Error!');
        }
    }

    public function getPayments(Request $request)
    {
        if (!auth()->user()->can('manage payments')) {
            return response()->json(['error' => 'Permission Error!'], 403);
        }

        $query = OrderPaymentDetail::with('order');

        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->has('status') && $request->status != 'all') {
            $query->whereHas('order', function ($q) use ($request) {
                $q->where('payment_status', $request->status);
            });
        }

        if ($request->has('payment_method') && $request->payment_method != 'all') {
            $query->where('transaction_account_type', $request->payment_method);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                  ->orWhere('transaction_account_type', 'LIKE', "%{$search}%")
                  ->orWhere('sub_total', 'LIKE', "%{$search}%")
                  ->orWhere('invoice_total', 'LIKE', "%{$search}%");
            });
        }

        $query->orderBy('created_at', 'desc');
        
        $payments = $query->paginate(10);
        
        $data = [];
        foreach($payments as $payment) {
            $order = $payment->order;
            
            // Map payment_status
            $status_name = 'Pending';
            $status_class = 'pending_card';
            
            if($order) {
                if ($order->payment_status == 1) {
                    $status_name = 'Paid';
                    $status_class = 'withdrawn_card'; // Paid / Withdrawn colored styling
                } elseif ($order->payment_status == 2) {
                    $status_name = 'Failed';
                    $status_class = 'pending_card';
                }
            }

            $payment_method_val = $payment->transaction_account_type ?: 'Unknown';
            $payment_method_img = '';
            
            if (stripos($payment_method_val, 'visa') !== false) {
                $payment_method_img = '<img src="'.asset('assets/payments/visa_card.png').'" alt="Visa" style="width: 18px; margin-right:5px;"> Visa';
            } elseif (stripos($payment_method_val, 'master') !== false) {
                $payment_method_img = '<img src="'.asset('assets/payments/master_card.png').'" alt="Mastercard" style="width: 18px; margin-right:5px;"> Mastercard';
            } elseif (stripos($payment_method_val, 'american_express') !== false) {
                $payment_method_img = '<img src="'.asset('assets/payments/american_express.png').'" alt="American Express" style="width: 18px; margin-right:5px;"> American Express';
            } else {
                $payment_method_img = htmlspecialchars($payment_method_val);
            }

            $date = Carbon::parse($payment->created_at)->format('d M, Y');
            
            // Format amounts
            $shipping_fee = $order && $order->shipping_fee ? '$' . number_format($order->shipping_fee, 2) : '-';
            $tax = $order && $order->sales_tax ? '$' . number_format($order->sales_tax, 2) : '-';

            $data[] = [
                'date' => $date,
                'status_html' => '<span class="'. $status_class .'">' . $status_name . '</span>',
                'order_id' => $payment->order_id,
                'order_number' => '#' . $this->order_number($payment->order_id),
                'payment_method' => $payment_method_img,
                'sub_total' => '$' . number_format($payment->sub_total, 2),
                'shipping_fee' => '$' . number_format($payment->shipping_fee, 2),
                'tax' => '$' . number_format($payment->sales_tax, 2),
                'invoice_total' => '$' . number_format($payment->invoice_total, 2),
                'processing_fee' => '$' . number_format($payment->processing_fee, 2),
                'paid_amount' => '$' . number_format($payment->paid_amount, 2),
            ];
        }

        return response()->json([
            'data' => $data,
            'current_page' => $payments->currentPage(),
            'last_page' => $payments->lastPage(),
            'total' => $payments->total()
        ]);
        
    }
}
