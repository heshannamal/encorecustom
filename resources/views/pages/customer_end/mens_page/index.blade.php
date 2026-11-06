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
    .mens_container {
        position: relative;
        cursor: pointer;
        overflow: hidden;
        border-radius: unset;
        flex: 1; /* allow equal width */
    }

    .mens_image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: unset;
        transition: transform 0.6s ease, filter 0.3s ease;
    }

    .mens_container:hover .mens_image {
        transform: scale(1.1);
    }

    .mens_overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.32);
        color: white;
        padding: 35px 60px;
        text-align: center;
    }

    .mens_overlay-text h1 {
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
    }

    /* 💪 Force one row across all screens */
    .mens_row {
        display: flex;
        flex-wrap: nowrap; /* prevent wrapping */
        gap: 0;
    }

    .mens_row > div {
        flex: 1; /* make all equal width */
        padding: 0 !important;
    }

    /* Optional: make sure images don’t shrink oddly on mobile */
    @media (max-width: 768px) {
        .mens_overlay {
            padding: 20px 10px;
        }
        .mens_overlay-text h1 {
            font-size: 18px;
        }
    }
    .lifestyle_men_row {
        padding: 30px;
        text-align: center;
        background-color: rgb(199, 199, 199);
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
            <source src="{{ asset('assets/customer_end/mens_page/mens_page_cover.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div class="col-lg-12">
        <div class="mens_row">

            <div>
                <div class="mens_container">
                    <a href="{{ route('mens_top_page') }}">
                        <img src="{{ asset('assets/customer_end/mens_page/top.JPG') }}" alt="Top" class="mens_image">
                        <div class="mens_overlay">
                            <div class="mens_overlay-text">
                                <h1>TOP</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <div class="mens_container">
                    <a href="{{ route('mens_bottom_page') }}">
                        <img src="{{ asset('assets/customer_end/mens_page/bottom.JPG') }}" alt="Bottom" class="mens_image">
                        <div class="mens_overlay">
                            <div class="mens_overlay-text">
                                <h1>BOTTOM</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div>
                <div class="mens_container">
                    <a href="{{ route('mens_accessories_page') }}">
                        <img src="{{ asset('assets/customer_end/mens_page/acce.JPG') }}" alt="Accessories" class="mens_image">
                        <div class="mens_overlay">
                            <div class="mens_overlay-text">
                                <h1>ACCESSORIES</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12">
        <div class="mens_row lifestyle_men_row">
            <div>
                <span> <a href="{{ route('lifestyle_page') }}"  style="color: purple; text-decoration: unset;"> Lifestyle </a></span>
                <span><a href="{{ route('mens_page') }}"  style="color: red; text-decoration: unset;"> | Men's </a></span>
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


@endsection
