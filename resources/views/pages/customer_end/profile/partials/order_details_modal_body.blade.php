<div class="modal_gray_card">
    <div class="row" style="margin: unset;">
        <div class="col-auto">
            <i class="fa-regular fas fa-file-zipper" style="color: white;"></i>
        </div>

        <div class="col-auto">
            <span class="font_12_white">Order #{{ $odHelper->order_number($order['id']) }}</span>
        </div>

        {{-- <div class="col-auto ml-auto">
            <span class="font_12_white"><i class="fa-solid fas fa-share" style="color: white;"></i> Share </span>
            <span class="font_12_white"> | </span>
            <span class="font_12_white"><i class="fa-solid fas fa-download" style="color: white;"></i> Download </span>
            <span class="font_12_white"> | </span>
            <span class="font_12_white"><i class="fa-solid fas fa-print" style="color: white;"></i> Print </span>
        </div> --}}
    </div>
</div>

<div style="padding-top: 25px; padding-bottom: 15px;">
    <div class="row" style="margin: unset;">
        <div class="col-lg-4">
            <div class="row" style="margin: unset;">
                <div class="col-lg-6">
                    <div class="modal_details_1">
                        <span>Billing Name:</span>
                    </div>
                    <div class="modal_details_1">
                        <span>Payment Method:</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="modal_details_2">
                        <span>{{ $order['user_details']['name'] ?? '' }}</span>
                    </div>
                    <div class="modal_details_2">
                        <span>{{ $order['payment_method_detail']['name'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" style="padding: unset;">
            <div class="row" style="margin: unset;">
                <div class="col-lg-5">
                    <div class="modal_details_1">
                        <span>Order Date:</span>
                    </div>
                    <div class="modal_details_1">
                        <span>Shipping Method:</span>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="modal_details_2">
                        <span>{{ $odHelper->order_date($order['created_at'], 'd M Y (h:i a)') }}</span>
                    </div>
                    <div class="modal_details_2">
                        <span>{{ $order['shipping_method_detail']['name'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row" style="margin: unset;">
                <div class="col-lg-6">
                    <div class="modal_details_1">
                        <span>Shipping Address: </span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="modal_details_2">
                        <span>{!! $odHelper->getOrderAddress($order) !!}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div style="padding: 20px 13px; overflow-x: auto; width: 100%;">
    <table class="table align-items-center" id="" style="min-width: 100%;">
        <thead style="background-color: #717070;">
            <th scope="col" class="modal_table_header_text"></th>
            <th scope="col" class="modal_table_header_text">Product</th>
            <th scope="col" class="modal_table_header_text">Color</th>
            <th scope="col" class="modal_table_header_text" style="text-align: right;">Size</th>
            <th scope="col" class="modal_table_header_text" style="text-align: right;">QTY</th>
            <th scope="col" class="modal_table_header_text" style="text-align: right;">Paid ($)</th>
        </thead>

        <tbody id="pending_orders">
            @php
                $totalQty = 0;
                $totalAmount = 0;
            @endphp
            @foreach ($order['order_items'] as $orderItem)
                @php
                    $totalQty = $totalQty + $orderItem['quantity'];
                    $totalAmount = $totalAmount + $orderItem['total_price'];
                @endphp
                <tr style="border-bottom: 1px solid #DEDEDE;">
                    <td scope="col" class="table_body_text_2">
                        @php
                            if ($orderItem['sub_product_detail']['display_main_image']) {
                                $imageUrl = $orderItem['sub_product_detail']['display_main_image'];
                            } else {
                                $imageUrl = asset('assets/product_img/test_product.png');
                            }
                        @endphp
                        <img src="{{ $imageUrl }}" alt="image"
                            style="object-fit: cover; border-radius: 8px; width: 40px; height: 40px;">
                    </td>
                    <td scope="col" class="table_body_text_2">{{ $orderItem['sub_product_detail']['display_product_name'] ?? '' }}</td>
                    <td scope="col" class="table_body_text_2">{{ $orderItem['color_detail']['pantone_code'] ?? '' }}</td>
                    <td scope="col" class="table_body_text_2" style="text-align: right;">
                        {{ $orderItem['size_detail']['size_name'] ?? '' }}
                    </td>
                    <td scope="col" class="table_body_text_2" style="text-align: right;">{{ $orderItem['quantity'] }}</td>
                    <td scope="col" class="table_body_text_2" style="text-align: right;">{{ $orderItem['total_price'] }}</td>
                </tr>
            @endforeach
            <tr style="border-bottom: 1px solid #DEDEDE;">
                <td scope="col" class="table_body_text_2" colspan="3"></td>
                <td scope="col" class="table_body_text_2" style="text-align: right;">Total</td>
                <td scope="col" class="table_body_text_2" style="text-align: right;">{{ $totalQty }}</td>
                <td scope="col" class="table_body_text_2" style="text-align: right;">
                    {{ number_format($totalAmount, 2) }}
                </td>
            </tr>

        </tbody>

    </table>
</div>
