<style>
    .bottomnavbar {
        background-color: #333f48;
        color: white;
        position: relative;
        z-index: auto;
        padding: 15px 0;
    }

    .bottomnavbar-container {
        max-width: 95%;
        margin: 0 auto;
        width: 100%;
    }

    /* ========== Left Section (Logo + Buttons) ========== */
    .bottom_logo_div {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px 15px;
    }

    .bottom_logo {
        width: 70%;
        margin-bottom: 15px;
    }

    .bottom_logo img {
        width: 100%;
        height: auto;
        display: block;
    }

    .bottom_logo_buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .bottom_logo_buttons button {
        background-color: transparent;
        color: white;
        border: 1px solid white;
        padding: 10px 20px;
        border-radius: 11px;
        font-weight: 400;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 11px;
    }

    .bottom_logo_buttons button:hover {
        background-color: white;
        color: black;
    }

    .company_base {
        font-size: 9px;
        padding-top: 15px;
    }

    /* ========== Middle Section (Contact Info) ========== */
    .contact_text {
        padding-left: 20px;
    }

    .contact_div {
        padding-top: 20px;
        font-size: 13px;
        display: flex;
        align-items: center;
    }

    .contact_icon {
        padding: 4px;
        border: 1px solid white;
        border-radius: 50%;
        font-size: 9px;
    }

    /* ========== Right Section (Newsletter) ========== */
    .contact_div_2 {
        padding-top: 15px;
    }

    .subscrib_text {
        font-size: 9px;
        color: rgb(181, 181, 181);
    }

    /* ========== Layout Setup ========== */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0;
    }

    .col-lg-4 {
        flex: 0 0 33.33%;
        max-width: 33.33%;
        box-sizing: border-box;
    }

    /* Borders on middle column */
    .middle_col {
        border-left: 1px solid white;
        border-right: 1px solid white;
    }

    /* ========== Responsive Styles ========== */
    @media (max-width: 992px) {
        .col-lg-4 {
            flex: 0 0 100%;
            max-width: 100%;
            text-align: center;
            padding: 20px 10px;
        }

        .middle_col {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin: 15px 0;
            padding-top: 25px;
            padding-bottom: 25px;
        }

        .contact_div {
            justify-content: center;
        }

        .bottom_logo {
            width: 50%;
        }

        .bottom_logo_buttons {
            gap: 10px;
        }
    }

    .subscribe_input_div {
        position: relative;
    }

    .subscribe_input {
        width: 100%;
        padding: 8px 12px;
    }

    .subscribe_input::placeholder {
        color: rgb(200, 200, 200);
    }

    .input_icon {
        position: absolute;
        top: 65%;
        right: 12px;
        transform: translateY(-50%);
        color: gray;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s ease;
    }

    .input_icon:hover {
        color: #ccc;
    }

    @media (min-width: 992px) {
        .footer-contact-main {
            padding-left: 35px;
        }

        .footer-contact-body {
            padding-left: 25px;
        }
    }
</style>

<nav class="bottomnavbar">
    <div class="bottomnavbar-container">
        <div class="row">
            <!-- Left side: logo + buttons -->
            <div class="col-lg-4 bottom_logo_div">
                <div class="bottom_logo">
                    <img src="{{ asset('assets/logos/main_logo.png') }}" alt="Logo">
                </div>
                <div class="bottom_logo_buttons">
                    <button onclick="window.location.href=`https://encr.co/customer_catalog`">CUSTOMER CATALOGUE</button>
                    {{-- <button>ACTION NOW</button> --}}
                </div>
                <div class="company_base">
                    <span>Apparel company based in San Francisco, California © 2023, Encore Custom</span>
                </div>
            </div>

            <!-- Middle: Contact -->
            <div class="col-lg-4 middle_col footer-contact-main">
                <div style="font-weight: 600;">
                    <span>Contact</span>
                </div>
                <div class=" footer-contact-body">
                    <div class="contact_div">
                        <i class="fa-solid fas fa-phone contact_icon"></i>
                        <span class="contact_text">+1 888-501-4999</span>
                    </div>
                    <div class="contact_div">
                        <i class="fa-solid fas fa-envelope contact_icon"></i>
                        <span class="contact_text">info@encorecustom.com</span>
                    </div>
                    <div class="contact_div">
                        <i class="fa-solid fa-location-dot contact_icon"></i>
                        <span class="contact_text">891 4th St, San Rafael, CA 94901, United States</span>
                    </div>
                </div>
            </div>

            <!-- Right: Newsletter -->
            <div class="col-lg-4" style="padding: 0 35px;">
                <div style="font-weight: 600;">
                    <span>NEWSLETTER</span>
                </div>
                <div>
                    <div class="contact_div_2">
                        <span class="subscrib_text">Get updates & deals in your inbox. Subscribe now!</span>
                    </div>
                    <div class="contact_div_2 subscribe_input_div">
                        <input type="text" placeholder="Email" class="form-control subscribe_input">
                        <i class="fa-solid fa-arrow-right input_icon"></i>
                    </div>

                    <div class="contact_div_2">
                        <span style="font-weight: 600; font-size: 12px;">FOLLOWING US</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>