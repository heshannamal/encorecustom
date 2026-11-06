<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* Navbar */
    .navbar {
        background-color: #333f48;
        color: white;
        position: sticky;
        top: 0;
        z-index: 1000;
        padding: 15px 0;
    }

    .navbar-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        max-width: 95%;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }

    /* Center Logo */
    .logo_div {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 18%;
    }

    .logo_div img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Left Menu */
    .nav-links {
        list-style: none;
        display: flex;
        gap: 25px;
        margin: 0;
        padding: 0;
    }

    .nav-links li {
        display: inline-block;
    }

    .nav-links a {
        text-decoration: none;
        color: #d1d1d1;
        font-size: 14px;
        font-weight: 600;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #ff4081;
        text-decoration: underline;
    }

    /* Right Icons */
    .icons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .icons i {
        color: #ffffff;
        font-size: 16px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .icons i:hover {
        color: #ff4081;
    }

    /* Mobile Menu Icon */
    .menu-icon {
        display: none;
        font-size: 22px;
        color: #fff;
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 909px) {
        .navbar-container {
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .logo_div {
            position: relative;
            left: unset;
            top: unset;
            transform: unset;
            width: 140px;
            margin: 0 auto;
            order: 1;
        }

        .menu-icon {
            display: block;
            order: 2;
        }

        .nav-links {
            display: none;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: #444a50;
            margin-top: 10px;
            padding: 10px 0;
            order: 3;
        }

        .nav-links.active {
            display: flex;
        }

        .icons {
            order: 4;
            width: 100%;
            justify-content: end;
            margin-top: 10px;
        }
    }

    .cart-wrapper {
        position: relative;
    }

    #cart-icon {
        position: relative;
        font-size: 20px;
        cursor: pointer;
        color: #fff;
    }

    /* cart count bubble */
    .cart-count {
        position: absolute;
        top: -8px;
        right: -10px;
        background: #00c2a8;
        color: #fff;
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 50%;
    }

    /* dropdown box */
    .mini-cart {
        position: absolute;
        top: 35px;
        right: 0;
        width: 320px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        display: none;
        z-index: 9999;
        overflow: hidden;
    }

    /* arrow */
    .mini-cart::before {
        content: "";
        position: absolute;
        top: -8px;
        right: 20px;
        border-width: 0 8px 8px 8px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
    }

    /* body */
    .mini-cart-body {
        max-height: 300px;
        overflow-y: auto;
        padding: 15px;
    }

    .mini-cart-item {
        display: flex;
        justify-content: space-between;
        /* left vs right */
        align-items: center;
        /* vertically center */
        margin-bottom: 12px;
        font-size: 14px;
        color: gray;
    }

    /* footer */
    .mini-cart-footer {
        border-top: 1px solid #eee;
        padding: 15px;
    }

    .subtotal {
        font-weight: 600;
    }

    .go-cart-btn {
        display: block;
        text-align: center;
        background: #00c2a8;
        color: #fff;
        padding: 8px;
        border-radius: 5px;
        text-decoration: none;
    }

    .go-cart-btn:hover {
        background: #00a892;
        color: white;
        text-decoration: none;
    }

    .mini-cart-item-left {
        display: flex;
        /* image + info side by side */
        align-items: center;
        flex: 1;
        /* take available width */
    }

    .mini-cart-item-left img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 10px;
    }

    .mini-cart-item-info {
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .qty-price {
        display: flex;
        justify-content: flex-start;
        /* left align */
        gap: 10px;
        /* space between qty and price */
        margin-top: 4px;
        /* small spacing under product name */
    }

    .qty-price .qty,
    .qty-price .price {
        font-size: 13px;
        font-weight: 500;
    }


    .product-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 500;
    }

    .mini-cart-item-price {
        /* flex-shrink: 0;
    margin-left: 10px; */
        font-weight: 600 !important;
    }

    .enquiry_box:hover {
        background: #00a892;
        color: white;
        text-decoration: none;
    }

    .tax_text {
        color: gray;
        padding-bottom: 15px;
        font-size: 13px;
    }

    .btn-google {
        background-color: #ffd2d7;
        color: #dc3545;
        border-color: #ffd2d7;
    }

    .btn-google:hover {
        background-color: #dc3545;
        color: #ffff;
        border-color: #dc3545;
    }

    .profile-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        /* background: #eee; */
    }

    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-icon {
        font-size: 28px;
        color: #555;
    }

    /* Dropdown */
    .profile-dropdown {
        position: absolute;
        top: 50px;
        right: 0;
        background: #fff;
        padding: 15px;
        width: 180px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        color: gray;
    }

    .profile-dropdown .dropdown-item {
        display: block;
        padding: 8px 0;
        color: #333;
        text-decoration: none;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
    }

    .profile-dropdown .dropdown-item:hover {
        color: #000;
    }

    .user-menu {
        position: relative;
        display: flex;
        align-items: center;
    }

    .user-menu__toggle {
        display: flex;
        align-items: center;
        /* gap: 10px; */
        /* background: #f6f7fb; */
        /* border: 1px solid #e1e5ee; */
        border-radius: 999px;
        /* padding: 4px 12px 4px 6px; */
        padding: 0px;
        cursor: pointer;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .user-menu__toggle:hover,
    .user-menu__toggle.open {
        border-color: #c9d1e1;
        box-shadow: 0 12px 24px rgba(19, 15, 64, 0.12);
    }

    .user-menu__avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .user-menu__meta {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
        text-align: left;
    }

    .user-menu__greet {
        font-size: 0.7rem;
        color: #9398a8;
    }

    .user-menu__name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1f2430;
    }

    .user-menu__chevron {
        font-size: 0.85rem;
        color: #7a7f8c;
        transition: transform 0.2s ease;
    }

    .user-menu__toggle.open .user-menu__chevron {
        transform: rotate(180deg);
    }

    .user-menu__dropdown {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        min-width: 240px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 20px 40px rgba(19, 25, 29, 0.18);
        padding: 18px;
        opacity: 0;
        transform: translateY(-10px);
        pointer-events: none;
        transition: opacity 0.2s ease, transform 0.2s ease;
        z-index: 1100;
    }

    .user-menu__dropdown::before {
        content: "";
        position: absolute;
        top: -8px;
        right: 26px;
        width: 16px;
        height: 16px;
        background: inherit;
        transform: rotate(45deg);
        border-radius: 2px;
    }

    .user-menu__dropdown.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .user-menu__profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f2f6;
        margin-bottom: 12px;
    }

    .user-menu__profile .user-menu__avatar {
        width: 48px;
        height: 48px;
    }

    .user-menu__email {
        font-size: 0.78rem;
        color: #7a7f8c;
    }

    .user-menu__logout {
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 10px 14px;
        background: #14191d;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .user-menu__logout:hover {
        background: #222933;
        transform: translateY(-1px);
    }

    .user-menu__link {
        display: block;
        padding: 10px 14px;
        border-radius: 10px;
        background: #f6f7fb;
        color: #1f2430;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease;
        margin-bottom: 8px;
    }

    .user-menu__link:hover {
        background: #e1e5ee;
        transform: translateY(-1px);
        text-decoration: none;
        color: #1f2430;
    }
    .main_content {
        min-height: 55rem;
    }
</style>

<nav class="navbar">
    <div class="navbar-container">

        <!-- Left Menu -->
        <ul class="nav-links" id="nav-links">
            <li><a href="{{ route('team_page') }}">TEAM</a></li>
            <li><a href="{{ route('lifestyle_page') }}">LIFESTYLE</a></li>
            <li><a href="{{ route('custom_apparel') }}">CUSTOM APPAREL</a></li>
            <li><a href="{{ route('customer_shop') }}">SHOP</a></li>
        </ul>

        <!-- Center Logo -->
        <div class="logo_div">
            <a href="{{ route('encorecustom_com') }}">
                <img src="{{ asset('assets/logos/main_logo.png') }}" alt="Logo">
            </a>
        </div>


        <!-- Right Icons -->
        <div class="icons">
            <div class="col-6 col-lg-auto">
                <div class="d-lg-none">
                    @if (request()->routeIs('profile_view') || request()->routeIs('profile.order_history') || request()->routeIs('profile.billing_payments') || request()->routeIs('profile.gift_cards'))
                        <button type="button" class="btn-mobile-sidebar-toggle" id="mobileSidebarToggle">
                            <i class="fas fa-bars"></i>
                            {{-- <span>Profile Menu</span> --}}
                        </button>
                    @endif
                </div>
            </div>
            <div class="col-6 col-lg-auto d-flex justify-content-end p-0" style="gap: 15px; align-items: center;">
                <div id="auth_nav_section" class="position-relative">
                    @if(Auth::check())
                        @php
                            $user = Auth::user();
                            $userAvatar = $user?->profile_pic_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($user?->name ?? 'User') . '&background=14191D&color=fff';
                            $dayGreeting = Carbon\Carbon::now()->format('H') < 12 ? 'Good Morning!' : (Carbon\Carbon::now()->format('H') < 18 ? 'Good Afternoon!' : 'Good Evening!');
                        @endphp
                        <div class="user-menu">
                            <button type="button" class="user-menu__toggle" id="user-menu-toggle" aria-haspopup="true"
                                aria-expanded="false" aria-controls="user-menu-dropdown">
                                <img src="{{ $userAvatar }}" alt="Profile Picture" class="user-menu__avatar">
                                {{-- <div class="user-menu__meta">
                                    <span class="user-menu__greet">Hi there</span>
                                    <span class="user-menu__name">{{ \Illuminate\Support\Str::limit($user?->name ?? 'Guest', 18)
                                        }}</span>
                                </div> --}}
                                {{-- <i class="fas fa-chevron-down user-menu__chevron" aria-hidden="true"></i> --}}
                            </button>

                            <div class="user-menu__dropdown" id="user-menu-dropdown" role="menu" aria-hidden="true">
                                <div class="user-menu__profile">
                                    <img src="{{ $userAvatar }}" alt="Profile Picture" class="user-menu__avatar">
                                    <div class="user-menu__info">
                                        <div class="user-menu__name">{{ $dayGreeting }}</div>
                                        <div class="user-menu__email">{{ auth()->user()->first_name ?? '' }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('profile.order_history') }}" class="user-menu__link">My Profile</a>
                                {{-- <a href="{{ route('order_history') }}" class="user-menu__link">Order History</a>
                                <a href="{{ route('address_book') }}" class="user-menu__link">Address Book</a>
                                <a href="{{ route('wishlist') }}" class="user-menu__link">Wishlist</a>
                                <a href="{{ route('payment_methods') }}" class="user-menu__link">Payment Methods</a>
                                <a href="{{ route('customer_support') }}" class="user-menu__link">Customer Support</a> --}}
                                <hr class="user-menu__divider">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <button type="submit" form="logout-form" class="user-menu__logout">Sign out</button>
                            </div>
                        </div>

                        {{-- <div class="profile-wrapper" id="profileToggle">

                            @if(auth()->user()->profile_pic)
                            <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" class="profile-img" />
                            @else
                            <i class="fa fas fa-circle-user profile-icon"></i>
                            @endif

                        </div>

                        <!-- Dropdown -->
                        <div class="profile-dropdown d-none" id="profileDropdown">
                            <p class="mb-2">Hi, {{ auth()->user()->customerDetail->first_name ?? '' }}</p>

                            <a href="{{ route('profile_view') }}" class="dropdown-item">View Profile</a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Log Out</button>
                            </form>
                        </div> --}}

                    @else
                        <i class="fa-solid fa-user" id="guest_profile" data-bs-toggle="modal" data-bs-target="#authModal"></i>
                    @endif
                </div>
                {{-- <a href="{{ route('cart_page') }}">
                    <i class="fa-solid fas fa-cart-shopping"></i>
                </a> --}}
                <div class="cart-wrapper">
                    <a href="javascript:void(0)" id="cart-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count d-none" id="cart-count"></span>
                    </a>

                    <div class="mini-cart" id="mini-cart">
                        <div class="mini-cart-body" id="cart-items">
                            <!-- AJAX items load wenawa -->
                        </div>

                        <div class="mini-cart-footer">
                            <div class="subtotal" style="color: black;">
                                Subtotal: $<span id="cart-subtotal">0.00</span>
                            </div>
                            <div class="tax_text">
                                <span>taxes will be included in the total.</span>
                            </div>
                            <a href="{{ route('cart_page') }}" class="go-cart-btn">Go To Cart</a>
                        </div>
                    </div>
                </div>




                {{-- @if($globalCartCount > 0)
                <span id="cart-count" style="position: absolute;
                        top: 12px;
                        right: 5px;
                        background: rgba(255, 255, 255, 0.41);
                        color: white;
                        font-size: 12px;
                        padding: 0px 5px;
                        border-radius: 50%;
                    ">
                    {{ $globalCartCount }}
                </span>
                @endif --}}
            </div>
        </div>

        <!-- Mobile Menu Icon -->
        <div class="menu-icon" id="menu-icon">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>

@php
    $countries = \Illuminate\Support\Facades\DB::table('countries')
        ->orderBy('name')
        ->get();
@endphp


<div class="modal fade" id="authModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="modalTitle">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- Sign In Form -->
                <form id="customerLoginForm">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100" id="proceedSignInBtn">Sign In</button>

                    <div class="mt-2 mb-3 text-center">
                        <a href="javascript:void(0)" onclick="googleLogin(event)" class="btn btn-google w-100">
                            <i class="fa-brands fa-google"></i> Sign In With Google
                        </a>
                    </div>

                    <p class="text-center mt-3">
                        Don't have an account?
                        <a href="javascript:void(0)" onclick="showRegister()">Sign Up</a>
                    </p>
                </form>

                <!-- Sign Up Form -->
                <form id="customerRegisterForm" style="display:none;">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="f_name" class="form-control" placeholder="First Name" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="l_name" class="form-control" placeholder="Last Name" required>
                    </div>

                    {{-- <div class="mb-3">
                        <div class="row">
                            <div class="" style="width: 30%; padding:unset;">
                                <select name="dial_code" class="form-select" style="max-width: 160px;" required>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->dial_code }}">
                                        {{ $country->flag }} {{ $country->dial_code }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="" style="width:70%; padding-right: unset;">
                                <input type="text" name="phone" class="form-control" placeholder="Enter phone number"
                                    required>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="street" class="form-control" placeholder="Street" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="city" class="form-control" placeholder="City" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="state" class="form-control" placeholder="State" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="postal_code" class="form-control" placeholder="Postal Code" required>
                    </div> --}}

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm Password" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100" id="proceedSignUpBtn">Sign Up</button>

                    <p class="text-center mt-3">
                        Already have an account?
                        <a href="javascript:void(0)" onclick="showLogin()">Sign In</a>
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="main_content">
    <div class="content-div">
        @yield('content')
    </div>
</div>

<script>
    var EC_ASSET = "{{ ec_asset('') }}";
</script>

<script>
    const userMenuToggle = document.getElementById("user-menu-toggle");
    const userMenuDropdown = document.getElementById("user-menu-dropdown");

    if (userMenuToggle && userMenuDropdown) {
        const closeUserMenu = () => {
            userMenuDropdown.classList.remove("show");
            userMenuToggle.classList.remove("open");
            userMenuToggle.setAttribute("aria-expanded", "false");
            userMenuDropdown.setAttribute("aria-hidden", "true");
        };

        userMenuToggle.addEventListener("click", (event) => {
            event.stopPropagation();
            const isExpanded = userMenuToggle.getAttribute("aria-expanded") === "true";
            if (isExpanded) {
                closeUserMenu();
            } else {
                userMenuDropdown.classList.add("show");
                userMenuToggle.classList.add("open");
                userMenuToggle.setAttribute("aria-expanded", "true");
                userMenuDropdown.setAttribute("aria-hidden", "false");
            }
        });

        document.addEventListener("click", (event) => {
            if (!userMenuDropdown.contains(event.target) && !userMenuToggle.contains(event.target)) {
                closeUserMenu();
            }
        });

        window.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                closeUserMenu();
            }
        });
    }

    // Mobile menu toggle
    document.getElementById('menu-icon').addEventListener('click', function () {
        document.getElementById('nav-links').classList.toggle('active');
    });

    $(document).ready(function () {
        $('#guest_profile').click(function () {
            $('#authModal').modal('show');
        });

        // AJAX Login
        $('#customerLoginForm').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('customer.login') }}",
                method: "POST",
                data: formData,
                beforeSend: function () {
                    $('#proceedSignInBtn').html('<div class="spinner-border text-primary"></div>');
                    $('#proceedSignInBtn').prop('disabled', true);
                },
                success: function (response) {
                    if (response.success) {
                        handleAuthSuccess(response.user);
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Login failed'
                    });
                    $('#proceedSignInBtn').html('Sign In');
                    $('#proceedSignInBtn').prop('disabled', false);
                }
            });
        });

        // AJAX Register
        $('#customerRegisterForm').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('customer.register') }}",
                method: "POST",
                data: formData,
                beforeSend: function () {
                    $('#proceedSignUpBtn').html('<div class="spinner-border text-primary"></div>');
                    $('#proceedSignUpBtn').prop('disabled', true);
                },
                success: function (response) {
                    if (response.success) {
                        handleAuthSuccess(response.user);
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Registration failed'
                    });
                    $('#proceedSignUpBtn').html('Sign Up');
                    $('#proceedSignUpBtn').prop('disabled', false);
                }
            });
        });
    });

    function showRegister() {
        document.getElementById('customerLoginForm').style.display = 'none';
        document.getElementById('customerRegisterForm').style.display = 'block';
        document.getElementById('modalTitle').innerText = 'Sign Up';
    }

    function showLogin() {
        document.getElementById('customerRegisterForm').style.display = 'none';
        document.getElementById('customerLoginForm').style.display = 'block';
        document.getElementById('modalTitle').innerText = 'Sign In';
    }

    function googleLogin(e) {
        e.preventDefault();
        let url = "{{ route('google.login') }}?ajax=1";
        let width = 600, height = 700;
        let left = (screen.width / 2) - (width / 2);
        let top = (screen.height / 2) - (height / 2);
        window.open(url, "GoogleLogin", `width=${width},height=${height},left=${left},top=${top}`);
    }

    window.addEventListener('message', function (event) {
        // if (event.origin !== window.location.origin) {
        //     console.warn('Origin mismatch rejected:', event.origin, window.location.origin);
        //     return;
        // }
        if (event.data && event.data.type === 'GOOGLE_LOGIN_SUCCESS') {
            handleAuthSuccess(event.data.user);
        }
    });

    function handleAuthSuccess(user) {
        userAuthentication = true;
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Welcome ' + user.first_name,
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            $('#authModal').modal('hide');
            window.location.reload();
            // updateNavbar(user);
            // if (typeof loadCart === 'function') {
            //     loadCart();
            // }
        });
    }

    function updateNavbar(user) {
        $('#auth_nav_section').html(`<i class="" id="auth_user_profile">${user.first_name}</i>`);
    }

    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.getElementById("profileToggle");
        const dropdown = document.getElementById("profileDropdown");

        if (toggle) {
            toggle.addEventListener("click", function () {
                dropdown.classList.toggle("d-none");
            });

            // click outside close
            document.addEventListener("click", function (e) {
                if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add("d-none");
                }
            });
        }
    });

</script>

<script>
    function getglobalCartCount() {
        $.ajax({
            url: "{{ route('get_global_cart_count') }}",
            method: "GET",
            success: function (response) {
                if(response.success) {
                    if(response.cart_count > 0) {
                        $('#cart-count').html(response.cart_count);
                        $('#cart-count').removeClass('d-none');
                    } else {
                        $('#cart-count').addClass('d-none');
                    }
                }
            }
        });
    }
    function loadCart() {
        if ($('#cart-items').length === 0) return; // Guard if elements not present

        $.ajax({
            url: "{{ route('global.cart.items') }}",
            method: "GET",
            success: function (response) {
                var cartItems = response.cart_items;
                let html = '';
                let subtotal = 0;

                if (cartItems.length > 0) {
                    cartItems.forEach(item => {
                        subtotal += item.display_product_price * item.cart_qty;

                        // truncate product name to 20 characters
                        let displayName = item.display_product_name;
                        if (displayName.length > 20) {
                            displayName = displayName.substring(0, 20) + '...';
                        }

                        html += `
                        <div class="mini-cart-item">
                            <div class="mini-cart-item-left">
                                <img src="${item.display_main_image}"
                                    alt="${item.display_product_name}"
                                    onerror="this.src='{{asset('assets/img/products/product_no_image.png')}}'" />
                                <div class="mini-cart-item-info">
                                    <div class="product-name" title="${item.display_product_name}">
                                        ${displayName}
                                    </div>
                                    <div class="qty-price">
                                        <span class="qty">Qty: ${item.cart_qty}</span>
                                        <span class="price mini-cart-item-price">$${(item.display_product_price * item.cart_qty).toFixed(2)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;


                    });
                } else {
                    html = '<p>Your cart is empty</p>';
                }

                $('#cart-items').html(html);
                $('#cart-subtotal').text(subtotal.toFixed(2));
                $('#cart-count').text(cartItems.length);
                if (cartItems.length > 0) {
                    $('#cart-count').removeClass('d-none');
                } else {
                    $('#cart-count').addClass('d-none');
                }
            }
        });
    }

    $(document).ready(function () {

        getglobalCartCount();
        // toggle dropdown
        $('#cart-icon').click(function (e) {
            e.stopPropagation();
            $('#mini-cart').toggle();
            loadCart();
        });

        // close when clicking outside
        $(document).click(function () {
            $('#mini-cart').hide();
        });

        $('#mini-cart').click(function (e) {
            e.stopPropagation();
        });

    });
</script>
