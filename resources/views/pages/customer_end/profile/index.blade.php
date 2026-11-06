@extends('layouts.customer_end_layouts.app')

@section('content')

<style>
    /* Main Content Area */

    .profile-header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 35px;
    }

    .profile-title-area h1 {
        font-size: 26px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 6px 0;
    }

    .profile-title-area p {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0;
    }

    .btn-signout {
        background-color: var(--primary-coral);
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(255, 90, 54, 0.2);
    }

    .btn-signout:hover {
        background-color: var(--primary-coral-hover);
        color: #ffffff;
        transform: translateY(-1px);
        text-decoration: none;
        box-shadow: 0 6px 16px rgba(255, 90, 54, 0.3);
    }

    /* Cards Grid */
    .profile-cards-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 40px;
    }

    .profile-card-custom {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 24px;
        position: relative;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .profile-card-custom:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .profile-card-custom.full-width {
        grid-column: 1 / -1;
    }

    .card-label-section {
        margin-bottom: 12px;
    }

    .card-label-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 0.8px;
        margin-bottom: 2px;
    }

    .card-label-desc {
        font-size: 11px;
        color: var(--text-muted);
    }

    .card-value-display {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 28px;
    }

    .card-edit-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid var(--border-color);
        background: #ffffff;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .card-edit-btn:hover {
        background-color: var(--primary-coral);
        border-color: var(--primary-coral);
        color: #ffffff;
        transform: scale(1.05);
    }

    /* Badges */
    .pill-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .pill-badge.badge-success {
        background-color: #ecfdf5;
        color: #059669;
    }

    .pill-badge.badge-gray {
        background-color: #f1f5f9;
        color: #475569;
    }

    .pill-badge.badge-pending {
        background-color: #fffbeb;
        color: #d97706;
    }

    /* Skeleton Loading Placeholder Styles */
    .skeleton-box {
        display: inline-block;
        height: 1em;
        position: relative;
        overflow: hidden;
        background-color: #e2e8f0;
        border-radius: 6px;
        vertical-align: middle;
    }

    .skeleton-box::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: translateX(-100%);
        background-image: linear-gradient(
            90deg,
            rgba(255, 255, 255, 0) 0,
            rgba(255, 255, 255, 0.5) 20%,
            rgba(255, 255, 255, 0.7) 60%,
            rgba(255, 255, 255, 0)
        );
        animation: shimmer 1.5s infinite;
        content: '';
    }

    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }

    /* Contact Row (inside full width card) */
    .contact-card-content {
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
    }

    .contact-item-box {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 260px;
    }

    .contact-icon-wrapper {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        background-color: #fff0eb;
        color: var(--primary-coral);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .contact-text-area {
        display: flex;
        flex-direction: column;
    }

    .contact-item-title {
        font-size: 10px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 2px;
    }

    .contact-item-value-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        min-height: 24px;
    }

    .contact-item-value {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* Account Activity section */
    .activity-section {
        margin-top: 45px;
    }

    .activity-section h3 {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .activity-timeline {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .activity-row {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: var(--text-dark);
    }

    .activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .activity-dot.dot-green {
        background-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    .activity-dot.dot-orange {
        background-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
    }

    .activity-dot.dot-grey {
        background-color: #94a3b8;
        box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
    }

    .activity-label {
        font-weight: 600;
        color: #0f172a;
    }

    .activity-value {
        color: var(--text-muted);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .profile-cards-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Modal Form Enhancements */
    .modal-content-custom {
        border-radius: 16px;
        border: none;
        box-shadow: var(--shadow-md);
    }

    .modal-header-custom {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }

    .modal-body-custom {
        padding: 24px;
    }

    .modal-footer-custom {
        border-top: 1px solid var(--border-color);
        padding: 18px 24px;
    }

    .form-label-custom {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 10px 14px;
        font-size: 14px;
        color: var(--text-dark);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: var(--primary-coral);
        box-shadow: 0 0 0 3px rgba(255, 90, 54, 0.15);
        outline: none;
    }

    .btn-submit-custom {
        background-color: var(--text-dark);
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-submit-custom:hover {
        background-color: #0f172a;
        color: #ffffff;
    }
</style>

<div class="profile-dashboard">
    <!-- Sidebar -->
    @include('pages.customer_end.profile.partials.sidebar', ['activePage' => 'personal_info'])

    <!-- Main Content -->
    <div class="profile-main-content">
        <div class="profile-header-row">
            <div class="profile-title-area">
                <h1>Personal Information</h1>
                <p>Manage your personal details, preferences, and contact information.</p>
            </div>
            <form id="signout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('signout-form').submit();" class="btn-signout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign out</span>
            </a>
        </div>

        <!-- Cards Grid -->
        <div class="profile-cards-grid">
            <!-- Name Card -->
            <div class="profile-card-custom">
                <div class="card-label-section">
                    <div class="card-label-title">Name</div>
                    <div class="card-label-desc">Full legal name</div>
                </div>
                <div class="card-value-display" id="displayFullName">
                    <span class="skeleton-box" style="width: 140px; height: 22px;"></span>
                </div>
                <div>
                    <span class="pill-badge badge-success">
                        <i class="fas fa-check-circle"></i> Verified
                    </span>
                </div>
                <button type="button" class="card-edit-btn" id="editNameBtn" data-bs-toggle="modal" data-bs-target="#editNameModal" style="display:none;">
                    <i class="fas fa-pen"></i>
                </button>
            </div>

            <!-- Date of Birth Card -->
            <div class="profile-card-custom">
                <div class="card-label-section">
                    <div class="card-label-title">Date of Birth</div>
                    <div class="card-label-desc">Your birthday</div>
                </div>
                <div class="card-value-display" id="displayDOB">
                    <span class="skeleton-box" style="width: 150px; height: 22px;"></span>
                </div>
                <div>
                    <span class="pill-badge badge-gray" id="displayAgeBadge">
                        <span class="skeleton-box" style="width: 60px; height: 14px;"></span>
                    </span>
                </div>
                <button type="button" class="card-edit-btn" id="editDOBBtn" data-bs-toggle="modal" data-bs-target="#editDOBModal" style="display:none;">
                    <i class="fas fa-pen"></i>
                </button>
            </div>

            <!-- Country/Region Card -->
            <div class="profile-card-custom">
                <div class="card-label-section">
                    <div class="card-label-title">Country / Region</div>
                    <div class="card-label-desc">Your location</div>
                </div>
                <div class="card-value-display" id="displayCountry">
                    <span id="displayCountryFlag" style="margin-right: 6px;"></span>
                    <span id="displayCountryName"><span class="skeleton-box" style="width: 130px; height: 22px;"></span></span>
                </div>
                <div>
                    <span class="pill-badge badge-gray" id="displayRegionBadge">
                        <span class="skeleton-box" style="width: 50px; height: 14px;"></span>
                    </span>
                </div>
                <button type="button" class="card-edit-btn" id="editCountryBtn" data-bs-toggle="modal" data-bs-target="#editCountryModal" style="display:none;">
                    <i class="fas fa-pen"></i>
                </button>
            </div>

            <!-- Language Card -->
            <div class="profile-card-custom">
                <div class="card-label-section">
                    <div class="card-label-title">Language</div>
                    <div class="card-label-desc">Preferred language</div>
                </div>
                <div class="card-value-display" id="displayLanguage">
                    <span class="skeleton-box" style="width: 110px; height: 22px;"></span>
                </div>
                <div>
                    <span class="pill-badge badge-gray">
                        <i class="fas fa-globe"></i> Default
                    </span>
                </div>
                <button type="button" class="card-edit-btn" id="editLanguageBtn" data-bs-toggle="modal" data-bs-target="#editLanguageModal" style="display:none;">
                    <i class="fas fa-pen"></i>
                </button>
            </div>

            <!-- Contactable At Card -->
            <div class="profile-card-custom full-width">
                <div class="card-label-section" style="margin-bottom: 20px;">
                    <div class="card-label-title">Contactable At</div>
                    <div class="card-label-desc">Email & phone number</div>
                </div>
                <div class="contact-card-content">
                    <div class="contact-item-box">
                        <div class="contact-icon-wrapper">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text-area">
                            <div class="contact-item-title">Email Address</div>
                            <div class="contact-item-value-row">
                                <span class="contact-item-value" id="displayEmail"><span class="skeleton-box" style="width: 160px; height: 18px;"></span></span>
                                <span class="pill-badge badge-success" style="padding: 3px 8px; font-size: 9px;">
                                    <i class="fas fa-check-circle"></i> Verified
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item-box">
                        <div class="contact-icon-wrapper">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-text-area">
                            <div class="contact-item-title">Phone Number</div>
                            <div class="contact-item-value-row">
                                <span class="contact-item-value" id="displayPhone"><span class="skeleton-box" style="width: 120px; height: 18px;"></span></span>
                                <span class="pill-badge badge-pending" id="displayPhoneBadge" style="padding: 3px 8px; font-size: 9px; display:none;">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="card-edit-btn" id="editContactBtn" data-bs-toggle="modal" data-bs-target="#editContactModal" style="display:none;">
                    <i class="fas fa-pen"></i>
                </button>
            </div>
        </div>

        <!-- Account Activity -->
        {{-- <div class="activity-section">
            <h3>Account Activity</h3>
            <div class="activity-timeline">
                <div class="activity-row">
                    <div class="activity-dot dot-green"></div>
                    <span class="activity-label">Last login</span>
                    <span class="activity-value">Today, {{ now()->format('h:i A') }} · Chrome on Windows</span>
                </div>
                <div class="activity-row">
                    <div class="activity-dot dot-orange"></div>
                    <span class="activity-label">Password changed</span>
                    <span class="activity-value">Recently updated</span>
                </div>
                <div class="activity-row">
                    <div class="activity-dot dot-grey"></div>
                    <span class="activity-label">Account created</span>
                    <span class="activity-value" id="displayCreatedAt"><span class="skeleton-box" style="width: 100px; height: 16px;"></span></span>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<!-- ================= MODALS ================= -->

<!-- Name Modal -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold">Edit Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editNameForm">
                @csrf
                <input type="hidden" name="section" value="name">
                <div class="modal-body modal-body-custom">
                    <div class="mb-3">
                        <label class="form-label form-label-custom">First Name</label>
                        <input type="text" name="first_name" class="form-control form-control-custom" value="" required>
                    </div>
                    <div>
                        <label class="form-label form-label-custom">Last Name</label>
                        <input type="text" name="last_name" class="form-control form-control-custom" value="">
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit-custom">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DOB Modal -->
<div class="modal fade" id="editDOBModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold">Edit Date of Birth</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDOBForm">
                @csrf
                <input type="hidden" name="section" value="dob">
                <div class="modal-body modal-body-custom">
                    <div class="mb-3">
                        <label class="form-label form-label-custom">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control form-control-custom" value="" required>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit-custom">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Country Modal -->
<div class="modal fade" id="editCountryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold">Edit Country / Region</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCountryForm">
                @csrf
                <input type="hidden" name="section" value="country">
                <div class="modal-body modal-body-custom">
                    <div class="mb-3">
                        <label class="form-label form-label-custom">Select Country</label>
                        <select name="country_id" class="form-select form-control-custom" required>
                            <option value="">-- Choose Country --</option>
                            @foreach($countries as $country)
                                <option value="{{ $country['id'] }}">
                                    {{ $country['flag'] }} {{ $country['name'] }} ({{ $country['code'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit-custom">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Language Modal -->
<div class="modal fade" id="editLanguageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold">Edit Preferred Language</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editLanguageForm">
                @csrf
                <input type="hidden" name="section" value="language">
                <div class="modal-body modal-body-custom">
                    <div class="mb-3">
                        <label class="form-label form-label-custom">Preferred Language</label>
                        <select name="preferred_language" class="form-select form-control-custom" required>
                            <option value="English (US)">English (US)</option>
                            <option value="English (UK)">English (UK)</option>
                            <option value="Spanish">Spanish</option>
                            <option value="French">French</option>
                            <option value="German">German</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Chinese">Chinese</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit-custom">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold">Edit Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editContactForm">
                @csrf
                <input type="hidden" name="section" value="contact">
                <div class="modal-body modal-body-custom">
                    <div class="mb-3">
                        <label class="form-label form-label-custom">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-custom" value="" required>
                    </div>
                    <div>
                        <label class="form-label form-label-custom">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control form-control-custom" value="">
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-submit-custom" id="contact_form_subumit_btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Setup headers for AJAX CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // AJAX function to fetch initial customer details and populate skeleton cards
        function loadCustomerDetails() {
            $.ajax({
                url: "{{ route('profile.get_customer_details') }}",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success && response.data) {
                        let user = response.data.user;
                        let detail = response.data.customer_detail;

                        // 1. Name Card
                        $('#displayFullName').text(user.name);
                        $('#sidebarUserName').text(user.name);

                        // 2. Date of Birth Card
                        $('#displayDOB').text(detail.dob_formatted);
                        $('#displayAgeBadge').html(`<i class="fas fa-calendar-alt"></i> Age ${detail.age}`);

                        // 3. Country / Region Card
                        $('#displayCountryFlag').text(detail.country_flag || '🌐');
                        $('#displayCountryName').text(detail.country_name);
                        $('#displayRegionBadge').html(`<i class="fas fa-map-marker-alt"></i> ${detail.country_code}`);

                        // 4. Language Card
                        $('#displayLanguage').text(detail.preferred_language);

                        // 5. Contactable At Card
                        $('#displayEmail').text(user.email);
                        $('#sidebarUserEmail').text(user.email);
                        $('#displayPhone').text(detail.phone_number || 'Not Specified');
                        if (detail.phone_number) {
                            $('#displayPhoneBadge').show();
                        } else {
                            $('#displayPhoneBadge').hide();
                        }

                        // 6. Account Activity
                        $('#displayCreatedAt').text(user.created_at_formatted);

                        // Populate Modal Inputs
                        $('#editNameForm input[name="first_name"]').val(detail.first_name || '');
                        $('#editNameForm input[name="last_name"]').val(detail.last_name || '');
                        $('#editDOBForm input[name="date_of_birth"]').val(detail.date_of_birth || '');
                        if (detail.country_id) {
                            $('#editCountryForm select[name="country_id"]').val(detail.country_id);
                        }
                        if (detail.preferred_language) {
                            $('#editLanguageForm select[name="preferred_language"]').val(detail.preferred_language);
                        }
                        $('#editContactForm input[name="email"]').val(user.email || '');
                        $('#editContactForm input[name="phone_number"]').val(detail.phone_number || '');

                        // Reveal Edit Buttons after loading
                        $('.card-edit-btn').show();
                    } else {
                        toastr.error(response.message || 'Failed to load profile details.');
                    }
                },
                error: function(xhr) {
                    toastr.error('Error loading customer details.');
                }
            });
        }

        // Execute initial AJAX data fetch
        loadCustomerDetails();

        // Universal AJAX submit handler helper for edit modals
        function submitFormAjax(formId, modalId, successCallback) {
            $(`#${formId}`).on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let submitBtn = $(this).find('button[type="submit"]');
                let originalBtnText = submitBtn.text();

                $.ajax({
                    url: "{{ route('profile.update') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function() {
                        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...').prop('disabled', true);
                    },
                    success: function(response) {
                        submitBtn.html(originalBtnText).prop('disabled', false);
                        if (response.success) {
                            $(`#${modalId}`).modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 1800,
                                showConfirmButton: false
                            });
                            successCallback(response.data);
                        } else {
                            toastr.error(response.message || 'Error occurred');
                        }
                    },
                    error: function(xhr) {
                        submitBtn.html(originalBtnText).prop('disabled', false);
                        let errMsg = 'Something went wrong. Please try again.';
                        if(xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        toastr.error(errMsg);
                    }
                });
            });
        }

        // 1. Edit Name AJAX
        submitFormAjax('editNameForm', 'editNameModal', function(data) {
            $('#displayFullName').text(data.full_name);
            $('#sidebarUserName').text(data.full_name);
            $('.user-menu__email').text(data.first_name);
        });

        // 2. Edit DOB AJAX
        submitFormAjax('editDOBForm', 'editDOBModal', function(data) {
            $('#displayDOB').text(data.dob_formatted);
            $('#displayAgeBadge').html(`<i class="fas fa-calendar-alt"></i> Age ${data.age}`);
        });

        // 3. Edit Country AJAX
        submitFormAjax('editCountryForm', 'editCountryModal', function(data) {
            $('#displayCountryFlag').text(data.country_flag || '🌐');
            $('#displayCountryName').text(data.country_name);
            $('#displayRegionBadge').html(`<i class="fas fa-map-marker-alt"></i> ${data.country_name}`);
        });

        // 4. Edit Language AJAX
        submitFormAjax('editLanguageForm', 'editLanguageModal', function(data) {
            $('#displayLanguage').text(data.language);
        });

        // 5. Edit Contact Details AJAX
        submitFormAjax('editContactForm', 'editContactModal', function(data) {
            $('#displayEmail').text(data.email);
            $('#sidebarUserEmail').text(data.email);
            $('#displayPhone').text(data.phone_number || 'Not Specified');
            if (data.phone_number) {
                $('#displayPhoneBadge').show();
            } else {
                $('#displayPhoneBadge').hide();
            }
        });

        $('#contact_form_subumit_btn').click(function() {
            if('{{ auth()->user()->email }}' != $('#editContactForm input[name="email"]').val()){
                Swal.fire({
                    title: 'Do you want to change the Email?',
                    text: 'It changes your login credentials.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, continue',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...').prop('disabled', true);
                        $('#editContactForm').submit();
                    } else {
                        $('#editContactForm input[name="email"]').val('{{ auth()->user()->email }}');
                    }
                });
            } else {
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...').prop('disabled', true);
                $('#editContactForm').submit();
            }
        });
    });
</script>

@endsection