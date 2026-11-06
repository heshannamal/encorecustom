<style>
    .option-badge {
        padding: 4px 12px;
        border: 1px solid rgb(193, 193, 193);
        cursor: pointer;
        display: inline-block;
        /* margin: 3px; */
        font-size: 13px;
        border-radius: 3px;
    }

    .option-badge.active {
        background: rgb(193, 193, 193);
        color: white;
        border: 1px solid rgb(193, 193, 193);
    }

    .option-badge.disabled {
        opacity: 0.4;
        pointer-events: none;
    }
    .color-option {
        width: 25px;
        height: 25px;
        display: inline-block;
        margin: 3px;
        border: 2px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        vertical-align: middle;
    }

    .color-option.active {
        border: 2px solid #333; /* selected border color */
    }

    .color-option.disabled {
        opacity: 0.4;
        pointer-events: none;
    }
    .qty-btn {
        background-color: rgb(193, 193, 193);
        border: unset;
        border-radius: 3px;
        height: 30px;
        width: 26px;
        color: white;
    }
    .gray_font_13 {
        font-size: 13px;
        color: gray;
    }
    .green_btn {
        background-color: rgb(63, 204, 171);
        border: unset;
        color: white;
    }
    .green_btn:hover {
        background-color: rgb(50, 130, 111);
        color: white;
    }
</style>

<div class="modal fade" id="addToCartModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: rgb(135, 135, 135);">Select Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row justify-content-center">

                    <!-- Quantity -->
                    <div class="col-md-9">
                        <label class="gray_font_13 d-block mb-2">Quantity</label>
                        <div class="d-flex align-items-center justify-content-center w-100 pr-4 pl-4">
                            <button type="button" class="qty-btn modal-minus">-</button>
                            <input type="text" id="modal-qty" value="1"
                                class="form-control mx-2 text-center"
                                style="width:200px; height:30px;">
                            <button type="button" class="qty-btn modal-plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4" id="size-wrapper">
                    <!-- Sizes -->
                    <div class="col-md-9">
                        <label class="gray_font_13 d-block mb-2">Size</label>
                        <div id="modal-sizes" class="d-flex flex-wrap justify-content-center w-100 pr-4 pl-4 gap-2"></div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4" id="color-wrapper">
                    <!-- Colors -->
                    <div class="col-md-9">
                        <label class="gray_font_13 d-block mb-2">Color</label>
                        <div id="modal-colors" class="d-flex flex-wrap justify-content-center w-100 pr-4 pl-4 gap-2"></div>
                    </div>

                </div>



            </div>

            <div class="modal-footer">
                <button class="btn green_btn" id="confirmAddToCart">
                    Add To Cart
                </button>
                <button class="btn green_btn" id="confirmUpdateCart" style="display: none;">
                    Update Cart
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    
    let selectedProductId = null;
    let selectedSize = null;
    let selectedColor = null;
    let combinations = [];
    let selectedStockQty = 0;

    var productOptionsRoute = "{{ route('product.options', ':id') }}";


    // =======================
    // 🔥 SIZE SHORTEN FUNCTION
    // =======================
    function shortenSizeName(sizeName){

        const sizeMap = {
            'Youth': 'Y',
            'Adult': 'A',
            'Small': 'S',
            'Medium': 'M',
            'Large': 'L',
            'XLarge': 'XL',
            'XXLarge': 'XXL',
            '3XLarge': '3XL',
            '4XLarge': '4XL'
        };

        for (let fullWord in sizeMap) {
            sizeName = sizeName.replaceAll(fullWord, sizeMap[fullWord]);
        }

        return sizeName.replace(/\s/g, '');
    }


    // =======================
    // 🔥 OPEN MODAL
    // =======================
    $(document).on('click', '.add-to-cart-modal', function(){

        selectedProductId = $(this).data('product-id');

        $('#modal-qty').val(1);
        selectedSize = null;
        selectedColor = null;
        combinations = [];
        selectedStockQty = 0;

        $('#modal-sizes').empty();
        $('#modal-colors').empty();
        $('#color-wrapper').hide();

        let url = productOptionsRoute.replace(':id', selectedProductId);

        $.ajax({
            url: url,
            method: "GET",
            success: function(response){

                combinations = response.combinations;

                window.allColors = response.colors;

                // ===== SHOW SIZES (SHORT FORMAT)
                if(response.sizes.length === 0){
                    $('#size-wrapper').hide();
                } else {
                    $('#size-wrapper').show();

                    response.sizes.forEach(size => {
                        let shortName = shortenSizeName(size.size_name);

                        $('#modal-sizes').append(
                            `<div class="option-badge size-option"
                                data-id="${size.id}">
                                ${shortName}
                            </div>`
                        );
                    });
                }

                $('#confirmAddToCart').show();
                $('#confirmUpdateCart').hide();

                $('#addToCartModal').modal('show');
            }
        });

    });

    $(document).on('click', '.cart-edit-btn', function(){

        let cartItemId = $(this).data('cart-item-id');

        // Reset everything
        selectedProductId = null;
        selectedSize = null;
        selectedColor = null;
        combinations = [];
        selectedStockQty = 0;

        $('#modal-qty').val(1);
        $('#modal-sizes').empty();
        $('#modal-colors').empty();
        // $('#color-wrapper').hide();

        // Load cart item details
        $.ajax({
            url: "{{ route('cart.edit', ':id') }}".replace(':id', cartItemId),
            method: "GET",
            success: function(response){
                let cartItem = response.cart_item;
                let productDetails = response.product_details;

                selectedProductId = cartItem.sub_product_id;
                selectedSize = cartItem.size_id;
                selectedColor = cartItem.color_id;
                combinations = productDetails.combinations;
                window.allColors = productDetails.colors;

                // Set current quantity
                $('#modal-qty').val(cartItem.quantity);

                // ===== SHOW SIZES
                if(productDetails.sizes.length === 0){
                    $('#size-wrapper').hide();
                } else {
                    $('#size-wrapper').show();

                    productDetails.sizes.forEach(size => {
                        let shortName = shortenSizeName(size.size_name);

                        let activeClass = (size.id == cartItem.size_id) ? 'active' : '';

                        $('#modal-sizes').append(
                            `<div class="option-badge size-option ${activeClass}"
                                data-id="${size.id}">
                                ${shortName}
                            </div>`
                        );
                    });
                }

                // ===== SHOW COLORS (if size + color product)
                let sizeCombinations = combinations.filter(c => c.size_id == cartItem.size_id);
                let colorIds = sizeCombinations
                    .map(c => c.color_id)
                    .filter(id => id !== null);

                if(colorIds.length > 0){

                    $('#color-wrapper').show();

                    let uniqueColorIds = [...new Set(colorIds)];

                    uniqueColorIds.forEach(colorId => {
                        let colorObj = window.allColors.find(col => col.id == colorId);
                        let hex = colorObj ? colorObj.hex : 'cccccc';

                        let activeClass = (colorId == cartItem.color_id) ? 'active' : '';

                        $('#modal-colors').append(
                            `<div class="option-badge color-option ${activeClass}"
                                data-id="${colorId}"
                                style="background-color:#${hex};">
                            </div>`
                        );
                    });

                } else {
                    $('#color-wrapper').hide();
                }

                // Set selected stock qty
                let selectedStock = combinations.find(c =>
                    c.size_id == cartItem.size_id &&
                    c.color_id == cartItem.color_id
                );
                
                if(selectedStock){
                    selectedStockQty = selectedStock.stock_qty;
                }

                // Store cart item ID for update
                $('#confirmUpdateCart').data('cart-item-id', cartItemId);

                $('#confirmAddToCart').hide();
                $('#confirmUpdateCart').show();

                $('#addToCartModal').modal('show');
            }
        });

    });


    // =======================
    // 🔥 SIZE CLICK
    // =======================
    $(document).on('click', '.size-option', function(){

        $('.size-option').removeClass('active');
        $(this).addClass('active');

        selectedSize = $(this).data('id');
        selectedColor = null;
        selectedStockQty = 0;

        $('#modal-qty').val(1);
        $('#modal-colors').empty();

        let sizeCombinations = combinations.filter(c => c.size_id == selectedSize);

        let colorIds = sizeCombinations
            .map(c => c.color_id)
            .filter(id => id !== null);

        // =============================
        // CASE 1: SIZE + COLOR PRODUCT
        // =============================
        if(colorIds.length > 0){

            $('#color-wrapper').show();

            let uniqueColorIds = [...new Set(colorIds)];

            uniqueColorIds.forEach(colorId => {

                // 🔥 Get correct hex from response colors
                let colorObj = window.allColors.find(col => col.id == colorId);

                let hex = colorObj ? colorObj.hex : 'cccccc';

                $('#modal-colors').append(
                    `<div class="option-badge color-option"
                        data-id="${colorId}"
                        style="background-color:#${hex};">
                    </div>`
                );
            });

        }

        // =============================
        // CASE 2: SIZE ONLY PRODUCT
        // =============================
        else{

            $('#color-wrapper').hide();
            
            if(sizeCombinations.length > 0){
                selectedStockQty = sizeCombinations[0].stock_qty;
            }

        }

    });


    // =======================
    // 🔥 COLOR CLICK
    // =======================
    $(document).on('click', '.color-option', function(){

        $('.color-option').removeClass('active');
        $(this).addClass('active');

        selectedColor = $(this).data('id');
        selectedStockQty = 0;

        let selectedStock = combinations.find(c =>
            c.size_id == selectedSize &&
            c.color_id == selectedColor
        );

        if(selectedStock){
            selectedStockQty = selectedStock.stock_qty;
        }

    });


    // =======================
    // 🔥 QTY +
    // =======================
    $(document).on('click', '.modal-plus', function(){

        if(selectedStockQty === 0){
            Swal.fire({
                icon: 'warning',
                title: 'Selection Required',
                text: 'Please select required options',
            });
            return;
        }

        let qtyInput = $('#modal-qty');
        let currentQty = parseInt(qtyInput.val()) || 1;

        if(currentQty < selectedStockQty){
            qtyInput.val(currentQty + 1);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Limit Exceeded',
                text: "Maximum available stock is " + selectedStockQty,
            });
        }
    });


    // =======================
    // 🔥 QTY -
    // =======================
    $(document).on('click', '.modal-minus', function(){

        let qtyInput = $('#modal-qty');
        let currentQty = parseInt(qtyInput.val()) || 1;

        if(currentQty > 1){
            qtyInput.val(currentQty - 1);
        }
    });


    $('#confirmAddToCart').on('click', function() {
        let cartBtn = $(this);
        let productId = selectedProductId;
        let sizeId = selectedSize;
        let colorId = selectedColor || null;
        let quantity = parseInt($('#modal-qty').val()) || 1;

        $.ajax({
            url: "{{ route('addToCart') }}",
            method: "POST",
            data: {
                product_id: productId,
                size_id: sizeId,
                color_id: colorId,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                cartBtn.html('<div class="spinner-border text-primary"></div>');
                cartBtn.prop('disabled', true);
            },
            success: function(res){
                if(res.success){
                   Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Product added to cart!',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    loadCart();
                    $('#addToCartModal').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message || "Something went wrong!",
                    });
                }
                cartBtn.html('Add to Cart');
                cartBtn.prop('disabled', false);
            },
            error: function(xhr){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || "Something went wrong!",
                });
                cartBtn.html('Add to Cart');
                cartBtn.prop('disabled', false);
            }
        });
    });


    $('#confirmUpdateCart').on('click', function() {
        let cartBtn = $(this);
        let cartItemId = $(this).data('cart-item-id');
        let productId = selectedProductId;
        let sizeId = selectedSize;
        let colorId = selectedColor || null;
        let quantity = parseInt($('#modal-qty').val()) || 1;

        $.ajax({
            url: "{{ route('cart.update_item', ':id') }}".replace(':id', cartItemId),
            method: "POST",
            data: {
                product_id: productId,
                size_id: sizeId,
                color_id: colorId,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                cartBtn.html('<div class="spinner-border text-primary"></div>');
                cartBtn.prop('disabled', true);
            },
            success: function(res){
                if(res.status){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Cart updated successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    loadCart();
                    $('#addToCartModal').modal('hide');
                    if (typeof window.loadCartItems === 'function') {
                        window.loadCartItems();
                    } else {
                        window.location.reload();
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message || "Something went wrong!",
                    });
                }
                cartBtn.html('Update Cart');
                cartBtn.prop('disabled', false);
            },
            error: function(xhr){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || "Something went wrong!",
                });
                cartBtn.html('Update Cart');
                cartBtn.prop('disabled', false);
            }
        });
    });
</script>