<style>
    .review-stars {
        margin-top: 10px;
        color: #FFD700; /* Gold color */
        font-size: 20px;
        text-align: center;
    }
    .review-text {
        display: block;            /* allows justification */
        text-align: justify;       /* aligns both left & right */
        line-height: 1.6;          /* improves readability */
        color: #333;               /* optional: better contrast */
        font-size: 16px;           /* optional */
    }
    .slider-container {
        position: relative;
        overflow: hidden;
        width: 101%;

    }

    .slider {
        display: flex;
        transition: transform 0.6s ease;
    }

    .slide {
        min-width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }

    .col-lg-8, .col-lg-4 {
        box-sizing: border-box;
        padding: 10px;
    }

    .col-lg-8 {
        flex: 0 0 65%;
    }

    .col-lg-4 {
        flex: 0 0 35%;
    }

    .review-text {
        display: block;
        text-align: justify;
        line-height: 1.6;
        color: #333;
        font-size: 16px;
    }

    .review-stars {
        margin-top: 10px;
        color: #FFD700;
        font-size: 20px;
        text-align: center;
    }

    .reviewer-info {
        text-align: center;
    }

    .reviewer-info img {
        width: 20%;
        padding:10px;
    }

    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        color: white;
        border: none;
        font-size: 10px;
        padding: 6px 8px;
        cursor: pointer;
        border: 1px solid gray;
        color: gray;
        z-index: 3;
    }

    .slider-btn:hover {
        background: rgba(33,37,41,1);
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    @media (max-width: 768px) {
        .slide {
            flex-direction: column;
        }
        .col-lg-8, .col-lg-4 {
            flex: 0 0 100%;
        }
    }
    .font_50_600 {
        font-size: 50px;
        font-weight: 600;
    }
    .padding_40_center {
        padding: 40px;
        text-align: center;
        box-shadow: 0px 4px 9px 1px #0000001A;
    }
    .featured-image {
        width: 100%;
        height: 100%;
        background-size: contain;   /* shows full image */
        background-repeat: no-repeat;
        background-position: center;
    }
    .f_product_topic {
        color: #3C3C3C;
        font-size: 54px;
    }
    .font_16_lh_180 {
        font-size: 16px;
        line-height: 180%;
    }
    .apparel_catalogue_btn {
        margin-top: 10px;
        padding: 7px 15px;
        border: unset;
        background-color: red;
        color: white;
        border-radius: 8px;
    }
    /* === FEATURED PRODUCT SLIDER === */
    .featured-slider-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        border-radius: 8px;
    }

    .featured-slider {
        display: flex;
        transition: transform 0.6s ease-in-out;
    }

    .featured-slide {
        min-width: 100%;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* color: white; */
        position: relative;
    }

    .featured-slide::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.25);
        z-index: 1;
    }

    .featured-slide > div {
        position: relative;
        z-index: 2;
    }


</style>

<div class="row padding_40_center" style="margin: unset; ">
        <div class="font_50_600">
            <span>Featured</span>
            <span style="color: red;">Products</span>
        </div>
        <div>
            <span>our featured selection: handpicked excellence. discover our top picks curated just for you.</span>
        </div>

    </div>


<div class="featured-slider-container" style="padding: unset;">
    <div class="featured-slider" id="featuredSlider">
        <!-- Slide 1 -->
        <div class="featured-slide" style="background-image: url('{{ asset('assets/customer_end/feachered_product/feachered_product_1.jpg') }}'); min-height: 500px;">
            <div style="padding: 10px 60px;">
                <div>
                    <strong class="f_product_topic">PANDA VEST</strong> <br>
                    <span class="font_16_lh_180">They're the canvas upon which we paint our personalities, moods, and aspirations.</span> <br>
                    <span class="font_16_lh_180">Your style statement, your comfort zone.</span> <br>
                    <button class="apparel_catalogue_btn">Apparel Catalogue</button>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="featured-slide" style="background-image: url('{{ asset('assets/customer_end/feachered_product/feachered_product_2.jpg') }}'); min-height: 500px;">
            <div style="padding: 10px 60px;">
                <div>
                    <strong class="f_product_topic">SAMURAI JACKET</strong> <br>
                    <span class="font_16_lh_180">They're the canvas upon which we paint our personalities, moods, and aspirations.</span> <br>
                    <span class="font_16_lh_180">Your style statement, your comfort zone.</span> <br>
                    <button class="apparel_catalogue_btn">Apparel Catalogue</button>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="featured-slide" style="background-image: url('{{ asset('assets/customer_end/feachered_product/feachered_product_3.jpg') }}'); min-height: 500px;">
            <div style="padding: 10px 60px;">
                <div>
                    <strong class="f_product_topic">WOMEN'S TRAINING SHORTS</strong> <br>
                    <span class="font_16_lh_180">They're the canvas upon which we paint our personalities, moods, and aspirations.</span> <br>
                    <span class="font_16_lh_180">Your style statement, your comfort zone.</span> <br>
                    <button class="apparel_catalogue_btn">Apparel Catalogue</button>
                </div>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="featured-slide" style="background-image: url('{{ asset('assets/customer_end/feachered_product/feachered_product_4.jpg') }}'); min-height: 500px;">
            <div style="padding: 10px 60px;">
                <div>
                    <strong class="f_product_topic">YOGA PANT</strong> <br>
                    <span class="font_16_lh_180">They're the canvas upon which we paint our personalities, moods, and aspirations.</span> <br>
                    <span class="font_16_lh_180">Your style statement, your comfort zone.</span> <br>
                    <button class="apparel_catalogue_btn">Apparel Catalogue</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <button class="slider-btn prev-btn featured-slider-btn featured-prev-btn" id="featuredPrevBtn">
        <i class="fa fa-chevron-left"></i>
    </button>
    <button class="slider-btn next-btn featured-slider-btn featured-next-btn" id="featuredNextBtn">
        <i class="fa fa-chevron-right"></i>
    </button>
</div>

<script>
    const featuredSlider = document.getElementById('featuredSlider');
    const featuredSlides = document.querySelectorAll('.featured-slide');
    const featuredNextBtn = document.getElementById('featuredNextBtn');
    const featuredPrevBtn = document.getElementById('featuredPrevBtn');

    let featuredIndex = 0;
    const featuredTotal = featuredSlides.length;

    function showFeaturedSlide(i) {
        featuredSlider.style.transform = `translateX(${-i * 100}%)`;
    }

    function nextFeatured() {
        featuredIndex = (featuredIndex + 1) % featuredTotal;
        showFeaturedSlide(featuredIndex);
    }

    function prevFeatured() {
        featuredIndex = (featuredIndex - 1 + featuredTotal) % featuredTotal;
        showFeaturedSlide(featuredIndex);
    }

    featuredNextBtn.addEventListener('click', nextFeatured);
    featuredPrevBtn.addEventListener('click', prevFeatured);

    // Auto slide every 3s
    let featuredAuto = setInterval(nextFeatured, 3000);

    // Pause on hover
    document.querySelector('.featured-slider-container').addEventListener('mouseenter', () => {
        clearInterval(featuredAuto);
    });

    // Resume when not hovering
    document.querySelector('.featured-slider-container').addEventListener('mouseleave', () => {
        featuredAuto = setInterval(nextFeatured, 3000);
    });
</script>

