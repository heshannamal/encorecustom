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
    .overlay-button span {
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

    .overlay-button span:hover {
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

        .overlay-button span {
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
    .teamwear_overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: calc(100% - 0px); /* adjust for col padding (2 × 12px) */
        margin-left: 0px; /* shift right to align with col’s content */
        background: rgba(0, 0, 0, 0.32);
        color: white;
        padding: 35px 60px;
        text-align: center;
        border-radius: 0px 0px 8px 8px;
    }
    .teamwear_container {
        position: relative;
        cursor: pointer;
        overflow: hidden; /* hides zoomed edges */
        border-radius: 8px;
    }

    .teamwear_image {
        width: 100%;
        border-radius: 8px;
        transition: transform 0.6s ease, filter 0.3s ease;
    }

    .teamwear_container:hover .teamwear_image {
        transform: scale(1.1); /* 10% zoom in */
    }
    .teamwear_overlay-text h1 {
        font-weight: 600;
    }
    .font_50_600 {
        font-size: 50px;
        font-weight: 600;
    }
    .padding_40_center {
        padding: 40px;
        text-align: center;
    }

</style>

<div class="video-section">
    <video autoplay loop muted playsinline>
        <source src="{{ asset('assets/customer_end/home/main_video.mp4') }}" type="video/mp4">
    </video>

    <div class="overlay">
        <div class="overlay-text">
            <h1><span>CUSTOM</span> MADE</h1>
            <p>Sportswear For Teams, Training, And Lifestyle</p>
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

<div class="col-lg-12" style="padding: 10px 40px;">
    <div class="row" style="margin: unset;">
        <div class="col-lg-6">
            <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                <a href="{{ route('team_page') }}">
                    <img src="{{ asset('assets/customer_end/home/teamwear.jpeg') }}" alt="Logo" class="teamwear_image">

                    <div class="teamwear_overlay">
                        <div class="teamwear_overlay-text">
                            <h1>TEAMWEAR</h1>
                            <p>CUSTOM TEAM KIT</p>
                        </div>
                        <div class="overlay-button">
                            <span>EXPLORE</span>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                <a href="{{ route('lifestyle_page') }}">
                    <img src="{{ asset('assets/customer_end/home/lifestyle.jpg') }}" alt="Logo" class="teamwear_image">

                    <div class="teamwear_overlay">
                        <div class="teamwear_overlay-text">
                            <h1>LIFESTYLE</h1>
                            <p>PLAY - TRAIN - LIVE</p>
                        </div>
                        <div class="overlay-button">
                            <span>SHOP</span>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>
</div>

<div class="col-lg-12" style="padding: 10px 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        <div class="col-lg-12">
            <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                <a href="{{ route('custom_apparel') }}">
                    <img src="{{ asset('assets/customer_end/home/custom_apparel.jpg') }}" alt="Logo" class="teamwear_image">

                    <div class="teamwear_overlay">
                        <div class="teamwear_overlay-text">
                            <h1>CUSTOM APPAREL</h1>
                            <p>have our team create your vision for your team or company uniform</p>
                        </div>
                        <div class="overlay-button">
                            <span>EXPLORE</span>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>
</div>

{{-- <div class="col-lg-12" style="padding: 10px 40px;">

</div> --}}

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.review')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.feachered_products')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.shop_lifestyle')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.lets_talk')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.custom_resource')
    </div>
</div>

<div class="col-lg-12" style="padding: 40px 0px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
    <div class="row" style="margin: unset;">
        @include('pages.customer_end.common_content.insta')
    </div>
</div>

<script>
    document.querySelector('.scroll-link').addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector('#letsTalkSection');
        const offset = 80; // adjust if you have a fixed navbar
        const topPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;

        window.scrollTo({
            top: topPosition,
            behavior: 'smooth'
        });
    });
</script>


@endsection
