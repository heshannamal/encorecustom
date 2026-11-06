<?php
namespace App\Services;

use App\Models\EmailTemplate;
use App\Models\EmailTemplateUser;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Organization;
use App\Models\UserLeave;
use App\Models\Project;
use App\Models\PmSectionDiscussion;
use App\Models\PmSectionSubDiscussion;
use App\Models\Store;
use Illuminate\Support\Facades\Blade;


class EmailNotificationBuilderService{

    // var $smptEncryption = 'SSL';
    // var $smptPort = '465';
    // var $smptHost = 'mail.encr.co';
    // var $username = 'info@encr.co';
    // var $password = 'Encr.co@ec123';
    // var $fromAddress = 'info@encr.co';

    public function sendEmailFromTemplate(string $templateId, array $replacements): bool
    {
        // config(['mail.mailers.smtp.transport' => 'smtp']);
        // config(['mail.mailers.smtp.host' => $this->smptHost]);
        // config(['mail.mailers.smtp.port' => $this->smptPort]);
        // config(['mail.mailers.smtp.encryption' => $this->smptEncryption]);

        // config(['mail.mailers.smtp.username' => $this->username]);
        // config(['mail.mailers.smtp.password' => $this->password]);
        
        // config(['mail.from.address' => $this->fromAddress]);
        // config(['mail.from.name' => 'Encore Custom']);
        $template = EmailTemplate::where('key', $templateId)->first();
        if (!$template) {
            \Log::warning("Email template ID {$templateId} not found.");
            return false;
        }
        if ($template->is_active != 1) {
            return true; // Notification disabled
        }

        $to = EmailTemplateUser::getEmailsByType($template->id, 0);
        $cc = EmailTemplateUser::getEmailsByType($template->id, 1);
        $bcc = EmailTemplateUser::getEmailsByType($template->id, 2);

        if (isset($replacements['orderId'])) {
            $order = Order::with([
                'orderItems.subProductDetail',
                'orderItems.colorDetail',
                'orderItems.sizeDetail',
                'userDetails',
                'paymentMethodDetail',
                'shippingMethodDetail',
                'orderBillingDetail',
                'orderPaymentDetail'
            ])->find($replacements['orderId']);

            if ($order) {
                // Determine customer email
                $customerEmail = null;
                if ($order->orderBillingDetail) {
                    $customerEmail = $order->orderBillingDetail->email ?? $order->orderBillingDetail->shipping_email;
                }
                if (!$customerEmail && $order->userDetails) {
                    $customerEmail = $order->userDetails->email;
                }
                if ($customerEmail) {
                    if ($template->is_custom_to == 1) {
                        $to = array_unique(array_merge($to, [$customerEmail]));
                    }
                    if ($template->is_custom_cc == 1) {
                        $cc = array_unique(array_merge($cc, [$customerEmail]));
                    }
                    if ($template->is_custom_bcc == 1) {
                        $bcc = array_unique(array_merge($bcc, [$customerEmail]));
                    }
                }

                // Format shipping address
                $shippingAddress = '';
                if ($order->orderBillingDetail) {
                    $ob = $order->orderBillingDetail;
                    if ($ob->is_shipping_address_available == 1) {
                        $shippingAddress = ($ob->shipping_first_name ?? '') . ' ' . ($ob->shipping_last_name ?? '') . '<br>' .
                                           ($ob->shipping_address ?? '') . ($ob->shipping_street ? ', ' . $ob->shipping_street : '') . '<br>' .
                                           ($ob->shipping_city ?? '') . ', ' . ($ob->shipping_state ?? '') . ' ' . ($ob->shipping_postal_code ?? '') . '<br>' .
                                           ($ob->shipping_country ?? '') . '<br>Phone: ' . ($ob->shipping_phone ?? $ob->shipping_phone_number ?? '');
                    } else {
                        $shippingAddress = ($ob->first_name ?? '') . ' ' . ($ob->last_name ?? '') . '<br>' .
                                           ($ob->address ?? '') . ($ob->street ? ', ' . $ob->street : '') . '<br>' .
                                           ($ob->city ?? '') . ', ' . ($ob->state ?? '') . ' ' . ($ob->postal_code ?? '') . '<br>' .
                                           ($ob->country ?? '') . '<br>Phone: ' . ($ob->phone ?? $ob->phone_number ?? '');
                    }
                } else {
                    $shippingAddress = ($order->userDetails->name ?? '') . '<br>' .
                                       ($order->shipping_address ?? '') . ($order->shipping_street ? ', ' . $order->shipping_street : '') . '<br>' .
                                       ($order->shipping_city ?? '') . ', ' . ($order->shipping_state ?? '') . ' ' . ($order->shipping_postal_code ?? '') . '<br>' .
                                       ($order->shipping_country ?? '') . '<br>Phone: ' . ($order->shipping_phone ?? '');
                }

                // Add values to replacements
                $replacements = array_merge([
                    'order' => $order,
                    'orderItems' => $order->orderItems,
                    'orderNo' => sprintf('%04d', $order->id),
                    'customerName' => $order->orderBillingDetail ? ($order->orderBillingDetail->first_name . ' ' . $order->orderBillingDetail->last_name) : ($order->userDetails->name ?? 'Customer'),
                    'customerEmail' => $customerEmail ?? 'N/A',
                    'paymentMethod' => $order->paymentMethodDetail->name ?? 'Credit Card',
                    'shippingMethod' => $order->shippingMethodDetail->name ?? 'Standard Shipping',
                    'fulfilmentStatus' => $order->fulfillment_status == 1 ? 'COMPLETE' : 'PROCESSING',
                    'date' => $order->created_at->format('d M Y, h:i a'),
                    'transactionId' => $order->orderPaymentDetail->transaction_id ?? 'N/A',
                    'subTotal' => number_format($order->sub_total, 2),
                    'tax' => number_format($order->sales_tax, 2),
                    'shipping' => number_format($order->shipping_fee, 2),
                    'otherFees' => number_format($order->other_fee, 2),
                    'discount' => number_format($order->discount_amount, 2),
                    'amountToPay' => number_format($order->invoice_total, 2),
                    'paidAmount' => number_format($order->paid_amount, 2),
                    'processingFee' => number_format($order->processing_fee, 2),
                    'totalPaid' => number_format(($order->orderPaymentDetail->paid_amount ?? $order->paid_amount), 2),
                    'shippingAddress' => $shippingAddress,
                ], $replacements);
            }
        }

        // Replace placeholders
        $subject = Blade::render($template->subject, $replacements);

        if(isset($replacements['custom_email']) && !empty($replacements['custom_email'])){
            $Customsettings = json_decode($template->custom_email, true);
            if(isset($Customsettings['to']['custom_email']) && $Customsettings['to']['custom_email'] == 1){
                $customToArray = $replacements['custom_email']['to'];
                if (!empty($customToArray)) {
                    $to = array_unique(array_merge($to, $customToArray));
                }
            }
            if(isset($Customsettings['cc']['custom_email']) && $Customsettings['cc']['custom_email'] == 1){
                $customCcArray = $replacements['custom_email']['cc'];
                if (!empty($customCcArray)) {
                    $cc = array_unique(array_merge($cc, $customCcArray));
                }
            }
            if(isset($Customsettings['bcc']['custom_email']) && $Customsettings['bcc']['custom_email'] == 1){
                $customBccArray = $replacements['custom_email']['bcc'];
                if (!empty($customBccArray)) {
                    $bcc = array_unique(array_merge($bcc, $customBccArray));
                }
            }
        }

            if (empty($to)) {
                \Log::warning("No 'To' recipients found for template ID {$templateId}.");
            }

            try {

                \Mail::send([], [], function ($message) use ($to, $cc, $bcc, $subject, $template, $replacements) {
                    $message->to($to);

                    if (!empty($cc)) {
                        $message->cc($cc);
                    }
                    if (!empty($bcc)) {
                        $message->bcc($bcc);
                    }
                    $message->subject($subject);

                    $replacements['message'] = $message;
                    $body = Blade::render($template->body, $replacements);
                    $message->html($body);
                });

                return true;
            } catch (\Exception $e) {

                \Log::error("Failed to send email for template {$templateId}: " . $e->getMessage());
                return false;
            }
        // }
    }

    protected function applyReplacements(string $text, array $replacements): string
    {
        foreach ($replacements as $placeholder => $value) {
            $text = str_replace($placeholder, $value, $text);
        }
        return $text;
    }

}
