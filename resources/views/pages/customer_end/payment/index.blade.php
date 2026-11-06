@extends('layouts.customer_end_layouts.app')

@section('content')


    <style>
        .top-navbar {
            background-color: white;
            z-index: 99;
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart_topic_text {
            font-size: 33px;
        }

        .cart_items {
            padding-top: 15px;
            padding-bottom: 15px !important;
            border-bottom: 1px solid rgb(231, 231, 231);
        }

        .cart_summary {
            max-width: 35%;
            width: 35%;
        }

        .text_input {
            font-size: 12px;
            border: 1px solid #DEDEDE !important;
            border-radius: 0rem !important;
            color: #717070 !important;
        }

        .text_input_div {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .form-field {
            display: flex;
            margin-bottom: 1rem;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
        }

        .form-lable {
            width: 12rem;
        }

        fieldset {
            min-width: 0px;
            margin: 0;
            padding: 1rem;
            border: 1px solid #e4e4e4;
        }

        legend {
            font-size: 0.8rem;
            font-weight: bold;
            line-height: inherit;
            display: block;
            width: 100%;
            max-width: 120px;
            margin-bottom: 0rem;
            padding: 0;
            white-space: normal;
            color: inherit;
            padding: .5rem;
        }

        .disclaimer {
            width: 100%;
            margin-bottom: 0rem;
            font-size: 14px;
            font-weight: bold;
        }

        .payment-status {
            font-size: 14px;
            color: #ffffff;
            text-align: center;
            padding: 0.1rem 1rem;
            width: 100px;
            text-transform: uppercase;
            float: right;
        }

        .uploaded-checks {
            width: 130px !important;
            height: 100px;
            overflow: hidden;
        }

        .uploaded-checks img {
            max-width: 100%;
            max-height: 100%;
        }

        .back-btn-div-position {
            padding: 0.5rem;
        }

        .btn-right {
            position: relative;
            right: 15px;
        }

        .back-btn-div {
            padding: 0.5rem;
            background-color: #787878;
            border-radius: 0.125rem;
            font-size: xx-small;
        }

        .content-div {
            position: relative;
            top: -20px;
        }

        .forPaymentStyles .nav-link2 {
            background-color: white !important;
            color: grey !important;
            font-weight: 600 !important;
            border: none !important;
            border-bottom: 2px solid #b3b3b3 !important;
        }

        .forPaymentStyles .nav-link2.active,
        .forPaymentStyles .nav-link2:hover {
            background-color: white !important;
            color: black !important;
            font-weight: 600 !important;
            border: none !important;
            border-bottom: 2px solid black !important;
        }

        .border-style {
            border: 1px solid #DEDEDE !important;
            border-radius: 0rem !important;
            color: #717070 !important;
        }

        .forPaymentStyles .form-control {
            border: 1px solid #DEDEDE;
            border-radius: 0rem !important;
            color: #717070 !important;
            padding-left: 7px !important;
            font-size: 0.8rem !important;
            height: calc(1.5rem + 1px) !important;
            margin-bottom: 0rem !important;
        }

        .forPaymentStyles label {
            margin-bottom: 0rem;
            color: black;
        }

        .header-style {
            color: black;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .forPaymentStyles .form-label {
            margin-top: 0.5rem;
            color: black;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .sub-header-style {
            color: black;
            font-size: .8rem;
            margin-top: 1rem;
            font-weight: 600;
        }

        .disabled-style {
            background-color: #F8F8F8;
            border: none !important;
            line-height: 14px;
        }

        .forPaymentStyles .custom-file-input-label:hover {
            border: 2px dashed #b3b3b3 !important;
        }

        .paymentSummaryTable thead tr {
            background-color: grey;
            color: white;
            height: 40px;
            font-size: .7rem;
        }

        .paymentSummaryTable tr {
            background-color: white;
            color: grey;
            min-height: 40px;
            font-size: .7rem;
            border-bottom: 1px solid #b3b3b3;
        }

        .paymentSummaryTable {
            width: 100%;
        }

        .paymentSummaryTable th,
        .paymentSummaryTable td {
            padding: 10px;
        }

        /* .save_continue_btn {
                padding-top: unset !important;
                padding-bottom: unset !important;
                padding-left: 5px !important;
                padding-right: 5px !important;
            } */

        .back_edit_btn {
            padding-top: unset !important;
            padding-bottom: unset !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
        }

        .details_card {
            padding: 10px;
            background-color: rgb(236, 236, 236);
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .completed-section {
            background-color: transparent !important;
            border: unset !important;
        }

        .card-radio-group {
            display: flex;
            gap: 15px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .card-radio-label {
            cursor: pointer;
            border: 2px solid #DEDEDE;
            border-radius: 6px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease-in-out;
            background-color: white;
            height: 55px;
            width: 100px;
            margin-bottom: 0 !important;
        }

        .card-radio-label img {
            height: 25px;
            width: auto;
            object-fit: contain;
        }

        .card-radio-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .card-radio-input:checked+.card-radio-label {
            border-color: #28a745;
            background-color: #f6fff8;
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.15);
        }

        .card-radio-input.is-invalid+.card-radio-label {
            border-color: #dc3545;
            background-color: #fff8f8;
        }

        .card-radio-input:hover:not(:checked)+.card-radio-label {
            border-color: #b3b3b3;
        }
    </style>

    <div class="col-lg-12 mt-4 forPaymentStyles" style="padding-top: 20px;">
        <div class="row" style="margin: unset;">
            <div class="col-md-9">
                <div class="card" style="border-radius: 0rem; border:none">
                    <div class="col-md-12 header-style mt-3 ml-3">
                        Payment Method
                    </div>
                    <div class="tab-container" style="width:100%;padding: 1rem; font-size: 0.8rem;">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link nav-link2 active" id="tab-card" data-toggle="tab"
                                    href="#card-tab">CARD</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">
                            <div class="tab-pane tab-pane2 active" id="card-tab" style="min-height: 30rem;">

                                <form id="payment_billing_info" method="post" action="#">
                                    @csrf

                                    <div class="row" style="padding-left: 15px;">
                                        <div class="col-md-12 header-style mt-2">
                                            Billing Details
                                        </div>
                                        <div class="col-md-12 customer-shipping-section mb-2 section_0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="first_name" class="form-label">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name"
                                                        name="first_name" value="" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="last_name" class="form-label">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                                        value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="address" class="form-label">Address <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="street" class="form-label">Street</label>
                                                    <input type="text" class="form-control" id="street" name="street"
                                                        value="" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="city" class="form-label">City <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="city" name="city" value=""
                                                        required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="state" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="state" name="state"
                                                        value="" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="country" class="form-label">Country <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="country" name="country"
                                                        value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="postal_code" class="form-label">Postal Code <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="postal_code"
                                                        name="postal_code" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="phone" class="form-label">Phone No <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="phone" name="phone"
                                                        maxlength="10" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="email" class="form-label">Email <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="" required />
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 header-style mt-2 section_0">
                                            Shipping Details
                                        </div>
                                        <div class="col-md-12 mt-2 section_0">
                                            <label class="mt-1"><strong>Select Shipping Method:</strong></label><br>
                                            <input class="form-check-input shipping-method-radio" type="radio"
                                                name="selected_shipping_method" id="shipping_method" value="">
                                            <label class="form-check-label" for="shipping_method">

                                            </label>

                                        </div> --}}
                                    </div>

                                    <div class="row" style="padding-left: 15px;">
                                        <div class="col-md-12 mt-4 section_0 same_as_billing_address">
                                            <input type="checkbox" name="use_same_as_billing_address"
                                                id="use_same_as_billing_address" checked>
                                            <lable class="form-label-info" for="use_same_as_billing_address"
                                                style="font-size: large;"><strong>&nbsp;Use billing address as Shipping
                                                    address</strong></lable>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-left: 15px; display: none;" id="shipping_address_row">
                                        <div class="col-md-12 header-style mt-2 shipping-details-area">
                                            Shipping Address
                                        </div>
                                        <div class="col-md-12 customer-shipping-section mb-2 section_1 shipping-details-area"
                                            style="display: ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="shipping_first_name" class="form-label">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="shipping_first_name"
                                                        name="shipping_first_name" value="" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="shipping_last_name" class="form-label">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="shipping_last_name"
                                                        name="shipping_last_name" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_address" class="form-label">Address <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="shipping_address"
                                                        name="shipping_address" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_street" class="form-label">Street</label>
                                                    <input type="text" class="form-control" id="shipping_street"
                                                        name="shipping_street" value="" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_city" class="form-label">City <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="shipping_city"
                                                        name="shipping_city" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_state" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="shipping_state"
                                                        name="shipping_state" value="" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_country" class="form-label">Country <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="shipping_country"
                                                        name="shipping_country" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_postal_code" class="form-label">Postal Code <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="shipping_postal_code"
                                                        name="shipping_postal_code" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_phone" class="form-label">Phone No <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="shipping_phone"
                                                        name="shipping_phone" maxlength="10" value="" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="shipping_email" class="form-label">Email <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="shipping_email"
                                                        name="shipping_email" value="" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-left: 15px;">
                                        <div class="col-md-12 ml-auto text-right">
                                            <button type="button"
                                                class="btn btn-success btn-custom mt-2 save_continue_btn">Save &
                                                Continue</button>
                                        </div>

                                    </div>
                                </form>

                                <form id="payment_card_info" method="post" action="{{ route('store_order') }}">
                                    @csrf
                                    <input type="hidden" id="cart_ids" name="cart_ids" value="{{ $cartItemIds }}">
                                    <input type="hidden" id="total_item_qty_original" name="total_item_qty" value="">
                                    <input type="hidden" id="sub_total_original" name="sub_total" value="">
                                    <input type="hidden" id="shipping_fee_original" name="shipping_fee" value="">
                                    <input type="hidden" id="shipping_fee_rate_original" name="shipping_fee_rate" value="">
                                    <input type="hidden" id="sales_tax_original" name="sales_tax" value="">
                                    <input type="hidden" id="sales_tax_rate_original" name="sales_tax_rate" value="">
                                    <input type="hidden" id="total_invoice_original" name="invoice_total" value="">
                                    <input type="hidden" id="other_fee_original" name="other_fee" value="">
                                    {{-- <input type="hidden" id="balance_invoice_original" name="balance_invoice" value="">
                                    --}}
                                    {{-- <input type="hidden" id="processing_fee_original" name="processing_fee" value="">
                                    --}}
                                    {{-- <input type="hidden" id="amount_to_pay_original" name="amount_to_pay" value="">
                                    --}}
                                    <input type="hidden" id="temp_billing_detail_id" name="temp_billing_detail_id" value="">

                                    <div class="row" style="padding-left: 15px;">

                                        <div class="col-md-12 row details_card mt-4" style=" margin: unset;">

                                            <div class="col-md-12 header-style mt-5"
                                                style="margin-top: .5rem!important; padding-left: unset;">
                                                Card Details
                                            </div>

                                            <div class="col-md-12" id="card_details_section" style="display:none;">
                                                <div class="row">
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" style="display: block;">Card Type <span
                                                                class="text-danger">*</span> <span class="pl-3 text-danger" id="card_type_error" style="display:none; font-weight: bold; font-size: 16px;">Please select a card type</span></label>
                                                        <div class="card-radio-group">
                                                            <input type="radio" id="card_type_visa" name="card_type"
                                                                value="1" class="card-radio-input" required>
                                                            <label for="card_type_visa" class="card-radio-label"
                                                                title="Visa">
                                                                <img src="{{asset('assets')}}/payments/visa.png" alt="Visa">
                                                            </label>

                                                            <input type="radio" id="card_type_mastercard" name="card_type"
                                                                value="2" class="card-radio-input" required>
                                                            <label for="card_type_mastercard" class="card-radio-label"
                                                                title="Mastercard">
                                                                <img src="{{asset('assets')}}/payments/mastercard.png"
                                                                    alt="Mastercard">
                                                            </label>

                                                            <input type="radio" id="card_type_american_express"
                                                                name="card_type" value="3" class="card-radio-input"
                                                                required>
                                                            <label for="card_type_american_express" class="card-radio-label"
                                                                title="American Express">
                                                                <img src="{{asset('assets')}}/payments/american_express.png"
                                                                    alt="American Express">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="card_holder_name" class="form-label">Name on Card <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="card_holder_name"
                                                            name="card_holder_name" value="{{ old('card_holder_name') }}"
                                                            placeholder="Card Owner's Name" required />
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0">
                                                        <label for="card_number" class="form-label">Card Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="card_number"
                                                            name="card_number" value="{{ old('card_number') }}"
                                                            placeholder="Card Number" required />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="card_expiry_month" class="form-label">Expiration Date
                                                            <span class="text-danger">*</span></label>
                                                        <div style="display: flex; width: 100%;">
                                                            <select class="form-control mr-2 pt-0 pb-0"
                                                                id="card_expiry_month" name="card_expiry_month"
                                                                placeholder="Month" required>
                                                                <option value="">MM</option>
                                                                @foreach($months as $k => $v)
                                                                    <option value="{{ $k }}" {{ old('card_expiry_month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                                @endforeach
                                                            </select>
                                                            <select class="form-control pt-0 pb-0" id="card_expiry_year"
                                                                name="card_expiry_year" placeholder="Year" required>
                                                                <option value="">YYYY</option>
                                                                @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" style="padding-left: 0">
                                                        <label for="card_csv" class="form-label">CSV: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" id="card_csv"
                                                            name="card_csv" value="{{ old('card_csv') }}" placeholder="CSV"
                                                            required />
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-lable">Invoice Amount ($): <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="balance_invoice_original" name="balance_invoice" readonly
                                                            value="" />
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-lable">Card Processing Fee (3%) ($):</label>
                                                        <input type="text" class="form-control" id="processing_fee_original"
                                                            name="processing_fee" value="" readonly />
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-lable">Payment Amount ($): <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control card_payment_amount"
                                                            id="amount_to_pay_original" name="amount_to_pay" value=""
                                                            readonly />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{-- <div class="col-lg-12 control-btns" style="background-color: white">
                                        <button style="display: none" type="submit" class="btn btn-success btn-custom"
                                            id="confirm-purchase-card">Confirm Payment</button>
                                    </div> --}}

                                    <div class="col-md-12 text-right" style="padding-right: 0px">
                                        <button type="button" class="btn btn-success btn-custom mt-2" id="pay_button"
                                            style="display: none;" onclick="submitCardForm()">CONFIRM & PAY</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}

            <div class="col-md-3 card tab-content" style="border: none;border-radius:0rem;min-height: 30rem;">
                <div class="tab-pane tab-pane2 active" id="card-tab" style="height: 100%;">
                    <div class="col-md-12 header-style mt-3" style="padding: 0">
                        Payment Summary
                    </div>
                    {{-- @if ($store->StoreAddedCoupons->count() > 0) --}}
                    <div class="col-md-12 mt-3" style="padding: 0">
                        <div class="input-group d-flex align-items-center position-relative">
                            <input type="text" id="coupon_code" name="coupon_code" class="form-control"
                                style="border: 1px solid #DEDEDE;height: calc(2rem + 1px) !important;"
                                placeholder="Enter Code" />

                            <button class="btn btn-secondary btn-custom m-2 coupon_apply_button"
                                style="padding: .1rem .7rem !important;" type="button">
                                Apply
                            </button>

                            <div id="coupon_error" class="invalid-feedback"
                                style="display:none; position:absolute; bottom:-12px; left:0; font-size: 12px;"></div>
                        </div>
                    </div>
                    {{-- @endif --}}
                    <div class="col-md-12 mt-3" style="padding: 0">
                        <table
                            style="color: #717070; font-size:.8rem;width:100%; line-height: 2;border-bottom:1px solid #b3b3b3">
                            <tr>
                                <td>Total item qty</td>
                                <td class="text-right" id="total_item_qty">0</td>
                            </tr>
                            <tr>
                                <td>Order item amount ($)</td>
                                <td class="text-right" id="sub_total_display">0.00</td>
                            </tr>
                            <tr>
                                <td>Sales tax fee <span id="sales_tax_rate_display">0%</span> ($)</td>
                                <td class="text-right" id="sales_tax_display">0.00</td>
                            </tr>
                            <tr>
                                <td>Shipping fee <span id="shipping_fee_rate_display">0</span>% ($)</td>
                                <td class="text-right" id="shipping_fee_td">0.00</td>
                            </tr>

                            <tr style="vertical-align: bottom;font-weight:700;height:40px">
                                <td>Total invoice amount ($)</td>
                                <td class="text-right" id="total_invoice_td">0.00</td>
                            </tr>
                            {{-- @if ($store->StoreAddedCoupons->count() > 0) --}}
                            <tr style="vertical-align: bottom;font-weight:700;color:#2ec49f99" id="coupon_tr"
                                class="d-none">
                                <td colspan="2" id="coupon_td"></td>
                            </tr>
                            {{-- @endif --}}

                            <tr style="height: 10px;"></tr>
                            <tr style="color: black;line-height: 1.5;border-top:1px solid #b3b3b3">
                                <td style="font-size: .8rem;font-weight: 600;">Balance invoice amount ($)</td>
                                <td style="font-size:16px; font-weight: 700;" class="text-right" id="balance_invoice_td">
                                    0.00</td>
                            </tr>
                            <tr>
                                <td>Processing fee 3% ($)</td>
                                <td class="text-right" id="processing_fee_td">0.00</td>
                            </tr>
                            <tr style="color: black;">
                                <td style="font-size: .8rem;font-weight: 600;">Total amount to pay ($)</td>
                                <td style="font-size:16px; font-weight: 700; color:red" id="amount_to_pay"
                                    class="text-right">0.00</td>

                                </td>
                            </tr>

                        </table>
                    </div>

                    <div class="col-md-12 form-field" style="padding: 0;">
                        <div class="row ml-1 mt-3" style="margin-bottom: 0rem !important;margin-right:2rem">
                            <div class="col-md-12 mt-3" style="padding: 0px">
                                <img src="{{asset('assets')}}/payments/visa.png" style="height: 25px;" />
                                <img src="{{asset('assets')}}/payments/mastercard.png" class="ml-1" style="height: 25px;" />
                                <img src="{{asset('assets')}}/payments/discover.png" class="ml-1" style="height: 25px;" />
                                <img src="{{asset('assets')}}/payments/american_express.png" class="ml-1"
                                    style="height: 25px;" />
                                <img src="{{asset('assets')}}/payments/venmo.png" class="ml-1" style="height: 25px;" />
                                <img src="{{asset('assets')}}/payments/paypal.png" class="ml-1" style="width: 50px;" />
                            </div>

                            <div class="col-md-12 mt-2" style="padding: 0px">
                                <p style="color: #5a5a5a;font-size:.7rem;line-height:1rem"><i style="color: blue"
                                        class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;<b
                                        style="font-weight: 700">DISCLAIMER</b> <br /> 3% processing fee will be added to
                                    all card payments.</p>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

            {{-- End Order Summary --}}
        </div>
    </div>

    <script>
        $(document).ready(function () {
            loadCustomerDetails();
            loadPaymentDetails();

            $('#use_same_as_billing_address').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#shipping_address_row').slideUp(300);
                    $('#shipping_address_row input').val('');
                } else {
                    $('#shipping_address_row').slideDown(300);
                }
            });
        });

        // Save & Continue button
        $('.save_continue_btn').on('click', function (e) {
            e.preventDefault();

            var currentSection = $('.section_0:visible');
            var shippingSection = $('.section_1:visible');
            var billingForm = $('#payment_billing_info:visible');
            var clickedButton = $(this);
            var cartIds = $('#cart_ids').val();

            var isValid = true;

            currentSection.each(function () {
                $(this).find('input, select').each(function () {

                    if (!this.checkValidity()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }

                });

            });

            if ($('#use_same_as_billing_address').is(':not(:checked)')) {
                shippingSection.each(function () {
                    $(this).find('input, select').each(function () {

                        if (!this.checkValidity()) {
                            $(this).addClass('is-invalid');
                            isValid = false;
                        } else {
                            $(this).removeClass('is-invalid');
                        }

                    });

                });
            }

            if (!isValid) {
                return;
            }

            var formData = billingForm.serialize();
            formData += '&cart_ids=' + cartIds;

            // $('.main-loading').fadeIn('slow');

            $.ajax({
                url: "{{ route('payment.update_billing_details') }}",
                method: 'POST',
                data: formData,
                success: function (response) {
                    // $('.main-loading').fadeOut('slow');
                    if (response.success) {
                        loadPaymentDetails();
                        $('#card_details_section').show();
                        $('#pay_button').show();
                        $('#temp_billing_detail_id').val(response.data.id);
                    } else {
                        Swal.fire({
                            position: 'top',
                            icon: 'warning',
                            title: response.message || 'There was an error, please try again.',
                            showConfirmButton: false,
                            timer: 2500,
                            toast: true
                        });
                    }
                },
                error: function (response) {
                    // $('.main-loading').fadeOut('slow');
                    // alert('There was an error, please try again.');
                    Swal.fire({
                        position: 'top',
                        icon: 'warning',
                        title: response.message || 'There was an error, please try again.',
                        showConfirmButton: false,
                        timer: 2500,
                        toast: true
                    });
                }
            });

        });

        $('.card-radio-input').on('click', function () {
            $('.card-radio-input').removeClass('is-invalid');
            $('#card_type_error').hide();
        });

        function loadCustomerDetails() {
            $.ajax({
                url: '{{ route("payment.get_customer_details") }}',
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    if (response && !$.isEmptyObject(response.data)) {
                        $('#first_name').val(response.data.first_name);
                        $('#last_name').val(response.data.last_name);
                        $('#address').val(response.data.address);
                        $('#street').val(response.data.street);
                        $('#city').val(response.data.city);
                        $('#state').val(response.data.state);
                        $('#country').val(response.data.country);
                        $('#postal_code').val(response.data.postal_code);
                        $('#phone').val(response.data.phone_number);
                        $('#email').val(response.data.user_detail.email);
                    } else {
                        Swal.fire({
                            position: 'top',
                            icon: 'warning',
                            title: response.message || 'There was an error, please try again.',
                            showConfirmButton: false,
                            timer: 2500,
                            toast: true
                        });
                    }
                }
            });
        }

        function loadPaymentDetails() {
            $.ajax({
                url: '{{ route("payment.get_payment_details") }}',
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        $('#total_item_qty').text(response.data.payment.total_item_qty);
                        $('#total_item_qty_original').val(response.data.payment.total_item_qty);

                        $('#sub_total_display').text(response.data.payment.sub_total);
                        $('#sub_total_original').val(response.data.payment.sub_total);

                        $('#sales_tax_display').text(response.data.sub_payment.sales_tax);
                        $('#sales_tax_original').val(response.data.sub_payment.sales_tax);

                        $('#sales_tax_rate_display').text(response.data.sub_payment.sales_tax_percentage);
                        $('#sales_tax_rate_original').val(response.data.sub_payment.sales_tax_rate);

                        $('#shipping_fee_td').text(response.data.sub_payment.shipping_fee);
                        $('#shipping_fee_original').val(response.data.sub_payment.shipping_fee);

                        $('#shipping_fee_rate_display').text(response.data.sub_payment.shipping_fee_percentage);
                        $('#shipping_fee_rate_original').val(response.data.sub_payment.shipping_fee_rate);

                        $('#total_invoice_td').text(response.data.payment.invoice_total);
                        $('#total_invoice_original').val(response.data.payment.invoice_total);

                        $('#other_fee_display').text(response.data.sub_payment.other_fee);
                        $('#other_fee_original').val(response.data.sub_payment.other_fee);

                        $('#balance_invoice_td').text(response.data.payment.balance_invoice);
                        $('#balance_invoice_original').val(response.data.payment.balance_invoice);
                        $('#payment_amount').val(response.data.payment.balance_invoice);

                        $('#processing_fee_td').text(response.data.payment.processing_fee);
                        $('#processing_fee_original').val(response.data.payment.processing_fee);
                        $('#card_processing_fee_to_pay').val(response.data.payment.processing_fee);

                        $('#amount_to_pay').text(response.data.payment.amount_to_pay);
                        $('#amount_to_pay_original').val(response.data.payment.amount_to_pay);
                        $('#amount').val(response.data.payment.amount_to_pay);
                    } else {
                        Swal.fire({
                            position: 'top',
                            icon: 'warning',
                            title: response.message || 'There was an error, please try again.',
                            showConfirmButton: false,
                            timer: 2500,
                            toast: true
                        });
                    }
                },
                error: function (response) {
                    // $('.main-loading').fadeOut('slow');
                    // alert('There was an error, please try again.');
                    console.log(response);

                    Swal.fire({
                        position: 'top',
                        icon: 'warning',
                        title: response.message || 'There was an error, please try again.',
                        showConfirmButton: false,
                        timer: 2500,
                        toast: true
                    });
                }
            });
        }

        function submitCardForm() {
            $('#pay_button').html('<div class="spinner-border text-black-50"></div>');
            $('#pay_button').prop('disabled', true);
            // $('.main-loading').fadeIn('slow');
            // $("#confirm-purchase-card").click();

            var paymentCardForm = $('#payment_card_info');
            var isValid = true;

            paymentCardForm.each(function () {
                $(this).find('input, select').each(function () {
                    if (!this.checkValidity()) {
                        $(this).addClass('is-invalid');
                        if($(this).attr('name') == "card_type"){
                            $('#card_type_error').show()
                        }
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                        if($(this).attr('name') == "card_type"){
                            $('#card_type_error').hide()
                        }
                    }
                });
            });

            if (!isValid) {
                $('#pay_button').html('CONFIRM & PAY');
                $('#pay_button').prop('disabled', false);
                return;
            }

            // $('.main-loading').fadeIn();
            paymentCardForm.submit();
        }
    </script>

@endsection
