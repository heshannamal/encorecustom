@extends('layouts.customer_end_layouts.app')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Outfit:wght@300;400;500;600;700;800&display=swap');

        /* Payment Receipt Mockup Styles */
        .receipt-card-mockup {
            width: 100%;
            max-width: 460px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            font-family: 'Outfit', sans-serif;
            color: #334155;
        }

        /* Header block */
        .receipt-card-header {
            background-color: #111518;
            color: #ffffff;
            padding: 22px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-logo-side {
            flex: 1;
            display: flex;
            align-items: center;
        }

        /* Logo branding style */
        .encore-badge-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: transparent;
        }

        .encore-badge-logo .arrow-indicator-top {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #ff3b30;
            margin-bottom: 2px;
        }

        .encore-badge-logo .arrow-indicator-bottom {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #ff3b30;
            margin-top: 2px;
        }

        .encore-badge-logo .middle-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            line-height: 1;
        }

        .encore-badge-logo .middle-brand-icon .left-chevron {
            color: #ff3b30;
            font-size: 10px;
            margin-right: 1px;
            font-weight: 800;
        }

        .encore-badge-logo .middle-brand-icon .right-chevron {
            color: #ff3b30;
            font-size: 10px;
            margin-left: 1px;
            font-weight: 800;
        }

        .encore-badge-logo .middle-brand-icon .center-brand-letters {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 900;
            letter-spacing: -1.2px;
            font-size: 12px;
            color: #ffffff;
        }

        .receipt-card-header .header-title-side {
            flex: 2;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .receipt-card-header .header-meta-side {
            flex: 1.2;
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .receipt-meta-order-lbl {
            font-size: 8px;
            color: #94a3b8;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 1px;
        }

        .receipt-meta-order-val {
            font-size: 13px;
            color: #ffffff;
            font-weight: 700;
        }

        .receipt-meta-status-badge {
            background-color: #2ec4b6;
            color: #ffffff;
            border-radius: 12px;
            padding: 2px 10px;
            font-size: 9px;
            font-weight: 700;
            margin-top: 5px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            line-height: 1.2;
        }

        /* Body elements */
        .receipt-card-body {
            padding: 24px 28px;
        }

        .receipt-card-section {
            margin-bottom: 24px;
        }

        .receipt-card-section:last-child {
            margin-bottom: 0;
        }

        .receipt-card-section-title {
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 4px;
        }

        .receipt-card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .receipt-card-row-lbl {
            color: #64748b;
            font-weight: 400;
        }

        .receipt-card-row-val {
            color: #0f172a;
            font-weight: 500;
            text-align: right;
        }

        /* Total Highlight Block */
        .receipt-total-paid-banner {
            background-color: #ecfdf5;
            border: 1px solid #d1fae5;
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 14px 0;
        }

        .receipt-total-paid-banner .total-paid-lbl {
            font-size: 13.5px;
            font-weight: 700;
            color: #065f46;
            text-transform: capitalize;
        }

        .receipt-total-paid-banner .total-paid-val {
            font-size: 18px;
            font-weight: 800;
            color: #065f46;
        }

        /* Footer styling */
        .receipt-card-footer {
            background-color: #f8fafc;
            border-top: 1px solid #f1f5f9;
            padding: 24px 20px;
            text-align: center;
        }

        .receipt-footer-thanks {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .receipt-footer-brand-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 2px;
        }

        .receipt-footer-brand-wrap .brand-footer-text {
            font-size: 16px;
            font-weight: 900;
            color: #0f172a;
        }

        .receipt-footer-brand-wrap .brand-footer-text.font-cursive {
            font-family: 'Dancing Script', cursive;
            font-size: 21px;
            font-weight: 700;
            margin-left: 2px;
        }

        .footer-logo-sm {
            width: 32px;
            height: 32px;
        }

        .footer-logo-sm .arrow-indicator-top {
            border-left-width: 4px;
            border-right-width: 4px;
            border-bottom-width: 4px;
        }

        .footer-logo-sm .arrow-indicator-bottom {
            border-left-width: 4px;
            border-right-width: 4px;
            border-top-width: 4px;
        }

        .footer-logo-sm .middle-brand-icon {
            font-size: 10px;
        }

        .footer-logo-sm .middle-brand-icon .center-brand-letters {
            color: #0f172a;
            font-size: 9px;
        }

        .receipt-footer-est {
            font-size: 8px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 2px;
            padding-left: 4px;
        }

        /* Main Content Area */


        .profile-title-area h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 6px 0;
        }

        .profile-title-area p {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 35px;
        }

        /* Section Subheadings */
        .section-title-uppercase {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.8px;
            margin-bottom: 16px;
        }

        /* Address Card */
        .address-card-custom {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 28px;
            display: flex;
            position: relative;
            box-shadow: var(--shadow-sm);
            margin-bottom: 40px;
            gap: 20px;
        }

        .address-icon-container {
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

        .address-info-container {
            flex: 1;
        }

        .address-recipient-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .address-company-tag {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-coral);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .address-line-text {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .address-phone-row {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .pill-badge.badge-success {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
        }

        .btn-edit-address {
            position: absolute;
            top: 24px;
            right: 24px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-edit-address:hover {
            background-color: var(--primary-coral);
            border-color: var(--primary-coral);
            color: #ffffff;
            transform: scale(1.02);
        }

        /* Transactions Table Card */
        .transactions-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            padding: 24px;
            margin-bottom: 40px;
        }

        .transactions-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .transactions-header-row h2 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
            margin: 0;
            letter-spacing: 0.8px;
        }

        .transactions-view-all-link {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary-coral);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .transactions-view-all-link:hover {
            color: var(--primary-coral-hover);
            text-decoration: none;
        }

        .table-custom {
            width: 100%;
            margin-bottom: 0;
        }

        .table-custom th {
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1px solid var(--border-color);
            padding: 12px 16px;
        }

        .table-custom td {
            font-size: 13px;
            color: var(--text-dark);
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table-custom tr:last-child td {
            border-bottom: none;
        }

        .table-order-id {
            font-weight: 700;
            background-color: #f8fafc;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .payment-method-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .card-brand-badge {
            font-size: 10px;
            font-weight: 800;
            padding: 3px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            color: #ffffff;
        }

        .card-brand-badge.visa {
            background-color: #1a1f71;
        }

        .card-brand-badge.mastercard {
            background-color: #eb001b;
        }

        .card-brand-badge.generic {
            background-color: #475569;
        }

        .table-amount {
            font-weight: 800;
            color: var(--text-dark);
        }

        /* Paid/Refunded Status Badges */
        .payment-status-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
        }

        .payment-status-badge.paid {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #dcfce7;
        }

        .payment-status-badge.refunded {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .payment-status-badge.pending {
            background-color: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
        }

        .btn-table-action {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-table-action:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: var(--text-dark);
        }

        /* Payment Activity */
        .payment-activity-section {
            margin-top: 40px;
        }

        .payment-activity-timeline {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .activity-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .activity-row-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .activity-indicator-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        .activity-indicator-circle.success {
            background-color: #ecfdf5;
            color: #10b981;
        }

        .activity-indicator-text {
            font-weight: 600;
            color: var(--text-dark);
        }

        .activity-indicator-desc {
            color: var(--text-muted);
            font-weight: 400;
        }

        .activity-date-stamp {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
        }

        @media (max-width: 991px) {
            .transactions-card {
                padding: 16px;
                overflow-x: auto;
            }

            .address-card-custom {
                flex-direction: column;
                padding: 20px;
            }

            .btn-edit-address {
                position: relative;
                top: 0;
                right: 0;
                margin-top: 14px;
                width: 100%;
                justify-content: center;
            }
        }

        /* Modal Styling */
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
    </style>

    <div class="profile-dashboard">
        <!-- Sidebar -->
        @include('pages.customer_end.profile.partials.sidebar', ['activePage' => 'billing_payments'])

        <!-- Main Content -->
        <div class="profile-main-content">
            <!-- Mobile Sidebar Toggle -->
            {{-- <div class="d-lg-none mb-3">
                <button type="button" class="btn-mobile-sidebar-toggle" id="mobileSidebarToggle">
                    <i class="fas fa-bars"></i>
                    <span>Profile Menu</span>
                </button>
            </div> --}}
            <div class="profile-title-area">
                <h1>Billing & Payments</h1>
                <p>Manage your payment methods, billing details, and transaction history.</p>
            </div>

            <!-- Billing Address Card -->
            <h2 class="section-title-uppercase">Billing Address</h2>
            <div class="address-card-custom">
                <div class="address-icon-container">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="address-info-container">
                    <div class="address-recipient-name">
                        <span id="billingRecipientName"><span class="skeleton-box" style="width: 140px; height: 18px;"></span></span>
                        <span class="pill-badge badge-success" id="billingVerifiedBadge" style="display: none;">
                            <i class="fas fa-check-circle"></i> Verified
                        </span>
                    </div>
                    <div class="address-line-text" id="billingAddressLines">
                        <span class="skeleton-box mb-1" style="width: 220px; height: 14px;"></span><br>
                        <span class="skeleton-box mb-1" style="width: 180px; height: 14px;"></span><br>
                        <span class="skeleton-box" style="width: 120px; height: 14px;"></span>
                    </div>
                    <div class="address-phone-row">
                        <i class="fas fa-phone-alt"></i>
                        <span id="billingPhone"><span class="skeleton-box" style="width: 110px; height: 14px;"></span></span>
                    </div>
                </div>
                <button type="button" class="btn-edit-address" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                    <i class="fas fa-pen"></i> Edit Address
                </button>
            </div>

            <!-- Recent Transactions Card -->
            <div class="transactions-card">
                <div class="transactions-header-row">
                    <h2>Recent Transactions</h2>
                    <a href="{{ route('profile.order_history') }}" class="transactions-view-all-link">
                        <span>View all</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody id="transactionsTableBody">
                            <tr>
                                <td><span class="skeleton-box" style="width: 70px; height: 20px;"></span></td>
                                <td><span class="skeleton-box" style="width: 90px; height: 16px;"></span></td>
                                <td>
                                    <div class="payment-method-item">
                                        <span class="skeleton-box" style="width: 45px; height: 18px; border-radius: 4px;"></span>
                                        <span class="skeleton-box" style="width: 110px; height: 16px;"></span>
                                    </div>
                                </td>
                                <td><span class="skeleton-box" style="width: 65px; height: 18px;"></span></td>
                                <td><span class="skeleton-box" style="width: 55px; height: 20px; border-radius: 12px;"></span></td>
                                <td><span class="skeleton-box" style="width: 60px; height: 26px; border-radius: 6px;"></span></td>
                            </tr>
                            <tr>
                                <td><span class="skeleton-box" style="width: 70px; height: 20px;"></span></td>
                                <td><span class="skeleton-box" style="width: 90px; height: 16px;"></span></td>
                                <td>
                                    <div class="payment-method-item">
                                        <span class="skeleton-box" style="width: 45px; height: 18px; border-radius: 4px;"></span>
                                        <span class="skeleton-box" style="width: 110px; height: 16px;"></span>
                                    </div>
                                </td>
                                <td><span class="skeleton-box" style="width: 65px; height: 18px;"></span></td>
                                <td><span class="skeleton-box" style="width: 55px; height: 20px; border-radius: 12px;"></span></td>
                                <td><span class="skeleton-box" style="width: 60px; height: 26px; border-radius: 6px;"></span></td>
                            </tr>
                            <tr>
                                <td><span class="skeleton-box" style="width: 70px; height: 20px;"></span></td>
                                <td><span class="skeleton-box" style="width: 90px; height: 16px;"></span></td>
                                <td>
                                    <div class="payment-method-item">
                                        <span class="skeleton-box" style="width: 45px; height: 18px; border-radius: 4px;"></span>
                                        <span class="skeleton-box" style="width: 110px; height: 16px;"></span>
                                    </div>
                                </td>
                                <td><span class="skeleton-box" style="width: 65px; height: 18px;"></span></td>
                                <td><span class="skeleton-box" style="width: 55px; height: 20px; border-radius: 12px;"></span></td>
                                <td><span class="skeleton-box" style="width: 60px; height: 26px; border-radius: 6px;"></span></td>
                            </tr>
                            <tr>
                                <td><span class="skeleton-box" style="width: 70px; height: 20px;"></span></td>
                                <td><span class="skeleton-box" style="width: 90px; height: 16px;"></span></td>
                                <td>
                                    <div class="payment-method-item">
                                        <span class="skeleton-box" style="width: 45px; height: 18px; border-radius: 4px;"></span>
                                        <span class="skeleton-box" style="width: 110px; height: 16px;"></span>
                                    </div>
                                </td>
                                <td><span class="skeleton-box" style="width: 65px; height: 18px;"></span></td>
                                <td><span class="skeleton-box" style="width: 55px; height: 20px; border-radius: 12px;"></span></td>
                                <td><span class="skeleton-box" style="width: 60px; height: 26px; border-radius: 6px;"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment Activity section -->
            {{-- <div class="payment-activity-section">
                <h2 class="section-title-uppercase">Payment Activity</h2>
                <div class="payment-activity-timeline">
                    <div class="activity-row">
                        <div class="activity-row-left">
                            <div class="activity-indicator-circle success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="activity-indicator-text">
                                Payment successful / <span class="activity-indicator-desc">$184.00 charged to Visa ****
                                    4242</span>
                            </div>
                        </div>
                        <div class="activity-date-stamp">Mar 12, 2026</div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- ================= EDIT ADDRESS MODAL ================= -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title font-weight-bold">Edit Billing Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAddressForm">
                    @csrf
                    <input type="hidden" name="section" value="address">
                    <div class="modal-body modal-body-custom">
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="form-label form-label-custom">Address Line 1</label>
                                <input type="text" name="address" class="form-control form-control-custom"
                                    value="{{ $customerDetail->address ?? '' }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label form-label-custom">Address Line 2 (Street/Suite)</label>
                                <input type="text" name="street" class="form-control form-control-custom"
                                    value="{{ $customerDetail->street ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label form-label-custom">City</label>
                                <input type="text" name="city" class="form-control form-control-custom"
                                    value="{{ $customerDetail->city ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label form-label-custom">State / Province</label>
                                <input type="text" name="state" class="form-control form-control-custom"
                                    value="{{ $customerDetail->state ?? '' }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label form-label-custom">Postal / ZIP Code</label>
                                <input type="text" name="postal_code" class="form-control form-control-custom"
                                    value="{{ $customerDetail->postal_code ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label form-label-custom">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control form-control-custom"
                                    value="{{ $customerDetail->phone_number ?? '' }}">
                                {{-- <label class="form-label form-label-custom">Country</label>
                                <select name="country_id" class="form-select form-control-custom" required>
                                    <option value="">-- Choose Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}">
                                            {{ $country['flag'] }} {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer modal-footer-custom">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-submit-custom">Save Address</button>
        </div>
        </form>
    </div>
    </div>
    </div>

    <!-- ================= PAYMENT RECEIPT MODAL ================= -->
    <div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content"
                style="border-radius: 20px; border: none; overflow: hidden; background-color: #f8fafc; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
                <div class="modal-header border-0 bg-light py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title font-weight-bold text-dark m-0" style="font-size: 16px; letter-spacing: 0.5px;">
                        Receipt Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-size: 10px;"></button>
                </div>

                <div class="modal-body p-4" style="background-color: #f8fafc;">
                    <!-- Printable/Captureable Receipt Area -->
                    <div id="receiptCardContainer" style="padding: 2px;">
                        <div id="receiptToPrint" class="receipt-card-mockup">
                            <!-- Receipt Header -->
                            <div class="receipt-card-header">
                                <div class="header-logo-side">
                                    <div class="encore-badge-logo">
                                        <img src="{{ asset('assets/logos/logo_icon.png') }}" alt="">
                                        {{-- <div class="arrow-indicator-top"></div>
                                        <div class="middle-brand-icon">
                                            <span class="left-chevron">&lt;</span>
                                            <span class="center-brand-letters">∃E</span>
                                            <span class="right-chevron">&gt;</span>
                                        </div>
                                        <div class="arrow-indicator-bottom"></div> --}}
                                    </div>
                                </div>
                                <div class="receipt-card-header .header-title-side"
                                    style="flex: 2; text-align: center; font-size: 18px; font-weight: 700; letter-spacing: 0.5px; color: #ffffff;">
                                    PAYMENT RECEIPT
                                </div>
                                <div class="header-meta-side">
                                    <div class="receipt-meta-order-lbl">ORDER ID</div>
                                    <div class="receipt-meta-order-val" id="receiptOrderNumber">#000000</div>
                                    <div class="receipt-meta-status-badge">● PAID</div>
                                </div>
                            </div>

                            <!-- Receipt Sub-sections -->
                            <div class="receipt-card-body">
                                <!-- Section: Customer Details -->
                                <div class="receipt-card-section">
                                    <div class="receipt-card-section-title">CUSTOMER DETAILS</div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Customer Name</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptCustomerName">---</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Payment Method</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptPaymentMethod">---</span>
                                    </div>
                                </div>

                                <!-- Section: Receipt Info -->
                                <div class="receipt-card-section">
                                    <div class="receipt-card-section-title">RECEIPT INFO</div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Date</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptDate">--/--/----</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Transaction ID</span>
                                        <span class="receipt-card-row-val font-weight-bold" id="receiptTransactionId"
                                            style="font-family: monospace; font-size: 12px; letter-spacing: 0.2px;">---</span>
                                    </div>
                                </div>

                                <!-- Section: Order Summary -->
                                <div class="receipt-card-section">
                                    <div class="receipt-card-section-title">ORDER SUMMARY</div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Order Item Amount</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptSubtotal">$0.00</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Sales Tax Fee %</span>
                                        <span class="receipt-card-row-val font-weight-bold" id="receiptTax">$0.00</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Shipping Fee</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptShipping">$0.00</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Other Fees</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptOtherFees">$0.00</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Discount</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptDiscount">$0.00</span>
                                    </div>

                                    <div class="receipt-card-row total-pay-row mt-2 pt-2"
                                        style="border-top: 1.5px solid #000; border-bottom: 1.5px solid #000; padding: 6px 0;">
                                        <span class="receipt-card-row-lbl font-weight-bold text-dark"
                                            style="font-size: 13.5px; text-transform: capitalize;">Amount to Pay</span>
                                        <span class="receipt-card-row-val font-weight-bold text-dark"
                                            style="font-size: 14px;" id="receiptAmountToPay">$0.00</span>
                                    </div>
                                </div>

                                <!-- Section: Payment details -->
                                <div class="receipt-card-section">
                                    <div class="receipt-card-section-title">PAYMENT</div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl">Paid Amount</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptPaidAmount">$0.00</span>
                                    </div>
                                    <div class="receipt-card-row">
                                        <span class="receipt-card-row-lbl" id="receiptProcessingFeeLabel">Card Processing
                                            Fee (3%)</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptProcessingFee">$0.00</span>
                                    </div>

                                    <!-- Highlighted Total Paid Row -->
                                    <div class="receipt-total-paid-banner">
                                        <span class="total-paid-lbl">Total Paid</span>
                                        <span class="total-paid-val" id="receiptTotalPaid">$0.00</span>
                                    </div>

                                    {{-- <div class="receipt-card-row mt-2">
                                        <span class="receipt-card-row-lbl">Balance to Pay</span>
                                        <span class="receipt-card-row-val font-weight-bold"
                                            id="receiptBalanceToPay">$0.00</span>
                                    </div> --}}
                                </div>
                            </div>

                            <!-- Receipt Footer -->
                            <div class="receipt-card-footer">
                                <div class="receipt-footer-thanks">Thank you for your business!</div>

                                <div class="receipt-footer-brand-wrap">
                                    <img src="{{ asset('assets/logos/logo_dark_custom.png') }}" alt="">
                                    {{-- <span class="brand-footer-text left-brand">ENCORE</span>
                                    <div class="encore-badge-logo footer-logo-sm">
                                        <div class="arrow-indicator-top"></div>
                                        <div class="middle-brand-icon">
                                            <span class="left-chevron">&lt;</span>
                                            <span class="center-brand-letters">∃E</span>
                                            <span class="right-chevron">&gt;</span>
                                        </div>
                                        <div class="arrow-indicator-bottom"></div>
                                    </div>
                                    <span class="brand-footer-text right-brand font-cursive">Custom</span> --}}
                                </div>
                                {{-- <div class="receipt-footer-est">EST. NOW</div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 bg-light py-3 px-4 d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-secondary px-3 py-2" data-bs-dismiss="modal"
                        style="border-radius: 8px; font-weight: 600; font-size: 13px;">Close</button>
                    <button type="button" class="btn btn-primary px-3 py-2 d-flex align-items-center gap-2"
                        id="saveReceiptPdfBtn"
                        style="background-color: var(--primary-coral); border-color: var(--primary-coral); border-radius: 8px; font-weight: 600; font-size: 13px; color: #ffffff;">
                        <i class="fas fa-file-pdf"></i> Save as PDF
                    </button>
                    <button type="button" class="btn btn-dark px-3 py-2 d-flex align-items-center gap-2"
                        id="printReceiptBtn" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>

        $(document).ready(function () {
            // Setup headers for AJAX CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Function to load customer billing address details via AJAX calling /profile/get_customer_details
            function loadCustomerDetails() {
                $.ajax({
                    url: "{{ route('profile.get_customer_details') }}",
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        if (response.success && response.data) {
                            let user = response.data.user || {};
                            let detail = response.data.customer_detail || {};

                            let fullName = (detail.first_name || detail.last_name)
                                ? (detail.first_name + ' ' + (detail.last_name || '')).trim()
                                : (user.name || 'User');

                            $('#billingRecipientName').text(fullName);
                            $('#billingVerifiedBadge').show();

                            let streetText = detail.street ? (detail.street + ', ') : '';
                            let addressText = detail.address ? detail.address : '';
                            let cityStateZipText = (detail.city ? detail.city + ', ' : '') +
                                                   (detail.state ? detail.state + ' ' : '') +
                                                   (detail.postal_code || '');
                            let countryText = detail.country_name || detail.country || 'Not Specified';

                            let addressHtml = `
                                <span>${escapeHtml(streetText)}${escapeHtml(addressText)}</span><br>
                                <span>${escapeHtml(cityStateZipText)}</span><br>
                                <span>${escapeHtml(countryText)}</span>
                            `;
                            $('#billingAddressLines').html(addressHtml);
                            $('#billingPhone').text(detail.phone_number || 'NotSpecified');

                            // Populate Edit Address Modal Inputs
                            // $('#editAddressForm input[name="first_name"]').val(detail.first_name || '');
                            // $('#editAddressForm input[name="last_name"]').val(detail.last_name || '');
                            $('#editAddressForm input[name="address"]').val(detail.address || '');
                            $('#editAddressForm input[name="street"]').val(detail.street || '');
                            $('#editAddressForm input[name="city"]').val(detail.city || '');
                            $('#editAddressForm input[name="state"]').val(detail.state || '');
                            $('#editAddressForm input[name="postal_code"]').val(detail.postal_code || '');
                            // if (detail.country_id) {
                            //     $('#editAddressForm select[name="country_id"]').val(detail.country_id);
                            // }
                            $('#editAddressForm input[name="phone_number"]').val(detail.phone_number || '');
                        }
                    },
                    error: function () {
                        $('#billingAddressLines').html('<span class="text-danger">Failed to load address details.</span>');
                    }
                });
            }

            // AJAX update billing address handler
            $('#editAddressForm').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let submitBtn = $(this).find('button[type="submit"]');
                let originalBtnText = submitBtn.text();

                $.ajax({
                    url: "{{ route('profile.update') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function () {
                        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...').prop('disabled', true);
                    },
                    success: function (response) {
                        submitBtn.html(originalBtnText).prop('disabled', false);
                        if (response.success) {
                            $('#editAddressModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 1800,
                                showConfirmButton: false
                            });

                            // Reload customer address card details
                            loadCustomerDetails();
                        } else {
                            toastr.error(response.message || 'Error occurred');
                        }
                    },
                    error: function (xhr) {
                        submitBtn.html(originalBtnText).prop('disabled', false);
                        let errMsg = 'Something went wrong. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        toastr.error(errMsg);
                    }
                });
            });

            // Helper to generate skeleton table rows for transactions
            function getTransactionsSkeletonHtml() {
                let html = '';
                for (let i = 0; i < 4; i++) {
                    html += `
                        <tr>
                            <td><span class="skeleton-box" style="width: 70px; height: 20px;"></span></td>
                            <td><span class="skeleton-box" style="width: 90px; height: 16px;"></span></td>
                            <td>
                                <div class="payment-method-item">
                                    <span class="skeleton-box" style="width: 45px; height: 18px; border-radius: 4px;"></span>
                                    <span class="skeleton-box" style="width: 110px; height: 16px;"></span>
                                </div>
                            </td>
                            <td><span class="skeleton-box" style="width: 65px; height: 18px;"></span></td>
                            <td><span class="skeleton-box" style="width: 55px; height: 20px; border-radius: 12px;"></span></td>
                            <td><span class="skeleton-box" style="width: 60px; height: 26px; border-radius: 6px;"></span></td>
                        </tr>
                    `;
                }
                return html;
            }

            // Function to load order payment details via AJAX calling /profile/get_order_payment_details
            function loadOrderPaymentDetails() {
                $('#transactionsTableBody').html(getTransactionsSkeletonHtml());

                $.ajax({
                    url: "{{ route('profile.get_order_payment_details') }}",
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        let orders = [];
                        if (response) {
                            if (Array.isArray(response.data)) {
                                orders = response.data;
                            } else if (response.data && Array.isArray(response.data.orders)) {
                                orders = response.data.orders;
                            } else if (Array.isArray(response.orders)) {
                                orders = response.orders;
                            } else if (Array.isArray(response)) {
                                orders = response;
                            }
                        }

                        renderTransactionsTable(orders);
                    },
                    error: function (xhr, status, error) {
                        $('#transactionsTableBody').html(`
                            <tr>
                                <td colspan="6" class="text-center py-4 text-danger">
                                    <i class="fas fa-exclamation-circle me-1"></i> Failed to load transactions.
                                    <button type="button" class="btn btn-sm btn-link text-decoration-none text-danger fw-bold ms-2" id="retryTransactionsBtn">
                                        <i class="fas fa-redo"></i> Retry
                                    </button>
                                </td>
                            </tr>
                        `);
                    }
                });
            }

            $(document).on('click', '#retryTransactionsBtn', function () {
                loadOrderPaymentDetails();
            });

            function renderTransactionsTable(orders) {
                if (!orders || orders.length === 0) {
                    $('#transactionsTableBody').html(`
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No transactions found</td>
                        </tr>
                    `);
                    return;
                }

                let html = '';
                orders.forEach(function (order) {
                    let orderIdText = order.order_number ? ('#' + order.order_number) : ('#' + String(order.id || '').padStart(4, '0'));

                    let dateStr = '';
                    if (order.created_at) {
                        let d = new Date(order.created_at);
                        if (!isNaN(d.getTime())) {
                            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            dateStr = `${months[d.getMonth()]} ${String(d.getDate()).padStart(2, '0')}, ${d.getFullYear()}`;
                        } else {
                            dateStr = order.created_at;
                        }
                    } else {
                        dateStr = 'N/A';
                    }

                    let paymentStatus = parseInt(order.payment_status);
                    let statusClass = 'pending';
                    let statusText = 'Pending';

                    if (paymentStatus === 1 || order.payment_status === '1' || order.payment_status === 'paid' || order.payment_status === 'Paid') {
                        statusClass = 'paid';
                        statusText = 'Paid';
                    } else if (paymentStatus === 3 || order.payment_status === '3' || order.payment_status === 'refunded' || order.payment_status === 'Refunded') {
                        statusClass = 'refunded';
                        statusText = 'Refunded';
                    }

                    let methodName = '';
                    if (typeof order.payment_method_name === 'string') {
                        methodName = order.payment_method_name;
                    } else if (typeof order.payment_method === 'string') {
                        methodName = order.payment_method;
                    } else if (order.payment_method_detail && order.payment_method_detail.name) {
                        methodName = order.payment_method_detail.name;
                    } else if (order.paymentMethodDetail && order.paymentMethodDetail.name) {
                        methodName = order.paymentMethodDetail.name;
                    } else {
                        methodName = 'Credit Card';
                    }

                    let badgeClass = 'generic';
                    let cardText = 'Card **** 4242';

                    if (/visa/i.test(methodName)) {
                        badgeClass = 'visa';
                        cardText = 'Visa **** 4242';
                    } else if (/master/i.test(methodName)) {
                        badgeClass = 'mastercard';
                        cardText = 'Mastercard **** 9821';
                    } else {
                        badgeClass = 'generic';
                        cardText = methodName || 'Credit Card';
                    }

                    let amountFormatted = parseFloat(order.invoice_total || order.amount || order.total_amount || 0).toFixed(2);

                    let actionHtml = '';
                    if (paymentStatus === 1 || paymentStatus === 3 || statusText === 'Paid' || statusText === 'Refunded') {
                        actionHtml = `
                            <button type="button" class="btn-table-action btn-invoice-action" data-id="${order.id}">
                                <i class="fas fa-file-download"></i> PDF
                            </button>
                        `;
                    } else {
                        actionHtml = `
                            <span class="btn-table-action text-muted" style="cursor:default;">
                                <i class="far fa-clock"></i> Soon
                            </span>
                        `;
                    }

                    html += `
                        <tr>
                            <td><span class="table-order-id">${escapeHtml(orderIdText)}</span></td>
                            <td>${escapeHtml(dateStr)}</td>
                            <td>
                                <div class="payment-method-item">
                                    <span class="card-brand-badge ${badgeClass}">${badgeClass}</span>
                                    <span>${escapeHtml(cardText)}</span>
                                </div>
                            </td>
                            <td class="table-amount">$${amountFormatted}</td>
                            <td>
                                <span class="payment-status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>${actionHtml}</td>
                        </tr>
                    `;
                });

                $('#transactionsTableBody').html(html);
            }

            function escapeHtml(text) {
                if (!text) return '';
                return String(text)
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            // Initial AJAX calls on page load
            loadCustomerDetails();
            loadOrderPaymentDetails();

            // Trigger payment receipt modal view (using delegation for dynamically rendered elements)
            $(document).on('click', '.btn-invoice-action', function (e) {
                e.preventDefault();
                let orderId = $(this).data('id');
                let originalHtml = $(this).html();
                let $btn = $(this);
                $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled', true);

                $.ajax({
                    url: `{{ url('profile/get_receipt_details') }}/${orderId}`,
                    method: 'GET',
                    success: function (res) {
                        $btn.html(originalHtml).prop('disabled', false);
                        if (res.success) {
                            let data = res.data;

                            // Populate modal fields
                            $('#receiptOrderNumber').text('#' + data.order_number);
                            $('#receiptCustomerName').text(data.customer_name);
                            $('#receiptPaymentMethod').text(data.payment_method);
                            $('#receiptDate').text(data.date);
                            $('#receiptTransactionId').text(data.transaction_id);

                            $('#receiptSubtotal').text('$' + data.subtotal);
                            $('#receiptTax').text('$' + data.tax);
                            $('#receiptShipping').text('$' + data.shipping);
                            $('#receiptOtherFees').text('$' + data.other_fees);
                            $('#receiptDiscount').text('$' + data.discount);
                            $('#receiptAmountToPay').text('$' + data.amount_to_pay);

                            $('#receiptPaidAmount').text('$' + data.paid_amount);

                            // Handle fee label and value
                            if (data.payment_method === 'Cash') {
                                $('#receiptProcessingFeeLabel').text('Processing Fee');
                                $('#receiptProcessingFee').text('$' + data.processing_fee);
                            } else {
                                $('#receiptProcessingFeeLabel').text('Card Processing Fee (3%)');
                                $('#receiptProcessingFee').text('$' + data.processing_fee);
                            }

                            $('#receiptTotalPaid').text('$' + data.total_paid);

                            // Set transaction ID on save/print buttons for filenames
                            $('#saveReceiptPdfBtn').data('order-id', data.order_number);

                            // Show modal
                            $('#receiptModal').modal('show');
                        } else {
                            toastr.error(res.message || 'Failed to fetch receipt details.');
                        }
                    },
                    error: function (xhr) {
                        $btn.html(originalHtml).prop('disabled', false);
                        let errMsg = 'Failed to fetch receipt details. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        toastr.error(errMsg);
                    }
                });
            });

            // Save receipt as PDF
            $('#saveReceiptPdfBtn').on('click', function () {
                let orderId = $(this).data('order-id') || 'receipt';
                let $btn = $(this);
                let originalHtml = $btn.html();
                $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...').prop('disabled', true);

                let element = document.getElementById('receiptToPrint');

                html2canvas(element, {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#ffffff',
                    logging: false
                }).then(function (canvas) {
                    let imgData = canvas.toDataURL('image/jpeg', 1.0);
                    let imgWidth = 210;
                    let imgHeight = (canvas.height * imgWidth) / canvas.width;

                    let doc = new jsPDF('p', 'mm', 'a4');
                    let position = 10;

                    doc.addImage(imgData, 'JPEG', (imgWidth - 140) / 2, position, 140, imgHeight * (140 / imgWidth));
                    doc.save('payment_receipt_#' + orderId + '.pdf');

                    $btn.html(originalHtml).prop('disabled', false);
                }).catch(function (error) {
                    console.error('PDF Generation Error:', error);
                    toastr.error('Failed to generate PDF receipt.');
                    $btn.html(originalHtml).prop('disabled', false);
                });
            });

            // Print receipt
            $('#printReceiptBtn').on('click', function () {
                let receiptHtml = $('#receiptCardContainer').html();

                let printWindow = window.open('', '_blank', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Payment Receipt</title>');
                printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">');
                printWindow.document.write('<style>');
                printWindow.document.write(`
                    body {
                        margin: 0;
                        padding: 20px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: #ffffff;
                    }
                    .receipt-card-mockup {
                        width: 100%;
                        max-width: 460px;
                        background: #ffffff;
                        border: 1px solid #e2e8f0;
                        border-radius: 16px;
                        box-shadow: none !important;
                        overflow: hidden;
                        font-family: 'Outfit', sans-serif;
                        color: #334155;
                    }
                    .receipt-card-header {
                        background-color: #111518;
                        color: #ffffff;
                        padding: 22px 24px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                    }
                    .header-logo-side {
                        flex: 1;
                        display: flex;
                        align-items: center;
                    }
                    .encore-badge-logo {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        width: 42px;
                        height: 42px;
                        background: transparent;
                    }
                    .encore-badge-logo .arrow-indicator-top {
                        width: 0;
                        height: 0;
                        border-left: 5px solid transparent;
                        border-right: 5px solid transparent;
                        border-bottom: 5px solid #ff3b30;
                        margin-bottom: 2px;
                    }
                    .encore-badge-logo .arrow-indicator-bottom {
                        width: 0;
                        height: 0;
                        border-left: 5px solid transparent;
                        border-right: 5px solid transparent;
                        border-top: 5px solid #ff3b30;
                        margin-top: 2px;
                    }
                    .encore-badge-logo .middle-brand-icon {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 13px;
                        font-weight: 700;
                        line-height: 1;
                    }
                    .encore-badge-logo .middle-brand-icon .left-chevron {
                        color: #ff3b30;
                        font-size: 10px;
                        margin-right: 1px;
                        font-weight: 800;
                    }
                    .encore-badge-logo .middle-brand-icon .right-chevron {
                        color: #ff3b30;
                        font-size: 10px;
                        margin-left: 1px;
                        font-weight: 800;
                    }
                    .encore-badge-logo .middle-brand-icon .center-brand-letters {
                        font-family: Arial, Helvetica, sans-serif;
                        font-weight: 900;
                        letter-spacing: -1.2px;
                        font-size: 12px;
                        color: #ffffff;
                    }
                    .receipt-card-header .header-title-side {
                        flex: 2;
                        text-align: center;
                        font-size: 18px;
                        font-weight: 700;
                        letter-spacing: 0.5px;
                        color: #ffffff;
                    }
                    .receipt-card-header .header-meta-side {
                        flex: 1.2;
                        text-align: right;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-end;
                    }
                    .receipt-meta-order-lbl {
                        font-size: 8px;
                        color: #94a3b8;
                        font-weight: 700;
                        letter-spacing: 0.8px;
                        text-transform: uppercase;
                        margin-bottom: 1px;
                    }
                    .receipt-meta-order-val {
                        font-size: 13px;
                        color: #ffffff;
                        font-weight: 700;
                    }
                    .receipt-meta-status-badge {
                        background-color: #2ec4b6;
                        color: #ffffff;
                        border-radius: 12px;
                        padding: 2px 10px;
                        font-size: 9px;
                        font-weight: 700;
                        margin-top: 5px;
                        display: inline-flex;
                        align-items: center;
                        gap: 4px;
                        line-height: 1.2;
                    }
                    .receipt-card-body {
                        padding: 24px 28px;
                    }
                    .receipt-card-section {
                        margin-bottom: 24px;
                    }
                    .receipt-card-section:last-child {
                        margin-bottom: 0;
                    }
                    .receipt-card-section-title {
                        font-size: 9px;
                        font-weight: 700;
                        color: #94a3b8;
                        letter-spacing: 0.8px;
                        text-transform: uppercase;
                        margin-bottom: 12px;
                        border-bottom: 1px solid #f1f5f9;
                        padding-bottom: 4px;
                    }
                    .receipt-card-row {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 8px;
                        font-size: 13px;
                    }
                    .receipt-card-row-lbl {
                        color: #64748b;
                        font-weight: 400;
                    }
                    .receipt-card-row-val {
                        color: #0f172a;
                        font-weight: 500;
                        text-align: right;
                    }
                    .receipt-total-paid-banner {
                        background-color: #ecfdf5;
                        border: 1px solid #d1fae5;
                        border-radius: 10px;
                        padding: 12px 16px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin: 14px 0;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .receipt-total-paid-banner .total-paid-lbl {
                        font-size: 13.5px;
                        font-weight: 700;
                        color: #065f46;
                    }
                    .receipt-total-paid-banner .total-paid-val {
                        font-size: 18px;
                        font-weight: 800;
                        color: #065f46;
                    }
                    .receipt-card-footer {
                        background-color: #f8fafc;
                        border-top: 1px solid #f1f5f9;
                        padding: 24px 20px;
                        text-align: center;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .receipt-footer-thanks {
                        font-size: 14px;
                        font-weight: 600;
                        color: #0f172a;
                        margin-bottom: 12px;
                    }
                    .receipt-footer-brand-wrap {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 6px;
                        margin-bottom: 2px;
                    }
                    .receipt-footer-brand-wrap .brand-footer-text {
                        font-size: 16px;
                        font-weight: 900;
                        color: #0f172a;
                    }
                    .receipt-footer-brand-wrap .brand-footer-text.font-cursive {
                        font-family: 'Dancing Script', cursive;
                        font-size: 21px;
                        font-weight: 700;
                        margin-left: 2px;
                    }
                    .footer-logo-sm {
                        width: 32px;
                        height: 32px;
                    }
                    .footer-logo-sm .arrow-indicator-top {
                        border-left-width: 4px;
                        border-right-width: 4px;
                        border-bottom-width: 4px;
                        border-bottom-color: #ff3b30;
                    }
                    .footer-logo-sm .arrow-indicator-bottom {
                        border-left-width: 4px;
                        border-right-width: 4px;
                        border-top-width: 4px;
                        border-top-color: #ff3b30;
                    }
                    .footer-logo-sm .middle-brand-icon {
                        font-size: 10px;
                    }
                    .footer-logo-sm .middle-brand-icon .center-brand-letters {
                        color: #0f172a;
                        font-size: 9px;
                    }
                    .receipt-footer-est {
                        font-size: 8px;
                        font-weight: 700;
                        color: #94a3b8;
                        letter-spacing: 4px;
                        text-transform: uppercase;
                        margin-top: 2px;
                        padding-left: 4px;
                    }
                    @media print {
                        body {
                            padding: 0;
                            background-color: #ffffff;
                        }
                        .receipt-card-mockup {
                            border: none;
                            box-shadow: none;
                            max-width: 100%;
                        }
                    }
                `);
                printWindow.document.write('</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write(receiptHtml);
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                setTimeout(function () {
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                }, 600);
            });

            $('.print-mock-pdf').on('click', function () {
                window.print();
            });

        });
    </script>

@endsection