<style>
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
    .lets_talk_bg_img_bg {
        background-image: url('{{ asset('assets/customer_end/lets_talk/lets_talk.jpg') }}');
    }
    .lets_talk_content {
        width: 50%;
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
        background-color: #3e4a52de !important;
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
    .submit_btn_form {

    }
</style>


<div class="row padding_40_center" style="margin: unset;">
    <div class="font_50_600">
        <span>Shop</span>
        <span style="color: red;">Lifestyle</span>
    </div>
    <div>
        <span>About Your Custom Team, Club Or Organization, Order Request A Sample On Confirmation</span>
    </div>
</div>



<div  id="letsTalkSection" class="col-lg-12" style="padding-top: 30px;">
    <div class="row" style="margin:unset;">
        <div class="lets_talk_bg_img lets_talk_bg_img_bg">
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

