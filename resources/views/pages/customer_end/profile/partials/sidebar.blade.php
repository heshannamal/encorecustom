<style>
    :root {
        --primary-coral: #ff5a36;
        --primary-coral-hover: #e04b28;
        --bg-light: #f9fbfd;
        --border-color: #eef1f6;
        --text-muted: #8a99ad;
        --text-dark: #1e293b;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    /* Desktop Layout with Separated Scrolling */
    @media (min-width: 992px) {
        .profile-dashboard {
            display: flex;
            background-color: var(--bg-light);
            min-height: 85vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            align-items: stretch;
        }

        .profile-sidebar {
            width: 280px;
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;

            /* Separate scrolling: Sticky sidebar */
            position: sticky;
            top: 80px; /* Sticks just below the sticky header */
            height: calc(100vh - 80px); /* Height of viewport minus header */
            overflow-y: auto; /* Scroll bar inside sidebar if needed */
        }

        .profile-main-content {
            flex: 1;
            padding: 40px 150px;
            min-height: calc(100vh - 80px);
        }
    }

    /* Sidebar Elements Styling */
    .sidebar-avatar-container {
        position: relative;
        width: 110px;
        height: 110px;
        margin-bottom: 20px;
    }

    .sidebar-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffffff;
        box-shadow: var(--shadow-sm);
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .sidebar-avatar:hover {
        transform: scale(1.03);
    }

    .avatar-upload-trigger {
        position: absolute;
        bottom: 2px;
        right: 2px;
        background: var(--primary-coral);
        color: #ffffff;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        transition: background 0.2s ease, transform 0.2s ease;
        border: 2px solid #ffffff;
    }

    .avatar-upload-trigger:hover {
        background: var(--primary-coral-hover);
        transform: scale(1.1);
    }

    .sidebar-user-name {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        text-align: center;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .sidebar-user-email {
        font-size: 13px;
        color: var(--text-muted);
        text-align: center;
        margin-bottom: 35px;
        word-break: break-all;
    }

    .sidebar-menu {
        width: 100%;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu-item {
        margin-bottom: 8px;
    }

    .sidebar-menu-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        border-radius: 10px;
        color: #556980;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar-menu-link i {
        font-size: 16px;
        width: 20px;
        text-align: center;
    }

    .sidebar-menu-link:hover {
        background-color: #f1f5f9;
        color: var(--text-dark);
        text-decoration: none;
    }

    .sidebar-menu-link.active {
        background-color: #fff0eb;
        color: var(--primary-coral);
        font-weight: 600;
    }

    /* Backdrop Overlay */
    .profile-sidebar-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 1040;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-sidebar-backdrop.show {
        display: block;
        opacity: 1;
    }

    .btn-close-sidebar-mobile {
        display: none;
    }

    /* Responsive Mobile Styles */
    @media (max-width: 991px) {
        .profile-dashboard {
            display: flex;
            flex-direction: column;
            background-color: var(--bg-light);
            min-height: 80vh;
        }

        .profile-sidebar {
            position: fixed;
            top: 0;
            left: -280px; /* hidden off-screen */
            width: 280px;
            height: 100vh;
            z-index: 1050;
            background-color: #ffffff;
            box-shadow: var(--shadow-md);
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .profile-sidebar.open {
            transform: translateX(280px); /* slide in */
        }

        .btn-close-sidebar-mobile {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-muted);
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .btn-close-sidebar-mobile:hover {
            background-color: #f1f5f9;
            color: var(--text-dark);
        }

        .profile-main-content {
            padding: 30px 20px;
            width: 100%;
        }
    }

    /* Crumble/Toggle Button Style */
    .btn-mobile-sidebar-toggle {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: var(--primary-coral);
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(255, 90, 54, 0.2);
        transition: all 0.2s ease;
        /* margin-bottom: 20px; */
        text-decoration: none;
    }

    .btn-mobile-sidebar-toggle:hover {
        background-color: var(--primary-coral-hover);
        color: #ffffff;
        transform: translateY(-1px);
        text-decoration: none;
        box-shadow: 0 6px 16px rgba(255, 90, 54, 0.3);
    }
</style>

<!-- Sidebar Container -->
<div class="profile-sidebar">
    <!-- Close Button (Mobile Only) -->
    <button type="button" class="btn-close-sidebar-mobile" id="mobileSidebarClose" aria-label="Close sidebar">
        <i class="fas fa-times"></i>
    </button>

    <!-- User Avatar Section -->
    <div class="sidebar-avatar-container">
        {{-- @php
            $profileUser = $user ?? auth()->user();
            $avatarUrl = $profileUser['profile_pic_url'] ?: 'https://ui-avatars.com/api/?name=' . urlencode($profileUser['name']) . '&background=14191D&color=fff';
        @endphp --}}
        <img src="{{ auth()->user()->profile_pic_url }}" class="sidebar-avatar" id="sidebarPreviewImage" onclick="$('#profilePicInput').click();" alt="User Avatar">
        <div class="avatar-upload-trigger" onclick="$('#profilePicInput').click();">
            <i class="fas fa-camera"></i>
        </div>
        <input type="file" id="profilePicInput" style="display: none;" accept="image/*">
    </div>

    <!-- User Information -->
    <div class="sidebar-user-name" id="sidebarUserName">{{ auth()->user()->name }}</div>
    <div class="sidebar-user-email" id="sidebarUserEmail">{{ auth()->user()->email }}</div>

    <!-- Navigational Menu -->
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('profile.order_history') }}" class="sidebar-menu-link {{ $activePage === 'order_history' ? 'active' : '' }}">
                <i class="fas fa-history"></i>
                <span>Order History</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('profile_view') }}" class="sidebar-menu-link {{ $activePage === 'personal_info' ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
                <span>Personal Information</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('profile.billing_payments') }}" class="sidebar-menu-link {{ $activePage === 'billing_payments' ? 'active' : '' }}">
                <i class="fas fa-credit-card"></i>
                <span>Billing & Payments</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('profile.gift_cards') }}" class="sidebar-menu-link {{ $activePage === 'gift_cards' ? 'active' : '' }}">
                <i class="fas fa-gift"></i>
                <span>Gift Cards</span>
            </a>
        </li>
    </ul>
</div>

<!-- Backdrop Overlay for Mobile Drawer -->
<div class="profile-sidebar-backdrop" id="profileSidebarBackdrop"></div>

<!-- Sidebar Control Scripts -->
<script>
    $(document).ready(function() {
        // Setup headers for AJAX CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Mobile drawer slide-in display
        $(document).on('click', '#mobileSidebarToggle', function(e) {
            e.preventDefault();
            $('.profile-sidebar').addClass('open');
            $('#profileSidebarBackdrop').addClass('show');
            $('body').css('overflow', 'hidden'); // prevent background body scrolling
        });

        // Mobile drawer hide / backdrop dismiss
        $(document).on('click', '#mobileSidebarClose, #profileSidebarBackdrop', function(e) {
            e.preventDefault();
            $('.profile-sidebar').removeClass('open');
            $('#profileSidebarBackdrop').removeClass('show');
            $('body').css('overflow', ''); // restore original background scrolling
        });

        // Profile Picture Upload AJAX Handler
        $('#profilePicInput').on('change', function(e) {
            let file = e.target.files[0];
            if (!file) return;

            let formData = new FormData();
            formData.append('profile_pic', file);
            formData.append('section', 'avatar');

            $.ajax({
                url: "{{ route('profile.update') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    Swal.fire({
                        title: 'Uploading...',
                        text: 'Please wait while we upload your picture.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        // Update preview on current page sidebar
                        $('#sidebarPreviewImage').attr('src', response.data.profile_pic_url);
                        // Update preview on top navbar avatar
                        $('.user-menu__avatar').attr('src', response.data.profile_pic_url);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Uploaded!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        toastr.error(response.message || 'Upload failed');
                    }
                },
                error: function(xhr) {
                    Swal.close();
                    let errMsg = 'Upload failed. Please try again.';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    toastr.error(errMsg);
                }
            });
        });
    });
</script>
