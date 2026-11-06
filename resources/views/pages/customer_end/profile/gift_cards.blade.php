@extends('layouts.customer_end_layouts.app')

@section('content')

<style>
    /* Main Content Area */

    .profile-header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
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

    .btn-action-primary {
        background-color: var(--primary-coral);
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(255, 90, 54, 0.2);
    }

    .btn-action-primary:hover {
        background-color: var(--primary-coral-hover);
        color: #ffffff;
        transform: translateY(-1px);
        text-decoration: none;
    }

    /* Stats Bar */
    .stats-bar-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card-custom {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: var(--shadow-sm);
    }

    .stat-icon-container {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .stat-icon-container.orange {
        background-color: #fff0eb;
        color: var(--primary-coral);
    }

    .stat-icon-container.blue {
        background-color: #eff6ff;
        color: #2563eb;
    }

    .stat-icon-container.green {
        background-color: #ecfdf5;
        color: #10b981;
    }

    .stat-text-container {
        display: flex;
        flex-direction: column;
    }

    .stat-number {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.1;
    }

    .stat-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 0.6px;
        margin-top: 2px;
    }

    .stat-desc {
        font-size: 10px;
        color: var(--text-muted);
        margin-top: 1px;
    }

    /* Section Subheadings */
    .section-title-uppercase {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 0.8px;
        margin-bottom: 20px;
    }

    /* Active Gift Card Panel */
    .active-gift-card-panel {
        display: flex;
        gap: 30px;
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 40px;
        align-items: center;
    }

    /* Physical Style Card */
    .physical-gift-card {
        width: 320px;
        height: 200px;
        border-radius: 16px;
        background: linear-gradient(135deg, #f97316, #ea580c);
        position: relative;
        overflow: hidden;
        color: #ffffff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 10px 25px rgba(234, 88, 12, 0.35);
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .physical-gift-card:hover {
        transform: translateY(-3px) rotate(1deg);
    }

    .physical-gift-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .physical-gift-card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -30px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
    }

    .card-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 2;
    }

    .card-brand {
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.5px;
    }

    .card-type-badge {
        font-size: 9px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-middle-row {
        z-index: 2;
        margin: 10px 0;
    }

    .card-value {
        font-size: 36px;
        font-weight: 850;
        line-height: 1;
        letter-spacing: -1px;
    }

    .card-number-dots {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 2px;
        margin-top: 8px;
        color: rgba(255, 255, 255, 0.85);
    }

    .card-bottom-row {
        display: flex;
        justify-content: space-between;
        z-index: 2;
        font-size: 10px;
    }

    .card-holder-info, .card-validity-info {
        display: flex;
        flex-direction: column;
    }

    .card-small-label {
        font-size: 8px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        margin-bottom: 2px;
        letter-spacing: 0.5px;
    }

    .card-bottom-row span {
        font-weight: 700;
    }

    /* Active Card Info Details */
    .active-card-details {
        flex: 1;
    }

    .details-id-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .active-card-id {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .active-card-meta {
        font-size: 13px;
        margin-bottom: 12px;
    }

    .active-card-meta-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .active-card-meta-val {
        font-weight: 700;
        color: var(--text-dark);
    }

    .usable-tags-container {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 8px;
        margin-bottom: 20px;
    }

    .usable-tag {
        font-size: 11px;
        font-weight: 600;
        color: #475569;
        background-color: #f1f5f9;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .active-card-actions {
        display: flex;
        gap: 12px;
    }

    .btn-outline-custom {
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        color: #334155;
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-outline-custom:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: var(--text-dark);
    }

    /* Send Gift Card Form Card */
    .send-gift-card-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 40px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 24px;
        margin-bottom: 24px;
    }

    .form-group-custom {
        display: flex;
        flex-direction: column;
    }

    .form-input-wrapper {
        position: relative;
    }

    .form-input-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 13px;
    }

    .form-input-field-custom {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 14px 10px 38px;
        font-size: 14px;
        color: var(--text-dark);
        background-color: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-input-field-custom:focus {
        border-color: var(--primary-coral);
        box-shadow: 0 0 0 3px rgba(255, 90, 54, 0.15);
        outline: none;
    }

    .form-select-field-custom {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        color: var(--text-dark);
        background-color: #ffffff;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }

    .form-select-field-custom:focus {
        border-color: var(--primary-coral);
        outline: none;
    }

    .form-group-custom.full-width {
        grid-column: 1 / -1;
    }

    .form-textarea-custom {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 12px 14px;
        font-size: 14px;
        color: var(--text-dark);
        min-height: 90px;
        resize: vertical;
        transition: border-color 0.2s ease;
    }

    .form-textarea-custom:focus {
        border-color: var(--primary-coral);
        outline: none;
    }

    .form-info-note {
        font-size: 12px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-info-note i {
        color: var(--primary-coral);
    }

    .form-actions-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    /* My Gift Cards Grid */
    .my-gift-cards-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .my-gift-cards-header-row h2 {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        margin: 0;
        letter-spacing: 0.8px;
    }

    .cards-count-tag {
        background-color: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .my-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 40px;
    }

    .grid-card-item {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
    }

    .grid-card-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .grid-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .grid-card-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .grid-card-icon-box.orange { background-color: #fff0eb; color: var(--primary-coral); }
    .grid-card-icon-box.blue { background-color: #eff6ff; color: #2563eb; }
    .grid-card-icon-box.grey { background-color: #f1f5f9; color: #64748b; }

    /* Badges */
    .status-badge-pill {
        font-size: 10px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .status-badge-pill.active { background-color: #ecfdf5; color: #059669; }
    .status-badge-pill.unused { background-color: #eff6ff; color: #2563eb; }
    .status-badge-pill.redeemed { background-color: #f1f5f9; color: #64748b; }

    .grid-card-value {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.1;
    }

    .grid-card-original-val {
        font-size: 11px;
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .grid-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 12px;
    }

    .grid-card-code-field {
        background-color: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        text-align: center;
        margin-bottom: 14px;
        letter-spacing: 0.5px;
    }

    .grid-card-expiry {
        font-size: 11px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 16px;
    }

    .grid-card-expiry.expired {
        color: #ef4444;
        font-weight: 600;
    }

    /* Progress line bar inside grid card */
    .grid-card-progress-wrapper {
        margin-bottom: 20px;
    }

    .grid-card-progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .progress-bar-track-custom {
        width: 100%;
        height: 6px;
        background-color: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill-custom {
        height: 100%;
        border-radius: 10px;
    }

    .progress-bar-fill-custom.orange { background-color: var(--primary-coral); }
    .progress-bar-fill-custom.blue { background-color: #2563eb; }
    .progress-bar-fill-custom.grey { background-color: #94a3b8; }

    .grid-card-buttons-row {
        display: flex;
        gap: 8px;
    }

    .btn-grid-action {
        flex: 1;
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-grid-action:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: var(--text-dark);
    }

    .btn-grid-action:disabled {
        background-color: #f8fafc;
        border-color: var(--border-color);
        color: #94a3b8;
        cursor: not-allowed;
    }

    /* Gift Card Activity timeline */
    .activity-section {
        margin-bottom: 40px;
    }

    .activity-timeline-wrapper {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .timeline-item-card {
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        padding: 16px 20px;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: var(--shadow-sm);
    }

    .timeline-item-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .timeline-indicator-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .timeline-indicator-circle.orange { background-color: #fff0eb; color: var(--primary-coral); }
    .timeline-indicator-circle.green { background-color: #ecfdf5; color: #10b981; }
    .timeline-indicator-circle.blue { background-color: #eff6ff; color: #2563eb; }
    .timeline-indicator-circle.grey { background-color: #f1f5f9; color: #64748b; }

    .timeline-event-text-container {
        display: flex;
        flex-direction: column;
    }

    .timeline-event-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .timeline-event-subtitle {
        font-size: 11.5px;
        color: var(--text-muted);
        margin-top: 1px;
    }

    .timeline-right-pricing-stamp {
        text-align: right;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .timeline-pricing-val {
        font-size: 14px;
        font-weight: 800;
    }

    .timeline-pricing-val.negative { color: #ef4444; }
    .timeline-pricing-val.positive { color: #10b981; }
    .timeline-pricing-val.neutral { color: var(--text-dark); }

    .timeline-date-val {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 600;
        margin-top: 2px;
    }

    /* Terms Card bottom */
    .gift-terms-card {
        background-color: #fff8f5;
        border: 1px solid #ffeedb;
        border-radius: 16px;
        padding: 30px;
        display: flex;
        gap: 20px;
        align-items: flex-start;
        box-shadow: var(--shadow-sm);
    }

    .terms-icon-box {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background-color: #fff0eb;
        color: var(--primary-coral);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .terms-content-box {
        flex: 1;
    }

    .terms-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 24px;
    }

    .terms-bullet-item {
        font-size: 13px;
        color: #475569;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        line-height: 1.4;
    }

    .terms-bullet-item i {
        color: var(--primary-coral);
        font-size: 11px;
        margin-top: 4px;
    }

    @media (max-width: 991px) {

        .stats-bar-grid {
            grid-template-columns: 1fr;
        }

        .active-gift-card-panel {
            flex-direction: column;
            align-items: stretch;
            padding: 20px;
        }

        .physical-gift-card {
            width: 100%;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .my-cards-grid {
            grid-template-columns: 1fr;
        }

        .terms-content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-dashboard">
    <!-- Sidebar -->
    @include('pages.customer_end.profile.partials.sidebar', ['activePage' => 'gift_cards'])

    <!-- Main Content -->
    <div class="profile-main-content">
        <!-- Mobile Sidebar Toggle -->
        {{-- <div class="d-lg-none mb-3">
            <button type="button" class="btn-mobile-sidebar-toggle" id="mobileSidebarToggle">
                <i class="fas fa-bars"></i>
                <span>Profile Menu</span>
            </button>
        </div> --}}
        <div class="profile-header-row">
            <div class="profile-title-area">
                <h1>Gift Cards</h1>
                <p>Buy, send, and manage gift cards for custom apparel purchases.</p>
            </div>
            <a href="{{ route('customer_shop') }}" class="btn-action-primary">
                <i class="fas fa-store"></i>
                <span>Buy Gift Card</span>
            </a>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar-grid">
            <div class="stat-card-custom">
                <div class="stat-icon-container orange">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">$125.00</div>
                    <div class="stat-label">Available Balance</div>
                    <div class="stat-desc">Store credit for future orders</div>
                </div>
            </div>
            <div class="stat-card-custom">
                <div class="stat-icon-container blue">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Active Gift Cards</div>
                    <div class="stat-desc">Gift cards ready to use</div>
                </div>
            </div>
            <div class="stat-card-custom">
                <div class="stat-icon-container green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">$420.00</div>
                    <div class="stat-label">Total Redeemed</div>
                    <div class="stat-desc">Lifetime redeemed value</div>
                </div>
            </div>
        </div>

        <!-- Active Gift Card Section -->
        <h2 class="section-title-uppercase">Active Gift Card</h2>
        <div class="active-gift-card-panel">
            <!-- Orange Physical Style Card -->
            <div class="physical-gift-card">
                <div class="card-top-row">
                    <div class="card-brand">
                        <i class="fas fa-gift"></i> ENCORE Custom
                    </div>
                    <span class="card-type-badge">Gift Card</span>
                </div>
                <div class="card-middle-row">
                    <div class="card-value">$125.00</div>
                    <div class="card-number-dots">•••• •••• •••• 4829</div>
                </div>
                <div class="card-bottom-row">
                    <div class="card-holder-info">
                        <span class="card-small-label">Card Holder</span>
                        <span>{{ $user->name }}</span>
                    </div>
                    <div class="card-validity-info">
                        <span class="card-small-label">Valid Until</span>
                        <span>Dec 31, 2026</span>
                    </div>
                </div>
            </div>

            <!-- Active Card Details -->
            <div class="active-card-details">
                <div class="details-id-row">
                    <div class="active-card-id">GC-EN-4829</div>
                    <span class="pill-badge badge-success">
                        <i class="fas fa-circle" style="font-size:6px; margin-top:-1px;"></i> Active
                    </span>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="active-card-meta-label">Issued</div>
                        <div class="active-card-meta-val">March 15, 2026</div>
                    </div>
                    <div class="col-6">
                        <div class="active-card-meta-label">Expiry</div>
                        <div class="active-card-meta-val">December 31, 2026</div>
                    </div>
                </div>

                <div class="active-card-meta-label">Usable For</div>
                <div class="usable-tags-container">
                    <span class="usable-tag"><i class="fas fa-tshirt"></i> Custom Apparel</span>
                    <span class="usable-tag"><i class="fas fa-hat-cowboy"></i> Accessories</span>
                    <span class="usable-tag"><i class="fas fa-users"></i> Team Uniforms</span>
                    <span class="usable-tag"><i class="fas fa-magic"></i> Embroidery</span>
                </div>

                <div class="active-card-actions">
                    <button type="button" class="btn-outline-custom copy-code-btn" data-code="GC-EN-4829">
                        <i class="far fa-copy"></i> Copy Code
                    </button>
                    <button type="button" class="btn-action-primary apply-code-btn" data-code="GC-EN-4829">
                        <i class="fas fa-key"></i> Use Gift Card
                    </button>
                    <button type="button" class="btn-outline-custom scroll-to-terms-btn">
                        <i class="far fa-file-alt"></i> View Terms
                    </button>
                </div>
            </div>
        </div>

        <!-- Send A Gift Card Form Section -->
        <div class="send-gift-card-card">
            <h2 class="section-title-uppercase" style="margin-bottom: 24px;">Send A Gift Card</h2>
            <form id="sendGiftCardForm">
                <div class="form-grid">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Recipient Name</label>
                        <div class="form-input-wrapper">
                            <i class="far fa-user"></i>
                            <input type="text" name="recipient_name" class="form-input-field-custom" placeholder="Enter recipient's name" required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Recipient Email</label>
                        <div class="form-input-wrapper">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="recipient_email" class="form-input-field-custom" placeholder="recipient@email.com" required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Gift Card Amount</label>
                        <select name="amount" class="form-select-field-custom" required>
                            <option value="100.00" selected>$100.00</option>
                            <option value="50.00">$50.00</option>
                            <option value="200.00">$200.00</option>
                            <option value="500.00">$500.00</option>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Occasion</label>
                        <select name="occasion" class="form-select-field-custom" required>
                            <option value="Birthday" selected>Birthday</option>
                            <option value="Anniversary">Anniversary</option>
                            <option value="Holiday">Holiday</option>
                            <option value="Congratulations">Congratulations</option>
                            <option value="Thank You">Thank You</option>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Delivery Date</label>
                        <div class="form-input-wrapper">
                            <i class="far fa-calendar-alt" style="z-index: 5;"></i>
                            <input type="date" name="delivery_date" class="form-input-field-custom" required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Your Name</label>
                        <div class="form-input-wrapper">
                            <i class="far fa-edit"></i>
                            <input type="text" name="sender_name" class="form-input-field-custom" value="{{ $user->name }}" required>
                        </div>
                    </div>

                    <div class="form-group-custom full-width">
                        <label class="form-label-custom">Personal Message</label>
                        <textarea name="message" class="form-textarea-custom" placeholder="Write a short message to your recipient... (e.g. 'Get something special from ENCORE Custom!')"></textarea>
                    </div>
                </div>

                <div class="form-actions-row">
                    <span class="form-info-note">
                        <i class="fas fa-info-circle"></i> Gift cards can be used for custom clothing, embroidery, team apparel, and accessories.
                    </span>
                    <button type="submit" class="btn-action-primary">
                        <i class="fas fa-paper-plane"></i> Send Gift Card
                    </button>
                </div>
            </form>
        </div>

        <!-- My Gift Cards Section -->
        <div class="my-gift-cards-header-row">
            <h2>My Gift Cards</h2>
            <span class="cards-count-tag">3 cards</span>
        </div>

        <div class="my-cards-grid">
            <!-- Grid Card 1 -->
            <div class="grid-card-item">
                <div class="grid-card-top">
                    <div class="grid-card-icon-box orange">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <span class="status-badge-pill active">Active</span>
                </div>
                <div class="grid-card-value">$125.00</div>
                <div class="grid-card-original-val">of $200.00 original</div>
                <div class="grid-card-title">Personal Store Credit</div>
                <div class="grid-card-code-field">ENCORE-GC-4829</div>
                <div class="grid-card-expiry">
                    <i class="far fa-calendar-alt"></i> Expires Dec 31, 2026
                </div>

                <div class="grid-card-progress-wrapper">
                    <div class="grid-card-progress-label">
                        <span>Balance Left</span>
                        <span>62.5% remaining</span>
                    </div>
                    <div class="progress-bar-track-custom">
                        <div class="progress-bar-fill-custom orange" style="width: 62.5%;"></div>
                    </div>
                </div>

                <div class="grid-card-buttons-row">
                    <button type="button" class="btn-grid-action show-card-details" data-title="Personal Store Credit" data-code="ENCORE-GC-4829" data-original="$200.00" data-balance="$125.00" data-used="$75.00" data-order="EC-20391" data-date="March 12, 2026">
                        <i class="far fa-eye"></i> Details
                    </button>
                    <button type="button" class="btn-grid-action copy-code-btn" data-code="ENCORE-GC-4829">
                        <i class="far fa-copy"></i> Copy
                    </button>
                </div>
            </div>

            <!-- Grid Card 2 -->
            <div class="grid-card-item">
                <div class="grid-card-top">
                    <div class="grid-card-icon-box blue">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <span class="status-badge-pill unused">Unused</span>
                </div>
                <div class="grid-card-value">$50.00</div>
                <div class="grid-card-original-val">of $50.00 original</div>
                <div class="grid-card-title">Birthday Gift Card</div>
                <div class="grid-card-code-field">ENCORE-GC-7194</div>
                <div class="grid-card-expiry">
                    <i class="far fa-calendar-alt"></i> Expires Jan 15, 2027
                </div>

                <div class="grid-card-progress-wrapper">
                    <div class="grid-card-progress-label">
                        <span>Balance Left</span>
                        <span>100% remaining</span>
                    </div>
                    <div class="progress-bar-track-custom">
                        <div class="progress-bar-fill-custom blue" style="width: 100%;"></div>
                    </div>
                </div>

                <div class="grid-card-buttons-row">
                    <button type="button" class="btn-grid-action show-card-details" data-title="Birthday Gift Card" data-code="ENCORE-GC-7194" data-original="$50.00" data-balance="$50.00" data-used="$0.00" data-order="N/A" data-date="N/A">
                        <i class="far fa-eye"></i> Details
                    </button>
                    <button type="button" class="btn-grid-action copy-code-btn" data-code="ENCORE-GC-7194">
                        <i class="far fa-copy"></i> Copy
                    </button>
                </div>
            </div>

            <!-- Grid Card 3 -->
            <div class="grid-card-item" style="opacity: 0.85;">
                <div class="grid-card-top">
                    <div class="grid-card-icon-box grey">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="status-badge-pill redeemed">Redeemed</span>
                </div>
                <div class="grid-card-value" style="color: #94a3b8;">$0.00</div>
                <div class="grid-card-original-val">of $100.00 original</div>
                <div class="grid-card-title">Team Apparel Credit</div>
                <div class="grid-card-code-field" style="background-color:#f1f5f9; color:#94a3b8;">ENCORE-GC-2268</div>
                <div class="grid-card-expiry expired">
                    <i class="far fa-times-circle"></i> Expired
                </div>

                <div class="grid-card-progress-wrapper">
                    <div class="grid-card-progress-label">
                        <span>Balance Left</span>
                        <span>0% remaining</span>
                    </div>
                    <div class="progress-bar-track-custom">
                        <div class="progress-bar-fill-custom grey" style="width: 0%;"></div>
                    </div>
                </div>

                <div class="grid-card-buttons-row">
                    <button type="button" class="btn-grid-action" disabled>
                        <i class="far fa-eye"></i> Details
                    </button>
                    <button type="button" class="btn-grid-action" disabled>
                        <i class="far fa-copy"></i> Copy
                    </button>
                </div>
            </div>
        </div>

        <!-- Gift Card Activity Section -->
        <div class="activity-section">
            <h2 class="section-title-uppercase">Gift Card Activity</h2>
            <div class="activity-timeline-wrapper">
                <div class="timeline-item-card">
                    <div class="timeline-item-left">
                        <div class="timeline-indicator-circle orange">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="timeline-event-text-container">
                            <div class="timeline-event-title">Gift card used at checkout</div>
                            <div class="timeline-event-subtitle">Order #EC-20391</div>
                        </div>
                    </div>
                    <div class="timeline-right-pricing-stamp">
                        <div class="timeline-pricing-val negative">-$75.00</div>
                        <div class="timeline-date-val">Mar 12, 2026</div>
                    </div>
                </div>

                <div class="timeline-item-card">
                    <div class="timeline-item-left">
                        <div class="timeline-indicator-circle green">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="timeline-event-text-container">
                            <div class="timeline-event-title">Gift card received</div>
                            <div class="timeline-event-subtitle">From: ENCORE Custom Rewards</div>
                        </div>
                    </div>
                    <div class="timeline-right-pricing-stamp">
                        <div class="timeline-pricing-val positive">+$200.00</div>
                        <div class="timeline-date-val">Mar 10, 2026</div>
                    </div>
                </div>

                <div class="timeline-item-card">
                    <div class="timeline-item-left">
                        <div class="timeline-indicator-circle blue">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="timeline-event-text-container">
                            <div class="timeline-event-title">Gift card sent</div>
                            <div class="timeline-event-subtitle">Recipient: Michael Carter</div>
                        </div>
                    </div>
                    <div class="timeline-right-pricing-stamp">
                        <div class="timeline-pricing-val neutral">$50.00</div>
                        <div class="timeline-date-val">Feb 20, 2026</div>
                    </div>
                </div>

                <div class="timeline-item-card">
                    <div class="timeline-item-left">
                        <div class="timeline-indicator-circle grey">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="timeline-event-text-container">
                            <div class="timeline-event-title">Gift card redeemed</div>
                            <div class="timeline-event-subtitle">Order #EC-20344</div>
                        </div>
                    </div>
                    <div class="timeline-right-pricing-stamp">
                        <div class="timeline-pricing-val negative">-$100.00</div>
                        <div class="timeline-date-val">Jan 28, 2026</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gift Card Terms Section -->
        <div class="gift-terms-card" id="giftCardTermsBox">
            <div class="terms-icon-box">
                <i class="fas fa-book"></i>
            </div>
            <div class="terms-content-box">
                <h3 class="font-weight-bold mb-3" style="font-size: 15px; color: var(--text-dark);">Gift Card Terms</h3>
                <div class="terms-content-grid">
                    <div class="terms-bullet-item">
                        <i class="fas fa-chevron-right"></i>
                        <span>Gift cards can be used for all ENCORE Custom products.</span>
                    </div>
                    <div class="terms-bullet-item">
                        <i class="fas fa-chevron-right"></i>
                        <span>Remaining balance stays available until the expiry date.</span>
                    </div>
                    <div class="terms-bullet-item">
                        <i class="fas fa-chevron-right"></i>
                        <span>Valid for custom apparel, accessories, embroidery, and team uniform orders.</span>
                    </div>
                    <div class="terms-bullet-item">
                        <i class="fas fa-chevron-right"></i>
                        <span>Lost or stolen gift cards cannot be replaced without proof of purchase.</span>
                    </div>
                    <div class="terms-bullet-item">
                        <i class="fas fa-chevron-right"></i>
                        <span>Gift cards cannot be exchanged for cash.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MY CARD DETAILS MODAL ================= -->
<div class="modal fade" id="cardDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; border:none; box-shadow:var(--shadow-md);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 20px 24px;">
                <h5 class="modal-title font-weight-bold" id="modalCardTitle">Store Credit Card Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 24px; font-size:14px; color: var(--text-dark);">
                <div class="mb-3">
                    <strong>Card Code:</strong> <span class="text-primary" id="modalCardCode">GC-XXXX</span>
                </div>
                <div class="mb-3">
                    <strong>Original Value:</strong> <span id="modalCardOriginal">$0.00</span>
                </div>
                <div class="mb-3">
                    <strong>Used Balance:</strong> <span id="modalCardUsed" class="text-danger">-$0.00</span>
                </div>
                <div class="mb-3">
                    <strong>Remaining Balance:</strong> <span id="modalCardBalance" class="text-success font-weight-bold">$0.00</span>
                </div>
                <div id="modalCardOrderSection" class="mb-3">
                    <strong>Last Transaction:</strong> Used on <span id="modalCardOrder">N/A</span> on <span id="modalCardDate">N/A</span>.
                </div>
                <p class="text-muted" style="font-size:12px; margin-top:20px;">Use this balance during checkout by copying and applying the code in the checkout page coupon section.</p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border-color); padding: 18px 24px;">
                <button type="button" class="btn btn-secondary" style="border-radius:8px;" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark copy-code-btn" style="border-radius:8px;" id="modalCopyBtn"><i class="far fa-copy"></i> Copy Code</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // 1. Copy Code Trigger
        $('.copy-code-btn').on('click', function() {
            let code = $(this).data('code');
            if(!code) {
                // If clicked from inside modal
                code = $('#modalCardCode').text();
            }

            navigator.clipboard.writeText(code).then(function() {
                toastr.success(`Code ${code} copied to clipboard!`, 'Copied!');
            }, function() {
                toastr.error('Failed to copy code.');
            });
        });

        // 2. Apply Code to Checkout Trigger
        $('.apply-code-btn').on('click', function() {
            let code = $(this).data('code');
            Swal.fire({
                icon: 'success',
                title: 'Gift Card Applied',
                text: `Gift Card ${code} ($125.00) has been applied to your current checkout session. You will see the discount at checkout.`,
                confirmButtonColor: '#ff5a36',
                confirmButtonText: 'Great!'
            });
        });

        // 3. Scroll to Terms Smoothly
        $('.scroll-to-terms-btn').on('click', function() {
            $('html, body').animate({
                scrollTop: $("#giftCardTermsBox").offset().top - 100
            }, 600);
        });

        // 4. Form Send Gift Card Handler
        $('#sendGiftCardForm').on('submit', function(e) {
            e.preventDefault();
            let submitBtn = $(this).find('button[type="submit"]');
            let originalText = submitBtn.html();
            let recipientName = $(this).find('input[name="recipient_name"]').val();
            let recipientEmail = $(this).find('input[name="recipient_email"]').val();
            let amount = $(this).find('select[name="amount"]').val();
            let occasion = $(this).find('select[name="occasion"]').val();
            let deliveryDate = $(this).find('input[name="delivery_date"]').val();

            $.ajax({
                url: '#', // Mock submit
                beforeSend: function() {
                    submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...').prop('disabled', true);
                },
                complete: function() {
                    // Delay for realistic feel
                    setTimeout(function() {
                        submitBtn.html(originalText).prop('disabled', false);
                        $('#sendGiftCardForm')[0].reset();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Gift Card Sent!',
                            text: `Success! A $${amount} ${occasion} Gift Card has been scheduled for delivery to ${recipientName} (${recipientEmail}) on ${deliveryDate}.`,
                            confirmButtonColor: '#ff5a36',
                            confirmButtonText: 'Perfect'
                        });
                    }, 1500);
                }
            });
        });

        // 5. Details Modal Handler
        $('.show-card-details').on('click', function() {
            let title = $(this).data('title');
            let code = $(this).data('code');
            let original = $(this).data('original');
            let balance = $(this).data('balance');
            let used = $(this).data('used');
            let order = $(this).data('order');
            let date = $(this).data('date');

            $('#modalCardTitle').text(title);
            $('#modalCardCode').text(code);
            $('#modalCardOriginal').text(original);
            $('#modalCardUsed').text(`-${used}`);
            $('#modalCardBalance').text(balance);

            if(order === 'N/A') {
                $('#modalCardOrderSection').hide();
            } else {
                $('#modalCardOrderSection').show();
                $('#modalCardOrder').text(`Order #${order}`);
                $('#modalCardDate').text(date);
            }

            // Bind code to modal copy button data
            $('#modalCopyBtn').data('code', code);

            $('#cardDetailsModal').modal('show');
        });
    });
</script>

@endsection
