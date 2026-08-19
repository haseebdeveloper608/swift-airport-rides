{{-- 
    BOOKER COMPONENT
    Usage: @include('components.booker')
--}}

{{-- Font Awesome 6 (Free) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* ===== GOOGLE PLACES AUTOCOMPLETE STYLING - ENHANCED ===== */
    .pac-container {
        border-radius: 16px;
        border: none;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .15);
        font-family: 'Public Sans', sans-serif;
        margin-top: 8px;
        overflow: hidden;
        z-index: 99999 !important;
        background: #fff;
        min-width: 420px !important;
        max-width: 600px !important;
        animation: pacFadeIn 0.18s ease-out;
    }

    @keyframes pacFadeIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pac-container:after {
        content: none;
    }

    .pac-item {
        padding: 12px 18px;
        font-size: 14px;
        cursor: pointer;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #101E45;
        transition: all 0.2s ease;
    }

    .pac-item:hover {
        background: linear-gradient(135deg, #EBF1FF 0%, #EBF1FF 100%);
        padding-left: 22px;
    }

    .pac-item-selected {
        background: linear-gradient(135deg, #EBF1FF 0%, #D9E4FA 100%);
    }


    .pac-item-query {
        font-weight: 600;
        font-size: 14px;
        color: #0A142E;
    }

    .pac-matched {
        color: #2E6BE6;
        font-weight: 700;
    }

    .pac-item-query+span {
        color: #64748b;
        font-size: 12px;
        margin-left: 8px;
    }

    /* Custom dropdown styling */
    .custom-dropdown {
        position: relative;
    }

    .form-group select {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 18px;
        cursor: pointer;
    }

    .form-group select:hover {
        border-color: var(--blue);
    }

    .form-group select:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
    }

    .search-form.hidden {
        display: none;
    }

    .search-results {
        display: none;
        margin-top: 28px;
        background: #fff;
        border: 1px solid rgba(10, 20, 46, 0.08);
        border-radius: 24px;
        box-shadow: 0 24px 70px rgba(10, 20, 46, 0.08);
        padding: 24px;
        text-align: left;
    }

    .search-results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .search-results-header h2 {
        margin: 0;
        font-size: 24px;
    }

    .search-results-grid {
        display: grid;
        gap: 18px;
        grid-template-columns: 1fr;
    }

    .result-card {
        background: #f8fafc;
        border-radius: 20px;
        border: 1px solid rgba(10, 20, 46, 0.08);
        padding: 22px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 18px;
        align-items: center;
    }

    .result-info {
        display: grid;
        gap: 10px;
    }

    .result-info strong {
        font-size: 18px;
        color: #0A142E;
    }

    .result-meta,
    .result-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        color: var(--text-muted);
        font-size: 13px;
    }

    .result-tag {
        background: #e0f2fe;
        color: #0c4a6e;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .result-price {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        gap: 8px;
        min-width: 150px;
    }

    .result-price strong {
        font-size: 28px;
        color: var(--blue);
    }

    .price-old {
        color: #64748b;
        font-size: 13px;
        text-decoration: line-through;
    }

    .btn-book,
    .btn-new-search {
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
    }

    .btn-book {
        background: var(--blue);
        color: #ffffff;
        border: none;
    }

    .btn-book:hover,
    .btn-new-search:hover {
        transform: translateY(-1px);
    }

    .btn-new-search {
        background: #ffffff;
        border: 1px solid rgba(46, 107, 230, 0.3);
        color: var(--blue);
    }

    .search-results-empty {
        display: none;
        font-size: 15px;
        color: var(--text-muted);
        padding: 32px 0 8px;
        text-align: center;
    }

    /* ===== AUTOCOMPLETE INPUT STATE ===== */
    .location-input-wrap {
        position: relative;
    }

    .location-input-wrap .location-pin {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        pointer-events: none;
        z-index: 1;
        color: #94a3b8;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .location-input-wrap input:focus ~ .location-pin {
        color: var(--blue);
        transform: translateY(-50%) scale(1.15);
    }

    .location-input-wrap input {
        padding-left: 42px !important;
        padding-right: 36px !important;
    }

    .input-verified {
        border-color: #16a34a !important;
        background: #f0fdf4 !important;
    }

    .input-verified+.verified-tick {
        display: flex !important;
    }

    .verified-tick {
        display: none;
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%) scale(0);
        color: #16a34a;
        font-size: 16px;
        font-weight: 700;
        background: #f0fdf4;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .input-verified+.verified-tick {
        animation: tickPop 0.3s ease forwards;
    }

    @keyframes tickPop {
        0% {
            transform: translateY(-50%) scale(0);
            opacity: 0;
        }
        60% {
            transform: translateY(-50%) scale(1.25);
            opacity: 1;
        }
        100% {
            transform: translateY(-50%) scale(1);
            opacity: 1;
        }
    }

    .verified-tick i {
        font-size: 12px;
    }

    /* Loading animation for search */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .search-loading {
        animation: pulse 1.5s ease-in-out infinite;
    }

    /* Fade-up entrance animation utility */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-up {
        animation: fadeUp 0.6s ease both;
    }

    /* ===== MILEAGE / DISTANCE BADGE STYLING ===== */
    .booking-mileage-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
        border: 1px solid #93c5fd;
        color: #1e40af;
        padding: 12px 18px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.08);
        transition: all 0.3s ease;
    }

    .booking-mileage-badge i {
        color: #2563eb;
        font-size: 16px;
    }

    .booking-mileage-badge strong {
        color: #1e3a8a;
        font-weight: 800;
        font-size: 15px;
    }

    /* ===== CUSTOM AUTOCOMPLETE DROPDOWN (EXACT REFERENCE DESIGN) ===== */
    .custom-autocomplete-dropdown {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(10, 20, 46, 0.16), 0 4px 12px rgba(0, 0, 0, 0.05);
        max-height: 310px;
        overflow-y: auto;
        z-index: 99999 !important;
        display: none;
        padding: 4px 0;
    }

    .custom-autocomplete-dropdown::-webkit-scrollbar {
        width: 7px;
    }
    .custom-autocomplete-dropdown::-webkit-scrollbar-track {
        background: #F1F5F9;
        border-radius: 10px;
    }
    .custom-autocomplete-dropdown::-webkit-scrollbar-thumb {
        background: #94A3B8;
        border-radius: 10px;
    }
    .custom-autocomplete-dropdown::-webkit-scrollbar-thumb:hover {
        background: #64748B;
    }

    .custom-autocomplete-item {
        padding: 13px 18px;
        font-size: 14px;
        font-weight: 600;
        color: #0F172A;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 14px;
        border-bottom: 1px solid #F1F5F9;
        transition: background 0.18s ease, color 0.18s ease;
    }

    .custom-autocomplete-item:last-child {
        border-bottom: none;
    }

    .custom-autocomplete-item:hover,
    .custom-autocomplete-item.active {
        background: #F0F6FF;
        color: #1D4ED8;
    }

    .custom-autocomplete-item i {
        font-size: 15px;
        color: #2563EB;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    .custom-autocomplete-item span.loc-label {
        flex: 1;
        line-height: 1.35;
    }

    .custom-autocomplete-item span.loc-postcode {
        font-size: 11px;
        background: #E0F2FE;
        color: #0369A1;
        padding: 2px 7px;
        border-radius: 6px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .custom-autocomplete-loading,
    .custom-autocomplete-empty {
        padding: 14px 18px;
        font-size: 13.5px;
        color: #64748B;
        text-align: center;
        font-weight: 500;
    }

    /* ===== HERO SECTION ===== */
    .hero {
        background: linear-gradient(135deg, #0A142E 0%, #16295E 50%, #0A142E 100%);
        padding: 60px 40px 50px;
        position: relative;
        overflow: hidden;
        min-height: 400px;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 1140px;
        margin: 0 auto;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        color: #e2e8f0;
        font-size: 12px;
        font-weight: 500;
        padding: 6px 16px;
        border-radius: 30px;
        margin-bottom: 20px;
        backdrop-filter: blur(4px);
        animation: fadeUp 0.5s ease both;
    }

    .hero-badge i {
        font-size: 11px;
        color: #F2C400;
        animation: spinSlow 4s linear infinite;
        display: inline-block;
    }

    @keyframes spinSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .hero h1 {
        font-size: clamp(28px, 5vw, 44px);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 14px;
        animation: fadeUp 0.6s ease 0.05s both;
    }

    .hero h1 span {
        color: #FFD426;
    }

    .hero-sub {
        color: #94a3b8;
        font-size: 15px;
        margin-bottom: 30px;
        max-width: 860px;
        margin-left: auto;
        margin-right: auto;
        animation: fadeUp 0.6s ease 0.1s both;
    }

    /* ===== SEARCH FORM ===== */
    .search-form {
        background: #fff;
        border-radius: 24px;
        padding: 28px 32px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .35);
        max-width: 860px;
        margin: 0 auto;
        animation: fadeUp 0.7s ease 0.2s both;
    }

    .search-tabs {
        display: flex;
        gap: 0;
        margin-bottom: 24px;
        border-bottom: 2px solid var(--border, #e5e7eb);
    }

    .search-tab {
        background: none;
        border: none;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-muted, #6b7280);
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all .2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-tab i {
        font-size: 14px;
    }

    .search-tab.active {
        color: var(--blue, #2E6BE6);
        border-bottom-color: var(--blue, #2E6BE6);
    }

    .search-tab:hover:not(.active) {
        color: var(--text, #101E45);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr auto 1fr 1fr;
        gap: 16px;
        align-items: end;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-group label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted, #6b7280);
        text-transform: uppercase;
        letter-spacing: .8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-group label i {
        font-size: 11px;
    }

    .form-group input,
    .form-group select {
        border: 1.5px solid var(--border, #e5e7eb);
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 14px;
        color: var(--text, #101E45);
        outline: none;
        transition: all .2s;
        font-family: inherit;
        background: #fff;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group input:hover,
    .form-group select:hover {
        border-color: #94a3b8;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: var(--blue, #2E6BE6);
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
    }

    .swap-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--blue-light, #EBF1FF);
        border: 1.5px solid var(--blue, #2E6BE6);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        align-self: center;
        margin-bottom: 2px;
        flex-shrink: 0;
        transition: all .3s;
        color: var(--blue, #2E6BE6);
        font-size: 16px;
    }

    .swap-icon:hover {
        background: var(--blue, #2E6BE6);
        color: #fff;
        transform: rotate(180deg);
    }

    .swap-icon:active {
        transform: rotate(180deg) scale(0.9);
    }

    .form-row2 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    .btn-search {
        width: 100%;
        background: linear-gradient(135deg, var(--blue, #2E6BE6), var(--blue-dark, #1E4FC2));
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 14px 24px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all .2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 10px 25px rgba(46, 107, 230, .4);
    }

    .btn-search i {
        font-size: 18px;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, var(--blue-dark, #1E4FC2), #0e3a8a);
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(46, 107, 230, .5);
    }

    .btn-search:active {
        transform: translateY(0);
    }

    /* Return date row (hidden by default) */
    .return-row {
        display: none;
        margin-bottom: 20px;
    }

    .return-row.show {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        animation: fadeUp 0.35s ease both;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: 1fr auto 1fr;
        }

        .form-grid .form-group:last-child {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 40px 20px 30px;
        }

        .search-form {
            padding: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .swap-icon {
            display: none;
        }

        .form-row2 {
            grid-template-columns: 1fr 1fr;
        }

        .return-row.show {
            grid-template-columns: 1fr;
        }

        .pac-container {
            min-width: 90vw !important;
            max-width: 95vw !important;
        }
    }

    @media (max-width: 480px) {
        .form-row2 {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- ===== HERO SECTION ===== -->
<section class="hero">
    <div class="hero-content">
        <h1>{{ $page->title }}</h1>
        </div>

        <!-- SEARCH FORM -->
        <div class="search-form">
            <div class="search-tabs d-flex align-items-center justify-content-between flex-wrap gap-2">
                <button class="search-tab active" onclick="switchTab(this,'one-way')">
                    <i class="fas fa-plane-departure"></i> One Way
                </button>
                <span class="search-tab-discount" style="background: #F0EEFF; color: #5843F6; font-size: 12px; font-weight: 800; padding: 6px 14px; border-radius: 50px; border: 1px solid rgba(88, 67, 246, 0.25); display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fas fa-tags"></i> 5% Discount on Return Booking
                </span>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label><i class="fas fa-map-pin"></i> Pickup Location</label>
                    <div class="location-input-wrap">
                        <i class="fas fa-location-dot location-pin"></i>
                        <input
                            type="text"
                            id="pickup"
                            placeholder="Enter pickup address or airport"
                            autocomplete="off" />
                        <span class="verified-tick"><i class="fas fa-check-circle"></i></span>
                    </div>
                </div>

                <button class="swap-icon" onclick="swapLocations()" title="Swap locations">
                    <i class="fas fa-arrow-right-arrow-left"></i>
                </button>

                <div class="form-group">
                    <label><i class="fas fa-flag-checkered"></i> Drop-off Location</label>
                    <div class="location-input-wrap">
                        <i class="fas fa-location-dot location-pin"></i>
                        <input
                            type="text"
                            id="dropoff"
                            placeholder="Enter destination address"
                            autocomplete="off" />
                        <span class="verified-tick"><i class="fas fa-check-circle"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pickup-date"><i class="far fa-calendar-alt"></i> Pickup Date</label>
                    <div class="input-with-icon-wrap">
                        <input type="text" id="pickup-date" class="custom-datepicker" placeholder="Select pickup date" />
                        <i class="fas fa-calendar-day input-icon"></i>
                    </div>
                </div>
            </div>

            <div class="return-row" id="return-row">
                <div class="form-group">
                    <label for="return-date"><i class="far fa-calendar-check"></i> Return Date</label>
                    <div class="input-with-icon-wrap">
                        <input type="text" id="return-date" class="custom-datepicker" placeholder="Select return date" />
                        <i class="fas fa-calendar-day input-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="return-time"><i class="far fa-clock"></i> Return Time</label>
                    <div class="input-with-icon-wrap">
                        <input type="text" id="return-time" class="custom-timepicker" value="12:00" placeholder="Select return time" />
                        <i class="fas fa-clock input-icon"></i>
                    </div>
                </div>
            </div>

            <div id="bookingMileageBadge" class="booking-mileage-badge" style="display: none;">
                <i class="fas fa-route"></i>
                <span id="bookingMileageText">Calculating distance...</span>
            </div>

            <div class="form-row2">
                <div class="form-group">
                    <label for="pickup-time"><i class="far fa-clock"></i> Pickup Time</label>
                    <div class="input-with-icon-wrap">
                        <input type="text" id="pickup-time" class="custom-timepicker" placeholder="Select pickup time" />
                        <i class="fas fa-clock input-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Passengers</label>
                    <select id="passengers">
                        <option value="1">1 Passenger</option>
                        <option value="2">2 Passengers</option>
                        <option value="3">3 Passengers</option>
                        <option value="4">4 Passengers</option>
                        <option value="5">5+ Passengers</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-suitcase"></i> Luggage</label>
                    <select id="luggage">
                        <option value="0">No luggage</option>
                        <option value="1">1 suitcase</option>
                        <option value="2">2 suitcases</option>
                        <option value="3">3+ suitcases</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-car"></i> Vehicle Type</label>
                    <select id="vehicle-type">
                        <option value="">Any Type</option>
                        <option value="saloon">Saloon / Sedan</option>
                        <option value="estate">Estate / Wagon</option>
                        <option value="mpv">MPV / People Carrier</option>
                        <option value="executive">Executive Class</option>
                        <option value="suv">Luxury SUV</option>
                        <option value="minibus">Minibus (8-16 seats)</option>
                    </select>
                </div>
            </div>

            <button class="btn-search" onclick="searchQuotes()">
                <i class="fas fa-search"></i> Compare Taxi Quotes
            </button>
        </div>
    </div>
</section>

<script>
    // =============================================
    // DEFAULTS
    // =============================================
    const today = new Date();
    const pickupDateEl = document.getElementById('pickup-date');
    const pickupTimeEl = document.getElementById('pickup-time');
    const returnDateEl = document.getElementById('return-date');
    const returnTimeEl = document.getElementById('return-time');

    if (pickupDateEl) {
        if (pickupDateEl._flatpickr) {
            if (!pickupDateEl.value) pickupDateEl._flatpickr.setDate(today, true);
        } else {
            if (!pickupDateEl.value) pickupDateEl.value = today.toISOString().split('T')[0];
        }
    }
    if (pickupTimeEl) {
        if (pickupTimeEl._flatpickr) {
            if (!pickupTimeEl.value) pickupTimeEl._flatpickr.setDate('10:00', true);
        } else {
            if (!pickupTimeEl.value) pickupTimeEl.value = '10:00';
        }
    }

    // =============================================
    // TAB SWITCH (One Way / Return)
    // =============================================
    function switchTab(el, type) {
        document.querySelectorAll('.search-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        const returnRow = document.getElementById('return-row');
        if (type === 'return') {
            returnRow.classList.add('show');
            // Set return date to pickup date + 1 day by default
            const pd = pickupDateEl ? pickupDateEl.value : '';
            if (pd && returnDateEl && !returnDateEl.value) {
                const next = new Date(pd);
                next.setDate(next.getDate() + 1);
                if (returnDateEl._flatpickr) {
                    returnDateEl._flatpickr.setDate(next, true);
                } else {
                    returnDateEl.value = next.toISOString().split('T')[0];
                }
            }
        } else {
            returnRow.classList.remove('show');
        }
    }

    // =============================================
    // DISTANCE / MILEAGE CALCULATION
    // =============================================
    function calculateBookingMileage() {
        const pInput = document.getElementById('pickup') || document.getElementById('srFrom');
        const dInput = document.getElementById('dropoff') || document.getElementById('srTo');
        
        if (!pInput || !dInput) return;
        
        const pickupVal = (pInput.dataset.address || pInput.value).trim();
        const dropoffVal = (dInput.dataset.address || dInput.value).trim();
        const badge = document.getElementById('bookingMileageBadge') || document.getElementById('srMileageBadge');
        const badgeText = document.getElementById('bookingMileageText') || document.getElementById('srMileageText');
        
        if (!pickupVal || !dropoffVal) {
            if (badge) badge.style.display = 'none';
            return;
        }
        
        if (badge && badgeText) {
            badge.style.display = 'flex';
            badgeText.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px;"></i> Calculating distance...';
        }
        
        const stops = [];
        document.querySelectorAll('.stop-input').forEach(inp => {
            if (inp.value.trim()) stops.push(inp.value.trim());
        });
        
        const params = new URLSearchParams({
            pickup: pickupVal,
            dropoff: dropoffVal,
            pickup_lat: pInput.dataset.lat || '',
            pickup_lng: pInput.dataset.lng || '',
            dropoff_lat: dInput.dataset.lat || '',
            dropoff_lng: dInput.dataset.lng || '',
            stops: JSON.stringify(stops)
        });
        
        fetch('/search/ajax?' + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data && data.distance && data.distance > 0) {
                if (badge && badgeText) {
                    badge.style.display = 'flex';
                    badgeText.innerHTML = `Estimated Distance: <strong>${data.distance} miles</strong>`;
                }
                window.calculatedTripDistance = data.distance;
                pInput.dataset.distance = data.distance;
                dInput.dataset.distance = data.distance;
            } else {
                if (badge) badge.style.display = 'none';
            }
        })
        .catch(err => {
            console.error('Distance calculation error:', err);
            if (badge) badge.style.display = 'none';
        });
    }

    // =============================================
    // SWAP LOCATIONS
    // =============================================
    function swapLocations() {
        const pInput = document.getElementById('pickup');
        const dInput = document.getElementById('dropoff');

        if (!pInput || !dInput) return;

        // Swap values
        const tmpVal = pInput.value;
        pInput.value = dInput.value;
        dInput.value = tmpVal;

        // Swap datasets (lat/lng/address/placeId)
        const tmpLat = pInput.dataset.lat;
        const tmpLng = pInput.dataset.lng;
        const tmpAddr = pInput.dataset.address;
        const tmpPlaceId = pInput.dataset.placeId;
        const tmpVerif = pInput.classList.contains('input-verified');

        pInput.dataset.lat = dInput.dataset.lat || '';
        pInput.dataset.lng = dInput.dataset.lng || '';
        pInput.dataset.address = dInput.dataset.address || '';
        pInput.dataset.placeId = dInput.dataset.placeId || '';

        dInput.dataset.lat = tmpLat || '';
        dInput.dataset.lng = tmpLng || '';
        dInput.dataset.address = tmpAddr || '';
        dInput.dataset.placeId = tmpPlaceId || '';

        // Swap verified state
        if (dInput.classList.contains('input-verified')) {
            pInput.classList.add('input-verified');
        } else {
            pInput.classList.remove('input-verified');
        }
        if (tmpVerif) {
            dInput.classList.add('input-verified');
        } else {
            dInput.classList.remove('input-verified');
        }

        // Recalculate mileage
        calculateBookingMileage();
    }

    // =============================================
    // SEARCH / VALIDATION
    // =============================================
    function searchQuotes() {
        const pickupInput = document.getElementById('pickup');
        const dropoffInput = document.getElementById('dropoff');
        const dateInput = document.getElementById('pickup-date');
        const timeInput = document.getElementById('pickup-time');

        const pickup = (pickupInput.dataset.address || pickupInput.value).trim();
        const dropoff = (dropoffInput.dataset.address || dropoffInput.value).trim();

        if (!pickup) {
            pickupInput.focus();
            pickupInput.style.borderColor = '#ef4444';
            setTimeout(() => pickupInput.style.borderColor = '', 2000);
            return;
        }
        if (!dropoff) {
            dropoffInput.focus();
            dropoffInput.style.borderColor = '#ef4444';
            setTimeout(() => dropoffInput.style.borderColor = '', 2000);
            return;
        }
        if (!dateInput.value) {
            alert('Please select a pickup date.');
            dateInput.focus();
            return;
        }

        const activeTab = document.querySelector('.search-tab.active');
        const isReturn = activeTab && activeTab.textContent.toLowerCase().includes('return');
        const returnDateInput = document.getElementById('return-date');
        const returnTimeInput = document.getElementById('return-time');

        if (isReturn && !returnDateInput.value) {
            alert('Please select a return date.');
            returnDateInput.focus();
            return;
        }

        const params = new URLSearchParams({
            trip_type: isReturn ? 'return' : 'oneway',
            pickup: pickup,
            dropoff: dropoff,
            pickup_date: dateInput.value,
            pickup_time: timeInput.value,
            return_date: isReturn ? returnDateInput.value : '',
            return_time: isReturn ? returnTimeInput.value : '',
            passengers: document.getElementById('passengers').value,
            luggage: document.getElementById('luggage').value,
            vehicle_type: document.getElementById('vehicle-type').value,
        });

        if (window.calculatedTripDistance || pickupInput.dataset.distance) {
            params.append('distance', window.calculatedTripDistance || pickupInput.dataset.distance);
        }

        const btn = document.querySelector('.btn-search');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        btn.disabled = true;

        window.location.href = '/search?' + params.toString();
    }

    // =============================================
    // CUSTOM LOCATION AUTOCOMPLETE INIT
    // =============================================
    // =============================================
    // CUSTOM LOCATION AUTOCOMPLETE ATTACH FUNCTION
    // =============================================
    function attachCustomAutocompleteToInput(input) {
        if (!input || input.dataset.autocompleteBound) return;
        input.dataset.autocompleteBound = 'true';

        let dropdown = null;
        let debounceTimer = null;
        let activeIndex = -1;

        const wrapper = input.closest('.input-wrap') || input.closest('.location-input-wrap') || input.closest('.sr-input-box') || input.parentElement;
        if (wrapper && getComputedStyle(wrapper).position === 'static') {
            wrapper.style.position = 'relative';
        }

        function createDropdown() {
            if (dropdown) return dropdown;
            dropdown = document.createElement('div');
            dropdown.className = 'custom-autocomplete-dropdown';
            wrapper.appendChild(dropdown);
            return dropdown;
        }

        function closeDropdown() {
            if (dropdown) {
                dropdown.style.display = 'none';
                dropdown.innerHTML = '';
            }
            activeIndex = -1;
        }

        function renderItems(items) {
            const dd = createDropdown();
            dd.innerHTML = '';
            activeIndex = -1;

            if (!items || !items.length) {
                dd.innerHTML = '<div class="custom-autocomplete-empty">No locations found</div>';
                dd.style.display = 'block';
                return;
            }

            items.forEach((item, index) => {
                const label = item.label || item.value || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.waypoint_address) || '';
                const postcode = item.extra?.postalcode || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.waypoint_postcode) || '';
                const type = (item.legacy && item.legacy.waypoint && item.legacy.waypoint.waypoint_type) || '';
                const lat = item.extra?.coordinates?.[0] || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.waypoint_latitude) || '';
                const lng = item.extra?.coordinates?.[1] || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.waypoint_longitude) || '';

                let iconClass = 'fa-location-dot';
                if (type.toLowerCase().includes('airport') || label.toLowerCase().includes('airport')) {
                    iconClass = 'fa-plane';
                } else if (type.toLowerCase().includes('station') || label.toLowerCase().includes('station')) {
                    iconClass = 'fa-train';
                } else if (label.toLowerCase().includes('hotel') || label.toLowerCase().includes('building') || label.toLowerCase().includes('center') || label.toLowerCase().includes('centre')) {
                    iconClass = 'fa-hotel';
                }

                const itemEl = document.createElement('div');
                itemEl.className = 'custom-autocomplete-item';
                itemEl.innerHTML = `
                    <i class="fas ${iconClass}"></i>
                    <span class="loc-label">${escapeHtml(label)}</span>
                    ${postcode ? `<span class="loc-postcode">${escapeHtml(postcode)}</span>` : ''}
                `;

                itemEl.addEventListener('mouseenter', () => {
                    setActiveItem(index);
                });

                itemEl.addEventListener('click', (e) => {
                    e.stopPropagation();
                    selectItem(label, lat, lng);
                });

                dd.appendChild(itemEl);
            });

            dd.style.display = 'block';
        }

        function setActiveItem(index) {
            if (!dropdown) return;
            const items = dropdown.querySelectorAll('.custom-autocomplete-item');
            items.forEach((el, i) => {
                if (i === index) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
            activeIndex = index;
        }

        function selectItem(label, lat, lng) {
            input.value = label;
            input.dataset.address = label;
            if (lat) input.dataset.lat = lat;
            if (lng) input.dataset.lng = lng;
            input.classList.add('input-verified');
            closeDropdown();

            // Automatically calculate distance when location is selected
            calculateBookingMileage();
        }

        function escapeHtml(str) {
            return String(str).replace(/[&<>"']/g, function(m) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
            });
        }

        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            this.classList.remove('input-verified');

            if (query.length < 2) {
                closeDropdown();
                calculateBookingMileage();
                return;
            }

            const dd = createDropdown();
            dd.innerHTML = '<div class="custom-autocomplete-loading"><i class="fas fa-spinner fa-spin" style="margin-right:8px; color:#2563EB;"></i> Searching locations...</div>';
            dd.style.display = 'block';

            debounceTimer = setTimeout(() => {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch('/find-address', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': token || '',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({ text: query })
                })
                .then(res => res.json())
                .then(data => {
                    let results = [];
                    if (data && Array.isArray(data.data)) {
                        results = data.data;
                    } else if (Array.isArray(data)) {
                        results = data;
                    }
                    renderItems(results);
                })
                .catch(err => {
                    console.error('Location fetch error:', err);
                    closeDropdown();
                });
            }, 250);
        });

        input.addEventListener('keydown', function(e) {
            if (!dropdown || dropdown.style.display === 'none') return;
            const items = dropdown.querySelectorAll('.custom-autocomplete-item');
            if (!items.length) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                let next = activeIndex + 1;
                if (next >= items.length) next = 0;
                setActiveItem(next);
                items[next]?.scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                let prev = activeIndex - 1;
                if (prev < 0) prev = items.length - 1;
                setActiveItem(prev);
                items[prev]?.scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'Enter') {
                if (activeIndex >= 0 && items[activeIndex]) {
                    e.preventDefault();
                    items[activeIndex].click();
                }
            } else if (e.key === 'Escape') {
                closeDropdown();
            }
        });

        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                closeDropdown();
            }
        });
    }

    function initCustomLocationAutocomplete() {
        const inputs = [
            document.getElementById('pickup'), 
            document.getElementById('dropoff'),
            document.getElementById('srFrom'),
            document.getElementById('srTo')
        ].filter(Boolean);
        
        inputs.forEach(input => attachCustomAutocompleteToInput(input));
    }

    document.addEventListener('DOMContentLoaded', initCustomLocationAutocomplete);
</script>