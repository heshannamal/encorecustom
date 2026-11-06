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

    /* Stats Bar (4 columns) */
    .stats-bar-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
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

    .stat-icon-container.green {
        background-color: #ecfdf5;
        color: #10b981;
    }

    .stat-icon-container.grey {
        background-color: #f1f5f9;
        color: #64748b;
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

    /* Filters Bar */
    .filters-bar {
        display: flex;
        gap: 16px;
        margin-bottom: 30px;
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
    }

    .search-input-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 14px;
    }

    .search-input-field {
        width: 100%;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 12px 16px 12px 42px;
        font-size: 14px;
        color: var(--text-dark);
        background-color: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .search-input-field:focus {
        border-color: var(--primary-coral);
        box-shadow: 0 0 0 3px rgba(255, 90, 54, 0.1);
        outline: none;
    }

    .filter-select {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0 16px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        background-color: #ffffff;
        cursor: pointer;
        width: 150px;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-coral);
    }

    /* Order Card Container */
    .order-container-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .order-container-card:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .order-card-header {
        background-color: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        padding: 14px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-card-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .order-id-badge {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .order-date-text {
        font-size: 13px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Status Badges */
    .status-badge-pill {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge-pill.status-production {
        background-color: #fff8f5;
        color: #f97316;
        border: 1px solid #ffedd5;
    }

    .status-badge-pill.status-delivered {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #dcfce7;
    }

    .status-badge-pill.status-shipped {
        background-color: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .status-badge-pill.status-refunded {
        background-color: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .status-dot-indicator {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-production .status-dot-indicator { background-color: #f97316; }
    .status-delivered .status-dot-indicator { background-color: #16a34a; }
    .status-shipped .status-dot-indicator { background-color: #2563eb; }
    .status-refunded .status-dot-indicator { background-color: #64748b; }

    /* Order Body */
    .order-card-body {
        padding: 24px;
    }

    .order-item-detail-row {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
    }

    .order-product-image {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid var(--border-color);
        flex-shrink: 0;
    }

    .order-product-info {
        flex: 1;
    }

    .order-product-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 6px 0;
    }

    .order-product-desc {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-height: 3em; /* 2 lines × 1.5 line-height */
        cursor: pointer;
        transition: max-height 0.4s ease;
        position: relative;
    }

    .order-product-desc.expanded {
        -webkit-line-clamp: unset;
        -webkit-box-orient: unset;
        display: block;
        overflow: hidden;
        max-height: 600px; /* large enough ceiling for any description */
    }

    .desc-toggle-hint {
        font-size: 11px;
        color: var(--primary-coral, #ff5a36);
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin-bottom: 10px;
        user-select: none;
        transition: opacity 0.2s ease;
    }

    .desc-toggle-hint:hover {
        opacity: 0.75;
    }

    .desc-toggle-hint i {
        font-size: 10px;
        transition: transform 0.25s ease;
    }

    .desc-toggle-hint.expanded i {
        transform: rotate(180deg);
    }

    .order-specs-list {
        display: flex;
        gap: 8px;
    }

    .order-spec-tag {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        background-color: #f1f5f9;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .order-pricing-delivery-box {
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        flex-shrink: 0;
    }

    .order-total-price {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.1;
    }

    .order-delivery-status-label {
        font-size: 9px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-top: 8px;
        margin-bottom: 2px;
    }

    .order-delivery-date {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* Production Progress Tracker */
    .production-progress-wrapper {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid var(--border-color);
    }

    .progress-tracker-title {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        letter-spacing: 0.8px;
        margin-bottom: 20px;
    }

    .progress-tracker-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        padding: 0 40px;
    }

    .progress-step-node {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .progress-node-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .progress-node-circle.completed {
        background-color: #ecfdf5;
        border: 2px solid #10b981;
        color: #10b981;
    }

    .progress-node-circle.active {
        background-color: #fff0eb;
        border: 2px solid var(--primary-coral);
        color: var(--primary-coral);
        box-shadow: 0 0 0 4px rgba(255, 90, 54, 0.15);
    }

    .progress-node-circle.pending {
        background-color: #f1f5f9;
        border: 2px solid #cbd5e1;
        color: #94a3b8;
    }

    .progress-node-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
        margin-top: 8px;
    }

    .progress-step-node:hover .progress-node-label {
        color: var(--text-dark);
    }

    .progress-tracker-line {
        position: absolute;
        top: 17px;
        left: 74px;
        right: 74px;
        height: 2px;
        z-index: 1;
        display: flex;
    }

    .progress-line-segment {
        flex: 1;
        height: 100%;
    }

    .progress-line-segment.active-segment {
        background-color: #10b981;
    }

    .progress-line-segment.pending-segment {
        background-color: #cbd5e1;
    }

    /* Actions Button Row */
    .order-actions-row {
        display: flex;
        gap: 12px;
    }

    .btn-action-outline {
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
        text-decoration: none;
    }

    .btn-action-outline:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: var(--text-dark);
        text-decoration: none;
    }

    .btn-action-sm {
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 6px;
    }

    /* Empty state */
    .empty-state-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #f1f5f9;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 24px;
    }

    .empty-state-card h2 {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .empty-state-card p {
        font-size: 14px;
        color: var(--text-muted);
        max-width: 400px;
        margin-bottom: 28px;
        line-height: 1.5;
    }

    .btn-shop-now {
        background-color: var(--text-dark);
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-shop-now:hover {
        background-color: #0f172a;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .modal_details_1 {
        color: #555555;
        font-size: 12px;
        padding: 10px 0px;
    }

    .modal_details_2 {
        /* color: #555555; */
        font-size: 12px;
        padding: 10px 0px;
    }

    .modal_table_header_text {
        border: unset;
        background-color: #D6D8DA !important;
        color: #0A0A0A !important;
        font-size: 13px;
        font-weight: 400;
    }

    @media (max-width: 991px) {
        .stats-bar-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filters-bar {
            flex-direction: column;
        }

        .filter-select {
            width: 100%;
        }

        .order-item-detail-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-pricing-delivery-box {
            text-align: left;
            margin-top: 14px;
        }
    }
</style>

<div class="profile-dashboard">
    <!-- Sidebar -->
    @include('pages.customer_end.profile.partials.sidebar', ['activePage' => 'order_history'])

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
                <h1>Order History</h1>
                <p>Track your custom apparel orders, production progress, and delivery updates.</p>
            </div>
            <a href="{{ route('customer_shop') }}" class="btn-action-primary">
                <i class="fas fa-plus"></i>
                <span>Start New Order</span>
            </a>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar-grid">
            <div class="stat-card-custom">
                <div class="stat-icon-container orange">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">{{ $totalOrders > 0 ? $totalOrders : 0 }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
            <div class="stat-card-custom">
                <div class="stat-icon-container orange">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">{{ $totalOrders > 0 ? $inPacking : 0 }}</div>
                    <div class="stat-label">In Packing</div>
                </div>
            </div>
            <div class="stat-card-custom">
                <div class="stat-icon-container green">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">{{ $totalOrders > 0 ? $delivered : 0 }}</div>
                    <div class="stat-label">Delivered</div>
                </div>
            </div>
            <div class="stat-card-custom">
                <div class="stat-icon-container grey">
                    <i class="fas fa-undo"></i>
                </div>
                <div class="stat-text-container">
                    <div class="stat-number">{{ $totalOrders > 0 ? $refundAndCancel : 0 }}</div>
                    <div class="stat-label">Refund and Cancel</div>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="filters-bar">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="orderSearchField" class="search-input-field" placeholder="Search by order ID, product, or fabric...">
            </div>
            <select id="statusFilterDropdown" class="filter-select">
                <option value="all">All Orders</option>
                <option value="packing">In Packing</option>
                <option value="delivered">Delivered</option>
                <option value="shipped">Shipped</option>
                <option value="refunded">Refunded</option>
            </select>
            <select id="dateFilterDropdown" class="filter-select">
                <option value="all">All Time</option>
                <option value="recent">Last Months</option>
                <option value="30days">Last 30 Days</option>
            </select>
        </div>

        <!-- Orders List Container -->
        <div id="ordersListWrapper">
            <div class="text-center py-5" id="ordersLoadingSpinner">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem; color: var(--primary-coral) !important;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted" style="font-weight: 500;">Loading order history...</p>
            </div>
        </div>
    </div>
</div>

<!-- ================= POPUP MODALS ================= -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; border:none; box-shadow:var(--shadow-md);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color); padding: 20px 24px;">
                <h5 class="modal-title font-weight-bold" id="detailModalTitle">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalBody" style="padding: 24px; font-size:14px; color: var(--text-dark);">
                <!-- Dynamic contents injected here -->
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border-color); padding: 18px 24px;">
                <button type="button" class="btn btn-secondary" style="border-radius:8px;" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" style="border-radius:8px;" id="modalPrintBtn"><i class="fas fa-print"></i> Print Details</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Global toggle for product description expand/collapse
    function toggleDesc(descEl) {
        var hint = descEl.nextElementSibling;
        descEl.classList.toggle('expanded');
        if (hint && hint.classList.contains('desc-toggle-hint')) {
            hint.classList.toggle('expanded', descEl.classList.contains('expanded'));
            hint.querySelector('span').textContent = descEl.classList.contains('expanded') ? 'Show less' : 'Show more';
        }
    }

    $(document).ready(function() {
        // Load Order History via AJAX
        loadOrderHistory();

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function formatDate(dateStr) {
            if (!dateStr) return '';
            let d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            return d.toLocaleDateString('en-US', { month: 'long', day: '2-digit', year: 'numeric' });
        }

        function formatAddDaysDate(dateStr, days) {
            if (!dateStr) return '';
            let d = new Date(dateStr);
            if (isNaN(d.getTime())) return dateStr;
            d.setDate(d.getDate() + days);
            return d.toLocaleDateString('en-US', { month: 'long', day: '2-digit', year: 'numeric' });
        }

        function loadOrderHistory() {
            let searchValue = $('#orderSearchField').val();
            let statusValue = $('#statusFilterDropdown').val();
            let dateValue = $('#dateFilterDropdown').val();

            $('#ordersListWrapper').html(`
                <div class="text-center py-5" id="ordersLoadingSpinner">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem; color: var(--primary-coral) !important;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted" style="font-weight: 500;">Loading order history...</p>
                </div>
            `);

            $.ajax({
                url: "{{ route('profile.get_order_history_data') }}",
                type: "GET",
                data: {
                    search: searchValue,
                    status: statusValue,
                    date_filter: dateValue
                },
                dataType: "json",
                success: function(response) {
                    let orders = [];
                    if (response) {
                        if (response.data && Array.isArray(response.data.orders)) {
                            orders = response.data.orders;
                        } else if (response.data && Array.isArray(response.data)) {
                            orders = response.data;
                        } else if (Array.isArray(response.orders)) {
                            orders = response.orders;
                        } else if (Array.isArray(response)) {
                            orders = response;
                        }
                    }

                    renderOrders(orders);
                },
                error: function(xhr, status, error) {
                    $('#ordersListWrapper').html(`
                        <div class="empty-state-card">
                            <div class="empty-state-icon">
                                <i class="fas fa-exclamation-circle text-danger"></i>
                            </div>
                            <h2>Failed to load orders</h2>
                            <p>There was an issue retrieving your order details. Please refresh or try again.</p>
                            <button type="button" class="btn-action-primary" id="retryLoadOrdersBtn">
                                <i class="fas fa-redo"></i> Retry
                            </button>
                        </div>
                    `);
                }
            });
        }

        $(document).on('click', '#retryLoadOrdersBtn', function() {
            loadOrderHistory();
        });

        function renderOrders(orders) {
            if (!orders || orders.length === 0) {
                let emptyHtml = `
                    <div class="empty-state-card">
                        <div class="empty-state-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h2>No orders found</h2>
                        <p>Looks like you haven't placed any orders yet. Discover our premium custom products and style your team today!</p>
                        <a href="{{ route('customer_shop') }}" class="btn-shop-now">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Start Shopping</span>
                        </a>
                    </div>
                `;
                $('#ordersListWrapper').html(emptyHtml);
                return;
            }

            let defaultImg = "{{ asset('assets/img/products/product_no_image.png') }}";
            let ecBase = "{{ ec_asset('') }}";
            let html = '';

            orders.forEach(function(order) {
                let fulfillmentStatus = order.fulfillment_status;
                let paymentStatus = order.payment_status;

                let statusClass = 'status-production';
                let statusText = 'In Packing';
                let cardStatus = 'production';

                let hasShippingLabel = Boolean(order.shipping_label || order.shippingLabel);
                let isShipped = hasShippingLabel && ((order.shipping_label && order.shipping_label.is_shipped == 1) || (order.shippingLabel && order.shippingLabel.is_shipped == 1));

                if (fulfillmentStatus == 1) {
                    statusClass = 'status-delivered';
                    statusText = 'Delivered';
                    cardStatus = 'delivered';
                } else if (paymentStatus == 3) {
                    statusClass = 'status-refunded';
                    statusText = 'Refunded';
                    cardStatus = 'refunded';
                } else if (isShipped) {
                    statusClass = 'status-shipped';
                    statusText = 'Shipped';
                    cardStatus = 'shipped';
                }

                let formattedOrderId = String(order.id).padStart(4, '0');
                let orderCreatedDate = formatDate(order.created_at);

                let itemsHtml = '';
                if (order.order_items && order.order_items.length > 0) {
                    order.order_items.forEach(function(item) {
                        let imgSrc = item.sub_product.display_main_image ? item.sub_product.display_main_image : defaultImg;
                        let prodTitle = item.sub_product.display_product_name ? item.sub_product.display_product_name : 'Custom Apparel';
                        let prodDesc = (item.sub_product && item.sub_product.description) ? item.sub_product.description : 'Custom colorway and corporate specifications.';
                        let sizeName = (item.size_detail && item.size_detail.size_name) ? item.size_detail.size_name : (item.size_name ? item.size_name : 'N/A');
                        let totalPrice = parseFloat(item.total_price || 0).toFixed(2);
                        let deliveryLabel = (fulfillmentStatus == 1) ? 'Delivered' : 'Est. Delivery';
                        let deliveryDate = (fulfillmentStatus == 1) ? formatDate(order.updated_at) : formatAddDaysDate(order.created_at, 10);

                        itemsHtml += `
                            <div class="order-item-detail-row">
                                <img src="${imgSrc}" class="order-product-image" onerror="this.src='${defaultImg}'">
                                <div class="order-product-info">
                                    <h3 class="order-product-title">${escapeHtml(prodTitle)}</h3>
                                    <div class="order-product-desc" onclick="toggleDesc(this)">
                                        ${prodDesc}
                                    </div>
                                    <span class="desc-toggle-hint" onclick="toggleDesc(this.previousElementSibling)">
                                        <i class="fas fa-chevron-down"></i>
                                        <span>Show more</span>
                                    </span>
                                    <div class="order-specs-list">
                                        <span class="order-spec-tag">
                                            <i class="fas fa-tag"></i> Size: ${escapeHtml(sizeName)}
                                        </span>
                                        <span class="order-spec-tag">
                                            <i class="fas fa-boxes"></i> Qty: ${item.quantity || 1}
                                        </span>
                                    </div>
                                </div>
                                <div class="order-pricing-delivery-box">
                                    <div class="order-total-price">$${totalPrice}</div>
                                    <div class="order-delivery-status-label">${deliveryLabel}</div>
                                    <div class="order-delivery-date">${deliveryDate}</div>
                                </div>
                            </div>
                        `;
                    });
                }

                let progressHtml = '';
                if (fulfillmentStatus == 0 && paymentStatus != 3) {
                    let hasPackingSlip = Boolean(order.packing_slip || order.packingSlip);

                    let packingCircle = hasPackingSlip
                        ? `<div class="progress-node-circle completed"><i class="fas fa-check"></i></div>`
                        : `<div class="progress-node-circle active"><i class="fas fa-box-open"></i></div>`;

                    let shippingCircle = '';
                    if (hasShippingLabel) {
                        shippingCircle = isShipped
                            ? `<div class="progress-node-circle completed"><i class="fas fa-check"></i></div>`
                            : `<div class="progress-node-circle active"><i class="fas fa-shipping-fast"></i></div>`;
                    } else {
                        shippingCircle = `<div class="progress-node-circle pending"><i class="fas fa-shipping-fast"></i></div>`;
                    }

                    let shippingLineClass = hasShippingLabel ? 'active-segment' : 'pending-segment';

                    progressHtml = `
                        <div class="production-progress-wrapper">
                            <div class="progress-tracker-title">Order Progress</div>
                            <div class="progress-tracker-timeline">
                                <div class="progress-step-node">
                                    <div class="progress-node-circle completed">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="progress-node-label">Order</span>
                                </div>

                                <div class="progress-step-node">
                                    ${packingCircle}
                                    <span class="progress-node-label">Packing</span>
                                </div>

                                <div class="progress-step-node">
                                    ${shippingCircle}
                                    <span class="progress-node-label">Shipping</span>
                                </div>

                                <div class="progress-tracker-line">
                                    <div class="progress-line-segment active-segment"></div>
                                    <div class="progress-line-segment ${shippingLineClass}"></div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                let hasPackingSlip = Boolean(order.packingSlip || order.packing_slip);
                let trackProgressBtn = (fulfillmentStatus == 0 && paymentStatus != 3 && hasPackingSlip)
                    ? `<a href="javascript:void(0);" class="btn-action-primary btn-action-sm track-progress-action">
                        <i class="fas fa-route"></i> Track Progress
                       </a>`
                    : '';

                html += `
                    <div class="order-container-card" data-status="${cardStatus}" data-date="${order.created_at || ''}">
                        <div class="order-card-header">
                            <div class="order-card-header-left">
                                <span class="order-id-badge">#${formattedOrderId}</span>
                                <span class="order-date-text">
                                    <i class="far fa-calendar"></i>
                                    ${orderCreatedDate}
                                </span>
                            </div>
                            <div>
                                <span class="status-badge-pill ${statusClass}">
                                    <span class="status-dot-indicator"></span> ${statusText}
                                </span>
                            </div>
                        </div>

                        <div class="order-card-body">
                            ${itemsHtml}
                            ${progressHtml}
                            <div class="order-actions-row">
                                <button type="button" class="btn-action-outline btn-action-sm show-order-details" data-id="${order.id}">
                                    <i class="far fa-eye"></i> View Details
                                </button>
                                ${trackProgressBtn}
                            </div>
                        </div>
                    </div>
                `;
            });

            $('#ordersListWrapper').html(html);

            // Toggle hint visibility — only show if text is actually clamped
            $('.order-product-desc').each(function() {
                var el = this;
                if (el.scrollHeight <= el.offsetHeight + 2) {
                    $(el).next('.desc-toggle-hint').hide();
                }
            });

            // Apply current filter state
            applyFilters();
        }

        // Search filter logic with debounce
        let searchTimeout;
        $('#orderSearchField').on('keyup input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                loadOrderHistory();
            }, 350);
        });

        // Dropdown filters logic
        $('#statusFilterDropdown, #dateFilterDropdown').on('change', function() {
            loadOrderHistory();
        });

        function applyFilters() {
            let searchValue = $('#orderSearchField').val().toLowerCase();
            let statusValue = $('#statusFilterDropdown').val();
            let dateValue = $('#dateFilterDropdown').val();

            let visibleCount = 0;

            $('.order-container-card').each(function() {
                let card = $(this);
                let orderId = card.find('.order-id-badge').text().toLowerCase();
                let productTitle = card.find('.order-product-title').text().toLowerCase();
                let productDesc = card.find('.order-product-desc').text().toLowerCase();
                let cardStatus = card.data('status');
                let cardDateStr = card.data('date');

                let statusMatch = (statusValue === 'all')
                    || (statusValue === 'packing' && cardStatus === 'production')
                    || (cardStatus === statusValue);

                let keywordMatch = !searchValue ||
                                   orderId.includes(searchValue) ||
                                   productTitle.includes(searchValue) ||
                                   productDesc.includes(searchValue);

                let dateMatch = true;
                if (dateValue !== 'all' && cardDateStr) {
                    let orderDate = new Date(cardDateStr);
                    let now = new Date();
                    let diffDays = (now - orderDate) / (1000 * 60 * 60 * 24);
                    if (dateValue === '30days') {
                        dateMatch = diffDays <= 30;
                    } else if (dateValue === 'recent') {
                        dateMatch = diffDays <= 90;
                    }
                }

                if (statusMatch && keywordMatch && dateMatch) {
                    card.fadeIn(200);
                    visibleCount++;
                } else {
                    card.fadeOut(200);
                }
            });

            if ($('.order-container-card').length > 0 && visibleCount === 0) {
                if ($('#noFilterResultsMsg').length === 0) {
                    $('#ordersListWrapper').append(`
                        <div id="noFilterResultsMsg" class="empty-state-card mt-3">
                            <div class="empty-state-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h2>No matching orders found</h2>
                            <p>No orders match your current search or filter criteria. Try adjusting your filters.</p>
                        </div>
                    `);
                } else {
                    $('#noFilterResultsMsg').show();
                }
            } else {
                $('#noFilterResultsMsg').hide();
            }
        }

        // Delegated event bindings for dynamically rendered order items
        $(document).on('click', '.show-order-details', function() {
            let orderId = $(this).data('id');
            $.ajax({
                url: `{{ url('profile/get_order_by_id')}}/${orderId}`,
                method: "GET",
                success: function(response) {
                    $('#detailModalBody').html(response);
                    $('#orderDetailsModal').modal('show');
                },
                error: function() {
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Failed to load order details.');
                    } else {
                        alert('Failed to load order details.');
                    }
                }
            });
        });

        $(document).on('click', '.track-progress-action', function(e) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'info',
                    title: 'Order Tracking',
                    text: 'Your order is currently processing. Details will be updated as soon as shipping labels are generated.',
                    confirmButtonText: 'Close'
                });
            } else {
                alert('Your order is currently processing. Details will be updated as soon as shipping labels are generated.');
            }
        });

        $(document).on('click', '.print-invoice-btn', function() {
            let orderId = $(this).data('id');
            window.open(`/packing_slip/download_packing_slip?order_id=${orderId}`, '_blank');
        });

        $('#modalPrintBtn').on('click', function() {
            var printDiv = document.getElementById('detailModalBody');
            var printWindow = window.open('','_blank','');
            printWindow.document.write(printDiv.innerHTML);
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>

@endsection
