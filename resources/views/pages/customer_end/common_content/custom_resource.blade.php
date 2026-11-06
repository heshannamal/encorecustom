<style>
    .custom_resource_name {
        text-align: center;
        font-size: 13px;
        padding: 10px 0 20px 0;
    }

    /* 🔹 Grid layout - responsive columns */
    .custom_resource_row {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 20px;
        background-color: white;
        margin: 0;
        padding: 0 10px;
    }

    @media (max-width: 1200px) {
        .custom_resource_row {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .custom_resource_row {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .custom_resource_row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .custom_resource_row {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    /* 🔹 Card container */
    .custom_resource_card {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 6px;
    }

    .custom_resource_card img {
        width: 100%;
        height: auto;
        display: block;
        transition: opacity 0.4s ease-in-out;
    }

    .custom_resource_card img.hover-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .custom_resource_card:hover img.hover-img {
        opacity: 1;
    }
</style>


<div class="row padding_40_center" style="margin: unset;">
    <div class="font_50_600">
        <span>Custom</span>
        <span style="color: red;">Resource</span>
    </div>
    <div>
        <span>Explore Our Services, Offering Custom Artwork And Graphics Design, A Variety Of Apparel, Lifestyle Choices, Intricate Embellishments, Team Store Solutions, And Convenient Door-To-Door Delivery. Our Sizing Guidelines Ensure A Perfect Fit, And Our Quality Fabrics Elevate Your Style Effortlessly.</span>
    </div>
</div>


<div class="col-lg-12" style="padding: 30px 0;">
    <div class="custom_resource_row">

        <div>
            <div class="custom_resource_card">
                <img src="{{ asset('assets/customer_end/custom_resources/resources1_1.JPG') }}" alt="Logo">
                <img src="{{ asset('assets/customer_end/custom_resources/resources1_2.JPG') }}" alt="Logo Hover" class="hover-img">
            </div>
            <div class="custom_resource_name">
                <span>Custom Artwork & Graphic Design</span>
            </div>
        </div>

        <div>
            <div class="custom_resource_card">
                <img src="{{ asset('assets/customer_end/custom_resources/resources2_1.JPG') }}" alt="Logo">
                <img src="{{ asset('assets/customer_end/custom_resources/resources2_2.JPG') }}" alt="Logo Hover" class="hover-img">
            </div>
            <div class="custom_resource_name">
                <span>Custom Hat Guide</span>
            </div>
        </div>

        <div>
            <div class="custom_resource_card">
                <img src="{{ asset('assets/customer_end/custom_resources/resources3_1.JPG') }}" alt="Logo">
                <img src="{{ asset('assets/customer_end/custom_resources/resources3_2.JPG') }}" alt="Logo Hover" class="hover-img">
            </div>
            <div class="custom_resource_name">
                <span>Embelishment</span>
            </div>
        </div>

        <div>
            <div class="custom_resource_card">
                <img src="{{ asset('assets/customer_end/custom_resources/resources4_1.JPG') }}" alt="Logo">
                <img src="{{ asset('assets/customer_end/custom_resources/resources4_2.JPG') }}" alt="Logo Hover" class="hover-img">
            </div>
            <div class="custom_resource_name">
                <span>Team Store & Door to Door Delivery</span>
            </div>
        </div>

        <div>
            <div class="custom_resource_card">
                <img src="{{ asset('assets/customer_end/custom_resources/resources5_1.JPG') }}" alt="Logo">
                <img src="{{ asset('assets/customer_end/custom_resources/resources5_2.JPG') }}" alt="Logo Hover" class="hover-img">
            </div>
            <div class="custom_resource_name">
                <span>Sizing Guidelines</span>
            </div>
        </div>

        <div>
            <div class="custom_resource_card">
                <img src="{{ asset('assets/customer_end/custom_resources/resources6_1.JPG') }}" alt="Logo">
                <img src="{{ asset('assets/customer_end/custom_resources/resources6_2.JPG') }}" alt="Logo Hover" class="hover-img">
            </div>
            <div class="custom_resource_name">
                <span>Fabric</span>
            </div>
        </div>

    </div>
</div>
