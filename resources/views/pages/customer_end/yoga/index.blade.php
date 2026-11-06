@extends('layouts.customer_end_layouts.app')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }
    .video-section {
        position: relative;
        width: 100%;
        /* height: 100vh;
        overflow: hidden; */
    }

    .video-section video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(33, 37, 41, 0.8); /* semi-transparent gray */
        color: white;
        padding: 77px 80px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        clip-path: path('M0,0 C300,62 938,75 1478,84 L1501,318 L11,318 Z');
        padding-bottom: 20px;
    }

    .overlay-text {
        flex: 1;
        min-width: 300px;
    }

    .overlay-text h1 {
        font-size: 45px;
        font-weight: 700;
        margin: 0;
    }

    .overlay-text h1 span {
        color: #ff2c2c; /* red for CUSTOM */
    }

    .overlay-text p {
        font-size: 15px;
        margin-top: 10px;
        color: #dcdcdc;
    }

    .overlay-button {
        margin-left: auto;
    }

    .overlay-button a {
        display: inline-block;
        background: transparent;
        border: 2px solid white;
        color: white;
        font-size: 18px;
        padding: 12px 35px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .overlay-button a:hover {
        background: white;
        color: #333;
    }

    @media (max-width: 768px) {
        .overlay {
            flex-direction: column;
            align-items: flex-start;
            padding: 40px 20px;
        }

        .overlay-text h1 {
            font-size: 40px;
        }

        .overlay-button {
            margin-top: 20px;
            width: 100%;
        }

        .overlay-button a {
            width: 100%;
            text-align: center;
        }
    }
    .gf_main_div {
        height: 80px;
        width: 60px;
        text-align: center;
        position: relative;
        top: -40px;
        background-color: #f1f1f1;
        border-radius: 45%;
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .gf_icon {
        border: 1px solid #000;
        border-radius: 50px;
        box-sizing: border-box;
        display: block;
        background: #e3e3e3;
        position: relative;
        width: 30px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
        .dot {
        position: absolute;
        top: 5px;
        width: 8px;
        height: 8px;
        background-color: #000;
        border-radius: 50%;
        animation: dropDot 1.5s ease-in-out infinite;
    }

    @keyframes dropDot {
        0% {
            top: -10px;
            opacity: 0;
        }
        10% {
            top: 0px;
            opacity: 1;
        }
        90% {
            top: 42px;
            opacity: 1;
        }
        100% {
            top: 60px;
            opacity: 0;
        }
    }
    .gif_main_div {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .font_50_600 {
        font-size: 50px;
        font-weight: 600;
    }
    .center {
        text-align: center;
    }
    .soccer_kit_image {
        width: 100%;
    }
    .slider-container2 {
        position: relative;
        width: 100%;
        max-width: 90%;
        margin: auto;
    }

    .slider2 {
        position: relative;
        width: 100%;
        height: auto;
        overflow: hidden;
    }

    .slide2 {
        width: 100%;
        display: none;
        opacity: 0;
        transition: opacity 0.7s ease;
    }

    .slide2.active {
        display: block;
        opacity: 1;
    }

    .prev-btn2, .next-btn2 {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        color: black;
        border: 1px solid black;
        border-color: none;
        padding: 3px 5px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 2px;
    }

    .prev-btn2:hover, .next-btn2:hover {
        background: rgb(193, 193, 193);
    }

    .prev-btn2 {
        left: 10px;
    }

    .next-btn2 {
        right: 10px;
    }
    .main_content {
        background-color: white;
    }

    /* catalog section */

    .our_catalog_div {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 36vh;
        display: flex;
        /* align-items: center; */
        justify-content: right;
        text-align: center;
        position: relative;
        color: #333F48;
        padding: 20px;
        box-shadow: 2px 3px 9px 5px #0000001a;
    }
    .jogger_pant_div {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 72vh;
        display: flex;
        /* align-items: center; */
        justify-content: right;
        text-align: center;
        position: relative;
        color: #333F48;
        padding: 20px;
        box-shadow: 2px 3px 9px 5px #0000001a;
    }
    .our_catalog_topic {
        font-size: 30px;
        font-weight: 600;
    }
    .game_uniform_topic {
        font-size: 25px;
        font-weight: 600;
    }
    .explore_red_btn {
        color: red;
        border: 1px solid red;
        background-color: transparent;
        font-weight: 600;
        padding: 7px 14px;
        text-decoration: unset;
    }
    .explore_red_btn:hover {
        color: rgb(135, 135, 135);
        text-decoration: unset;
    }
    /* 📱 Mobile & Tablet Responsive Fixes */
    @media (max-width: 992px) {

        .our_catalog_div,
        .jogger_pant_div {
            height: auto !important;         /* Let height adjust naturally */
            padding: 30px 20px !important;
            display: flex !important;
            align-items: flex-end !important;
        }

        .our_catalog_topic,
        .game_uniform_topic {
            font-size: 22px !important;
            text-align: center !important;
            display: block !important;
        }

        .explore_red_btn {
            margin-top: 10px !important;
            font-size: 14px !important;
        }

        /* Columns stack vertically */
        .col-lg-6,
        .col-lg-3,
        .col-lg-4,
        .col-lg-8,
        .col-lg-9,
        .col-lg-12 {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
    }

    /* 📱 Small mobile (max-width: 576px) */
    @media (max-width: 576px) {

        .our_catalog_topic,
        .game_uniform_topic {
            font-size: 18px !important;
        }

        .explore_red_btn {
            padding: 4px 10px !important;
            font-size: 12px !important;
        }
    }
    /* height auto from background-image aspect ratio */
    .bg-auto-height {
        position: relative;
        width: 100%;
        padding-top: 60%; /* change this value to match your image ratio */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .bg-auto-height > * {
        position: absolute;
        bottom: 20px;
        right: 20px;
    }
    .lets_talk_bg_img_bg {
        background-image: url('{{ asset('assets/customer_end/yoga/soccer_talk.jpg') }}') !important;
    }

</style>


<div class="video-section">
    <video autoplay loop muted playsinline>
        <source src="{{ asset('assets/customer_end/yoga/yoga.mp4') }}" type="video/mp4">
    </video>

    <div class="overlay">
        <div class="overlay-text">
            <h1>YOGA</h1>
            <p>Creating The Highest Quality Custom Kits For Your Team</p>
        </div>
        <div class="overlay-button">
            <a href="#letsTalkSection" class="scroll-link">Let's Talk</a>
        </div>
    </div>
</div>

<div class="gif_main_div">
    <div class="gf_main_div">
        <div class="gf_icon">
            <div class="dot"></div>
        </div>
    </div>
</div>

<div class="row center" style="margin: unset; ">
    <div class="font_50_600">
        <span>Yoga</span>
        <span style="color: red;">Apparel</span>
    </div>
    <div>
        <span>Flow In Style With Our Yoga Apparel Collection. Designed For Comfort And Flexibility, Our Gear Keeps You Centered On And Off The Mat.</span>
    </div>
</div>

<div class="slider-container2">
    <div class="slider">
        <img src="{{ asset('assets/customer_end/yoga/yoga_1.png') }}" class="slide2 active">
        <img src="{{ asset('assets/customer_end/yoga/yoga_2.png') }}" class="slide2">
        <img src="{{ asset('assets/customer_end/yoga/yoga_3.png') }}" class="slide2">
        <img src="{{ asset('assets/customer_end/yoga/yoga_4.png') }}" class="slide2">
        <!-- Add more images if needed -->
    </div>

    <button class="prev-btn2">&#10094;</button>
    <button class="next-btn2">&#10095;</button>
</div>


<div class="row center" style="margin: unset; ">
    <div class="font_50_600">
        <span>Yoga CUSTOM</span>
        <span style="color: red;">Apparel</span>
    </div>
    <div>
        <span>Find balance on and off the mat with our custom yoga apparel.</span>
    </div>
</div>

<div>
    <div>
        <img src="{{ asset('assets/customer_end/yoga/custom_uniform.jpg') }}" alt="Logo" style="width: 100%;">
    </div>
</div>

<div class="row center" style="margin: unset; padding: 50px 0px;">
    <div class="font_50_600">
        <span>Yoga </span>
        <span style="color: red;">Catalog</span>
    </div>
    <div>
        <span>Custom Apparel for Basketball Teams, Clubs, and Events</span>
    </div>
</div>

<div class="col-lg-12" style="padding: 15px;">
    <div class="row" style="margin: unset;">
        <div class="col-lg-6">
            <div>
                <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/gym/our_catalog.jpg') }}');">

                    <div style="text-align: right;">
                        <span class="our_catalog_topic">
                            OUR CATALOG
                        </span><br>
                        <a href="https://encr.co/customer_catalog" target="_blank" class="explore_red_btn">
                            EXPLORE
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div>
                <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/gym/game_uniform.jpg') }}');">

                    <div style="text-align: right;">
                        <span class="game_uniform_topic">
                            GAME UNIFORMS
                        </span><br>
                        <a href="https://encr.co/product_filter?_token=6AnqdDEKAWD9Iw8jaAamCkWgvYok31QA7Bk1w9Ol&selectedCategory=1&selectedGender=All&selectedSport=12&selectedStyle=0" target="_blank" class="explore_red_btn">
                            EXPLORE
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div>
                <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/soccer/hoodies.jpg') }}');">

                    <div style="text-align: right;">
                        <span class="game_uniform_topic">
                            HOODIES AND FLEECE
                        </span><br>
                        <a href="https://encr.co/product_filter?_token=6AnqdDEKAWD9Iw8jaAamCkWgvYok31QA7Bk1w9Ol&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=7" target="_blank" class="explore_red_btn">
                            EXPLORE
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="col-lg-12" style="padding: 15px;">
    <div class="row" style="margin: unset;">
        <div class="col-lg-3">
            <div>
                <div class="jogger_pant_div" style="background-image: url('{{ asset('assets/customer_end/gym/joggers.jpg') }}');">

                    <div style="text-align: right;">
                        <span class="game_uniform_topic">
                            JOGGERS AND PANTS
                        </span><br>
                        <a href="https://encr.co/product_filter?_token=Tx9IPWjCHHuSdabFQs9XG7zcoo6iD298pmSsIjcg&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=10" target="_blank" class="explore_red_btn">
                            EXPLORE
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row" style="margin: unset;">
                <div class="col-lg-4">
                    <div>
                        <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/soccer/shocks.jpg') }}');">

                            <div style="text-align: right;">
                                <span class="game_uniform_topic">
                                    SOCKS
                                </span><br>
                                <a href="https://encr.co/product_filter?_token=Tx9IPWjCHHuSdabFQs9XG7zcoo6iD298pmSsIjcg&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=9" target="_blank" class="explore_red_btn">
                                    EXPLORE
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div>
                        <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/soccer/bags.jpg') }}');">

                            <div style="text-align: right;">
                                <span class="game_uniform_topic">
                                    BAGS
                                </span><br>
                                <a href="https://encr.co/product_filter?_token=Tx9IPWjCHHuSdabFQs9XG7zcoo6iD298pmSsIjcg&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=1" target="_blank" class="explore_red_btn">
                                    EXPLORE
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div>
                        <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/gym/performance.jpg') }}');">

                            <div style="text-align: right;">
                                <span class="game_uniform_topic">
                                    PERFORMANCE TEES
                                </span><br>
                                <a href="https://encr.co/product_filter?_token=Tx9IPWjCHHuSdabFQs9XG7zcoo6iD298pmSsIjcg&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=11" target="_blank" class="explore_red_btn">
                                    EXPLORE
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div>
                        <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/soccer/outerwear.jpg') }}');">

                            <div style="text-align: right;">
                                <span class="game_uniform_topic">
                                    OUTERWEAR
                                </span><br>
                                <a href="https://encr.co/product_filter?_token=Tx9IPWjCHHuSdabFQs9XG7zcoo6iD298pmSsIjcg&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=5" target="_blank" class="explore_red_btn">
                                    EXPLORE
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div>
                        <div class="our_catalog_div" style="background-image: url('{{ asset('assets/customer_end/soccer/hats.jpg') }}');">

                            <div style="text-align: right;">
                                <span class="game_uniform_topic">
                                    HATS
                                </span><br>
                                <a href="https://encr.co/product_filter?_token=Tx9IPWjCHHuSdabFQs9XG7zcoo6iD298pmSsIjcg&selectedCategory=5&selectedGender=All&selectedSport=12&selectedStyle=17" target="_blank" class="explore_red_btn">
                                    EXPLORE
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.review')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px 0px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.lets_talk')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.custom_resource')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.insta')
    </div>
</div>

<script>
    let slideIndex = 0;
    const slides2 = document.querySelectorAll('.slide2');
    const intervalTime = 3000; // 3 seconds
    let autoSlide = setInterval(nextSlide, intervalTime);

    function showSlide(index) {
        slides2.forEach((slide, i) => {
            slide.classList.remove('active');
        });

        slides2[index].classList.add('active');
    }

    function nextSlide() {
        slideIndex = (slideIndex + 1) % slides2.length;
        showSlide(slideIndex);
    }

    function prevSlide() {
        slideIndex = (slideIndex - 1 + slides2.length) % slides2.length;
        showSlide(slideIndex);
    }

    document.querySelector('.next-btn2').addEventListener('click', () => {
        nextSlide();
        resetAutoSlide();
    });

    document.querySelector('.prev-btn2').addEventListener('click', () => {
        prevSlide();
        resetAutoSlide();
    });

    function resetAutoSlide() {
        clearInterval(autoSlide);
        autoSlide = setInterval(nextSlide, intervalTime);
    }
</script>


@endsection
