@extends('layouts.customer_end_layouts.app')

@section('content')

    <style>
        .card_padding {
            padding: 10px 10px;
        }

        .card_div {
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            position: relative;
        }

        .cart-remove-btn {
            position: absolute;
            top: 10px;
            left: 96%;
            font-size: 22px;
            color: #999;
            text-decoration: none;
            font-weight: bold;
            width: auto;
            z-index: 1;
        }

        .cart-remove-btn:hover {
            color: red;
        }

        .qty-btn {
            width: 25px;
            height: 25px;
            border: unset;
            font-weight: bold;
            background-color: rgb(193, 193, 193);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            line-height: 1;
            color: white;
            border-radius: 3px;
        }

        .qty-btn:hover {
            background: #e2e2e2;
        }

        .qty-input {
            width: 50px;
            /* height: 35px; */
            border: 1px solid #ddd;
            margin: 0 5px;
            font-weight: 600;
            font-size: 14px;
            color: #333f48;
        }

        .product_name {
            color: gray;
            font-weight: 600;
        }

        .default_price {
            /* padding-left: 10px; */
            font-size: 13px;
            color: rgb(166, 166, 166);
        }
        .default_price_topic {
            font-size: 16px;
            color: #4c4a4a;
            font-weight: 600;
        }

        .amount_qty {
            padding-left: 10px;
            font-size: 13px;
            color: rgb(166, 166, 166);
        }

        .size_badge {
            background-color: transparent !important;
            color: gray;
            /* border: 1px solid #333f48; */
            border-radius: 3px;
        }

        .size_badge {
            /* cursor: pointer;
                    padding: 5px 10px;
                    border-radius: 4px;
                    user-select: none; */
        }

        .size_badge.selected {
            /* background-color: #333f48 !important; */
            color: gray;
        }

        .card_div {
            display: flex;
            flex-wrap: wrap;
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            position: relative;
        }

        .card_div>.col-lg-2,
        .card_div>.col-lg-9 {
            padding: 5px;
        }

        /* Image column */
        .card_div>.col-lg-2 {
            flex: 0 0 140px;
            /* fixed image width */
            max-width: 140px;
        }

        /* Info column */
        .card_div>.col-lg-9 {
            /* flex: 1 1 auto; */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card_div {
                flex-direction: column;
                align-items: flex-start;
            }

            .card_div>.col-lg-2,
            .card_div>.col-lg-9 {
                flex: 1 1 100%;
                max-width: 100%;
            }

            .qty_div .mt-1 {
                flex-wrap: wrap;
            }

            .fit-sizes {
                justify-content: flex-start;
            }
        }

        /* Very small screens */
        @media (max-width: 480px) {
            .qty-btn {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }

            .qty-input {
                width: 60px;
            }

            .size_badge {
                /* padding: 4px 8px; */
                font-size: 12px;
            }

            .total_amount .col-auto {
                font-size: 13px;
            }
        }

        .check_out_button {
            background-color: #333f48;
            border: 1px solid #333f48;
            border-radius: 3px;
            padding: 7px 20px;
            color: white;
            transition: all 0.3s;
        }

        .check_out_button:hover:not(:disabled) {
            background-color: white;
            color: #333f48;
        }

        .check_out_button:disabled {
            background-color: #cccccc;
            border-color: #cccccc;
            cursor: not-allowed;
        }

        .item-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .grand_total_div {
            background-color: white;
            padding: 20px;
            border-radius: 4px;
            margin-top: 20px;
            border: 1px solid #eee;
        }

        .summary-table th {
            background-color: #f8f9fa;
        }

        .size_text {
            color: rgb(63, 204, 171);
            font-size: 15px;
        }

        .each_topic {
            font-size: 14px;
            color: gray;
            font-weight: 600;
        }

        /* ============================= */
        /* CART RESPONSIVE IMPROVEMENTS */
        /* ============================= */

        /* card layout */

        .cart-card-flex {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 20px;
            border-top: 1px solid rgb(231, 231, 231);
        }

        /* image column */

        .cart-img-col {
            flex: 0 0 140px;
            max-width: 140px;
        }

        .cart-img-col img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* product details */

        .cart-info-col {
            flex: 1;
            min-width: 250px;
        }

        /* product info grid */

        .cart-info-grid {
            display: grid;
            grid-template-columns: auto auto auto auto;
            gap: 40px;
            align-items: center;
            width: 100%;
            margin-top: 8px;
        }

        /* info boxes */

        .cart-info-grid .info-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* qty alignment */

        .cart-info-grid .qty_div {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* product name spacing */

        .product_name {
            font-size: 15px;
            margin-bottom: 8px;
        }

        /* remove button fix */

        .cart-remove-btn {
            right: 10px;
            left: auto;
        }

        /* ============================= */
        /* TABLET RESPONSIVE */
        /* ============================= */

        @media (max-width:992px) {

            .cart-info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }

        }

        /* ============================= */
        /* MOBILE RESPONSIVE */
        /* ============================= */

        @media (max-width:576px) {

            .cart-card-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-img-col {
                width: 100%;
                max-width: 200px;
            }

            .cart-img-col img {
                max-width: 200px;
            }

            .cart-info-col {
                width: 100%;
            }

            .cart-info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                width: 100%;
            }

            .qty-btn {
                width: 30px;
                height: 30px;
                font-size: 16px;
            }

            .qty-input {
                width: 55px;
            }

            .product_name {
                font-size: 14px;
            }

        }

        .price_card {
            padding: 5px;
            padding-left: 10px;
            background-color: rgb(241, 241, 241);
            border: unset;
            padding-top: 10px;
            padding-bottom: 20px;
        }

        .price_card_row {
            padding-top: 5px;
            margin: unset;
            padding-right: 5px;
        }

        .gray_font {
            font-size: 12px;
            color: gray;
        }

        .cart-edit-btn {
            position: absolute;
            top: 10px;
            right: 40px;
            font-size: 12px;
            color: #999;
            text-decoration: none;
            z-index: 1;
            text-align: right;
            padding-top: 8px;
        }

        .cart-edit-btn:hover {
            color: #333f48;
        }
    </style>


    <div class="col-lg-12" style="padding: 10px 40px; background-color: white;">
        <div class="row" style="margin: unset;">
            <div class="col-lg-9">
                <b class="cart_topic_text">Your Shopping Cart</b><br>

                <div id="cart-products-container">
                    <div class="text-center py-5">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3" style="padding-top: 30px;">
                <div class="card price_card ">
                    <b>Order Summary</b>

                    <div class="row price_card_row">
                        <div class="col-auto" style="padding-top: 10px;">
                            <span class="sub_total_cart_count gray_font ">Sub Total</span>
                        </div>
                        <div class="ml-auto col-auto" style="padding-top: 10px; text-align: right;">
                            <span id="sub_total" class="gray_font ">0.00</span>
                        </div>
                    </div>

                    <div class="row price_card_row">
                        <div class="col-auto" style="">
                            <span class=" gray_font ">Sales tax fee % ($)</span>
                        </div>
                        <div class="ml-auto col-auto" style="text-align: right;">
                            <span id="sales_tax_rate" class="gray_font ">--</span>
                        </div>
                    </div>

                    <div class="row price_card_row">
                        <div class="col-auto" style="">
                            <span class=" gray_font ">Shipping fee ($)</span>
                        </div>
                        <div class="ml-auto col-auto" style="text-align: right;">
                            <span id="shipping_fee" class="gray_font ">--</span>
                        </div>
                    </div>

                    <div class="row price_card_row">
                        <div class="col-auto" style="">
                            <span class="default_price_topic">Estimated Total ($)</span>
                        </div>
                        <div class="ml-auto col-auto" style="text-align: right;">
                            <span id="estimate_total" class="default_price_topic">0.00</span>
                        </div>
                    </div>

                    <div style="padding-top: 20px; text-align: center; padding-bottom: 20px;">
                        <button class="btn btn-success checkout_enabled" type="button"
                            style=" border: unset; width: 92%; background-color: rgb(63, 204, 171);"
                            id="checkoutBtn">Proceed to Checkout</button>
                    </div>

                    <div class="row" style="margin: unset;">
                        <div>
                            <img src="{{ asset('assets') }}/img/Cart/status_icon.png" alt="image" style="width: 16px;">
                        </div>
                        <div style="width: 60%; padding-left: 7px;">
                            <span style="font-weight: 600;">Disclaimer</span>
                        </div>
                        <div style="padding-left: 23px;">
                            <span class="gray_font ">3% additional charge will be added to all card payments.</span>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3" style="padding: 0px; padding-left: 23px;">
                        <img src="{{asset('assets')}}/payments/visa.png" style="height: 25px;" />
                        <img src="{{asset('assets')}}/payments/mastercard.png" class="ml-1" style="height: 25px;" />
                        <img src="{{asset('assets')}}/payments/discover.png" class="ml-1" style="height: 25px;" />
                        <img src="{{asset('assets')}}/payments/american_express.png" class="ml-1" style="height: 25px;" />
                        <img src="{{asset('assets')}}/payments/venmo.png" class="ml-1" style="height: 25px;" />
                        <img src="{{asset('assets')}}/payments/paypal.png" class="ml-1" style="width: 50px;" />
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-12 grand_total_div">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="mb-0">Selected Items Total: <span id="grand_total">$0.00</span></h4>
                    </div>
                    <div class="col-lg-6 text-end">
                        <button class="check_out_button" id="checkoutBtn">Check Out</button>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

    <!-- Checkout Summary Modal -->
    {{-- <div class="modal fade" id="checkoutSummaryModal" tabindex="-1" aria-labelledby="checkoutSummaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutSummaryModalLabel">Order Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table summary-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody id="summaryItemsBody">
                                <!-- Items will be populated by JS -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Grand Total</th>
                                    <th class="text-end" id="modalGrandTotal">$0.00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-dark" id="proceedCheckoutBtn">Proceed to Order</button>
                </div>
            </div>
        </div>
    </div> --}}

    @include('includes.customer_end_includes.add_to_cart_model')

    <script>
        $(document).ready(function () {

            window.loadCartItems = function() {
                $('#cart-products-container').html(`
                    <div class="text-center py-5">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `);

                $.ajax({
                    url: "{{ route('get_cart_items') }}",
                    type: "GET",
                    dataType: "json",
                    success: function (res) {
                        let items = res.cart_items;

                        if (!items || items.length === 0) {
                            $('#cart-products-container').html(`
                                <div class="text-center py-5">
                                    <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                                    <h5>Your Shopping Cart is Empty</h5>
                                    <p class="text-muted">Looks like you haven't added any items to your cart yet.</p>
                                    <a href="{{ route('customer_shop') }}" class="btn text-white mt-2" style="background-color: #333f48;">Continue Shopping</a>
                                </div>
                            `);
                            $('#sub_total').text('0.00');
                            $('#estimate_total').text('0.00');
                            $('#checkoutBtn').prop('disabled', true);
                            return;
                        }

                        $('#checkoutBtn').prop('disabled', false);
                        let html = '';
                        const ecAssetBase = "{{ ec_asset('') }}";
                        const noImgAsset = "{{ asset('assets/img/products/product_no_image.png') }}";

                        items.forEach(function (cartProduct) {
                            const cartId = cartProduct.cart_id || cartProduct.id;
                            const productId = cartProduct.id || cartProduct.sub_product_id || cartProduct.product_id;
                            const productName = cartProduct.display_product_name || '';
                            // const mockupImg = cartProduct.mockup_img_1 || '';
                            const imgSrc = cartProduct.display_main_image;
                            const defaultPrice = parseFloat(cartProduct.display_product_price || 0);
                            const cartQty = parseInt(cartProduct.cart_qty || cartProduct.quantity || 1);
                            const stockQty = parseInt(cartProduct.stock_qty || cartProduct.stock || 0);
                            const totalItemPrice = (defaultPrice * cartQty).toFixed(2);
                            const removeRoute = "{{ route('cart.remove', ':id') }}".replace(':id', cartId);

                            let sizeName = '-';
                            let sizeId = '';
                            if (cartProduct.selected_size) {
                                if (typeof cartProduct.selected_size === 'object') {
                                    sizeName = cartProduct.selected_size.size_name || '-';
                                    sizeId = cartProduct.selected_size.id || '';
                                } else {
                                    sizeName = cartProduct.selected_size;
                                }
                            } else if (cartProduct.size_id) {
                                sizeId = cartProduct.size_id;
                            }

                            let colorId = '';
                            let colorHex = '';
                            let colorPantone = '';
                            if (cartProduct.selected_color && typeof cartProduct.selected_color === 'object') {
                                colorId = cartProduct.selected_color.id || '';
                                colorHex = cartProduct.selected_color.hex || '';
                                colorPantone = cartProduct.selected_color.pantone_code || '';
                            } else if (cartProduct.color_id) {
                                colorId = cartProduct.color_id;
                            }

                            let colorHtml = '';
                            if (colorHex || colorPantone) {
                                const bgStyle = colorHex ? `background-color: #${colorHex};` : '';
                                colorHtml = `
                                    <span style="${bgStyle} padding: 5px 10px; border-radius:4px; height: 25px; width: 25px; display: inline-block;">
                                        ${colorPantone}
                                    </span>
                                `;
                            }

                            html += `
                                <div class="col-lg-12 card_padding item-row">
                                    <div class="row card_div cart-card-flex align-items-center">
                                        <!-- Edit Button -->
                                        <a href="javascript:void(0)" class="cart-edit-btn" data-cart-item-id="${cartId}">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        <!-- Remove Button -->
                                        <a href="${removeRoute}" class="cart-remove-btn" data-id="${cartId}">
                                            &times;
                                        </a>

                                        <div class="col-lg-2 cart-img-col">
                                            <img src="${imgSrc}" alt="${productName}" style="width: 100%;"
                                                onerror="this.src='${noImgAsset}'">
                                        </div>

                                        <div class="col-lg-9 d-flex flex-column justify-content-start cart-info-col">
                                            <!-- Product Name -->
                                            <div class="product_name mb-2">
                                                <span>${productName}</span>
                                            </div>

                                            <!-- Quantity Selector -->
                                            <div class="product-info-row cart-info-grid">
                                                <div class="info-box">
                                                    <span class="each_topic">Size</span>
                                                    <div class="fit-sizes">
                                                        <span class="badge bg-secondary size_badge"
                                                            data-size="${sizeName}"
                                                            data-size-id="${sizeId}">
                                                            ${sizeName}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="info-box text-center">
                                                    <span class="each_topic">Each</span>
                                                    <span class="default_price">
                                                        $${defaultPrice.toFixed(2)}
                                                    </span>
                                                </div>

                                                <div class="info-box text-center">
                                                    <span class="each_topic">Qty</span>
                                                    <div class="qty_div d-flex align-items-center justify-content-center">
                                                        <button class="qty-btn minus-btn" data-id="${cartId}">-</button>
                                                        <input type="text" class="qty-input text-center mx-2"
                                                            value="${cartQty}" data-id="${cartId}"
                                                            data-product="${productId}"
                                                            data-price="${defaultPrice}"
                                                            data-stock="${stockQty}"
                                                            data-size="${sizeId}"
                                                            data-color="${colorId}" readonly>
                                                        <button class="qty-btn plus-btn" data-id="${cartId}">+</button>
                                                    </div>
                                                </div>

                                                <div class="info-box text-center">
                                                    <span class="each_topic">Total</span>
                                                    <span class="amount_qty" style="display:none;" data-id="${cartId}">
                                                        ${cartQty}
                                                    </span>
                                                    <span class="totalamount default_price_topic" data-id="${cartId}"
                                                        data-price="${defaultPrice}">
                                                        $${totalItemPrice}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="size_div">
                                                <div class="row">
                                                    <div class="fit-sizes d-flex flex-wrap gap-1" style="padding: 15px 0px;">
                                                        ${colorHtml}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });

                        $('#cart-products-container').html(html);
                        updateGrandTotal();
                    },
                    error: function (xhr) {
                        $('#cart-products-container').html(`
                            <div class="text-center py-5">
                                <i class="fa fa-exclamation-circle fa-3x text-danger mb-3"></i>
                                <h5>Failed to load cart items</h5>
                                <button onclick="window.loadCartItems()" class="btn btn-outline-secondary mt-2">Retry</button>
                            </div>
                        `);
                    }
                });
            };

            // Load items initially
            window.loadCartItems();

            function recalcTotal(cartId) {
                const qtyInput = $(`.qty-input[data-id='${cartId}']`)[0];
                const totalAmountSpan = $(`.totalamount[data-id='${cartId}']`)[0];
                const amountQtySpan = $(`.amount_qty[data-id='${cartId}']`)[0];

                if (qtyInput && totalAmountSpan && amountQtySpan) {
                    const quantity = parseInt(qtyInput.value);
                    const price = parseFloat(totalAmountSpan.dataset.price);

                    amountQtySpan.textContent = quantity;
                    totalAmountSpan.textContent = `$${(quantity * price).toFixed(2)}`;
                }

                updateGrandTotal();
            }

            function updateGrandTotal() {
                let total = 0;
                let count = 0;
                $('.qty-input').each(function () {
                    const price = parseFloat($(this).data('price'));
                    const qty = parseInt($(this).val());
                    total += price * qty;
                    count++;
                });

                $('#sub_total').text(total.toFixed(2));
                $('#estimate_total').text(total.toFixed(2));
                if (count === 0) {
                    $('#checkoutBtn').prop('disabled', true);
                }
            }

            function updateCart(cartId, productId, sizeId, colorId, newQty) {
                return $.ajax({
                    url: "{{ route('cart.update', ':id') }}".replace(':id', cartId),
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        quantity: newQty
                    }
                });
            }

            // Handle plus button (delegated)
            $(document).on('click', '.plus-btn', function () {
                const id = $(this).data('id');
                const input = $(`.qty-input[data-id='${id}']`);
                const sizeId = input.data('size');
                const colorId = input.data('color');
                const productId = input.data('product');
                let currentQty = parseInt(input.val());

                updateCart(id, productId, sizeId, colorId, currentQty + 1)
                    .done(function (res) {
                        if (res.status) {
                            input.val(currentQty + 1);
                            recalcTotal(id);
                            if ($('#cart-count').length) {
                                $('#cart-count').text(res.cart_count).css('display', 'inline-block');
                            }
                        }
                    })
                    .fail(function (xhr) {
                        const response = xhr.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: (response && response.message) ? response.message : 'Cannot update cart',
                        });
                    });
            });

            // Handle minus button (delegated)
            $(document).on('click', '.minus-btn', function () {
                const id = $(this).data('id');
                const input = $(`.qty-input[data-id='${id}']`);
                const sizeId = input.data('size');
                const colorId = input.data('color');
                const productId = input.data('product');
                let currentQty = parseInt(input.val());

                if (currentQty <= 1) return;

                updateCart(id, productId, sizeId, colorId, currentQty - 1)
                    .done(function (res) {
                        if (res.status) {
                            input.val(currentQty - 1);
                            recalcTotal(id);
                            if ($('#cart-count').length) {
                                $('#cart-count').text(res.cart_count).css('display', 'inline-block');
                            }
                        }
                    })
                    .fail(function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Cannot decrease quantity',
                        });
                    });
            });

            // Handle cart remove button (delegated AJAX)
            $(document).on('click', '.cart-remove-btn', function (e) {
                e.preventDefault();
                const removeUrl = $(this).attr('href');
                Swal.fire({
                    title: 'Remove Item?',
                    text: "Are you sure you want to remove this item from your cart?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: removeUrl,
                            type: "GET",
                            success: function (res) {
                                if(res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: res.message,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: res.message,
                                    });
                                }
                                getglobalCartCount();
                                window.loadCartItems();
                            },
                            error: function () {
                                window.location.reload();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong, please try again',
                                });
                            }
                        });
                    }
                });
            });

            $('#checkoutBtn').click(function () {
                @if(Auth::check())
                    let items = [];
                    $('.qty-input').each(function () {
                        items.push({
                            cart_id: $(this).data('id')
                        });
                    });

                    if (items.length === 0) return;

                    $(this).prop('disabled', true).text('Processing...');

                    $.ajax({
                        url: "{{ route('proceed_to_checkout') }}",
                        type: "POST",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: { items: items },
                        beforeSend: function () {
                            $('.main-loading').fadeIn();
                        },
                        success: function (res) {
                            if (res.status == 'success') {
                                window.location.href = "{{ route('cartPayment') }}";
                            } else {
                                $('.main-loading').fadeOut();
                                Swal.fire({
                                    icon: res.status,
                                    title: res.title,
                                    html: res.message,
                                });
                            }
                            $('#checkoutBtn').prop('disabled', false).text('Proceed to Checkout');
                        },
                        error: function (xhr) {
                            $('.main-loading').fadeOut();
                            const msg = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: msg,
                            });
                            $('#checkoutBtn').prop('disabled', false).text('Proceed to Checkout');
                        }
                    });
                @else
                    $('#authModal').modal('show');
                @endif
            });

        });
    </script>


@endsection
