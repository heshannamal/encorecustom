@extends('layouts.customer_portal.app')

@section('content')

<style>
    @media only screen and (min-width: 320px) and (max-width: 420px )
    {
        .style-reset{
            width:145% !important;
            left: -7% !important;
        }
        .hr-style{
            width: 125% !important;
            left: -7% !important;
        }
        .right-175{
            right: 100%;
            margin-top: 8px !important;
        }
        .width-75{
            width:75px !important;
        }
        .hide-icon{
            display: none !important;
        }
        .padding-none{
            padding-left:unset !important;
            padding-right:unset !important;
        }
        .filter-style{
            display: flex;
            gap: 10px;
        }
        .filter-row{
            padding-left:unset !important;
            margin-left:unset !important;
            margin-right:unset !important;
        }
        .filter_text{
            width: 80px;
        }
        .image_width_logo{
            width: -webkit-fill-available;
            height: 85px;
        }
        .product_count{
            margin-top:unset !important;
            text-align:center !important;
            padding-right: 20% !important;
            padding-left: 20% !important;
        }

    }
    .close-button {
        position: absolute;
        top: -15px; /* Adjust the top position as needed */
        right: -12px; /* Adjust the right position as needed */
    }

    .close-button button {
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 50%;
        background-color: gray;
        height: 20px;
        width: 20px;
        line-height: 3px;
        font-size: 7px;
        color: white;
    }
    .search_div {
        height: 40px;
        box-shadow: 10px 10px 30px 0px rgba(0, 0, 0, 0.05);
    }
    .search_text {
        font-size: 14px;
        text-align: left;
        color: rgba(202, 201, 201, 1);
        background-color: transparent;
        border: unset;
        height: 95%;
    }
    .search_bar_text {
        font-size: 14px;
        text-align: left;
        color: rgba(202, 201, 201, 1);
        background-color: transparent;
        border: unset;
        height: 95%;
    }
    .hr_style {
        margin: unset;
        position: relative;
        top: -8px;
        /* width: 171%;
        left: -65%; */
        border: 1px solid rgba(222, 222, 222, 1)
    }
    .search_text::placeholder {
        font-size: 13px;
        text-align: left;
        color: rgba(202, 201, 201, 1);
    }
    .search_bar_text:hover .search_bar_text {
        color: rgba(113, 112, 112, 1);
    }
    .close-button {
        position: absolute;
        top: 8px;
        right: -33px;
    }

    .close-button button {
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 50%;
        background-color: gray;
        height: 25px;
        width: 25px;
        line-height: 3px;
        font-size: 10px;
        color: white;
        font-weight: 900;
    }
    .search_box {
        margin-right: 26px;
        padding-right: 25px;
    }
    .filter_attribute {
        margin-left: 26px;
        padding-left: 25px;
        padding-top: 30px;
        margin-right: 26px;
        padding-right: 25px;
    }
    .filter_attribute1 {
        padding-left: 25px;
        padding-right: 25px;
        /* padding-bottom: 25px; */
    }
    .enquary_attribute {
        /* margin-left: 26px;
        padding-left: 32px; */
        padding-top: 23px;
        /* margin-right: 26px;
        padding-right: 32px; */
        width: 93%;
    }
    .search_box_visible {
        display: none;
    }
    .product_content {
        padding-left: 4%;
        padding-right: 4%;
        padding-top: 40px;
    }
    .image_card {
        height: fit-content;
        width: 100%;
        /* padding: 10px; */
        border-radius: 5px;
    }
    .product_image {
        width: 100%;
        height: auto;
        padding-left: 10px;
        padding-right: 10px;
    }
    .product_div {
        padding-bottom: 20px;
        padding-right: 10px;
        padding-left: 10px;
    }
    .filter_text {
        margin-bottom: unset;
        font-size: 13px;
        border-radius: 5px;
        color: gray;
        height: 22px;
        padding-right: 10px;
    }
    .search_icon {
        padding-top: 6px;
        /* padding-left: 7px; */
        text-align: center;
    }
    .enquary_attribute_icon {
        padding-left: 10px;
        padding-right: 10px;
    }
    .product-link {
        font-size: 1rem;
        color: rgb(48, 48, 48);
    }
    .product-link:hover {
        color: rgb(105, 105, 105);
    }
    .enquiry_tab {
        font-size: 14px;
        color: white;
        padding-left: 20%;
    }
    .enquiry_box {
        background-color: rgb(0, 255, 164);
        width: 75%;
        border-radius: 5px;
        height: auto;
        /* padding-top: 7px; */
        padding: 1%
    }
    .enquiry_tab {
    display: none;
}
.product_name .hide {
    display: none;
    transition: opacity 0.5s;
    opacity: 0;
}

.product_name:hover .hide {
    display: block;
    opacity: 1;
}

.enquiry_tab .hide {
    display: block;
    transition: opacity 0.5s;
    opacity: 1;
}

.enquiry_tab:hover .hide {
    display: none;
    opacity: 0;
}
.filter_select {
    background-color: transparent;
    border: unset;
    padding-top: 4px;
    color: gray;
    text-align: center;
    outline-color: unset;
    height: 25px;
    width: 100%;
    border: 1px solid #c2c2c2;
    border-radius: 5px;
    text-align: left;
}
.filter_card {
    margin-bottom: unset;
    font-size: 11px;
    border: 1px solid #d4d4d4;
    border-radius: 5px;
    color: gray;
    background-color: #f9f9f9;
    height: 22px;
}
.head_p {
    color: rgb(55, 55, 55) !important;
    font-weight: 500;
    font-size: 24px;
    text-align: right;
    /* margin-top: 1rem; */
    }
    .hide {
    display: none;
}
.page-item.active .page-link {
    background-color: rgb(214, 214, 214) !important;
    color: gray;
    box-shadow: unset;
    border-radius: unset !important;
}
.navbar {
    background-color: white;
    padding: 10px;
    width: 100%;
    /* position: fixed; */
    z-index: 1000;
    padding-top: unset;
}

@media (min-width: 992px) {
    .navbar {
        position: fixed;
    }
    .container {
    margin-top: 150px;
    }

}
.scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    padding: .4rem .7rem;
    background-color: white;
    border: 1px solid #b3b3b3;
    border-radius: .3rem;
    color: grey;
    cursor: pointer;
}
.scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 40px;
    z-index: 1000;
    padding: .4rem .7rem;
    background-color: white;
    border: 1px solid #b3b3b3;
    border-radius: .3rem;
    color: grey;
    cursor: pointer;
}
.sub-header-style{
        font-size: 1rem;
        color: rgb(55, 55, 55) !important;
    }
    .category_row {
        margin: unset !important;
        padding-top: 20px !important;
    }
    .filter_div_space {
        /* padding-left: 30px; */
    }
    .custom-select-box {
        width: 120px;
        padding: 3px;
        /* font-size: 16px; */
        border: unset;
        border-radius: 5px;
        background-color: #f7f7f7;
        color: #a3a3a3;
        -moz-appearance: none;
        /* appearance: none; */
        padding-left: 8px;
    }

    .custom-select-box:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .custom-select-box option {
        padding: 10px;
        background-color: #fff;
        color: #333;
    }
    .body_class {
        max-width: 100%;
    }
    .group_topic {
        padding-left: 10px;
        background-color: rgb(251 251 251);
        color: rgb(80, 80, 80);
        font-size: 1.2rem;
    }

    /* Default (small screens) → sidebar mode */
.filter-sidebar {
    position: fixed;
    top: 0;
    right: -300px;
    width: 300px;
    height: 100%;
    background: #fff;
    box-shadow: -2px 0 5px rgba(0,0,0,0.3);
    transition: right 0.3s ease-in-out;
    z-index: 1050;
    overflow-y: auto;
}

/* Show when active */
.filter-sidebar.active {
    right: 0;
    background: #fff;
}

/* Overlay (small screens) */
.filter-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    z-index: 1040;
}
.filter-overlay.active {
    display: block;
}

/* Sidebar header */
.filter-sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid #ddd;
}

.close-btn {
    background: none;
    border: none;
    font-size: 1.5rem;
}

/* Large screens → normal view */
@media (min-width: 992px) {
    .filter-toggle { /* Hide hamburger */
        display: none;
    }
    .filter-sidebar {
        position: relative;
        right: 0;
        width: 100%;
        height: auto;
        box-shadow: none;
        overflow: visible;
        transition: none;
        z-index: 1 !important;
    }
    .filter-sidebar-header { /* Hide close button and title */
        display: none;
    }
    .filter-overlay {
        display: none !important;
    }
    .small_screen_search {
        padding-left: 45px !important;
    }

}

@media (max-width: 992px) {
    .filter_div_space {
        padding-left: unset !important;
    }
    .max_width_at_min {
        min-width: 90px;
    }
    .small_screen_search {
        padding-left: 45px !important;
    }
}
.filter-sidebar {
    background-color: transparent;
}
.show_more_button {
    font-weight: 500;
    padding-left: .5rem .7rem;
    color: red;
    border: 1px solid red;
}
.slider-container {
  position: relative;
  overflow: hidden;
}
.slider-container img {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  opacity: 0;
  transition: opacity 0.6s ease-in-out;
  border-radius: 5px 5px 0 0;
}
.slider-container img.active {
  opacity: 1;
  position: relative;
}
.card_div {
    display: flex;
    flex-direction: column;       /* stack image and bottom section */
    min-height: 355px;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    border: unset;
}

.image_card {
    /* flex: 1; */
    /* display: flex; */
    justify-content: center;
    align-items: center;
    width: 100%;
}

.product_bottom {
    padding: 10px;
    text-align: center;
    border-top: 1px solid #f0f0f0; /* optional separator */
}
.item_count {
    font-size: 13px;
}
.product_count {
     padding-right: 2.5rem;
}
@media (min-width: 1785px){
    .card_div {
        /* min-height: 1050px; */
    }
}
@media (min-width: 1600px){
    .container {
    max-width: 100%;
    }
    img, video {
    max-width: 100%;
    }
    .card_div {
        /* min-height: 650px; */
    }
}
@media (min-width: 1024px){
    .card_div {
        /* min-height: 453px; */
    }
}
@media (min-width: 1280px){
    .card_div {
        /* min-height: 605px; */
    }
}
@media (min-width: 1536px) and (max-width: 1600px){
    .card_div {
        /* min-height: 600px; */
    }
    .product-link {
        font-size: 1.5rem;
        /* color: rgba(202, 201, 201, 1); */
    }
    .slider-img {
        width: 100% !important;
    }
    .image_class_link {
        width: 95% ;
    }
    .group_topic {
        font-size: 1.7rem;
        font-weight: 600;
    }
    .filter_text {
        font-size: 1rem;
        margin-bottom: 10px !important;
    }
    .custom-select-box {
        font-size: 1rem;
        width: 165px;
        height: 35px;
    }
    #mainCategories option {
    font-size: 1rem; /* dropdown options podi */
    }
    .image_width_logo {
        height: 100px !important;
    }
    .head_p {
        font-size: 30px;
    }
    .item_count {
        font-size: 20px;
    }
    .product_count {
        padding-right: 6.5rem;
    }


}
@media (min-width: 1785px){
    .card_div {
        /* min-height: 750px; */
    }
}
.two-line-text {
    display: -webkit-box;
    -webkit-line-clamp: 2;   /* limit to 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;     /* allow wrapping */
    max-width: 100%;
}
.breadcrumb-wrapper {
    padding: 10px 0;
    padding-left: 60px;
}

.breadcrumb-nav {
    font-size: 14px;
    color: #3e3e3e;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 6px;
}

.breadcrumb-nav a {
    color: #3e3e3e;
    text-decoration: none;
}

.breadcrumb-nav a:hover {
    color: #111827;
    text-decoration: underline;
}

.breadcrumb-current {
    color: #111827;
    font-weight: 500;
}

/* Mobile */
@media (max-width: 768px) {
    .breadcrumb-nav {
        font-size: 12px;
    }
}
.selected-filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #acacac;
}

.selected-filter-tag .clear-filter {
    text-decoration: none;
    font-size: 15px;
    color: #999;
    cursor: pointer;
}

.selected-filter-tag .clear-filter:hover {
    color: #000;
}
.filter-column {
    min-height: 62px; /* adjust if needed */
}
.filter-placeholder {
    height: 22px; /* same height */
    padding: 12px 0px;
    margin-top: 4px;
}
/* Slider container – fixed ratio */
.slider-container {
    position: relative;
    width: 100%;
    /* aspect-ratio: 1 / 1;  */
    overflow: hidden;
}

/* Active image */
.slider-container img.active {
    display: block;
}
/* Mobile screens */
@media (max-width: 991px) {

    .filter-wrapper {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 15px !important;
        width: 100%;
    }

    .filter-wrapper > div {
        width: 100%;
    }

    .filter-wrapper .d-flex.align-items-center {
        justify-content: space-between;
    }

    .filter_select {
        width: 100%;
    }

    .product_count {
        align-items: flex-start !important;
    }
    .filter_text {
        width: 50%;
    }
    .selected-filter-tag {
        padding-right: 20px;
    }
    .card_div {
        /* min-height: 675px; */
    }
}

@media (max-width: 1138px) and (min-width: 992px){
    .container {
        margin-top: 200px !important;
    }
}
@media (max-width: 1200px) and (min-width: 992px){
    .custom-select-box {
        font-size: 0.7rem;
        width: 80px;
        height: 25px;
    }
}
@media (min-width: 2275px) {
    .card_div {
        /* min-height: 835px; */
    }
}
.product_name {
    /* min-height: 75px; */
    padding: 0px 20px;
}
.two-line-text {
    display: -webkit-box;
    -webkit-line-clamp: 2;   /* max lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    line-height: 1.4em;
    height: 2.8em; /* line-height × 2 */
}
.product_price {
    /* font-weight: 600; */
}
.custom-select-box:disabled {
    background-color: #d3d3d3;
    color: #6c757d;
    cursor: not-allowed;
}
.card_div {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card_div:hover {
    transform: scale(1.02);
    box-shadow: rgba(0, 0, 0, 0.25) 0px 8px 20px;
    z-index: 10;
}
.product_div {
    overflow: visible;
}
.card_div {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.enquiry_tab {
    margin-top: auto;
}
.shine-text {
    font-size: 12px;
    color: #555;
    margin-top: 5px;
    padding: 0px 20px 10px;

    position: relative;
    display: inline-block;

    background: linear-gradient(
        80deg,
        #555 0%,
        #555 40%,
        #ffffff 50%,
        #555 60%,
        #555 100%
    );

    background-size: 200% auto;
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;

    transition: background-position 1.6s ease;
}

/* Hover effect */
.shine-text:hover {
    background-position: -200% center;
}

</style>

<div class="navbar" style=" background-color:white; z-index:99; padding: unset;">


    @section('page-route')
        <a href="{{ route('customer_catlog') }}">
            <img src="{{ asset('argon') }}/img/encore/logo_dark.png" alt="image" style="width:auto !important; color:black;height: 85px;" class="image_width_logo">
        </a>
    @endsection

    @section('apparel-catalog')
        {{-- <a href="{{ route('customer_catlog') }}"> --}}
            <p class="head_p">APPAREL CATALOG</p>
        {{-- </a> --}}
    @endsection

    @include('pages.customer_product_catlog.layout.header')


    {{-- <hr style="margin: unset; width: 90%; margin-left: 5%;"> --}}

    {{-- <div class="filter_attribute1 col-lg-9 padding-none" style=""> --}}
        <div class="col-lg-12 filter-sidebar" id="filterSidebar"  style="padding: unset; border-bottom: 1px solid rgb(235, 235, 235);">



            <div class="filter-sidebar-header">
                <h5>Filters</h5>
                <button id="closeFilter" class="close-btn">&times;</button>
            </div>

            <div class="row align-items-center"
                style="margin: unset; padding: 15px 3.5% 15px; gap: 20px;">

                <!-- LEFT : Breadcrumb -->
                <div class="breadcrumb-wrapper">
                    <nav class="breadcrumb-nav">
                        <a href="{{ route('customer_catlog') }}" style="font-size: 15px; font-weight: 500;">Home</a>
                        <span>/</span>

                        <a href="{{ route('product_filter1', [
                            'selectedGender' => 'All',
                            'selectedCategory' => '5',
                            'selectedSport' => '18',
                            'selectedStyle' => '0',
                        ]) }}">
                            Catalog
                        </a>
                    </nav>
                </div>


                <!-- RIGHT : Filters + Count -->
                <div class="d-flex align-items-center ms-auto filter-wrapper" style="gap: 20px;">

                    <!-- Category -->
                    <div class="d-flex flex-column">

                        @php
                            $selectedMainCategory = $selectedMainCategory ?? 5;
                            $selectedGender = $selectedGender ?? 'All';
                            $selectedSport = $selectedSport ?? 18;
                            $selectedStyle = $selectedStyle ?? 0;
                        @endphp

                        @php
                            $hasAnyFilter =
                                (!empty($selectedMainCategory) && $selectedMainCategory != 5) ||
                                (!empty($selectedGender) && $selectedGender !== 'All') ||
                                (!empty($selectedSport) && $selectedSport != 18) ||
                                (!empty($selectedStyle) && $selectedStyle != 0);
                        @endphp

                        <!-- Label + Select (ROW) -->
                        <div class="d-flex align-items-center">
                            <p class="filter_text mb-0 me-2">Category</p>

                            <select id="mainCategories" class="filter_select custom-select-box">
                                @foreach ($mainCategory as $mainCat)
                                    <option value="{{ $mainCat->id }}"
                                        {{ $selectedMainCategory == $mainCat->id ? 'selected' : '' }}>
                                        {{ $mainCat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selected value (BELOW SELECT) -->
                        @if(!empty($selectedMainCategory) && $selectedMainCategory != 5 && !empty($hasAnyFilter))
                            @php
                                $cat = $mainCategory->firstWhere('id', $selectedMainCategory);
                            @endphp

                            @if($cat)
                                <div class="selected-filter-tag mt-1 ms-auto">
                                    <span>{{ $cat->category_name }}</span>

                                    <a href="{{ route('product_filter1', [
                                        'selectedCategory' => 5,
                                        'selectedGender' => $selectedGender ?? 'All',
                                        'selectedSport' => $selectedSport ?? 18,
                                        'selectedStyle' => $selectedStyle ?? 0,
                                    ]) }}"
                                    class="clear-filter">×</a>
                                </div>
                            @endif
                        @elseif ($hasAnyFilter)
                            <div class="filter-placeholder"></div>
                        @endif


                    </div>


                    <!-- Gender -->
                    <div class="d-flex flex-column">

                        <div class="d-flex align-items-center">
                            <p class="filter_text mb-0 me-2">Gender</p>
                            <select id="genderSelect" class="filter_select custom-select-box">
                                <option value="Men" {{ $selectedGender == 'Men' ? 'selected' : '' }}>Men's</option>
                                <option value="Women" {{ $selectedGender == 'Women' ? 'selected' : '' }}>Women's</option>
                                <option value="All" {{ $selectedGender == 'All' ? 'selected' : '' }}>All</option>
                            </select>
                        </div>

                        @if(!empty($selectedGender) && $selectedGender !== 'All'  && !empty($hasAnyFilter))
                            <div class="selected-filter-tag mt-1 ms-auto">
                                <span>{{ $selectedGender }}</span>
                                <a href="{{ route('product_filter1', [
                                    'selectedGender' => 'All',
                                    'selectedCategory' => $selectedMainCategory ?? 5,
                                    'selectedSport' => $selectedSport ?? 18,
                                    'selectedStyle' => $selectedStyle ?? 0,
                                ]) }}" class="clear-filter">×</a>
                            </div>
                        @elseif ($hasAnyFilter)
                            <div class="filter-placeholder"></div>
                        @endif

                    </div>

                    <!-- Sport -->
                    <div class="d-flex flex-column">

                        <!-- Label + Select -->
                        <div class="d-flex align-items-center">
                            <p class="filter_text mb-0 me-2">Sport</p>
                            <select id="sportSelect" class="filter_select custom-select-box" {{ $selectedMainCategory == 3 ? 'disabled' : '' }}>
                                @foreach ($sports as $sport)
                                    <option value="{{ $sport->id }}"
                                        {{ $selectedSport == $sport->id ? 'selected' : '' }}>
                                        {{ $sport->sport_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selected sport BELOW -->
                        @if(!empty($selectedSport) && $selectedSport != 18  && !empty($hasAnyFilter))
                            @php
                                $sportObj = $sports->firstWhere('id', $selectedSport);
                            @endphp

                            @if($sportObj)
                                <div class="selected-filter-tag mt-1 ms-auto">
                                    <span>{{ $sportObj->sport_name }}</span>

                                    <a href="{{ route('product_filter1', [
                                        'selectedSport' => 18,
                                        'selectedCategory' => $selectedMainCategory ?? 5,
                                        'selectedGender' => $selectedGender ?? 'All',
                                        'selectedStyle' => $selectedStyle ?? 0,
                                    ]) }}"
                                    class="clear-filter">×</a>
                                </div>
                            @endif
                        @elseif ($hasAnyFilter)
                            <div class="filter-placeholder"></div>
                        @endif

                    </div>

                    <!-- Style -->
                    <div class="d-flex flex-column">

                        <!-- Label + Select -->
                        <div class="d-flex align-items-center">
                            <p class="filter_text mb-0 me-2">Style</p>
                            <select id="styleSelect" class="filter_select custom-select-box" {{ $selectedMainCategory == 1 ? 'disabled' : '' }}>
                                <option value="0">All</option>
                                @foreach ($productCategories as $productStyle)
                                    <option value="{{ $productStyle->id }}"
                                        {{ $selectedStyle == $productStyle->id ? 'selected' : '' }}>
                                        {{ $productStyle->product_category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selected style BELOW -->
                        @if(!empty($selectedStyle) && $selectedStyle != 0  && !empty($hasAnyFilter))
                            @php
                                $styleObj = $productCategories->firstWhere('id', $selectedStyle);
                            @endphp

                            @if($styleObj)
                                <div class="selected-filter-tag mt-1 ms-auto">
                                    <span>{{ $styleObj->product_category_name }}</span>

                                    <a href="{{ route('product_filter1', [
                                        'selectedStyle' => 0,
                                        'selectedCategory' => $selectedMainCategory ?? 5,
                                        'selectedGender' => $selectedGender ?? 'All',
                                        'selectedSport' => $selectedSport ?? 18,
                                    ]) }}"
                                    class="clear-filter">×</a>
                                </div>
                            @endif
                        @elseif ($hasAnyFilter)
                            <div class="filter-placeholder"></div>
                        @endif

                    </div>


                    <!-- Item count -->


                    <div class="product_count d-flex flex-column align-items-end">

                        <p class="item_count mb-0" style="color: grey;"></p>

                        @if($hasAnyFilter)
                            <a href="{{ route('product_filter1', [
                                'selectedCategory' => 5,
                                'selectedGender' => 'All',
                                'selectedSport' => 18,
                                'selectedStyle' => 0,
                            ]) }}"
                            class="clear-all-filters selected-filter-tag mt-1 clear-filter">
                                Clear ×
                            </a>
                        @elseif (!empty($hasAnyFilter))
                            <div class="filter-placeholder"></div>
                        @endif

                    </div>


                </div>
            </div>


        </div>
    {{-- </div> --}}


    {{-- <div class="col-lg-3 product_count" style="text-align: right; margin-top: 1.8rem; padding-right: 2.5rem;">

        <p class="item_count" style="font-size: 13px; color: grey;"></p>
    </div> --}}
</div>

<hr style="margin: unset; width: 90%; margin-left: 5%;">
{{-- <div class="container col-lg-12 product_content">
    <div class="row">
        @foreach ($matchingData as $matchingProduct)
            <div class="col-lg-3 product_div">
                <div class="card">
                    <div style="height: 300px;">
                        <div class="image_card">
                            @php
                            $defaultSearchValue = ''; // Define a default value
                        @endphp

                        <a href="{{ route('product.show', ['id' => $matchingProduct->id, 'searchValue' => $searchValue ?? $defaultSearchValue]) }}">
                            <img class="product_image" src="{{ $matchingProduct->mockup_img_1 }}" alt="" onerror="setDefaultImage()">
                        </a>
                            <div class="like_tag" style="position: absolute; top: 12px; right: 20px;">
                                <img style="width: 22px;" src="{{ asset('argon') }}/img/icons/customer_portal/heart.png" alt="">
                            </div>
                        </div>
                        <div class="product_name" style="text-align: center;">
                            <a href="#" class="product-link">{{ $matchingProduct->product_name}}</a>
                        </div>
                        <div class="enquiry_tab hide" style="text-align: center;">
                            <div class="enquiry_box">
                                ADD TO ENQUIRY
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

<div class="container col-lg-12 product_content" style="min-height: 70vh; max-width: 100%;">
    <div id="paste_container" class="row">
        <!-- Products will be dynamically displayed here -->
    </div>
</div>
<div>
    <div id="paginationbar" class="row justify-content-center" style="width: 103%;">
      {{-- pagination bar paste here --}}
    </div>
</div>

<button class="scroll-to-top" id="copyButton"><i class="fa fa-clone" aria-hidden="true" title="Copy Page URL"></i></button>

<button class="scroll_up scroll-to-top " style="right: 90px;" id="scroll_up"><i class="fa fa-arrow-up" aria-hidden="true" title="Copy Page URL"></i></button>

@include('pages.customer_product_catlog.layout.footer')

{{-- <footer style="background-color: #f4f4f4; z-index: 100; border-top: rgb(235, 232, 232) solid 0.5px;">
    <div class="section_new" style="margin-left: 10%;margin-right: 10%;">
        <div class="row">
            <div class="col-md-4" style="border-right: 2px solid #e6e6e6;margin-top: 1rem;margin-bottom: 1rem;">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <img src="{{ asset('argon') }}/img/encore/logo_dark.png" alt="image" style="height: 3rem; color:black" class="image_width">
                    </div>
                    <div class="col-md-12 mt-3" style="color: grey">
                        Custom made sportwear for teams, <br> training and lifestyle.
                    </div>
                    <div class="col-md-12 mt-3" style="color: grey">
                        © Encore Custom 2024. All Rights Reserved.
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="margin-top: 1rem;margin-bottom: 1rem;padding-left: 10%;">
                <div class="row">
                    <div class="col-md-12 sub-header-style mt-3">
                        Contact
                    </div>
                    <div class="col-md-12 mt-3" style="color: grey">
                        <i class="fa fa-envelope-o" aria-hidden="true" style="font-size: 1rem;"></i>&nbsp;&nbsp;info@encorecustom.com
                    </div>
                    <div class="col-md-12 mt-3" style="color: grey">
                        <i class="fa fa-phone" aria-hidden="true" style="font-size: 1rem;"></i>&nbsp;&nbsp;+1 888-501-4999
                    </div>
                    <div class="col-md-12 mt-3" style="color: grey">
                        <i class="fa fa-map-marker" aria-hidden="true" style="font-size: 1rem;"></i>&nbsp;&nbsp;891 4th St, San Rafael, <br> &nbsp;&nbsp;&nbsp;&nbsp;CA 94901, USA
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="border-left: 2px solid #e6e6e6;margin-top: 1rem;margin-bottom: 1rem;padding-left: 10%;">
                <div class="row">
                    <div class="col-md-12 sub-header-style mt-3">
                        Explore
                    </div>
                    <div class="col-md-12 mt-3">
                        <a href="http://www.encorecustom.com" target="_blank" style="color: grey">
                            <i class="fa fa-safari" aria-hidden="true" style="font-size: 1rem;color: grey"></i>&nbsp;&nbsp;www.EncoreCustom.com
                        </a>
                    </div>
                    <div class="col-md-12 sub-header-style mt-3">
                        Connect
                    </div>
                    <div class="col-md-12 mt-3" style="color: grey">
                        <a href="http://www.encorecustom.com" target="_blank" style="color: grey">
                            <i class="fa fa-facebook-square" aria-hidden="true" style="font-size: 2rem;"></i>
                        </a>
                        <a href="http://www.encorecustom.com" target="_blank" style="color: grey">
                            <i class="fa fa-instagram ml-3" aria-hidden="true" style="font-size: 2rem;"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> --}}

{{-- <form action="{{ route('product_filter1') }}" method="POST" id="filterForm">
    @csrf
    <input type="hidden" name="selectedCategory" id="selectedCategoryInput" value="">
    <input type="hidden" name="selectedGender" id="selectedGenderInput" value="">
    <input type="hidden" name="selectedSport" id="selectedSportInput" value="">
    <input type="hidden" name="selectedStyle" id="selectedStyleInput" value="">
    <button style="display: none;" type="submit">Submit</button>
</form>


<form action="{{ route('search.products') }}" method="POST" id="searchForm">
    @csrf
    <input type="hidden" name="search" id="searchInput" value="">
    <button style="display: none;" type="submit">Submit</button>
</form> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<!-- Add SweetAlert stylesheet -->

<!-- Add SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>


<script>
    document.getElementById("scroll_up").addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
       var clipboard = new ClipboardJS('#copyButton', {
          text: function () {
             return window.location.href;
          }
       });

       clipboard.on('success', function (e) {
        Swal.fire({
                title: 'Link copied',
                icon: 'success',
                confirmButtonText: 'OK',
            });
       });

       clipboard.on('error', function (e) {
        Swal.fire({
            title: 'Copy failed',
            text: 'An error occurred while copying the link.',
            icon: 'error',
            confirmButtonText: 'OK',
        });
       });
    });
 </script>


<script>
    function handleDropdownChange() {
        updateHiddenInput('mainCategories', 'selectedCategoryInput');
        updateHiddenInput('genderSelect', 'selectedGenderInput');
        updateHiddenInput('sportSelect', 'selectedSportInput');
        updateHiddenInput('styleSelect', 'selectedStyleInput');

        const selectedCategory = document.querySelector('input[name="selectedCategory"]').value;
        const selectedGender = document.querySelector('input[name="selectedGender"]').value;
        const selectedSport = document.querySelector('input[name="selectedSport"]').value;
        const selectedStyle = document.querySelector('input[name="selectedStyle"]').value;

        const url = "{{ route('product_filter1') }}" +
            "?selectedCategory=" + encodeURIComponent(selectedCategory) +
            "&selectedGender=" + encodeURIComponent(selectedGender) +
            "&selectedSport=" + encodeURIComponent(selectedSport) +
            "&selectedStyle=" + encodeURIComponent(selectedStyle);

        history.pushState(null, null, url);

    }

    function updateHiddenInput(selectId, hiddenInputId) {
        var selectedValue = $('#' + selectId).val();
        var hiddenInput = $('#' + hiddenInputId);
        hiddenInput.val(selectedValue);
    }

    $(document).ready(function () {
        $('.filter_select').change(handleDropdownChange);
    });
</script>

<form action="{{ route('product_filter1') }}" method="GET" id="filterForm">
    @csrf
    <input type="hidden" name="selectedCategory" id="selectedCategoryInput" value="">
    <input type="hidden" name="selectedGender" id="selectedGenderInput" value="">
    <input type="hidden" name="selectedSport" id="selectedSportInput" value="">
    <input type="hidden" name="selectedStyle" id="selectedStyleInput" value="">
    <!-- Remove the submit button -->
</form>




<form action="{{ route('search.products') }}" method="GET" id="searchForm" onsubmit="return submitSearchForm()">
    @csrf
    <input type="hidden" name="search" id="searchInput" value="">
    <button style="display: none;" type="submit">Submit</button>
</form>

<script>
    function submitSearchForm() {
        var searchValue = document.getElementById('searchInput').value;
        var form = document.getElementById('searchForm');
        form.action = "{{ route('search.products') }}" + "?search=" + encodeURIComponent(searchValue);
        return true;
    }
</script>

<script>
  function setDefaultImage(id) {
    console.log(id);
    var imgElement = document.getElementById(id);

    if (imgElement) {
      imgElement.src = 'assets/img/products/def.jpg';
    }
  }
</script>

<script>

// $('.filter_select').select2();

$(document).ready(function () {
    // Triggered when the value of any select element changes
    $('.filter_select').change(function () {
        // Update the corresponding hidden input value
        updateHiddenInput('mainCategories', 'selectedCategoryInput');
        updateHiddenInput('genderSelect', 'selectedGenderInput');
        updateHiddenInput('sportSelect', 'selectedSportInput');
        updateHiddenInput('styleSelect', 'selectedStyleInput');

        // Submit the form
        $('#filterForm').submit();
    });

    // Function to update the hidden input value based on the selected option
    function updateHiddenInput(selectId, hiddenInputId) {
        var selectedValue = $('#' + selectId).val();
        var hiddenInput = $('#' + hiddenInputId)[0]; // Get the DOM element

        // Add your specific condition here
        // if (selectId === 'mainCategories' && selectedValue === '5') {
        //     hiddenInput.value = ""; // Set it to an empty string
        // } else {
            hiddenInput.value = selectedValue;
        // }
    }
});


    const matchingData = @json($matchingData);

    let totalValues1;

    // Check if matchingData is an array
    if (Array.isArray(matchingData)) {
        totalValues1 = matchingData.length;
    } else if (typeof matchingData === 'object') {
        // Check if matchingData is an object
        totalValues1 = Object.keys(matchingData).length;
    } else {
        console.error('matchingData is not an array or object.');
    }

    // Set the value of the <p> element
    const itemCountElement = document.querySelector('.item_count');
    if (itemCountElement) {
        itemCountElement.textContent = ` ${totalValues1} Items`;
    } else {
        console.error('Element with class "item_count" not found.');
    }

    @php
        $searchValue = $searchValue ?? '';
        $selectedGender = $selectedGender ?? '';
        $selectedCategory = $selectedCategory ?? '';
        $selectedSport = $selectedSport ?? '';
        $selectedStyle = $selectedStyle ?? '';
    @endphp

    const searchValue = @json($searchValue);
    const selectedGender = @json($selectedGender);
    const selectedCategory = @json($selectedCategory);
    const selectedSport = @json($selectedSport);
    const selectedStyle = @json($selectedStyle);
    const products = (matchingData && matchingData) ? matchingData : [];
    const productCategories = @json($productCategories);

    var customOrder = [20, 8, 11, 21, 9, 2, 7, 1, 17, 5, 3];

    if (selectedSport == 2 || selectedSport == 15) {
        customOrder = [20, 2, 11, 21, 8, 9, 7, 1, 17, 5, 3];
    }

    const sortedCategories = productCategories.sort((a, b) => {
        let aIndex = customOrder.indexOf(Number(a.id));
        let bIndex = customOrder.indexOf(Number(b.id));

        if (aIndex === -1) aIndex = Infinity;
        if (bIndex === -1) bIndex = Infinity;

        return aIndex - bIndex;
    });

    productCategories.forEach(productCategory => {

            var filteredProducts = products.filter(item =>
                item.category.some(cat => cat == productCategory.id)
            );

            // if(selectedStyle != 0 && selectedStyle != productCategory.id){
            //     filteredProducts = [];
            // }

            if (filteredProducts.length > 0) {
                var headerContent = `
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3 mb-3" style="padding: 0px 7px;">
                                        <div class="group_topic" style="display: flex; justify-content: space-between; align-items: center; padding-top: 0.3rem; padding-bottom: 0.3rem;">
                                            <span>${productCategory.product_category_name}</span>
                                            <i class="fa fa-chevron-down catagory_chevron mr-3" style="cursor:pointer" data-category-id="${productCategory.id}" aria-hidden="true"></i>
                                        </div>
                                    </div>`;

                $('#paste_container').append(headerContent);

                filteredProducts.forEach((item, index) => {
                    var product = item.data;

                    let extraContent = '';

                    console.log(item.data);

                    let hasSublimation = false;

                    if (item.relatedEmbellishments && item.relatedEmbellishments.length > 0) {
                        hasSublimation = item.relatedEmbellishments.some(e =>
                            e.embellishment_name &&
                            e.embellishment_name.toLowerCase().includes('sublimation')
                        );
                    }

                    if (hasSublimation) {

                        extraContent = `
                            <div class="shine-text">
                                This Product Can Be Sublimated In Any Color
                            </div>
                        `;

                    } else {

                        let colorCircles = '';

                        if (item.relatedFabric && item.relatedFabric.length > 0) {

                            const colors = item.relatedFabric[0].fabric_detail.colors;

                            if (colors) {
                                try {
                                    const parsedColors = JSON.parse(colors);

                                    parsedColors.forEach(color => {
                                        colorCircles += `
                                            <div style="
                                                width:18px;
                                                height:18px;
                                                border-radius:50%;
                                                background:${color.code};
                                                border:1px solid #ccc;
                                            " title="${color.name}"></div>
                                        `;
                                    });

                                } catch (e) {
                                    console.log('Color parse error', e);
                                }
                            }
                        }

                        if (colorCircles) {
                            extraContent = `
                                <div style="display:flex; gap: 13px; padding: 0px 20px;padding-bottom: 10px; align-items:center; margin-top:5px;">
                                    <span style="font-size: 12px; color:#555;">Available In</span>
                                    <div style="display:flex; gap:4px;">
                                        ${colorCircles}
                                    </div>
                                </div>
                            `;
                        }
                        // else {
                        //     // 🔥 IMPORTANT PART (empty case)
                        //     extraContent = `
                        //         <div style="min-height:20px;"></div>
                        //     `;
                        // }
                    }

                    var maxIndex = filteredProducts.length - 1;
                    if (item.type == 'product') {
                        const productId = product.product_id !== undefined ? product.product_id : product.id;
                        const imageURL = product.mockup_img_1 ? product.mockup_img_1 : 'assets/img/products/product_default_image.jpg';

                        let queryParams = [];


                        let sliderImages = '';

                        // ✅ Always show mockup_img_1 first
                        if (product.mockup_img_1) {
                            sliderImages += `<img class="slider-img active"
                                src="https://encr.co/assets/${product.mockup_img_1}"
                                alt="mockup 1"
                                onerror="this.src='assets/img/products/default-loading.gif'">`;
                        }

                        // ✅ Check studio images
                        if (item.studio_images && item.studio_images.length > 0) {

                            // 👉 Add studio images after mockup 1
                            item.studio_images.forEach((img) => {
                                sliderImages += `<img class="slider-img"
                                    src="{{ asset('') }}${img.image_link}"
                                    alt="studio image"
                                    onerror="this.src='assets/img/products/default-loading.gif'">`;
                            });

                        } else {

                            // 👉 Only if NO studio images → add mockup 2 & 3
                            if (product.mockup_img_2) {
                                sliderImages += `<img class="slider-img"
                                    src="https://encr.co/assets/${product.mockup_img_2}"
                                    alt="mockup 2"
                                    onerror="this.src='assets/img/products/default-loading.gif'">`;
                            }

                            if (product.mockup_img_3) {
                                sliderImages += `<img class="slider-img"
                                    src="https://encr.co/assets/${product.mockup_img_3}"
                                    alt="mockup 3"
                                    onerror="this.src='assets/img/products/default-loading.gif'">`;
                            }
                        }

                        // ✅ Final fallback
                        if (!sliderImages) {
                            sliderImages = `<img class="slider-img active"
                                src="https://encr.co/assets/img/products/product_default_image.jpg"
                                alt="default"
                                onerror="this.src='assets/img/products/default-loading.gif'">`;
                        }

                        queryParams.push(`type=${encodeURIComponent('product')}`);
                        if (searchValue) queryParams.push(`search=${encodeURIComponent(searchValue)}`);
                        if (selectedGender) queryParams.push(`selectedGender=${encodeURIComponent(selectedGender)}`);
                        if (selectedCategory) queryParams.push(`selectedCategory=${encodeURIComponent(selectedCategory)}`);
                        if (selectedSport) queryParams.push(`selectedSport=${encodeURIComponent(selectedSport)}`);
                        if (selectedStyle) queryParams.push(`selectedStyle=${encodeURIComponent(selectedStyle)}`);

                        const productUrl = `productDetails/${productId}${queryParams.length ? '?' + queryParams.join('&') : ''}`;

                        const cardDisplay = index < 8 ? 'block' : 'none';
                        const category_class = index >= 8 ? `show_more_category_${productCategory.id}` : '';

                        const productCard = `
                            <div class="col-lg-3 col-md-6 col-sm-6 product_div div_by_category_${productCategory.id} ${category_class}" style="display: ${cardDisplay};">
                                <div class="card card_div" style=" box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; border: unset;">


                                        <div class="image_card" style="background-image: url('https://encr.co/assets/img/customer_catalog/catalog_background.jpg');
                                                background-size: cover;
                                                background-position: center;
                                                position: relative;
                                                margin-bottom: 10px;">

                                            <a href="${productUrl}" class="image_class_link">
                                                <div class="slider-container">
                                                    ${sliderImages}
                                                </div>
                                            </a>

                                            <div class="like_tag" style="position: absolute; top: 12px; right: 20px; display:none;">
                                                <img style="width: 22px;" src="{{ asset('argon') }}/img/icons/customer_portal/heart.png" alt="">
                                            </div>
                                        </div>
                                        <div class="product_name" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">

                                            <a href="#" class="product-link two-line-text" style="
                                                text-align: left;
                                                flex: 1;
                                                display: -webkit-box;
                                                -webkit-line-clamp: 2;
                                                -webkit-box-orient: vertical;
                                                overflow: hidden;
                                                font-weight: 500;
                                            ">
                                                ${product.show_in_catalog_name || product.product_name}
                                            </a>

                                            <p class="product-link product_price" style="
                                                white-space: nowrap;
                                                text-align: right;
                                                margin: 0;
                                                font-weight: 500;
                                            ">
                                                $${product.default_price}
                                            </p>

                                        </div>

                                        ${extraContent}

                                        <div class="enquiry_tab hide" style="text-align: center;">
                                            <div class="enquiry_box mb-3 mt-2">
                                                ADD TO ENQUIRY
                                            </div>
                                        </div>

                                </div>
                            </div>

                        `;

                        $('#paste_container').append(productCard);

                        if(index >= 8 && index == maxIndex){
                            var moreContent = `<div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0px 10px;">
                                        <div style="text-align: center;"><button data-category-value="${productCategory.id}" id="show_more_button_${productCategory.id}" class="btn show_more_button" style="padding: .5rem .7rem;">Show more <i class="fa fa-chevron-down catagory_chevron" style="padding-left: 5px;"></i> </button></div>
                                    </div>`;

                            $('#paste_container').append(moreContent);
                        }
                    }else{
                        const productId = product.sub_product_id !== undefined ? product.sub_product_id : product.id;
                        const imageURL = product.mockup_img_1 ? product.mockup_img_1 : 'assets/img/products/product_default_image.jpg';


                        // let sliderImages = '';

                        // // --- Step 1: Add mockup images if available ---
                        // if (product.mockup_img_1) {
                        //     sliderImages += `<img class="slider-img active"
                        //                         src="https://encr.co/assets/${product.mockup_img_1}"
                        //                         alt="mockup 1"
                        //                         onerror="this.src='assets/img/products/default-loading.gif'">`;
                        // }
                        // if (product.mockup_img_2) {
                        //     sliderImages += `<img class="slider-img"
                        //                         src="https://encr.co/assets/${product.mockup_img_2}"
                        //                         alt="mockup 2"
                        //                         onerror="this.src='assets/img/products/default-loading.gif'">`;
                        // }
                        // if (product.mockup_img_3) {
                        //     sliderImages += `<img class="slider-img"
                        //                         src="https://encr.co/assets/${product.mockup_img_3}"
                        //                         alt="mockup 3"
                        //                         onerror="this.src='assets/img/products/default-loading.gif'">`;
                        // }

                        // // --- Step 2: Add studio images if available ---
                        // if (item.studio_images && item.studio_images.length > 0) {
                        //     item.studio_images.forEach((img) => {
                        //         sliderImages += `<img class="slider-img"
                        //                             src="{{ asset('') }}${img.image_link}"
                        //                             alt="studio image"
                        //                             onerror="this.src='assets/img/products/default-loading.gif'">`;
                        //     });
                        // }

                        // // --- Step 3: If nothing, show default image ---
                        // if (!sliderImages) {
                        //     sliderImages = `<img class="slider-img active"
                        //                         src="https://encr.co/assets/img/products/product_default_image.jpg"
                        //                         alt="default"
                        //                         onerror="this.src='assets/img/products/default-loading.gif'">`;
                        // }

                        let sliderImages = '';

                        // ✅ Always show mockup_img_1 first
                        if (product.mockup_img_1) {
                            sliderImages += `<img class="slider-img active"
                                src="https://encr.co/assets/${product.mockup_img_1}"
                                alt="mockup 1"
                                onerror="this.src='assets/img/products/default-loading.gif'">`;
                        }

                        // ✅ Check studio images
                        if (item.studio_images && item.studio_images.length > 0) {

                            // 👉 Add studio images after mockup 1
                            item.studio_images.forEach((img) => {
                                sliderImages += `<img class="slider-img"
                                    src="{{ asset('') }}${img.image_link}"
                                    alt="studio image"
                                    onerror="this.src='assets/img/products/default-loading.gif'">`;
                            });

                        } else {

                            // 👉 Only if NO studio images → add mockup 2 & 3
                            if (product.mockup_img_2) {
                                sliderImages += `<img class="slider-img"
                                    src="https://encr.co/assets/${product.mockup_img_2}"
                                    alt="mockup 2"
                                    onerror="this.src='assets/img/products/default-loading.gif'">`;
                            }

                            if (product.mockup_img_3) {
                                sliderImages += `<img class="slider-img"
                                    src="https://encr.co/assets/${product.mockup_img_3}"
                                    alt="mockup 3"
                                    onerror="this.src='assets/img/products/default-loading.gif'">`;
                            }
                        }

                        // ✅ Final fallback
                        if (!sliderImages) {
                            sliderImages = `<img class="slider-img active"
                                src="https://encr.co/assets/img/products/product_default_image.jpg"
                                alt="default"
                                onerror="this.src='assets/img/products/default-loading.gif'">`;
                        }

                        let queryParams = [];

                        queryParams.push(`type=${encodeURIComponent('sub_product')}`);
                        if (searchValue) queryParams.push(`search=${encodeURIComponent(searchValue)}`);
                        if (selectedGender) queryParams.push(`selectedGender=${encodeURIComponent(selectedGender)}`);
                        if (selectedCategory) queryParams.push(`selectedCategory=${encodeURIComponent(selectedCategory)}`);
                        if (selectedSport) queryParams.push(`selectedSport=${encodeURIComponent(selectedSport)}`);
                        if (selectedStyle) queryParams.push(`selectedStyle=${encodeURIComponent(selectedStyle)}`);

                        const productUrl = `productDetails/${productId}${queryParams.length ? '?' + queryParams.join('&') : ''}`;

                        const cardDisplay = index < 8 ? 'block' : 'none';
                        const category_class = index >= 8 ? `show_more_category_${productCategory.id}` : '';

                        const productCard = `
                            <div class="col-lg-3 col-md-6 col-sm-6 product_div div_by_category_${productCategory.id} ${category_class}" onmouseover="showEnquiryTab(this)" onmouseout="hideEnquiryTab(this)" style="display: ${cardDisplay};">
                                <div class="card card_div" style=" box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; border: unset;">

                                        <div class="image_card"  style="background-image: url('https://encr.co/assets/img/customer_catalog/catalog_background.jpg');
                                                background-size: cover;
                                                background-position: center;
                                                position: relative;
                                                margin-bottom: 10px;">

                                            <a href="${productUrl}">
                                                <div class="slider-container">
                                                    ${sliderImages}
                                                </div>
                                            </a>

                                            <div class="like_tag" style="position: absolute; top: 12px; right: 20px; display:none;">
                                                <img style="width: 22px;" src="{{ asset('argon') }}/img/icons/customer_portal/heart.png" alt="">
                                            </div>
                                        </div>
                                        <div class="product_name" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">

                                            <a href="#" class="product-link two-line-text" style="
                                                text-align: left;
                                                flex: 1;
                                                display: -webkit-box;
                                                -webkit-line-clamp: 2;
                                                -webkit-box-orient: vertical;
                                                overflow: hidden;
                                                font-weight: 500;
                                            ">
                                                ${product.show_in_catalog_name || product.product_name}
                                            </a>

                                            <p class="product-link product_price" style="
                                                white-space: nowrap;
                                                text-align: right;
                                                margin: 0;
                                                font-weight: 500;
                                            ">
                                                $${product.default_price}
                                            </p>

                                        </div>

                                        ${extraContent}

                                        <div class="enquiry_tab hide" style="text-align: center;">
                                            <div class="enquiry_box mb-3 mt-2">
                                                ADD TO ENQUIRY
                                            </div>
                                        </div>

                                </div>
                            </div>

                        `;

                        $('#paste_container').append(productCard);

                        if(index >= 8 && index == maxIndex){
                            var moreContent = `<div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0px 10px;">
                                        <div style="text-align: center;"><button data-category-value="${productCategory.id}" id="show_more_button_${productCategory.id}" class="btn show_more_button" style="padding: .5rem .7rem;">Show more <i class="fa fa-chevron-down catagory_chevron" style="padding-left: 5px;"></i> </button></div>
                                    </div>`;

                            $('#paste_container').append(moreContent);
                        }
                    }
                });
            }
    });

    let sliderTimers = new WeakMap();

    document.addEventListener('mouseover', function (e) {
        const container = e.target.closest('.slider-container');
        if (!container) return;

        const images = container.querySelectorAll('.slider-img');
        if (images.length <= 1) return;

        let index = 0;
        const timer = setInterval(() => {
            images[index].classList.remove('active');
            index = (index + 1) % images.length;
            images[index].classList.add('active');
        }, 1200);

        sliderTimers.set(container, timer);
    });

    document.addEventListener('mouseout', function (e) {
        const container = e.target.closest('.slider-container');
        if (!container) return;

        const timer = sliderTimers.get(container);
        if (timer) {
            clearInterval(timer);
            sliderTimers.delete(container);
        }

        // Reset back to first image
        const images = container.querySelectorAll('.slider-img');
        if (images.length > 0) {
            images.forEach(img => img.classList.remove('active'));
            images[0].classList.add('active');
        }
    });


    $(document).on('click', '.show_more_button', function () {
        var categoryId = $(this).data('category-value');
        var targetDivs = $(`.show_more_category_${categoryId}`);

        targetDivs.toggle();

        if (targetDivs.is(':visible')) {
            $(this).text('Show less');
        } else {
            $(this).text('Show more');
        }
    });

    $(document).on('click', '.catagory_chevron', function () {
        var categoryId = $(this).data('category-id');
        var targetDivs = $('.div_by_category_' + categoryId);

        var targetHideDivs = $(`.show_more_category_${categoryId}`);

        $(this).toggleClass('fa-chevron-down fa-chevron-right');

        if (targetDivs.is(':visible')) {
            targetDivs.hide();
            $('#show_more_button_'+categoryId).text('Show more');
            $('#show_more_button_'+categoryId).hide();
        } else {
            targetDivs.show();
            targetHideDivs.hide();
            $('#show_more_button_'+categoryId).show();
        }
    });

</script>



<script>
    $(document).ready(function () {
        var searchInput = $('#searchInput');
        var searchForm = $('#searchForm');

        $('.search_text').on('input', function () {
            var searchValue = $(this).val();
            searchInput.val(searchValue);
        });

        $('.search_text').on('blur', function () {
            var searchValue = $(this).val();
            searchInput.val(searchValue);

            // Trigger form submission only if the input is not empty
            if (searchValue.trim() !== '') {
                searchForm.submit();
            }
        });

        $('.search_text').on('keydown', function (event) {
            if (event.key === 'Enter') {
                // Enter key is pressed
                var searchValue = $(this).val();
                searchInput.val(searchValue);

                // Trigger form submission only if the input is not empty
                if (searchValue.trim() !== '') {
                    searchForm.submit();
                }
            }
        });
    });


    document.getElementById('filterToggleBtn').addEventListener('click', function() {
        document.getElementById('filterSidebar').classList.add('active');
        document.getElementById('filterOverlay').classList.add('active');
    });

    document.getElementById('closeFilter').addEventListener('click', function() {
        document.getElementById('filterSidebar').classList.remove('active');
        document.getElementById('filterOverlay').classList.remove('active');
    });

    document.getElementById('filterOverlay').addEventListener('click', function() {
        document.getElementById('filterSidebar').classList.remove('active');
        document.getElementById('filterOverlay').classList.remove('active');
    });

</script>


{{-- Enquary button temparary hide --}}
<script>

    // function showEnquiryTab(element) {
    //     // Hide product_name div
    //     element.querySelector('.product_name').style.display = 'none';

    //     // Show enquiry_tab div
    //     element.querySelector('.enquiry_tab').style.display = 'block';
    // }

    // function hideEnquiryTab(element) {
    //     // Show product_name div
    //     element.querySelector('.product_name').style.display = 'block';

    //     // Hide enquiry_tab div
    //     element.querySelector('.enquiry_tab').style.display = 'none';
    // }

</script>

<script>
    // document.getElementById("show-search-bar").addEventListener("click", function() {
    //     document.querySelector(".enquary_attribute_icon").classList.add("search_box_visible");
    //     document.querySelector(".search_box").classList.remove("search_box_visible");
    // });

    // document.getElementById("close-search").addEventListener("click", function() {
    //     document.querySelector(".search_box").classList.add("search_box_visible");
    //     document.querySelector(".enquary_attribute_icon").classList.remove("search_box_visible");
    // });

    // Listen for clicks anywhere on the page
    // document.addEventListener("click", function(event) {
    //     if (!document.querySelector(".search_box").contains(event.target)) {
    //         // Click was outside of the search_box, hide it
    //         document.querySelector(".search_box").classList.add("search_box_visible");
    //         document.querySelector(".filter_attribute").classList.remove("search_box_visible");
    //     }
    // });
</script>

{{-- <script>
    const input = document.querySelector('.search_text');
    const placeholderText = "Search Products By; Category, Sport, Style, Gender, Name";
    let index = 0;

    function updatePlaceholder() {
      input.setAttribute('placeholder', placeholderText.substring(0, index));

      if (index < placeholderText.length) {
        index++;
        setTimeout(updatePlaceholder, 100); // Adjust the delay (in milliseconds) between each letter
      } else {
        index = 0;
        setTimeout(updatePlaceholder, 1000); // Adjust the delay (in milliseconds) before it starts over
      }
    }

    updatePlaceholder();


  </script> --}}

@endsection
