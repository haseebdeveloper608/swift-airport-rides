{{-- resources/views/book.blade.php --}}
@extends('layout.app')

@section('title', 'Complete Your Booking - Swift-Ride-taxis')

@php
    $carId = request('car_id') ?: null;
    $car = request('car', 'Vehicle');
    $pickup = request('pickup', '');
    $dropoff = request('dropoff', '');
    $distance = request('distance', '0');
    $trip_type = request('trip_type', 'oneway');
    $base_price = request('price', '0');
    $passengers = request('passengers', 1);
    $luggage = request('luggage', 0);
    $pickup_date = request('pickup_date', '');
    $pickup_time = request('pickup_time', '');
    $return_date = request('return_date', '');
    $return_time = request('return_time', '');
    $outboundIsAirport = false;
    $returnIsAirport = false;
    $appliedCharges = [];

    $airportKeywords = ['airport', 'heathrow', 'gatwick', 'stansted', 'luton', 'london city', 'lhr', 'lgw', 'stn', 'ltn', 'lcy'];
    foreach ($airportKeywords as $kw) {
        if (!$outboundIsAirport && stripos($pickup, $kw) !== false) {
            $outboundIsAirport = true;
        }
        if (!$returnIsAirport && stripos($dropoff, $kw) !== false) {
            $returnIsAirport = true;
        }
    }

    $countryCodes = [
        ['code' => '+44', 'flag' => '🇬🇧', 'name' => 'United Kingdom (+44)'],
        ['code' => '+1',  'flag' => '🇺🇸', 'name' => 'USA / Canada (+1)'],
        ['code' => '+61', 'flag' => '🇦🇺', 'name' => 'Australia (+61)'],
        ['code' => '+971', 'flag' => '🇦🇪', 'name' => 'UAE (+971)'],
        ['code' => '+966', 'flag' => '🇸🇦', 'name' => 'Saudi Arabia (+966)'],
        ['code' => '+92', 'flag' => '🇵🇰', 'name' => 'Pakistan (+92)'],
        ['code' => '+91', 'flag' => '🇮🇳', 'name' => 'India (+91)'],
        ['code' => '+49', 'flag' => '🇩🇪', 'name' => 'Germany (+49)'],
        ['code' => '+33', 'flag' => '🇫🇷', 'name' => 'France (+33)'],
        ['code' => '+39', 'flag' => '🇮🇹', 'name' => 'Italy (+39)'],
        ['code' => '+34', 'flag' => '🇪🇸', 'name' => 'Spain (+34)'],
        ['code' => '+31', 'flag' => '🇳🇱', 'name' => 'Netherlands (+31)'],
        ['code' => '+353', 'flag' => '🇮🇪', 'name' => 'Ireland (+353)'],
        ['code' => '+41', 'flag' => '🇨🇭', 'name' => 'Switzerland (+41)'],
        ['code' => '+46', 'flag' => '🇸🇪', 'name' => 'Sweden (+46)'],
        ['code' => '+47', 'flag' => '🇳🇴', 'name' => 'Norway (+47)'],
        ['code' => '+45', 'flag' => '🇩🇰', 'name' => 'Denmark (+45)'],
        ['code' => '+358', 'flag' => '🇫🇮', 'name' => 'Finland (+358)'],
        ['code' => '+43', 'flag' => '🇦🇹', 'name' => 'Austria (+43)'],
        ['code' => '+32', 'flag' => '🇧🇪', 'name' => 'Belgium (+32)'],
        ['code' => '+351', 'flag' => '🇵🇹', 'name' => 'Portugal (+351)'],
        ['code' => '+30', 'flag' => '🇬🇷', 'name' => 'Greece (+30)'],
        ['code' => '+48', 'flag' => '🇵🇱', 'name' => 'Poland (+48)'],
        ['code' => '+90', 'flag' => '🇹🇷', 'name' => 'Turkey (+90)'],
        ['code' => '+974', 'flag' => '🇶🇦', 'name' => 'Qatar (+974)'],
        ['code' => '+965', 'flag' => '🇰🇼', 'name' => 'Kuwait (+965)'],
        ['code' => '+968', 'flag' => '🇴🇲', 'name' => 'Oman (+968)'],
        ['code' => '+973', 'flag' => '🇧🇭', 'name' => 'Bahrain (+973)'],
        ['code' => '+20', 'flag' => '🇪🇬', 'name' => 'Egypt (+20)'],
        ['code' => '+27', 'flag' => '🇿🇦', 'name' => 'South Africa (+27)'],
        ['code' => '+234', 'flag' => '🇳🇬', 'name' => 'Nigeria (+234)'],
        ['code' => '+254', 'flag' => '🇰🇪', 'name' => 'Kenya (+254)'],
        ['code' => '+65', 'flag' => '🇸🇬', 'name' => 'Singapore (+65)'],
        ['code' => '+60', 'flag' => '🇲🇾', 'name' => 'Malaysia (+60)'],
        ['code' => '+66', 'flag' => '🇹🇭', 'name' => 'Thailand (+66)'],
        ['code' => '+63', 'flag' => '🇵🇭', 'name' => 'Philippines (+63)'],
        ['code' => '+62', 'flag' => '🇮🇩', 'name' => 'Indonesia (+62)'],
        ['code' => '+84', 'flag' => '🇻🇳', 'name' => 'Vietnam (+84)'],
        ['code' => '+81', 'flag' => '🇯🇵', 'name' => 'Japan (+81)'],
        ['code' => '+82', 'flag' => '🇰🇷', 'name' => 'South Korea (+82)'],
        ['code' => '+86', 'flag' => '🇨🇳', 'name' => 'China (+86)'],
        ['code' => '+852', 'flag' => '🇭🇰', 'name' => 'Hong Kong (+852)'],
        ['code' => '+886', 'flag' => '🇹🇼', 'name' => 'Taiwan (+886)'],
        ['code' => '+64', 'flag' => '🇳🇿', 'name' => 'New Zealand (+64)'],
        ['code' => '+55', 'flag' => '🇧🇷', 'name' => 'Brazil (+55)'],
        ['code' => '+52', 'flag' => '🇲🇽', 'name' => 'Mexico (+52)'],
        ['code' => '+54', 'flag' => '🇦🇷', 'name' => 'Argentina (+54)'],
        ['code' => '+57', 'flag' => '🇨🇴', 'name' => 'Colombia (+57)'],
        ['code' => '+56', 'flag' => '🇨🇱', 'name' => 'Chile (+56)'],
        ['code' => '+7',  'flag' => '🇷🇺', 'name' => 'Russia (+7)'],
        ['code' => '+380', 'flag' => '🇺🇦', 'name' => 'Ukraine (+380)'],
        ['code' => '+420', 'flag' => '🇨🇿', 'name' => 'Czech Republic (+420)'],
        ['code' => '+36', 'flag' => '🇭🇺', 'name' => 'Hungary (+36)'],
        ['code' => '+40', 'flag' => '🇷🇴', 'name' => 'Romania (+40)'],
        ['code' => '+359', 'flag' => '🇧🇬', 'name' => 'Bulgaria (+359)'],
        ['code' => '+385', 'flag' => '🇭🇷', 'name' => 'Croatia (+385)'],
        ['code' => '+421', 'flag' => '🇸🇰', 'name' => 'Slovakia (+421)'],
        ['code' => '+386', 'flag' => '🇸🇮', 'name' => 'Slovenia (+386)'],
        ['code' => '+370', 'flag' => '🇱🇹', 'name' => 'Lithuania (+370)'],
        ['code' => '+371', 'flag' => '🇱🇻', 'name' => 'Latvia (+371)'],
        ['code' => '+372', 'flag' => '🇪🇪', 'name' => 'Estonia (+372)'],
        ['code' => '+354', 'flag' => '🇮🇸', 'name' => 'Iceland (+354)'],
        ['code' => '+352', 'flag' => '🇱🇺', 'name' => 'Luxembourg (+352)'],
        ['code' => '+356', 'flag' => '🇲🇹', 'name' => 'Malta (+356)'],
        ['code' => '+357', 'flag' => '🇨🇾', 'name' => 'Cyprus (+357)'],
        ['code' => '+962', 'flag' => '🇯🇴', 'name' => 'Jordan (+962)'],
        ['code' => '+961', 'flag' => '🇱🇧', 'name' => 'Lebanon (+961)'],
        ['code' => '+880', 'flag' => '🇧🇩', 'name' => 'Bangladesh (+880)'],
        ['code' => '+94', 'flag' => '🇱🇰', 'name' => 'Sri Lanka (+94)'],
        ['code' => '+977', 'flag' => '🇳🇵', 'name' => 'Nepal (+977)'],
        ['code' => '+233', 'flag' => '🇬🇭', 'name' => 'Ghana (+233)'],
        ['code' => '+212', 'flag' => '🇲🇦', 'name' => 'Morocco (+212)'],
        ['code' => '+216', 'flag' => '🇹🇳', 'name' => 'Tunisia (+216)'],
        ['code' => '+213', 'flag' => '🇩🇿', 'name' => 'Algeria (+213)'],
        ['code' => '+964', 'flag' => '🇮🇶', 'name' => 'Iraq (+964)'],
    ];
@endphp

@push('styles')
<style>
    /* Booking Page Specific Styles */
    .booking-hero {
        background: linear-gradient(135deg, #0A142E 0%, #101E45 50%, #0A142E 100%);
        padding: 100px 0 50px;
        color: #fff;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .booking-hero h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #fff, #94a3b8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .booking-hero p {
        color: #94a3b8;
        font-size: 1rem;
    }

    .booking-container {
        max-width: 1280px;
        margin: -30px auto 80px;
        padding: 0 24px;
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        position: relative;
        z-index: 10;
    }

    @media (max-width: 968px) {
        .booking-container {
            grid-template-columns: 1fr;
            margin-top: 0;
        }

        .booking-hero {
            padding: 80px 0 40px;
        }

        .booking-hero h1 {
            font-size: 1.8rem;
        }

        .summary-sticky {
            position: relative !important;
            top: 0 !important;
        }
    }

    @media (max-width: 640px) {
        .booking-container {
            padding: 0 16px;
        }
        .form-row {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }
        .form-row.form-row-2col,
        .form-row-2col {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 10px !important;
        }
        .form-group label {
            font-size: 11.5px !important;
            white-space: normal !important;
            overflow: visible !important;
            line-height: 1.25 !important;
        }
        .form-group input,
        .form-group select {
            padding: 10px 10px !important;
            font-size: 13.5px !important;
        }
    }

    /* Form Cards */
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
        overflow: hidden;
        border: 1px solid #eef2f8;
    }

    .form-card-header {
        padding: 20px 28px;
        background: #fafcff;
        border-bottom: 1px solid #eef2f8;
    }

    .form-card-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0A142E;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header h3 i {
        color: #4A6CFE;
        font-size: 1.2rem;
    }

    .form-card-body {
        padding: 28px;
    }

    /* Form Elements */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 2px;
    }

    .form-group {
        margin-bottom: 15px;
        margin-top: 15px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .form-group label i {
        margin-right: 6px;
        color: #4A6CFE;
        font-size: 12px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 16px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #0A142E;
        transition: all 0.2s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #2E6BE6;
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
    }

    .form-group input[readonly] {
        background: #f8fafc;
        border-color: #e2e8f0;
        color: #475569;
        cursor: default;
    }

    /* Phone Input Group Styles */
    .phone-input-group {
        display: flex;
        gap: 8px;
        align-items: center;
        width: 100%;
    }

    .phone-code-select {
        width: 95px !important;
        min-width: 95px !important;
        max-width: 95px !important;
        flex-shrink: 0 !important;
        padding: 12px 6px !important;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px !important;
        cursor: pointer;
        font-size: 13.5px !important;
        color: #0A142E;
        background-position: right 6px center !important;
    }

    .phone-input-group input {
        flex: 1 !important;
        width: calc(100% - 103px) !important;
        min-width: 0 !important;
    }

    @media (max-width: 640px) {
        .phone-code-select {
            width: 88px !important;
            min-width: 60px !important;
            max-width: 22px !important;
            padding: 10px 4px 10px 6px !important;
            font-size: 12.5px !important;
            border-radius: 10px !important;
            background-position: right 4px center !important;
        }

        .phone-input-group input {
            padding: 10px 10px !important;
            font-size: 13.5px !important;
            border-radius: 10px !important;
        }
    }

    @media (max-width: 560px) {
        .form-card-header,
        .form-card-body {
            padding: 18px 14px;
        }
    }

    /* Airport Section */
    .airport-section {
        background: #F0F4FF;
        border-radius: 16px;
        padding: 20px;
        margin-top: 24px;
        border: 1px solid #D0DCFF;
    }

    .airport-section h4 {
        font-size: 15px;
        font-weight: 700;
        color: #4A6CFE;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .flight-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }

    /* Checkbox */
    .checkbox-wrap {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-top: 16px;
        padding: 12px;
        background: #ffffff;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .checkbox-wrap:hover {
        background: #f8fafc;
    }

    .checkbox-wrap input {
        width: 18px;
        height: 18px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #4A6CFE;
    }

    .checkbox-wrap label {
        margin: 0;
        cursor: pointer;
        text-transform: none;
        letter-spacing: normal;
        font-weight: 500;
    }

    .checkbox-wrap small {
        display: block;
        font-size: 11px;
        color: #64748b;
        font-weight: 400;
        margin-top: 4px;
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #4A6CFE 0%, #2563EB 100%);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(74, 108, 254, 0.35);
    }

    /* Summary Sidebar */
    .summary-sticky {
        position: sticky;
        top: 90px;
    }

    .summary-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f8;
        overflow: hidden;
    }

    .summary-header {
        padding: 20px 24px;
        background: #0A142E;
        color: white;
    }

    .summary-header .badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 12px;
        letter-spacing: 0.5px;
    }

    .summary-header h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }

    .summary-body {
        padding: 24px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #eef2f8;
        font-size: 14px;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-item.total {
        margin-top: 12px;
        padding-top: 16px;
        border-top: 2px solid #e2e8f0;
        font-size: 18px;
        font-weight: 800;
        color: #2E6BE6;
    }

    .summary-item.total span:first-child {
        color: #0A142E;
    }

    .concession-item {
        background: #FFF6CC;
        margin: 8px 0;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 12px;
        color: #7A6200;
    }

    .concession-warning {
        background: #dcfce7;
        border: 1px solid #86efac;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 600;
        color: #166534;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .meet-greet-summary {
        display: none;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 13px;
        color: #475569;
    }

    .meet-greet-summary.show {
        display: flex;
    }
</style>
@endpush

@section('content')
<div class="booking-hero">
    <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 24px;">
        <h1>Complete Your Booking</h1>
        <p>Secure your ride with Swift-Ride-taxis — fixed prices, no hidden fees</p>
    </div>
</div>

<div class="booking-container">
    <!-- LEFT COLUMN: FORM SECTION -->
    <div class="form-section">
        <form id="bookingForm" action="{{ route('checkout.create') }}" method="POST">
            @csrf
            
            <!-- Hidden Fields -->
            @if(isset($carId))
                <input type="hidden" name="car_id" value="{{ $carId }}">
            @endif
            <input type="hidden" name="car" value="{{ $car ?? 'Vehicle' }}">
            <input type="hidden" name="pickup" value="{{ $pickup ?? '' }}">
            <input type="hidden" name="dropoff" value="{{ $dropoff ?? '' }}">
            <input type="hidden" name="distance" value="{{ $distance ?? '0' }}">
            <input type="hidden" name="trip_type" value="{{ $trip_type ?? 'oneway' }}">
            <input type="hidden" name="base_price" value="{{ $base_price ?? '0' }}">
            <input type="hidden" id="meet_greet_outbound_fee" name="meet_greet_outbound_fee" value="0">
            <input type="hidden" id="meet_greet_return_fee" name="meet_greet_return_fee" value="0">
            <input type="hidden" id="total_price_input" name="total_price" value="{{ $base_price ?? '0' }}">

            <!-- Passenger Details Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <h3><i class="fas fa-user-circle"></i> Passenger Details</h3>
                </div>
                <div class="form-card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="head_passenger_name"><i class="fas fa-user"></i> Head Passenger Name :</label>
                            <input type="text" id="head_passenger_name" name="head_passenger_name" required placeholder="Lead Passenger/Co. Name" value="{{ old('head_passenger_name', old('first_name') ? trim(old('first_name').' '.old('last_name')) : '') }}">
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Passenger Email :</label>
                            <input type="email" id="email" name="email" required placeholder="Passenger Email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone"></i> Passenger Mobile :</label>
                            <div class="phone-input-group">
                                <select name="phone_code" class="phone-code-select">
                                    @foreach($countryCodes as $c)
                                        <option value="{{ $c['code'] }}" {{ old('phone_code', '+44') == $c['code'] ? 'selected' : '' }}>
                                            {{ $c['flag'] }} {{ $c['code'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="tel" id="phone" name="phone" required placeholder="Phone number" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-row form-row-2col" style="gap: 10px;">
                            <div class="form-group">
                                <label for="passengers"><i class="fas fa-users"></i> Passengers :</label>
                                <select id="passengers" name="passengers">
                                    @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ (int)old('passengers', $passengers) === $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i === 1 ? 'Person' : 'Persons' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="luggage"><i class="fas fa-suitcase"></i> Luggage :</label>
                                <select id="luggage" name="luggage">
                                    <option value="">No Luggage</option>
                                    <option value="Hand Luggage" {{ old('luggage') === 'Hand Luggage' ? 'selected' : '' }}>Hand Luggage</option>
                                    <option value="Suitcases" {{ old('luggage') === 'Suitcases' || old('luggage') === 'Suitecase' ? 'selected' : '' }}>Suitcases</option>
                                    <option value="Hand Luggage + Suitcases" {{ old('luggage') === 'Hand Luggage + Suitcases' ? 'selected' : '' }}>Hand Luggage + Suitcases</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Outbound Journey Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <h3><i class="fas fa-plane-departure"></i> {{ ($trip_type ?? 'oneway') === 'return' ? 'Outbound Journey' : 'Journey Details' }}</h3>
                </div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Pickup Location</label>
                        <input type="text" value="{{ $pickup ?? '' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-map-pin"></i> Drop-off Location</label>
                        <input type="text" value="{{ $dropoff ?? '' }}" readonly>
                    </div>
                    <div class="form-row form-row-2col">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt"></i> Pickup Date</label>
                            <div class="input-with-icon-wrap">
                                <input type="text" name="pickup_date" class="custom-datepicker" required min="{{ date('Y-m-d') }}" value="{{ old('pickup_date', $pickup_date) }}" placeholder="Select pickup date">
                                <i class="fas fa-calendar-day input-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-clock"></i> Pickup Time</label>
                            <div class="input-with-icon-wrap">
                                <input type="time" name="pickup_time"  required value="{{ old('pickup_time', $pickup_time ?: '10:00') }}" placeholder="Select pickup time">
                                <i class="fas fa-clock input-icon"></i>
                            </div>
                        </div>
                    </div>

                    @if(isset($outboundIsAirport) && $outboundIsAirport)
                    <div class="airport-section">
                        <h4><i class="fas fa-fighter-jet"></i> Flight Details (Outbound)</h4>
                        <div class="flight-row">
                            <div class="form-group">
                                <label>Flight Number</label>
                                <input type="text" name="outbound_flight_number" placeholder="e.g. BA123" value="{{ old('outbound_flight_number') }}">
                            </div>
                            <div class="form-group">
                                <label>Arriving From</label>
                                <input type="text" name="outbound_flight_from" placeholder="e.g. New York" value="{{ old('outbound_flight_from') }}">
                            </div>
                        </div>
                        <div class="checkbox-wrap" onclick="toggleCheckbox(this, 'meet_greet_outbound')">
                            <input type="checkbox" id="meet_greet_outbound" name="meet_greet_outbound" value="1" onchange="calculateTotal()">
                            <label for="meet_greet_outbound">
                                <strong>Add Meet & Greet Service (+£15.00)</strong>
                                <small>Our driver will wait in arrivals with a name board and assist with luggage</small>
                            </label>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label><i class="fas fa-comment"></i> Additional Notes (Optional)</label>
                        <input type="text" name="notes" placeholder="Child seat needed, extra luggage, special requests..." value="{{ old('notes') }}">
                    </div>
                </div>
            </div>

            <!-- Return Journey Card (if return trip) -->
            @if(isset($trip_type) && $trip_type === 'return')
            <div class="form-card">
                <div class="form-card-header">
                    <h3><i class="fas fa-plane-arrival"></i> Return Journey</h3>
                </div>
                <div class="form-card-body">
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Return Pickup</label>
                        <input type="text" value="{{ $dropoff ?? '' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-map-pin"></i> Return Drop-off</label>
                        <input type="text" value="{{ $pickup ?? '' }}" readonly>
                    </div>
                    <div class="form-row form-row-2col">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt"></i> Return Date</label>
                            <div class="input-with-icon-wrap">
                                <input type="text" name="return_date" class="custom-datepicker" min="{{ date('Y-m-d') }}" value="{{ old('return_date', $return_date) }}" placeholder="Select return date">
                                <i class="fas fa-calendar-day input-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-clock"></i> Return Time</label>
                            <div class="input-with-icon-wrap">
                                <input type="time" name="return_time"  value="{{ old('return_time', $return_time ?: '18:00') }}" placeholder="Select return time">
                                <i class="fas fa-clock input-icon"></i>
                            </div>
                        </div>
                    </div>

                    @if(isset($returnIsAirport) && $returnIsAirport)
                    <div class="airport-section">
                        <h4><i class="fas fa-fighter-jet"></i> Flight Details (Return)</h4>
                        <div class="flight-row">
                            <div class="form-group">
                                <label>Flight Number</label>
                                <input type="text" name="return_flight_number" placeholder="e.g. BA456" value="{{ old('return_flight_number') }}">
                            </div>
                            <div class="form-group">
                                <label>Arriving From</label>
                                <input type="text" name="return_flight_from" placeholder="e.g. London" value="{{ old('return_flight_from') }}">
                            </div>
                        </div>
                        <div class="checkbox-wrap" onclick="toggleCheckbox(this, 'meet_greet_return')">
                            <input type="checkbox" id="meet_greet_return" name="meet_greet_return" value="1" onchange="calculateTotal()">
                            <label for="meet_greet_return">
                                <strong>Add Meet & Greet Service (+£15.00)</strong>
                                <small>Our driver will wait in arrivals with a name board and assist with luggage</small>
                            </label>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label><i class="fas fa-comment"></i> Return Notes (Optional)</label>
                        <input type="text" name="return_notes" placeholder="Special requests for return journey..." value="{{ old('return_notes') }}">
                    </div>
                </div>
            </div>
            @endif

            <button type="submit" class="btn-submit">
                <i class="fas fa-lock"></i> Proceed to Secure Payment
            </button>
        </form>
    </div>

    <!-- RIGHT COLUMN: SUMMARY -->
    <div class="summary-sticky">
        <div class="summary-card">
            <div class="summary-header">
                <div class="badge">
                    <i class="fas fa-{{ isset($trip_type) && $trip_type === 'return' ? 'exchange-alt' : 'car' }}"></i>
                    {{ isset($trip_type) && $trip_type === 'return' ? 'RETURN TRIP' : 'ONE WAY TRIP' }}
                </div>
                <h4>Booking Summary</h4>
            </div>
            <div class="summary-body">
                <div class="summary-item">
                    <span>Vehicle</span>
                    <strong>{{ $car ?? 'Standard Taxi' }}</strong>
                </div>
                <div class="summary-item">
                    <span>Distance</span>
                    <strong>{{ $distance ?? '0' }} miles</strong>
                </div>

                @if(isset($appliedCharges) && count($appliedCharges) > 0)
                <div class="concession-warning">
                    <i class="fas fa-info-circle"></i>
                    <span>Concession charges applied: £{{ number_format(array_sum(array_column($appliedCharges, 'amount')), 2) }}</span>
                </div>
                @endif

                <div class="summary-item">
                    <span>Base Fare</span>
                    <strong>£<span id="display_base_price">{{ number_format($base_price ?? 0, 2) }}</span></strong>
                </div>

                @if(isset($appliedCharges) && count($appliedCharges) > 0)
                    @foreach($appliedCharges as $charge)
                        <div class="concession-item">
                            <span>{{ $charge['place'] }} ({{ $charge['applies'] }})</span>
                            <strong>+£{{ number_format($charge['amount'], 2) }}</strong>
                        </div>
                    @endforeach
                @endif

                <div id="meet_greet_summary_outbound" class="meet-greet-summary">
                    <span><i class="fas fa-hand-sparkles"></i> Meet & Greet (Outbound)</span>
                    <strong>+£15.00</strong>
                </div>
                <div id="meet_greet_summary_return" class="meet-greet-summary">
                    <span><i class="fas fa-hand-sparkles"></i> Meet & Greet (Return)</span>
                    <strong>+£15.00</strong>
                </div>

                <div class="summary-item total">
                    <span>Total Amount</span>
                    <span>£<span id="display_total_price">{{ number_format($base_price ?? 0, 2) }}</span></span>
                </div>

                <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #eef2f8; font-size: 11px; color: #94a3b8; text-align: center;">
                    <i class="fas fa-shield-alt"></i> Fixed fare • No surge pricing • 24/7 support
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Helper function for checkbox clicks
    function toggleCheckbox(container, checkboxId) {
        const cb = document.getElementById(checkboxId);
        if (cb) {
            cb.checked = !cb.checked;
            calculateTotal();
        }
    }

    // Calculate total with meet & greet fees
    function calculateTotal() {
        let basePrice = parseFloat({{ $base_price ?? 0 }});
        let total = basePrice;
        
        const cbOutbound = document.getElementById('meet_greet_outbound');
        const cbReturn = document.getElementById('meet_greet_return');
        const summaryOutbound = document.getElementById('meet_greet_summary_outbound');
        const summaryReturn = document.getElementById('meet_greet_summary_return');
        const hiddenOutbound = document.getElementById('meet_greet_outbound_fee');
        const hiddenReturn = document.getElementById('meet_greet_return_fee');
        const displayTotal = document.getElementById('display_total_price');
        const inputTotalPrice = document.getElementById('total_price_input');

        if (cbOutbound && cbOutbound.checked) {
            total += 15;
            if (summaryOutbound) summaryOutbound.classList.add('show');
            if (hiddenOutbound) hiddenOutbound.value = '15';
        } else {
            if (summaryOutbound) summaryOutbound.classList.remove('show');
            if (hiddenOutbound) hiddenOutbound.value = '0';
        }

        if (cbReturn && cbReturn.checked) {
            total += 15;
            if (summaryReturn) summaryReturn.classList.add('show');
            if (hiddenReturn) hiddenReturn.value = '15';
        } else {
            if (summaryReturn) summaryReturn.classList.remove('show');
            if (hiddenReturn) hiddenReturn.value = '0';
        }

        if (displayTotal) displayTotal.innerText = total.toFixed(2);
        if (inputTotalPrice) inputTotalPrice.value = total.toFixed(2);
    }

    // Save form data to sessionStorage for persistence
    function saveFormData() {
        const form = document.getElementById('bookingForm');
        if (!form) return;
        
        const formData = new FormData(form);
        const data = {};
        
        for (let [key, value] of formData.entries()) {
            const field = form.querySelector(`[name="${key}"]`);
            if (field && field.type === 'checkbox') {
                data[key] = field.checked;
            } else {
                data[key] = value;
            }
        }
        
        sessionStorage.setItem('ots_booking_data', JSON.stringify(data));
    }

    // Restore saved form data
    function restoreFormData() {
        const savedData = sessionStorage.getItem('ots_booking_data');
        if (!savedData) return;
        
        try {
            const data = JSON.parse(savedData);
            const form = document.getElementById('bookingForm');
            
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field) {
                    if (field.type === 'checkbox') {
                        field.checked = data[key];
                    } else {
                        if (field._flatpickr) {
                            field._flatpickr.setDate(data[key], true);
                        } else {
                            field.value = data[key];
                        }
                    }
                }
            });
            
            calculateTotal();
        } catch(e) {
            console.error('Error restoring form data:', e);
        }
    }

    // Clear saved data after successful submission
    function clearSavedData() {
        sessionStorage.removeItem('ots_booking_data');
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        restoreFormData();
        calculateTotal();
        
        const form = document.getElementById('bookingForm');
        if (form) {
            // Save on any input change
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('change', saveFormData);
                input.addEventListener('blur', saveFormData);
            });
            
            // Clear saved data on successful submission
            form.addEventListener('submit', function() {
                setTimeout(clearSavedData, 500);
            });
        }
    });
</script>
@endsection
