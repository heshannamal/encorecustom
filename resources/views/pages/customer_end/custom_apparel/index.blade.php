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
    .mens_image {
        width: 100%;
        border-radius: unset;
        transition: transform 0.6s ease, filter 0.3s ease;
    }
    .display_middle {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .customize_header {
        padding: 10px 0px;
        color: #5e5e5e;
        font-size: 29px;
    }
    .customize_text {
        color: #5e5e5e;
        text-align: justify;
    }
    .design_concept_btn {
        background-color: black;
        color: white;
        border: unset;
        border-radius: 30px;
        padding: 4px;
        font-size: 30px;
        font-weight: 600;
        text-align: center;
        text-decoration: unset;
    }
    .design_concept_btn:hover {
        background-color: rgb(255, 0, 0);
        color: white;
        text-decoration: unset;
    }
    .contact_number {
        color: white;
        font-size: 30px;
        font-weight: 600;
    }
    .website_link {
        color: red;
        font-size: 18px;
        font-weight: 600;
        padding: 10px;
    }
    .padding_40_center {
        display: none !important;
    }
</style>

    <div class="video-section">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/customer_end/custom_apparel/custom_apparel_cover.mp4') }}" type="video/mp4">
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
            <div class="col-lg-6 ">
                <div>
                    <img src="{{ asset('assets/customer_end/custom_apparel/design.jpg') }}" alt="Logo" class="mens_image">
                </div>
                <div class="display_middle customize_header">
                    <strong>CUSTOM UNIFORM DESIGN</strong>
                </div>
                <div class="display_middle customize_text">
                    <span>We provide custom designs and visual mock-ups based on customer needs and vision,  as part of our standard uniform ordering process. Utilize our design concept gallery, or send over other inspiration for our designers to create your custom look.</span>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div>
                    <img src="{{ asset('assets/customer_end/custom_apparel/logo_creation.jpg') }}" alt="Logo" class="mens_image">
                </div>
                <div class="display_middle customize_header">
                    <strong>LOGO CREATION</strong>
                </div>
                <div class="display_middle customize_text">
                    <span>Encore offers A-Z branding for your club, whether forming a new team for the first time, or looking for a brand update and new designs to reinvigorate your club image through apparel, website and logos.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding: 15px 150px; background-color:black;">
        <div class="row">
            <div class="col-lg-6 ">
                <div>
                    <img src="{{ asset('assets/customer_end/custom_apparel/image_replication.jpg') }}" alt="Logo" class="mens_image">
                </div>
                <div class="display_middle customize_header" style="color: white;">
                    <strong>IMAGE REPLICATION</strong>
                </div>
                <div class="display_middle customize_text" style="color: white;">
                    <span>If your club has a low resolution logo that is not suitable for printing, or perhaps an old favorite apparel design that you would like to replicate- our design team can redraft your image in a high resolution, vector file so it can be used for all design, marketing and apparel needs.</span>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div>
                    <img src="{{ asset('assets/customer_end/custom_apparel/color_matching.jpg') }}" alt="Logo" class="mens_image">
                </div>
                <div class="display_middle customize_header" style="color: white;">
                    <strong>COLOR MATCHING</strong>
                </div>
                <div class="display_middle customize_text" style="color: white;">
                    <span>Color matching is more art than science. Different fabrics, embellishment styles, embellishment equipment, and lighting sources can cause similar colors to look very different. Our design team has the ability to support your club by assigning the proper color code, and can create custom swatches and prints for approval prior to final production.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding: 15px 150px;">
        <div class="row">
            <div class="col-lg-6 ">
                <div>
                    <img src="{{ asset('assets/customer_end/custom_apparel/total_branding.jpg') }}" alt="Logo" class="mens_image">
                </div>
                <div class="display_middle customize_header">
                    <strong>TOTAL BRANDING</strong>
                </div>
                <div class="display_middle customize_text">
                    <span>Your Team, Company or Organization Logo | Web Site | Social Media content design can be fully developed by the ENCORE Design Studio.</span>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12" style="padding: 25px 150px;">
        <div class="row">
            <a href="{{ route('design_concept') }}" class="design_concept_btn">
                DESIGN CONCEPTS
            </a>

        </div>
    </div>

    <div class="col-lg-12" style="padding: 25px 150px; background-color:black;">
        <div class="row">
            <div class="display_middle">
                <span class="contact_number">CONTACT US - 1-888-501-4999</span>
            </div>
            <div class="display_middle website_link">
                <span class="">Info@EncoreBrand.com</span>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
        <div class="row" style="margin: unset;">
            @include('pages.customer_end.common_content.custom_resource')
        </div>
    </div>

@endsection
