<style>
    .image_card_product {
        padding: 10px;
        box-shadow: 0px 5px 13px 3px #0000001A;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .product_name_font {
        text-align: center;
        padding-top: 10px;
        font-size: 12px;
    }

    .image_card_product img {
        width: 100%;
        border-radius: 6px;
        transition: transform 0.3s ease;
    }

    .image_card_product:hover img {
        transform: scale(1.02);
    }

    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        padding: 5px 8px;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image_card_product:hover .nav-btn {
        opacity: 1;
    }

    .prev-btn {
        left: 8px;
    }

    .next-btn {
        right: 8px;
    }

    /* 🔹 Responsive Section */
    @media (max-width: 992px) {
        .col-lg-3 {
            width: 50%;
            flex: 0 0 50%;
            max-width: 50%;
            margin-bottom: 20px;
        }
    }

    @media (max-width: 576px) {
        .col-lg-3 {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .product_name_font {
            font-size: 14px;
        }

        .nav-btn {
            padding: 6px 10px;
        }

        .image_card_product img {
            border-radius: 8px;
        }
    }
</style>

<div class="row padding_40_center" style="margin: unset;">
    <div class="font_50_600">
        <span>Let's </span>
        <span style="color: red;"> Talk</span>
    </div>
    <div>
        <span>Our Featured Selection: Handpicked Excellence. Discover Our Top Picks Curated Just For You.</span>
    </div>
</div>

<div class="col-lg-12" style="padding: 10px;">
    <div class="row" style="margin:unset; display: flex; flex-wrap: wrap;">

        <div class="col-lg-3">
            <div class="image_card_product" data-images='[
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_1.jpg') }}",
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_1b.jpg') }}",
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_1c.jpg') }}"
            ]'>
                <img src="{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_1.jpg') }}" class="product-img" alt="Product">
                <button class="nav-btn prev-btn"><i class="fa fa-chevron-left"></i></button>
                <button class="nav-btn next-btn"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="product_name_font">
                <span>Men’s Breeze Windbreaker</span>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="image_card_product" data-images='[
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_2.jpg') }}",
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_2b.jpg') }}"
            ]'>
                <img src="{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_2.jpg') }}" class="product-img" alt="Product">
                <button class="nav-btn prev-btn"><i class="fa fa-chevron-left"></i></button>
                <button class="nav-btn next-btn"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="product_name_font">
                <span>Men’s Bamboo Pocket T - Black w-Orange Pattern Pocket</span>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="image_card_product" data-images='[
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_3.jpg') }}",
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_3b.jpg') }}"
            ]'>
                <img src="{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_3.jpg') }}" class="product-img" alt="Product">
                <button class="nav-btn prev-btn"><i class="fa fa-chevron-left"></i></button>
                <button class="nav-btn next-btn"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="product_name_font">
                <span>Men's Cotton Tee - Navy</span>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="image_card_product" data-images='[
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_4.jpg') }}",
                "{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_4b.jpg') }}"
            ]'>
                <img src="{{ asset('assets/customer_end/shop_lifestyle/shop_lifestyle_4.jpg') }}" class="product-img" alt="Product">
                <button class="nav-btn prev-btn"><i class="fa fa-chevron-left"></i></button>
                <button class="nav-btn next-btn"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="product_name_font">
                <span>Men's Zip Up Hoodie - Fleece</span>
            </div>
        </div>

    </div>
</div>

<script>
    document.querySelectorAll('.image_card_product').forEach(card => {
        const img = card.querySelector('.product-img');
        const images = JSON.parse(card.getAttribute('data-images'));
        let index = 0;

        // Hover auto change
        let hoverInterval;
        card.addEventListener('mouseenter', () => {
            hoverInterval = setInterval(() => {
                index = (index + 1) % images.length;
                img.src = images[index];
            }, 1000);
        });
        card.addEventListener('mouseleave', () => {
            clearInterval(hoverInterval);
            img.src = images[0];
            index = 0;
        });

        // Button navigation
        card.querySelector('.next-btn').addEventListener('click', (e) => {
            e.stopPropagation();
            index = (index + 1) % images.length;
            img.src = images[index];
        });
        card.querySelector('.prev-btn').addEventListener('click', (e) => {
            e.stopPropagation();
            index = (index - 1 + images.length) % images.length;
            img.src = images[index];
        });
    });
</script>
