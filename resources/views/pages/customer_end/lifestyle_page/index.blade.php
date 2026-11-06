@extends('layouts.customer_end_layouts.app')

@section('content')


<style>

    html {
        scroll-behavior: smooth;
    }
    .content-div {
        background-color: white;
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
    .color_divs {
        margin: unset;
        height: 20px;
        top: -7px;
        position: relative;
    }
    .teamwear_overlay {
        position: absolute;
        top: 50%;                  /* center vertically */
        left: 50%;                 /* center horizontally */
        transform: translate(-50%, -50%); /* perfect center alignment */
        width: 100%;
        background: rgba(0, 0, 0, 0.35);  /* subtle dark overlay */
        color: white;
        padding: 35px 60px;
        text-align: center;
        border-radius: unset;
    }

    .teamwear_container {
        position: relative;
        cursor: pointer;
        overflow: hidden; /* hides zoomed edges */
        border-radius: unset;
        height: 400px;
    }

    .teamwear_image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* ensures image fills container nicely */
        transition: transform 0.6s ease, filter 0.3s ease;
    }

    .teamwear_container:hover .teamwear_image {
        transform: scale(1.1); /* 10% zoom in */
    }
    .teamwear_overlay-text h1 {
        font-weight: 600;
    }
    .padding_10 {
        padding: 10px;
    }

    .background-div {
        width: 100%;
        height: 100%; /* full viewport height */
        background-image: url('{{ asset("assets/customer_end/team_page/all_back.jpg") }}');
        background-size: cover;       /* makes sure it covers the entire div */
        background-position: center;  /* centers the image */
        background-attachment: fixed; /* keeps it fixed during scroll */

    }
    .mens_overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: calc(100% - 0px); /* adjust for col padding (2 × 12px) */
        margin-left: 0px; /* shift right to align with col’s content */
        background: rgba(0, 0, 0, 0.32);
        color: white;
        padding: 35px 60px;
        text-align: center;
        border-radius: unset;
    }
    .mens_container {
        position: relative;
        cursor: pointer;
        overflow: hidden; /* hides zoomed edges */
        border-radius: unset;
    }

    .mens_image {
        width: 100%;
        border-radius: unset;
        transition: transform 0.6s ease, filter 0.3s ease;
    }

    .mens_container:hover .mens_image {
        transform: scale(1.1); /* 10% zoom in */
    }
    .mens_overlay-text h1 {
        font-weight: 600;
    }
    .feahchered_product_topic {
        color: #43464b;
        font-size: 35px;
        text-align: center;
        padding-bottom: 20px;
    }
    .slider-container {
        position: relative;
    }

    .slider-wrapper {
        position: relative;
        width: 100%;
    }

    .slide {
        display: none;
        opacity: 0;
        transition: opacity 0.6s ease, transform 0.6s ease;
        transform: translateX(100%);
    }

    .slide.active {
        display: block;
        opacity: 1;
        transform: translateX(0);
    }

    .product img {
        border-radius: unset;
        transition: transform 0.3s;
    }

    .product img:hover {
        transform: scale(1.05);
    }

    /* Buttons */
    .prev-btn, .next-btn {
        position: absolute;
        top: 40%;
        background-color: rgba(189, 189, 189, 1);
        color: black;
        border: none;
        font-size: 24px;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: unset;
        display: none; /* Hidden by default */
        z-index: 10;
    }

    .prev-btn:hover, .next-btn:hover {
        background-color: rgb(108, 108, 108);
        color: white;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    /* Show buttons on hover */
    .slider-container:hover .prev-btn,
    .slider-container:hover .next-btn {
        display: block;
    }
    .product {
        text-align: center;
    }
    .padding_40_center {
        display: none !important;
    }
 </style>

    <div class="video-section">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/customer_end/lifestyle_page/lifestyle_cover.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div>
        <div class="row color_divs" style="">
            <div style="width: 35%; background-color: #ba0c2f;"></div>
            <div style="width: 30%; background-color: black;"></div>
            <div style="width: 35%; background-color: #ba0c2f;"></div>
        </div>
    </div>

    <div class="col-lg-12" style="padding: 15px 150px;">
        <div class="row">
            <div class="col-lg-6">
                <div class="mens_container" style="position: relative; cursor: pointer; overflow: hidden;">
                    <a href="{{ route('mens_page') }}">
                        <img src="{{ asset('assets/customer_end/lifestyle_page/mens.jpg') }}" alt="Logo" class="mens_image">

                        <div class="mens_overlay">
                            <div class="mens_overlay-text">
                                <h1>MEN</h1>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="mens_container" style="position: relative; cursor: pointer; overflow: hidden;">
                    <img src="{{ asset('assets/customer_end/lifestyle_page/womens.jpg') }}" alt="Logo" class="mens_image">

                    <div class="mens_overlay">
                        <div class="mens_overlay-text">
                            <h1>WOMEN</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="padding: 35px 50px;">
        <div class="row">
            <div class="feahchered_product_topic" style="text-align:center; margin-bottom:20px;">
                <strong>FEATURED PRODUCTS</strong>
            </div>

            <div class="slider-container" style="position: relative; overflow: hidden;">
                <div class="slider-wrapper">
                    <!-- SLIDE 1 -->
                    <div class="slide active">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/Samurai_Jacket_Gray.jpg') }}" style="width:100%;">
                                <div><span>Samurai Jacket - Gray</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$10.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/BSEHoodie-BambooGray.jpg') }}" style="width:100%;">
                                <div><span>BSE Hoodie - Bamboo Gray</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$12.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/Men_sLongSleeveBambooTee.jpg') }}" style="width:100%;">
                                <div><span>Men’s Long Sleeve Tee</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$14.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/Men_sLongSleeveBambooTee_b.jpg') }}" style="width:100%;">
                                <div><span>Bamboo Tee - Black</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$15.00</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- SLIDE 2 -->
                    <div class="slide">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item5.jpg') }}" style="width:100%;">
                                <div><span>Elite Hoodie</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$13.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item6.jpg') }}" style="width:100%;">
                                <div><span>Pro Jacket</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$11.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item7.jpg') }}" style="width:100%;">
                                <div><span>Performance Tee</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$9.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item8.jpg') }}" style="width:100%;">
                                <div><span>Training Hoodie</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$17.00</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- SLIDE 3 -->
                    <div class="slide">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item9.jpg') }}" style="width:100%;">
                                <div><span>Speed Jacket</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$18.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item10.jpg') }}" style="width:100%;">
                                <div><span>Runner Tee</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$8.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item11.jpg') }}" style="width:100%;">
                                <div><span>Streetwear Hoodie</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$20.00</span></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 product">
                                <img src="{{ asset('assets/customer_end/lifestyle_page/item12.jpg') }}" style="width:100%;">
                                <div><span>Comfort Fit Tee</span></div>
                                <div style="color: rgb(145, 145, 145);"><span>$9.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <button class="prev-btn">&#10094;</button>
                <button class="next-btn">&#10095;</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="padding: 35px 50px;">
        <div class="row">

            <div class="col-lg-3" style="text-align: center;">
                <div>
                    <img src="{{ asset('assets/customer_end/lifestyle_page/M1_1024x1024.jpg') }}" style="width:100%;">
                </div>
                <div><span>Men's Cotton tee Sublimated</span></div>
            </div>


            <div class="col-lg-3" style="text-align: center;">
                <div>
                    <img src="{{ asset('assets/customer_end/lifestyle_page/M3_1024x1024.jpg') }}" style="width:100%;">
                </div>
                <div><span>Men's Sleeveless Hoodie Black</span></div>
            </div>

            <div class="col-lg-3" style="text-align: center;">
                <div>
                    <img src="{{ asset('assets/customer_end/lifestyle_page/M4_1024x1024.jpg') }}" style="width:100%;">
                </div>
                <div><span>Women's Classic hoodie</span></div>
            </div>

            <div class="col-lg-3" style="text-align: center;">
                <div>
                    <img src="{{ asset('assets/customer_end/lifestyle_page/M2_1024x1024.jpg') }}" style="width:100%;">
                </div>
                <div><span>Women's V Neck tee</span></div>
            </div>

        </div>
    </div>

    <div class="col-lg-12" style="padding: 35px 50px;">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 product">
                <img src="{{ asset('assets/customer_end/lifestyle_page/Samurai_Jacket_Gray.jpg') }}" style="width:100%;">
                <div><span>Samurai Jacket - Gray</span></div>
                <div style="color: rgb(145, 145, 145);"><span>$10.00</span></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 product">
                <img src="{{ asset('assets/customer_end/lifestyle_page/BSEHoodie-BambooGray.jpg') }}" style="width:100%;">
                <div><span>BSE Hoodie - Bamboo Gray</span></div>
                <div style="color: rgb(145, 145, 145);"><span>$12.00</span></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 product">
                <img src="{{ asset('assets/customer_end/lifestyle_page/Men_sLongSleeveBambooTee.jpg') }}" style="width:100%;">
                <div><span>Men’s Long Sleeve Tee</span></div>
                <div style="color: rgb(145, 145, 145);"><span>$14.00</span></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 product">
                <img src="{{ asset('assets/customer_end/lifestyle_page/Men_sLongSleeveBambooTee_b.jpg') }}" style="width:100%;">
                <div><span>Bamboo Tee - Black</span></div>
                <div style="color: rgb(145, 145, 145);"><span>$15.00</span></div>
            </div>
        </div>
    </div>


    <div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
        <div class="row" style="margin: unset;">
            @include('pages.customer_end.common_content.custom_resource')
        </div>
    </div>


<script>
    let slides = document.querySelectorAll('.slide');
    let currentSlide = 0;
    let slideInterval = setInterval(nextSlide, 4000); // Auto slide every 4s

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            slide.style.transform = i < index ? 'translateX(-100%)' : 'translateX(100%)';
        });
        slides[index].classList.add('active');
        slides[index].style.transform = 'translateX(0)';
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    document.querySelector('.next-btn').addEventListener('click', () => {
        clearInterval(slideInterval);
        nextSlide();
    });

    document.querySelector('.prev-btn').addEventListener('click', () => {
        clearInterval(slideInterval);
        prevSlide();
    });
</script>



@endsection
