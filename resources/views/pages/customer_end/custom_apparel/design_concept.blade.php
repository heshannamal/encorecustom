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
    .background-div {
        width: 100%;
        height: 100%; /* full viewport height */
        background-image: url('{{ asset("assets/customer_end/team_page/all_back.jpg") }}');
        background-size: cover;       /* makes sure it covers the entire div */
        background-position: center;  /* centers the image */
        background-attachment: fixed; /* keeps it fixed during scroll */
    }
    /* TAB BUTTONS */
    .tabs {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding-top: 10px;
        position: relative;
        z-index: 5;
    }

    .tab-btn {
        padding: 10px 5px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
        font-size: 14px;
    }

    .tab-btn.active {
        color: #ba0c2f;
    }

    /* TAB CONTENT */
    .tab-content {
        display: none;
        padding: 40px 150px;
        margin: 0 auto;
        color: #707070;
        text-align: center;
        background: white;
    }
    .tab-content h2 {
        font-size: 35px;
        font-weight: 600;
    }

    .tab-content.active {
        display: block;
    }
    .tab_div {
        background-color: white;
        margin-top: -7px;
    }
    .action_main_div {
        margin: 100px 0px;
        text-align: center;
        background-color: rgba(0, 0, 0, 0.45);
        padding: 50px 0px;
    }
    .action_text_div {
        font-size: 30px;
        font-weight: 600;
        color: white;
    }
    .action_button_div {
        padding-top: 20px;
    }
    .action_btn {
        text-decoration: unset;
        color: white;
        background-color: red;
        padding: 10px 35px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: 600;
    }
    .action_btn:hover {
        color: white;
        text-decoration: unset;
    }

    .padding_40_center {
        display: none !important;
    }

</style>

<div class="background-div">
    <div class="video-section">
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/customer_end/design_concept/design_concept_cover.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div class="tab_div">

        <div class="tabs">
            <button class="tab-btn active" onclick="openTab('tab1')">WOMEN'S BASKETBALL</button>
            <button class="tab-btn" onclick="openTab('tab2')">MEN'S BASKETBALL</button>
            <button class="tab-btn" onclick="openTab('tab3')">MEN'S BASEBALL</button>
            <button class="tab-btn" onclick="openTab('tab4')">WOMEN'S VOLLEYBALL</button>
            <button class="tab-btn" onclick="openTab('tab5')">MUAY THAI/MMA </button>
            <button class="tab-btn" onclick="openTab('tab6')">SOCCER</button>
            <button class="tab-btn" onclick="openTab('tab7')">LACROSSE</button>
        </div>

        <div id="tab1" class="tab-content active">
            <h2>WOMEN'S BASKETBALL</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_basketball10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>

        <div id="tab2" class="tab-content">
            <h2>MEN'S BASKETBALL</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/mens_basketball10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>

        <div id="tab3" class="tab-content">
            <h2>MEN'S BASEBALL</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP1.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/BASEBALL_OP10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>

        <div id="tab4" class="tab-content">
            <h2>WOMEN'S VOLLEYBALL</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/women_volleyball10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>

        <div id="tab5" class="tab-content">
            <h2>MUAY THAI \ MMA</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/muay10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>

        <div id="tab6" class="tab-content">
            <h2>SOCCER</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>

        <div id="tab7" class="tab-content">
            <h2>LACROSSE (MEN'S)</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_men10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>

            <h2>LACROSSE (WOMEN'S)</h2>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women2.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women3.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women4.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women5.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women6.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women7.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women8.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women9.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
            <div>
                <img src="{{ asset('assets/customer_end/design_concept/soccer_women10.jpg') }}" style="width: 100%; border-radius: 15px;">
            </div>
        </div>


    </div>

    <div class="action_main_div">
        <div class="action_text_div">
            <span>REQUEST A FREE SAMPLE</span>
        </div>
        <div class="action_button_div">
            <a href="#" class="action_btn">TAKE ACTION</a>
        </div>
    </div>

    <div class="col-lg-12" style="background-color: rgb(0, 0, 0);">
        @include('pages.customer_end.common_content.review_slide')
    </div>

    <div class="col-lg-12" style="padding: 40px; background-color: rgb(249, 249, 249); padding-bottom: 40px;">
        <div class="row" style="margin: unset;">
            @include('pages.customer_end.common_content.custom_resource')
        </div>
    </div>

</div>

<script>
function openTab(tabId) {
    // Remove active from all tabs
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

    // Add to selected
    event.target.classList.add('active');
    document.getElementById(tabId).classList.add('active');
}
</script>


@endsection
