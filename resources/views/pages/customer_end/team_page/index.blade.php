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
    .color_divs {
        margin: unset;
        height: 60px;
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
    .custom_gif {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .font_35_600 {
        font-size: 35px;
        font-weight: 600;
    }
    .take_action_text_div {
        color: white;
        text-align: center;
        justify-content: center;
        align-items: center;
    }

    .lets_talk_bg_img {
        width: 100%;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: flex-end; /* 👈 pushes content to right */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        box-sizing: border-box;
        padding: 20px; /* add padding for spacing on small screens */
    }

    .lets_talk_content {
        text-align: left;
        padding: 20px;
    }

    /* 🔹 Responsive behavior */
    @media (max-width: 768px) {
        .lets_talk_content {
            width: 100%;
            text-align: center;
        }
        .lets_talk_bg_img {
            justify-content: center;
        }
    }
    .form_card {
        padding: 20px;
        height: 100%;
        color: white;
    }
    .form_card label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        display: block;
    }

    .form_card input,
    .form_card textarea {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 7px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
        background-color: rgba(128, 128, 128, 0.27);
    }

    .form_card input:focus,
    .form_card textarea:focus {
        border-color: #c91d1d;
    }

    .form_card button {
        width: 100%;
        padding: 12px;
        background-color: #c91d1d;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
        font-weight: 500;
    }

    .form_card button:hover {
        background-color: #a91515;
    }

    /* 🔹 Responsive */
    @media (max-width: 992px) {
        .lets_talk_content {
            width: 100%;
            justify-content: center;
        }
    }
    .form-group {
        margin-bottom: 0.5rem;
    }
    .iti {
        width: 100%;
    }
    .iti__country-list {
        color: gray;
    }
    .iti--separate-dial-code .iti__selected-dial-code {
        color: gray;
    }
    .comma_text {
        font-size: 50px;
        color: red;
    }
    .review_text {
        padding: 0px 13%;
        font-size: 18px;
        color: white;
    }
    .reviewer-info {
        text-align: center;
        color: white;
    }

    .reviewer-info img {
        width: 7%;
        padding:10px;
    }
    .review-stars {
        margin-top: 10px;
        color: #FFD700;
        font-size: 20px;
        text-align: center;
    }
    .prev-btn, .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 50%;
        transition: background 0.3s ease;
    }

    .prev-btn:hover, .next-btn:hover {
        background: rgba(255,255,255,0.3);
    }

    .prev-btn {
        left: 20px;
    }

    .next-btn {
        right: 20px;
    }
    .review-slider {
        position: relative;
        width: 100%;
        text-align: center;
        overflow: hidden;
    }
    .review_content {
        display: none;
        color: white;
        max-width: 800px;
        margin: 0 auto;
        transition: opacity 0.6s ease-in-out;
    }

    .review_content.active {
        display: block;
        opacity: 1;
    }
    .padding_40_center {
        display: none !important;
    }
</style>

<div class="background-div">
    <div class="video-section">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/customer_end/team_page/team_cover_video.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div>
        <div class="row color_divs" style="">
            <div style="width: 35%; background-color: #ba0c2f;"></div>
            <div style="width: 30%; background-color: black;"></div>
            <div style="width: 35%; background-color: #ba0c2f;"></div>
        </div>
    </div>

    <div class="col-lg-12" style="background-color: white;">
        <div class="row" style="margin: unset;">
            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('soccer') }}">
                            <img src="{{ asset('assets/customer_end/team_page/SC.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>SOCCER</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="https://encorelacrosse.com" target="_blank">
                            <img src="{{ asset('assets/customer_end/team_page/LC.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>LACROSSE</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('basketball') }}">
                            <img src="{{ asset('assets/customer_end/team_page/BB.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>BASKETBALL</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('volleyball') }}">
                            <img src="{{ asset('assets/customer_end/team_page/VB.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>VOLLEYBALL</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('thai_mma') }}">
                            <img src="{{ asset('assets/customer_end/team_page/MT.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>MUAY THAI & MMA</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('baseball') }}">
                            <img src="{{ asset('assets/customer_end/team_page/baseball.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>BASEBALL</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('disc_golf') }}">
                            <img src="{{ asset('assets/customer_end/team_page/DG.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>DISC GOLF</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('water_sport') }}">
                            <img src="{{ asset('assets/customer_end/team_page/water.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>WATER SPORTS</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('gym') }}">
                            <img src="{{ asset('assets/customer_end/team_page/gym.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>GYM</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 padding_10">
                <div>
                    <div class="teamwear_container" style="position: relative; cursor: pointer; overflow: hidden;">
                        <a href="{{ route('yoga') }}">
                            <img src="{{ asset('assets/customer_end/team_page/yoga.JPG') }}" alt="Logo" class="teamwear_image">

                            <div class="teamwear_overlay">
                                <div class="teamwear_overlay-text">
                                    <h1>YOGA</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12" style="background-color: rgb(0, 0, 0);">
        <div class="row custom_gif" style="margin: unset;">
            <img src="{{ asset('assets/customer_end/team_page/Custom.gif') }}" alt="Logo" style="width:20%;">
        </div>
    </div>

    <div class="col-lg-12" style="">
        <div class="row custom_gif" style="margin: unset;">
            <div class="col-lg-6 take_action_text_div">
                <div>
                    <span class="font_35_600">TAKE ACTION</span>
                </div>
                <div style="font-weight: 600;">
                    <span>
                        REQUEST A MOCKUP, SAMPLE OR <br>
                        A MEETING WITH A TEAM UNIFORM SPECIALIST <br>
                        TO CUSTOMIZE YOUR KIT NOW
                    </span>

                </div>
            </div>

            <div class="col-lg-6">

                <div class="lets_talk_content">
                    <div class="form_card">
                        <form>
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" id="name" placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <label for="subject">Team Name</label>
                                <input type="text" id="team_name" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Sport</label>
                                <input type="text" id="sport" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_no">Phone Number</label>
                                <input type="tel" id="phone_no" placeholder="Enter phone number" required>
                            </div>


                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" rows="4" placeholder="Type your message..." required></textarea>
                            </div>

                            <div style="text-align: center;">
                                <button class="submit_btn_form" style="width: 170px;" type="submit"><i class="fa-solid fas fa-paper-plane" style="padding-right: 10px;"></i>SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12" style="background-color: rgb(0, 0, 0);">
        @include('pages.customer_end.common_content.review_slide')
    </div>

    <div class="col-lg-12"
        style="background-image: url('{{ asset('assets/customer_end/team_page/all_sport.jpg') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 80vh; /* adjust height as you like */
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                position: relative;
                color: white;">

        <div class="row custom_gif" style="margin: unset; padding-bottom: 40px;">
            <div>
                <span style="font-size: 35px; font-weight: 600; text-shadow: 2px 2px 10px rgba(0,0,0,0.6); text-transform: uppercase;">
                    Outfit your team and customize encore brand gear
                </span>
            </div>
        </div>

    </div>

    <div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
        <div class="row" style="margin: unset;">
            @include('pages.customer_end.common_content.custom_resource')
        </div>
    </div>

</div>

<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/css/intlTelInput.css"/>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/js/utils.min.js"></script>


<script>
    const phoneInput = document.querySelector("#phone_no");
    const iti = window.intlTelInput(phoneInput, {
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch('https://ipapi.co/json')
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback('us'));
        },
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/js/utils.min.js"
    });


</script>

@endsection
