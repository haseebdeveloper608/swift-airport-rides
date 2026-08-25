@extends('layout.app')

@section('content')

@php
    $settings = $homepage ?? $websiteSettings ?? \App\Models\WebsiteSetting::first();
    $resolveImage = fn ($path, $fallback) => $path
        ? (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') ? $path : asset('storage/' . ltrim($path, '/')))
        : $fallback;
    $heroBadgeText = $settings->hero_badge_text ?? 'PREMIUM AIRPORT TRANSFERS ACROSS THE UK';
    $heroTitleLine1 = $settings->hero_title_line1 ?? 'Your Journey.';
    $heroTitleLine2 = $settings->hero_title_line2 ?? 'Our Priority.';
    $heroTitleGradient = $settings->hero_title_gradient_text ?? 'Priority';
    $heroTitlePrefix = trim(str_replace($heroTitleGradient, '', $heroTitleLine2));
    $heroDescription = $settings->hero_description ?? 'Professional airport transfers, private taxi services and city-to-city rides with fixed fares, expert drivers and 24/7 support.';
    $heroBenefits = is_array($settings->hero_benefits ?? null) ? $settings->hero_benefits : [
        ['title' => 'Fixed Fares', 'subtitle' => 'No hidden charges'],
        ['title' => 'Flight Monitoring', 'subtitle' => 'We track your flight'],
        ['title' => 'Meet & Greet', 'subtitle' => 'At the arrivals hall'],
        ['title' => '24/7 Support', 'subtitle' => 'We\'re always here'],
    ];
    $heroDiscountText = $settings->hero_form_discount_text ?? '5% Discount on Return Booking';
    $heroSubmitText = $settings->hero_form_submit_text ?? 'GET AN INSTANT QUOTE';
    $heroNoteText = $settings->hero_form_note_text ?? '5% Discount on Return Booking | Fixed prices. No hidden charges.';
    $heroBackgroundImage = $resolveImage($settings->hero_background_image ?? null, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=2000&q=80');

    $stats = is_array($settings->stats ?? null) ? $settings->stats : [
        ['value' => '98%', 'label' => 'Customer Satisfaction'],
        ['value' => '5000+', 'label' => 'Trips Completed'],
        ['value' => '24/7', 'label' => 'Service Available'],
        ['value' => 'Safe & Reliable', 'label' => 'Licensed Drivers'],
    ];

    $servicesLabel = $settings->services_label ?? 'OUR SERVICES';
    $servicesHeadingLine1 = $settings->services_heading_line1 ?? 'Ride Your Way,';
    $servicesHeadingLine2 = $settings->services_heading_line2 ?? 'Anytime, Anywhere';
    $servicesHeadingGradient = $settings->services_heading_gradient ?? 'Anywhere';
    $servicesDescription = $settings->services_description ?? 'From airport pickups to business travel, we\'ve got the perfect ride for every journey.';
    $servicesButtonText = $settings->services_button_text ?? 'VIEW ALL SERVICES';
    $servicesList = is_array($settings->services_list ?? null) ? $settings->services_list : [
        ['title' => 'Airport Transfers', 'description' => 'Reliable transfers to and from all major UK airports.'],
        ['title' => 'City Transfers', 'description' => 'Comfortable city-to-city private transfers.'],
        ['title' => 'Business Travel', 'description' => 'Executive travel solutions for professionals.'],
        ['title' => 'Hourly Hire', 'description' => 'Flexible hourly hire with professional drivers.'],
    ];

    $aboutBadge = $settings->about_badge ?? 'ABOUT US';
    $aboutHeadingLine1 = $settings->about_heading_line1 ?? 'Your Trusted Taxi';
    $aboutHeadingLine2 = $settings->about_heading_line2 ?? 'Partner Across the UK';
    $aboutDescription = $settings->about_description ?? 'Swift Ride Taxis is a UK-based taxi service company dedicated to providing reliable, punctual and comfortable transport solutions. Whether you\'re travelling for business, leisure or a special occasion, we are here to make your journey smooth and hassle-free.';
    $aboutExperienceYears = $settings->about_experience_years ?? '15+';
    $aboutExperienceText = $settings->about_experience_text ?? 'Years of Experience';
    $aboutImage = $resolveImage($settings->about_image ?? null, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=800&auto=format&fit=crop');
    $aboutCheckmarks = is_array($settings->about_checkmarks ?? null) ? $settings->about_checkmarks : [
        'Licensed & Insured Services',
        'Professional & Courteous Drivers',
        'Real-time Flight Monitoring',
        'No Hidden Charges – Fixed Prices',
    ];
    $aboutButtonText = $settings->about_button_text ?? 'Learn More About Us';
    $aboutButtonLink = $settings->about_button_link ?? route('about');

    $airportsLabel = $settings->airports_label ?? 'MAJOR AIRPORT TRANSFERS';
    $airportsHeadingLine1 = $settings->airports_heading_line1 ?? 'All Major Airports';
    $airportsHeadingLine2 = $settings->airports_heading_line2 ?? 'Across the UK';
    $airportsButtonText = $settings->airports_view_all_text ?? 'View all airports';
    $airports = is_array($settings->airports_list ?? null) ? $settings->airports_list : [
        ['name' => 'Heathrow Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=600&q=80'],
        ['name' => 'Gatwick Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=600&q=80'],
        ['name' => 'Stansted Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1583517786578-e1c8ffe6b3a3?auto=format&fit=crop&w=600&q=80'],
        ['name' => 'Luton Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1517400508447-f8dd518b86db?auto=format&fit=crop&w=600&q=80'],
        ['name' => 'London City Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1526481280693-3bfa7568e0f3?auto=format&fit=crop&w=600&q=80'],
        ['name' => 'Manchester Airport', 'city' => 'Manchester', 'image' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?auto=format&fit=crop&w=600&q=80'],
    ];

    $coverageLabel = $settings->coverage_label ?? 'WIDE COVERAGE';
    $coverageHeadingLine1 = $settings->coverage_heading_line1 ?? 'We Cover All Major Cities';
    $coverageHeadingLine2 = $settings->coverage_heading_line2 ?? '& Airports Across the UK';
    $coverageDescription = $settings->coverage_description ?? 'Wherever you are, we\'ll get you there. Safe, on-time and comfortable.';
    $coverageButtonText = $settings->coverage_button_text ?? 'EXPLORE LOCATIONS';
    $coverageFloatTitle = $settings->coverage_float_card_title ?? 'City to City Transfers';
    $coverageFloatRoute = $settings->coverage_float_card_route ?? 'London ↔ Manchester';
    $coverageFloatPrice = $settings->coverage_float_card_price ?? '£120';
    $coverageFloatPriceText = $settings->coverage_float_card_price_text ?? 'From';

    $fleetLabel = $settings->fleet_label ?? 'OUR FLEET';
    $fleetHeading = $settings->fleet_heading ?? 'Travel in Comfort & Style';
    $fleetSubheading = $settings->fleet_subheading ?? 'A range of modern vehicles to suit your needs.';
    $fleetButtonText = $settings->fleet_view_all_text ?? 'View all vehicles';
    $defaultVehicles = [
        ['name' => 'Saloon', 'pax' => '1-4', 'luggage' => '2', 'image' => asset('images/fleet_saloon.jpg')],
        ['name' => 'Estate', 'pax' => '1-4', 'luggage' => '4', 'image' => asset('images/fleet_estate.jpg')],
        ['name' => 'Executive', 'pax' => '1-3', 'luggage' => '2', 'image' => asset('images/fleet_executive.jpg')],
        ['name' => 'MPV', 'pax' => '1-6', 'luggage' => '4', 'image' => asset('images/fleet_mpv.jpg')],
        ['name' => 'Minibus', 'pax' => '1-8', 'luggage' => '8', 'image' => asset('images/fleet_minibus.jpg')],
    ];
    $fleetVehicles = is_array($settings->fleet_vehicles ?? null) && count($settings->fleet_vehicles ?? []) > 0
        ? $settings->fleet_vehicles
        : $defaultVehicles;

    $hasEstate = false;
    foreach ($fleetVehicles as &$v) {
        if (strtolower($v['name'] ?? '') === 'saloon') { $v['pax'] = '1-4'; $v['luggage'] = '2'; }
        if (strtolower($v['name'] ?? '') === 'estate') { $v['pax'] = '1-4'; $v['luggage'] = '4'; $hasEstate = true; }
        if (strtolower($v['name'] ?? '') === 'executive') { $v['pax'] = '1-3'; $v['luggage'] = '2'; }
        if (strtolower($v['name'] ?? '') === 'mpv') { $v['pax'] = '1-6'; $v['luggage'] = '4'; }
        if (strtolower($v['name'] ?? '') === 'minibus') { $v['pax'] = '1-8'; $v['luggage'] = '8'; }
    }
    unset($v);
    if (!$hasEstate) {
        array_splice($fleetVehicles, 1, 0, [[
            'name' => 'Estate',
            'pax' => '1-4',
            'luggage' => '4',
            'image' => asset('images/fleet_estate.jpg')
        ]]);
    }


    $reviewsLabel = $settings->reviews_label ?? 'REVIEWS';
    $reviewsHeading = $settings->reviews_heading ?? 'What passengers are saying';
    $reviewsDescription = $settings->reviews_description ?? 'Verified reviews are collected after every completed journey to ensure genuine feedback and help maintain the highest standards of service.';
    $reviews = is_array($settings->reviews_list ?? null) ? $settings->reviews_list : [
        ['name' => 'Daniel H.', 'initials' => 'DH', 'rating' => 5, 'text' => 'Booked a 4 am pick-up for Heathrow the evening before and honestly expected a phone call at midnight saying something had gone wrong. Instead, the driver was parked outside ten minutes early. Clean car, sensible price, and I was through security before the queues built up.'],
        ['name' => 'Sophie M.', 'initials' => 'SM', 'rating' => 5, 'text' => 'Our flight into Gatwick landed almost an hour late after a delay in Malaga. Nobody rang us, and nobody charged us extra. The driver was simply there in arrivals with the board when we finally came through.'],
        ['name' => 'Leon B.', 'initials' => 'LB', 'rating' => 4.5, 'text' => 'I compared four operators for the same Manchester run and the price gap between the cheapest and the dearest was genuinely surprising. Booking took under two minutes on my phone.'],
    ];

    $faqLabel = $settings->faq_label ?? 'COMMON QUESTIONS';
    $faqHeading = $settings->faq_heading ?? 'Frequently Asked Questions';
    $faqDescription = $settings->faq_description ?? 'Everything you need to know before booking with Swift Ride Taxis.';
    $faqs = is_array($settings->faq_list ?? null) ? $settings->faq_list : [
        ['question' => 'How does Swift Ride Taxis work?', 'answer' => 'Simply enter your pickup and drop-off locations, select your date and time, and choose from our range of vehicles. We\'ll match you with a professional driver who will arrive on time, every time.'],
        ['question' => 'Do I need an account to book a taxi online?', 'answer' => 'No, you don\'t need an account. You can book as a guest, although creating an account makes future bookings faster and lets you track your journey history.'],
        ['question' => 'When should I reserve my airport taxi?', 'answer' => 'We recommend booking at least 48 hours in advance for better rates. However, we can often accommodate same-day bookings depending on availability.'],
        ['question' => 'Do I have the option of changing or cancelling my booking?', 'answer' => 'Yes, you can modify or cancel your booking up to 24 hours before your scheduled pickup time with no penalty.'],
        ['question' => 'Does the quoted price include all tax and duties?', 'answer' => 'Yes, our quoted prices are all-inclusive. There are no hidden charges or surprise fees at the end.'],
        ['question' => 'Does the airport parking and dropping off fee apply?', 'answer' => 'Airport drop-off fees are already included in your quoted price. No additional charges will apply.'],
        ['question' => 'If there is any traffic, will I have to pay more?', 'answer' => 'No, you won\'t pay extra for traffic delays. Our fixed-price model means you always know exactly what you\'ll pay.'],
        ['question' => 'What forms of payment do you take?', 'answer' => 'We accept all major credit and debit cards, as well as digital payment methods. Payment is secure and encrypted.'],
        ['question' => 'Do you have a fee for early morning / late night trips?', 'answer' => 'Early morning and late night trips are available at standard rates. Premium rates may apply during peak holiday periods.'],
        ['question' => 'What will be done if my air flight is delayed?', 'answer' => 'We monitor flight status in real-time and adjust pickup times accordingly. You won\'t be charged extra for delays.'],
        ['question' => 'At what airport location will my driver be waiting for me?', 'answer' => 'Your driver will meet you at the designated arrivals zone or entrance you specify during booking. We\'ll send you a meeting point confirmation.'],
        ['question' => 'Which British airports do you service?', 'answer' => 'We service all major UK airports including Heathrow, Gatwick, Stansted, Luton, London City, Manchester, Birmingham, and many more.'],
    ];
@endphp

<style>
    /* ==========================================================================
       CITYAIRPORTRIDES - EXACT REFERENCE DESIGN STYLES & FULL RESPONSIVENESS
       ========================================================================== */

    :root {
        --sr-navy-deep: #030812;
        --sr-navy-dark: #071120;
        --sr-navy-card: #0B1930;
        --sr-purple: #5843F6;
        --sr-blue: #5843F6;
        --sr-white: #FFFFFF;
        --sr-bg-light: #F8F9FE;
        --sr-muted: #64748B;
        --sr-gradient: linear-gradient(135deg, #5843F6 0%, #4332D9 100%);
        --sr-gradient-gold: linear-gradient(135deg, #FFB800 0%, #FF8A00 100%);
        --sr-font-display: 'Plus Jakarta Sans', sans-serif;
        --sr-font-body: 'Manrope', sans-serif;
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
    .booking-mileage-badge i { color: #2563eb; font-size: 16px; }
    .booking-mileage-badge strong { color: #1e3a8a; font-weight: 800; font-size: 15px; }

    /* Common Utilities */
    .sr-section {
        padding: 20px 0;
    }
    .sr-label {
        font-family: var(--sr-font-body);
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1.6px;
        text-transform: uppercase;
        color: var(--sr-purple);
        margin-bottom: 12px;
        display: inline-block;
    }
    .sr-label.on-dark {
        color: #A9B6FF;
    }
    .sr-heading-lg {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.5px;
        color: var(--sr-navy-dark);
    }
    .sr-heading-lg.on-dark {
        color: #FFFFFF;
    }

    .sr-btn-gradient {
        background: var(--sr-gradient);
        color: #fff !important;
        border: none;
        border-radius: 12px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: transform .25s ease, box-shadow .25s ease;
        box-shadow: 0 10px 30px rgba(91, 61, 245, 0.35);
    }
    .sr-btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 36px rgba(91, 61, 245, 0.45);
    }

    .sr-btn-outline {
        border: 1.5px solid #D6D9E4;
        color: var(--sr-navy-dark) !important;
        border-radius: 12px;
        padding: 13px 26px;
        font-weight: 700;
        font-size: 13.5px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all .25s ease;
        background: transparent;
    }
    .sr-btn-outline:hover {
        border-color: var(--sr-purple);
        color: var(--sr-purple) !important;
        background: rgba(91,61,245,0.04);
    }

    .sr-link-arrow {
        color: var(--sr-purple) !important;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap .2s ease, color .2s ease;
    }
    .sr-link-arrow:hover {
        color: var(--sr-blue) !important;
        gap: 10px;
    }

    .sr-nav-arrow {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid #E2E8F0;
        background: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--sr-navy-dark);
        font-size: 14px;
        transition: all .2s ease;
        cursor: pointer;
    }
    .sr-nav-arrow:hover {
        border-color: var(--sr-purple);
        color: var(--sr-purple);
        background: #F8F9FE;
    }

    /* ==========================================================================
       HEADER & NAVIGATION
       ========================================================================== */
    .sr-header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        padding: 20px 0;
        transition: all .3s ease;
    }
    .sr-header.sr-scrolled {
        position: fixed;
        background: rgba(4, 11, 22, 0.95);
        backdrop-filter: blur(16px);
        padding: 12px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: srSlideDown .3s ease;
    }
    @keyframes srSlideDown {
        from { transform: translateY(-100%); }
        to { transform: translateY(0); }
    }

    .sr-brand {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    .sr-logo-img {
        height: 52px;
        max-height: 52px;
        width: auto;
        object-fit: contain;
        display: block;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .sr-brand:hover .sr-logo-img {
        transform: scale(1.04);
        opacity: 0.95;
    }

    .sr-nav-links {
        display: flex;
        align-items: center;
        gap: 24px;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .sr-nav-links a {
        color: rgba(255,255,255,0.85);
        font-size: 13.5px;
        font-weight: 600;
        transition: color .2s ease;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .sr-nav-links a:hover {
        color: #FFFFFF;
    }
    .sr-nav-links a i.chevron {
        font-size: 11px;
        opacity: 0.7;
    }

    .sr-header-right {
        display: flex;
        align-items: center;
        gap: 24px;
    }
    .sr-phone-box {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #FFFFFF;
    }
    .sr-phone-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #A9B6FF;
        font-size: 14px;
    }
    .sr-phone-text {
        line-height: 1.15;
    }
    .sr-phone-text .num {
        font-weight: 800;
        font-size: 14px;
        color: #FFFFFF;
    }
    .sr-phone-text .sup {
        font-size: 10.5px;
        color: rgba(255,255,255,0.55);
        font-weight: 600;
    }

    .sr-header-cta {
        background: var(--sr-gradient);
        color: #fff !important;
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 700;
        font-size: 12.5px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        white-space: nowrap;
        box-shadow: 0 6px 20px rgba(91, 61, 245, 0.35);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .sr-header-cta:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(91, 61, 245, 0.45);
    }

    .sr-navbar-toggler {
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        background: rgba(255,255,255,0.08);
        border-radius: 10px;
        padding: 8px 12px;
        transition: background .2s ease;
    }
    .sr-navbar-toggler:hover {
        background: rgba(255,255,255,0.15);
    }

    /* Offcanvas Mobile Sidebar Drawer */
    .sr-offcanvas-sidebar {
        background: #040B16 !important;
        color: #FFFFFF;
        width: 320px !important;
        border-left: 1px solid rgba(255, 255, 255, 0.12);
        box-shadow: -10px 0 40px rgba(0,0,0,0.5);
    }
    .sr-sidebar-nav {
        margin: 0;
        padding: 0;
    }
    .sr-sidebar-nav li {
        margin-bottom: 6px;
    }
    .sr-sidebar-nav li a {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 14.5px;
        font-weight: 700;
        border-radius: 12px;
        transition: all .2s ease;
        text-decoration: none;
    }
    .sr-sidebar-nav li a:hover {
        background: rgba(91, 61, 245, 0.18);
        color: #FFFFFF;
        transform: translateX(4px);
    }
    .sr-sidebar-nav li a i {
        color: #3D7BFF;
        font-size: 16px;
    }

    /* ==========================================================================
       HERO SECTION
       ========================================================================== */
    .sr-hero {
        position: relative;
        min-height: 740px;
        display: flex;
        align-items: center;
        background:
            linear-gradient(110deg, rgba(3, 8, 18, 0.96) 25%, rgba(3, 8, 18, 0.75) 55%, rgba(3, 8, 18, 0.88) 100%),
            url('https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=2000&q=80') center/cover no-repeat;
        padding: 170px 0 145px;
        overflow: hidden;
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 110px), calc(100% - 110px) 100%, 110px 100%, 0 calc(100% - 110px));
    }
    .sr-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 75% 35%, rgba(91, 61, 245, 0.22), transparent 60%);
        pointer-events: none;
    }

    .sr-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255,255,255,0.16);
        background: rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.9);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        padding: 8px 18px;
        border-radius: 30px;
        margin-bottom: 24px;
        backdrop-filter: blur(6px);
    }
    .sr-badge-pill .gold-tag {
        color: #FFB800;
    }

    .sr-hero h1 {
        font-size: 4rem;
        font-weight: 900;
        line-height: 1.05;
        color: #FFFFFF;
        letter-spacing: -1.2px;
        margin-bottom: 22px;
        font-family: var(--sr-font-display);
    }
    .sr-hero h1 span.grad-text {
        background: linear-gradient(135deg, #6B4DFF 0%, #3D7BFF 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .sr-hero p.lead-desc {
        color: rgba(255,255,255,0.72);
        font-size: 15.5px;
        line-height: 1.65;
        max-width: 480px;
        margin-bottom: 38px;
        font-weight: 500;
    }

    /* Key Benefits Grid - EXACT REFERENCE MATCH */
    .sr-benefits-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        max-width: 520px;
        margin-top: 32px;
    }
    .sr-benefit-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }   
    .sr-benefit-icon-box {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 16px;
        background: radial-gradient(circle at 30% 30%, rgba(192, 132, 252, 0.16), rgba(15, 23, 42, 0.6));
        border: 1px solid rgba(139, 92, 246, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        margin-left: auto;
        margin-right: auto;
        backdrop-filter: blur(8px);
        box-shadow: 
            0 8px 24px rgba(0, 0, 0, 0.4),
            0 0 20px rgba(124, 58, 237, 0.25),
            inset 0 0 12px rgba(139, 92, 246, 0.2);
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .sr-benefit-item:hover .sr-benefit-icon-box {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 
            0 12px 28px rgba(0, 0, 0, 0.5),
            0 0 25px rgba(124, 58, 237, 0.4),
            inset 0 0 15px rgba(139, 92, 246, 0.3);
    }
    .sr-benefit-title {
        color: #FFFFFF;
        font-weight: 800;
        font-size: 14px;
        margin-bottom: 3px;
        letter-spacing: -0.2px;
    }
    .sr-benefit-sub {
        color: rgba(255, 255, 255, 0.65);
        font-size: 12px;
        line-height: 1.35;
        font-weight: 500;
    }

    /* Booking Form Card */
    .sr-quote-card {
        background: #FFFFFF;
        border-radius: 20px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
        padding: 24px 26px;
        position: relative;
        z-index: 10;
        max-width: 440px;
        margin-left: auto;
        margin-right: auto;
    }
    .sr-tabs {
        display: flex;
        gap: 28px;
        border-bottom: 1px solid #EEF2F6;
        margin-bottom: 22px;
    }
    .sr-tab-btn {
        background: none;
        border: none;
        padding: 0 0 14px;
        font-weight: 700;
        font-size: 14.5px;
        color: var(--sr-muted);
        position: relative;
        transition: color .2s ease;
        cursor: pointer;
    }
    .sr-tab-btn.active {
        color: var(--sr-purple);
    }
    .sr-tab-btn.active::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1px;
        height: 3px;
        border-radius: 3px;
        background: var(--sr-purple);
    }

    .sr-field-group {
        margin-bottom: 16px;
    }
    .sr-via-field {
        position: relative;
        animation: srStopReveal .2s ease;
    }
    @keyframes srStopReveal {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .sr-via-label {
        display: flex !important;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .sr-via-remove {
        border: 0;
        padding: 0;
        background: transparent;
        color: #DC2626;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }
    .sr-add-stop-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 9px;
        background: #FFFFFF;
        color: #1D4ED8;
        padding: 7px 10px;
        font-size: 12px;
        font-weight: 800;
        margin: -2px 0 14px;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }
    .sr-add-stop-btn:hover {
        background: #FFF9D8;
        transform: translateY(-1px);
    }
    .sr-field-group label {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #64748B;
        margin-bottom: 6px;
    }
    .sr-input-box {
        position: relative;
    }
    .sr-input-box input,
    .sr-input-box select {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 13px 40px 13px 16px;
        font-size: 14px;
        font-weight: 600;
        color: var(--sr-navy-dark);
        background: #F8FAFC;
        transition: all .2s ease;
        appearance: none;
    }
    .sr-input-box input::placeholder {
        color: #94A3B8;
        font-weight: 500;
    }
    .sr-input-box input:focus,
    .sr-input-box select:focus {
        outline: none;
        border-color: var(--sr-purple);
        background: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(91,61,245,0.12);
    }
    .sr-input-box i.icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 16px;
        pointer-events: none;
    }
    .sr-form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .sr-quote-submit-btn {
        width: 100%;
        border: none;
        background: var(--sr-gradient);
        color: #fff;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 8px;
        box-shadow: 0 12px 30px rgba(91, 61, 245, 0.35);
        transition: transform .2s ease, box-shadow .2s ease;
        cursor: pointer;
    }
    .sr-quote-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(91, 61, 245, 0.45);
    }

    .sr-quote-note-text {
        text-align: center;
        font-size: 12px;
        color: #94A3B8;
        margin-top: 14px;
        margin-bottom: 0;
        font-weight: 600;
    }

    /* Success Alert */
    .sr-quote-alert-success {
        display: none;
        align-items: center;
        gap: 10px;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        color: #166534;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 12px;
    }
    .sr-quote-alert-success.show { display: flex; }

    /* ==========================================================================
       STATS CAPSULE BAR - EXACT REFERENCE MATCH
       ========================================================================== */
    .sr-stats-wrapper {
        margin-top: -75px;
        position: relative;
        z-index: 25;
    }
    .sr-stats-capsule {
        background: 
            radial-gradient(circle at 5% 50%, rgba(139, 92, 246, 0.18), transparent 35%),
            radial-gradient(circle at 95% 50%, rgba(56, 189, 248, 0.18), transparent 35%),
            linear-gradient(180deg, #070E1C 0%, #040812 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-top: 1px solid rgba(192, 132, 252, 0.4);
        border-radius: 22px;
        box-shadow: 
            0 30px 80px rgba(0, 0, 0, 0.75),
            0 0 40px rgba(124, 58, 237, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        padding: 24px 36px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        backdrop-filter: blur(16px);
        position: relative;
        overflow: hidden;
    }
    .sr-stats-capsule::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.06) 1px, transparent 1px);
        background-size: 12px 12px;
        opacity: 0.4;
        pointer-events: none;
    }
    .sr-stat-box {
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        z-index: 2;
    }
    .sr-stat-box:not(:last-child) {
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        padding-right: 20px;
    }
    .sr-stat-icon-circle {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 16px;
        background: radial-gradient(circle at 30% 30%, rgba(192, 132, 252, 0.18), rgba(99, 102, 241, 0.08));
        border: 1px solid rgba(192, 132, 252, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 
            0 0 20px rgba(124, 58, 237, 0.25),
            inset 0 0 15px rgba(139, 92, 246, 0.2);
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .sr-stat-box:hover .sr-stat-icon-circle {
        transform: translateY(-2px) scale(1.04);
        box-shadow: 
            0 0 25px rgba(124, 58, 237, 0.4),
            inset 0 0 18px rgba(139, 92, 246, 0.3);
    }
    .sr-stat-val {
        color: #FFFFFF;
        font-weight: 900;
        font-size: 1.45rem;
        line-height: 1.1;
        font-family: var(--sr-font-display);
        letter-spacing: -0.5px;
    }
    .sr-stat-val .highlight-blue {
        background: linear-gradient(135deg, #60A5FA 0%, #38BDF8 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        display: block;
    }
    .sr-stat-lbl {
        color: rgba(255, 255, 255, 0.65);
        font-size: 12px;
        font-weight: 600;
        margin-top: 2px;
    }

    /* ==========================================================================
       OUR SERVICES SECTION - EXACT REFERENCE MATCH
       ========================================================================== */
    .sr-service-card {
        background: #FFFFFF;
        border: 1px solid #EEF2F6;
        border-radius: 20px;
        padding: 28px 20px 24px;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        display: flex;
        flex-direction: column;
    }
    .sr-service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(91, 61, 245, 0.08);
        border-color: rgba(91, 61, 245, 0.3);
    }
    .sr-service-card-graphic {
        height: 85px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .sr-service-card h5 {
        font-weight: 800;
        font-size: 16px;
        margin-bottom: 8px;
        color: var(--sr-navy-dark);
        letter-spacing: -0.3px;
    }
    .sr-service-card p {
        color: var(--sr-muted);
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 22px;
        flex-grow: 1;
    }

    .sr-faq-section {
        background: linear-gradient(180deg, #F8F9FE 0%, #FFFFFF 100%);
    }
    .sr-faq-intro {
        max-width: 680px;
        margin-left: auto;
        margin-right: auto;
    }
    .sr-faq-intro p {
        color: #64748B;
        font-size: 15px;
        line-height: 1.7;
        margin: 16px auto 0;
    }
    .sr-faq-accordion {
        max-width: 900px;
        margin: 0 auto;
    }
    .sr-faq-item {
        overflow: hidden;
        border: 1px solid #E2E8F0 !important;
        border-radius: 14px !important;
        background: #FFFFFF;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }
    .sr-faq-item + .sr-faq-item {
        margin-top: 12px;
    }
    .sr-faq-item:has(.show) {
        border-color: rgba(88, 67, 246, 0.35) !important;
        box-shadow: 0 12px 30px rgba(88, 67, 246, 0.1);
        transform: translateY(-1px);
    }
    .sr-faq-button {
        display: flex !important;
        align-items: center;
        gap: 14px;
        width: 100%;
        padding: 18px 22px !important;
        background: #FFFFFF !important;
        color: #071120 !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        line-height: 1.4;
        box-shadow: none !important;
    }
    .sr-faq-button::before {
        content: '?';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 10px;
        background: #EEECFE;
        color: #5843F6;
        font-size: 14px;
        font-weight: 900;
    }
    .sr-faq-button:not(.collapsed) {
        color: #5843F6 !important;
    }
    .sr-faq-button:not(.collapsed)::before {
        background: #5843F6;
        color: #FFFFFF;
    }
    .sr-faq-button::after {
        margin-left: auto;
        flex-shrink: 0;
    }
    .sr-faq-body {
        padding: 0 22px 20px 66px !important;
        color: #64748B;
        font-size: 14px;
        line-height: 1.7;
    }

    /* ==========================================================================
       MAJOR AIRPORT TRANSFERS SECTION
       ========================================================================== */
    /* ==========================================================================
       MAJOR AIRPORT TRANSFERS SECTION - EXACT REFERENCE MATCH
       ========================================================================== */
    .sr-nav-arrow {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        color: #64748B;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        transition: all .2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        cursor: pointer;
    }
    .sr-nav-arrow:hover {
        border-color: var(--sr-purple);
        color: var(--sr-purple);
        background: #F8FAFC;
        transform: translateY(-1px);
    }

    .sr-airport-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 260px;
        display: flex;
        align-items: flex-end;
        color: #FFFFFF;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .sr-airport-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.22);
    }
    .sr-airport-card img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }
    .sr-airport-card:hover img {
        transform: scale(1.08);
    }
    .sr-airport-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(7, 17, 32, 0.05) 0%, rgba(7, 17, 32, 0.6) 45%, rgba(7, 17, 32, 0.95) 100%);
        z-index: 1;
    }
    .sr-airport-info {
        position: relative;
        z-index: 2;
        padding: 20px 16px;
        width: 100%;
    }
    .sr-airport-badge-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(59, 130, 246, 0.85), rgba(37, 99, 235, 0.95));
        border: 1px solid rgba(255, 255, 255, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #FFFFFF;
        margin-bottom: 12px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
    .sr-airport-info h6 {
        font-weight: 800;
        font-size: 15px;
        line-height: 1.25;
        margin-bottom: 3px;
        color: #FFFFFF;
        letter-spacing: -0.2px;
    }
    .sr-airport-info .location-city {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 12px;
        font-weight: 500;
    }
    .sr-airport-info .sr-link-arrow {
        color: #FFFFFF !important;
        font-size: 12.5px;
        font-weight: 700;
    }

    /* ==========================================================================
       UK COVERAGE SECTION - EXACT REFERENCE MATCH
       ========================================================================== */
    .sr-coverage-banner {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        min-height: 380px;
        background: #030814;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
    }
    .sr-coverage-bg-image {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 48%;
        background: url('{{ asset("images/london-sunset.jpg") }}') center/cover no-repeat;
    }
    .sr-coverage-bg-image::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, #030814 0%, rgba(3, 8, 20, 0.35) 45%, transparent 100%);
    }
    .sr-coverage-left-content {
        position: relative;
        z-index: 5;
        padding: 50px 50px;
        width: 100%;
    }
    .sr-uk-map-img {
        width: 100%;
        max-width: 260px;
        height: auto;
        border-radius: 16px;
        filter: drop-shadow(0 0 25px rgba(61, 123, 255, 0.35));
    }
    .sr-coverage-text-box {
        max-width: 420px;
    }
    .sr-coverage-right-float {
        position: absolute;
        bottom: 35px;
        right: 40px;
        z-index: 10;
        width: 320px;
    }
    .sr-city-card-float {
        background: rgba(5, 12, 26, 0.85);
        border: 1px solid rgba(59, 130, 246, 0.4);
        backdrop-filter: blur(16px);
        border-radius: 20px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), 0 0 25px rgba(59, 130, 246, 0.2);
    }
    .sr-city-card-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(59, 130, 246, 0.5), rgba(37, 99, 235, 0.8));
        border: 1px solid rgba(59, 130, 246, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        box-shadow: 0 0 16px rgba(59, 130, 246, 0.4);
    }
    .sr-city-card-float h6 {
        color: #FFFFFF;
        font-weight: 800;
        font-size: 14px;
        margin-bottom: 2px;
    }
    .sr-city-card-float .route-name {
        color: rgba(255, 255, 255, 0.7);
        font-size: 12.5px;
        margin-bottom: 3px;
        font-weight: 500;
    }
    .sr-city-card-float .price-tag {
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
    }
    .sr-city-card-float .price-tag strong {
        color: #FFFFFF;
        font-size: 13.5px;
        font-weight: 800;
    }

    /* ==========================================================================
       OUR FLEET SECTION - EXACT REFERENCE MATCH
       ========================================================================== */
    .sr-vehicle-card {
        background: #060E1A;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: transform .3s ease, box-shadow .3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .sr-vehicle-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    }
    .sr-vehicle-img-holder {
        height: 185px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #060E1A;
    }
    .sr-vehicle-img-holder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }
    .sr-vehicle-card:hover .sr-vehicle-img-holder img {
        transform: scale(1.05);
    }
    .sr-vehicle-content {
        padding: 16px 20px 20px;
        background: #060E1A;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    .sr-vehicle-title-specs {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        gap: 12px;
    }
    .sr-vehicle-title-specs h5 {
        color: #FFFFFF;
        font-weight: 800;
        font-size: 15.5px;
        margin: 0;
        letter-spacing: -0.2px;
    }
    .sr-vehicle-specs {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        font-weight: 600;
    }
    .sr-vehicle-specs span {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .sr-vehicle-price {
        color: rgba(255, 255, 255, 0.7);
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }
    .sr-vehicle-price strong {
        color: #FFB800;
        font-size: 16px;
        font-weight: 800;
        margin-left: 2px;
    }
    .sr-vehicle-price-bar {
        padding-top: 14px;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .sr-vehicle-price-bar strong {
        color: #FFFFFF;
        font-size: 18px;
        font-weight: 800;
    }

    /* ==========================================================================
       FOOTER
       ========================================================================== */
    .sr-footer {
        background: #030812;
        color: rgba(255,255,255,0.7);
        padding: 80px 0 30px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }
    .sr-footer h6 {
        color: #FFFFFF;
        font-weight: 800;
        font-size: 15px;
        margin-bottom: 20px;
    }
    .sr-footer ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .sr-footer ul li {
        margin-bottom: 12px;
    }
    .sr-footer ul li a {
        color: rgba(255,255,255,0.65);
        font-size: 14px;
        transition: color .2s ease;
    }
    .sr-footer ul li a:hover {
        color: #FFFFFF;
    }
    .sr-footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.08);
        margin-top: 60px;
        padding-top: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
    }

    /* ==========================================================================
       MEDIA QUERIES FOR 100% RESPONSIVENESS
       ========================================================================== */
    @media (max-width: 1199.98px) {
        .sr-hero h1 { font-size: 3.2rem; }
        .sr-benefits-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }

    @media (max-width: 991.98px) {
        .sr-section { padding: 0px 0; }
        .sr-hero { padding: 130px 0 70px; min-height: auto; clip-path: polygon(0 0, 100% 0, 100% calc(100% - 50px), calc(100% - 50px) 100%, 50px 100%, 0 calc(100% - 50px)); }
        .sr-badge-pill { display: none !important; }
        .sr-hero h1 { text-align: center; }
        .sr-hero-description,
        .sr-hero p.lead-desc { text-align: center; margin-left: auto; margin-right: auto; }
        .sr-stats-wrapper { margin-top: -35px; }
        .sr-stats-capsule {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 22px 24px;
        }
        .sr-stat-box:not(:last-child) {
            border-right: none;
            padding-right: 0;
        }
        .sr-coverage-banner { padding: 36px 24px; }
        .sr-heading-lg { font-size: 2.1rem; }
    }

    @media (max-width: 575.98px) {
        .sr-section { padding: 45px 0; }
        .sr-hero { padding: 155px 10px 80px; clip-path: none; }
        .sr-hero .col-lg-7,
        .sr-hero-copy { display: contents; }
        .sr-hero .col-lg-5 { order: 2; width: 100%; }
        .sr-hero-description { order: 3; width: 100%; margin-top: 24px; text-align: center; margin-left: auto; margin-right: auto; }
        .sr-benefits-grid { order: 4; width: 100%; }
        .sr-badge-pill { display: none !important; }
        .sr-hero h1 { font-size: 1.8rem; letter-spacing: -0.5px; text-align: center; width: 100%; }
        .sr-hero p.lead-desc { font-size: 14px; margin-bottom: 24px; text-align: center; margin-left: auto; margin-right: auto; }
        .sr-benefits-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 6px; width: 100%; }
        .sr-benefit-icon-box { width: 38px; height: 38px; font-size: 16px; margin-bottom: 6px; }
        .sr-benefit-title { font-size: 10px; }
        .sr-benefit-sub { font-size: 8px; }

        .sr-quote-card { padding: 18px 16px; border-radius: 16px; }
        .sr-tabs { gap: 18px; margin-bottom: 16px; }
        .sr-tab-btn { font-size: 13.5px; padding-bottom: 10px; }
        .sr-form-grid-2 { grid-template-columns: 1fr; gap: 0; }

        .sr-stats-wrapper { margin-top: -25px; }
        .sr-stats-capsule {
            grid-template-columns: repeat(2, 1fr);
            padding: 16px 14px;
            gap: 12px;
            border-radius: 18px;
        }
        .sr-stat-box { gap: 10px; }
        .sr-stat-icon-circle { width: 38px; height: 38px; min-width: 38px; font-size: 16px; border-radius: 10px; }
        .sr-stat-val { font-size: 1.15rem; }
        .sr-stat-lbl { font-size: 10.5px; }

        .sr-heading-lg { font-size: 1.7rem; }
        .sr-coverage-banner { padding: 24px 16px; border-radius: 20px; }
        .sr-faq-button { padding: 15px 14px !important; font-size: 13.5px !important; }
        .sr-faq-button::before { width: 27px; height: 27px; min-width: 27px; border-radius: 8px; }
        .sr-faq-body { padding: 0 14px 16px 55px !important; font-size: 13px; }

        .sr-footer { padding: 50px 0 25px; }
        .sr-footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
    }

    #trsued-about {
        background-image: url('{{ asset("images/city-to-city.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
    }

    /* Carousel & Slider Styles */
    .sr-mobile-slider {
        display: flex !important;
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        scroll-behavior: smooth !important;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .sr-mobile-slider::-webkit-scrollbar {
        display: none;
    }

    @media (max-width: 767.98px) {
        .sr-mobile-slider {
            scroll-snap-type: x mandatory !important;
            padding-bottom: 12px;
            margin-left: -12px;
            margin-right: -12px;
            padding-left: 12px;
            padding-right: 12px;
        }

        .sr-mobile-slider > [class*="col-"] {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100% !important;
            scroll-snap-align: center !important;
            scroll-snap-stop: always !important;
        }
    }

    @media (max-width: 991.98px) {
        .sr-hero .row {
            align-items: stretch;
        }

        .sr-hero .col-lg-7,
        .sr-hero .col-lg-5 {
            width: 100%;
        }

        .sr-quote-card {
            max-width: 620px;
            width: 100%;
        }

        .sr-benefits-grid {
            max-width: 620px;
            width: 100%;
        }

        .sr-coverage-banner {
            min-height: 0;
        }

        .sr-coverage-bg-image {
            width: 100%;
            opacity: 0.35;
        }

        .sr-coverage-left-content {
            padding: 40px 24px;
        }

        .sr-coverage-right-float {
            display: none;
        }

        .sr-footer-bottom {
            gap: 20px;
        }
    }

    @media (max-width: 767.98px) {
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .sr-section {
            padding: 52px 0;
        }

        .sr-hero .container,
        .sr-section .container,
        .sr-stats-wrapper {
            max-width: 100%;
        }

        .sr-hero .row {
            margin-left: 0;
            margin-right: 0;
        }

        .sr-hero .col-lg-7,
        .sr-hero .col-lg-5 {
            padding-left: 0;
            padding-right: 0;
        }

        .sr-stats-wrapper {
            margin-top: -12px;
            padding-left: 14px;
            padding-right: 14px;
        }

        .sr-stats-capsule {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px 10px;
            padding: 18px 14px;
        }

        .sr-stat-box {
            min-width: 0;
            gap: 8px;
        }

        .sr-stat-box:not(:last-child) {
            border-right: none;
            padding-right: 0;
        }

        .sr-stat-val,
        .sr-stat-lbl {
            overflow-wrap: anywhere;
        }

        .sr-coverage-left-content {
            padding: 34px 18px;
        }

        .sr-uk-map-img {
            max-width: 190px;
        }

        .sr-coverage-text-box {
            max-width: none;
        }

        .sr-vehicle-content {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }

        .sr-vehicle-title-specs {
            flex-wrap: wrap;
        }

        .sr-footer-bottom {
            margin-top: 36px;
        }
    }
</style>

<!-- ==========================================================================
     HERO SECTION
     ========================================================================== -->
<section class="sr-hero" id="quote" style="background-image: linear-gradient(110deg, rgba(3, 8, 18, 0.96) 25%, rgba(3, 8, 18, 0.75) 55%, rgba(3, 8, 18, 0.88) 100%), url('{{ $heroBackgroundImage }}');">
    <div class="container position-relative">
        <div class="row align-items-center gy-5">
            <!-- Left Copy -->
            <div class="col-lg-7">
                <div class="sr-hero-copy">
                    <div class="sr-badge-pill">
                        <span class="gold-tag">{!! $heroBadgeText !!}</span>
                    </div>

                    <h1>{!! $heroTitleLine1 !!}<br>{!! $heroTitlePrefix !!} <span class="grad-text">{!! $heroTitleGradient !!}.</span></h1>

                    <p class="lead-desc sr-hero-description">
                        {!! $heroDescription !!}
                    </p>
                </div>

                <div class="sr-benefits-grid">
                    @foreach ($heroBenefits as $index => $benefit)
                        <div class="sr-benefit-item">
                            <div class="sr-benefit-icon-box">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="srBenGrad{{ $index + 1 }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#C084FC"/>
                                            <stop offset="50%" stop-color="#818CF8"/>
                                            <stop offset="100%" stop-color="#38BDF8"/>
                                        </linearGradient>
                                    </defs>
                                    @if ($index === 0)
                                        <path d="M4 11.25V4.75C4 4.33579 4.33579 4 4.75 4H11.25C11.4489 4 11.6397 4.07902 11.7803 4.21967L20.2803 12.7197C20.5732 13.0126 20.5732 13.4874 20.2803 13.7803L13.7803 20.2803C13.4874 20.5732 13.0126 20.5732 12.7197 20.2803L4.21967 11.7803C4.07902 11.6397 4 11.4489 4 11.25Z" stroke="url(#srBenGrad1)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="8" cy="8" r="1.5" fill="url(#srBenGrad1)"/>
                                    @elseif ($index === 1)
                                        <path d="M21 16V14L13 9V3.5C13 2.67 12.33 2 11.5 2C10.67 2 10 2.67 10 3.5V9L2 14V16L10 13.5V19L8 20.5V22L11.5 21L15 22V20.5L13 19V13.5L21 16Z" stroke="url(#srBenGrad2)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    @elseif ($index === 2)
                                        <circle cx="12" cy="7" r="3.5" stroke="url(#srBenGrad3)" stroke-width="1.8"/>
                                        <path d="M5.5 20C5.5 16.41 8.41 13.5 12 13.5C13.5 13.5 14.8 14 15.8 14.9M16.5 18L18.5 20L21.5 16" stroke="url(#srBenGrad3)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    @else
                                        <path d="M3 12C3 7.03 7.03 3 12 3C16.97 3 21 7.03 21 12V17.5C21 18.88 19.88 20 18.5 20H17M3 12V17.5C3 18.88 4.12 20 5.5 20H7" stroke="url(#srBenGrad4)" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M11.5 8V12L14 13.5" stroke="url(#srBenGrad4)" stroke-width="1.8" stroke-linecap="round"/>
                                        <rect x="2" y="11" width="3" height="6" rx="1.5" stroke="url(#srBenGrad4)" stroke-width="1.8"/>
                                        <rect x="19" y="11" width="3" height="6" rx="1.5" stroke="url(#srBenGrad4)" stroke-width="1.8"/>
                                    @endif
                                </svg>
                            </div>
                            <div class="sr-benefit-title">{!! $benefit['title'] ?? '' !!}</div>
                            <div class="sr-benefit-sub">{!! $benefit['subtitle'] ?? '' !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Booking Form Card -->
            <div class="col-lg-5 ms-auto">
                <div class="sr-quote-card">
                    <div class="sr-tabs d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <button type="button" class="sr-tab-btn active" data-tab="oneway">Check-in</button>
                        <span class="sr-discount-banner-line" style="background: #F0EEFF; color: #5843F6; font-size: 12px; font-weight: 800; padding: 6px 14px; border-radius: 50px; border: 1px solid rgba(88, 67, 246, 0.25); display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fas fa-tags"></i> {!! $heroDiscountText !!}
                        </span>
                    </div>

                    <form id="srQuoteForm" novalidate action="{{ route('search') }}" method="GET">
                        <!-- Pickup Location -->
                        <div class="sr-field-group">
                            <label for="srFrom">From</label>
                            <div class="sr-input-box">
                                <input type="text" id="srFrom" name="pickup" placeholder="Enter pickup location" required>
                                <i class="bi bi-geo-alt icon"></i>
                            </div>
                        </div>

                        <div id="srViaContainer"></div>
                        <button type="button" class="sr-add-stop-btn" id="srAddStopBtn">
                            <i class="fas fa-plus-circle"></i> Add a stop
                        </button>

                        <!-- Dropoff Location -->
                        <div class="sr-field-group">
                            <label for="srTo">To</label>
                            <div class="sr-input-box">
                                <input type="text" id="srTo" name="dropoff" placeholder="Enter drop-off location" required autocomplete="off">
                                <i class="bi bi-geo-alt-fill icon"></i>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="sr-quote-submit-btn">
                            Quote / Book Now <i class="bi bi-arrow-right fs-5"></i>
                        </button>

                        <p class="sr-quote-note-text"><i class="fas fa-percent text-primary me-1"></i> {!! $heroNoteText !!}</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ==========================================================================
     STATS CAPSULE BAR
     ========================================================================== -->
<div class="container sr-stats-wrapper">
    <div class="sr-stats-capsule">
        @foreach ($stats as $stat)
            <div class="sr-stat-box">
                <div class="sr-stat-icon-circle">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="srGrad{{ $loop->index + 1 }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#C084FC"/>
                                <stop offset="50%" stop-color="#818CF8"/>
                                <stop offset="100%" stop-color="#38BDF8"/>
                            </linearGradient>
                            @if ($loop->index === 0)
                                <filter id="glow1" x="-20%" y="-20%" width="140%" height="140%">
                                    <feGaussianBlur stdDeviation="1.5" result="blur" />
                                    <feComposite in="SourceGraphic" in2="blur" operator="over" />
                                </filter>
                            @endif
                        </defs>
                        @if ($loop->index === 0)
                            <circle cx="12" cy="12" r="9.5" stroke="url(#srGrad1)" stroke-width="1.8" stroke-dasharray="28 8" filter="url(#glow1)"/>
                            <path d="M12 3C7.03 3 3 7.03 3 12C3 14.25 3.83 16.31 5.2 17.89L4.25 20.75L7.25 19.85C8.68 20.58 10.29 21 12 21C16.97 21 21 16.97 21 12C21 7.03 16.97 3 12 3Z" stroke="url(#srGrad1)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.5 13C8.5 13 9.8 15.2 12 15.2C14.2 15.2 15.5 13 15.5 13" stroke="url(#srGrad1)" stroke-width="1.8" stroke-linecap="round"/>
                            <circle cx="9" cy="9.5" r="1.2" fill="url(#srGrad1)"/>
                            <circle cx="15" cy="9.5" r="1.2" fill="url(#srGrad1)"/>
                        @elseif ($loop->index === 1)
                            <path d="M5 12L6.8 6.2C7.1 5.3 7.9 4.7 8.8 4.7H15.2C16.1 4.7 16.9 5.3 17.2 6.2L19 12M5 12H19M5 12C3.9 12 3 12.9 3 14V17.5C3 18.1 3.4 18.5 4 18.5H5C5.6 18.5 6 18.1 6 17.5V16.5H18V17.5C18 18.1 18.4 18.5 19 18.5H20C20.6 18.5 21 18.1 21 17.5V14C21 12.9 20.1 12 19 12M7.5 14.2H7.51M16.5 14.2H16.51" stroke="url(#srGrad2)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 9H15" stroke="url(#srGrad2)" stroke-width="1.5" stroke-linecap="round"/>
                        @elseif ($loop->index === 2)
                            <path d="M21 12A9 9 0 1 1 12 3C15.2 3 17.9 4.7 19.3 7.3M19.3 7.3V3M19.3 7.3H15" stroke="url(#srGrad3)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.2 10.2V11.2H10.2V14.8M8.2 14.8H10.2M12.2 10.2H14.2L12.5 14.8H14.8" stroke="url(#srGrad3)" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        @else
                            <path d="M12 3L4 7V12C4 16.5 7.4 20.4 12 21.5C16.6 20.4 20 16.5 20 12V7L12 3Z" stroke="url(#srGrad4)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 12L11.2 14.2L15.5 9.8" stroke="url(#srGrad4)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        @endif
                    </svg>
                </div>
                <div>
                    <div class="sr-stat-val">{{ $stat['value'] ?? '' }}</div>
                    <div class="sr-stat-lbl">{{ $stat['label'] ?? '' }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<!-- ==========================================================================
     OUR SERVICES SECTION
     ========================================================================== -->
<section class="sr-section" id="services">
    <div class="container">
        <div class="row align-items-center mb-5 gy-4">
            <div class="col-lg-4">
                <span class="sr-label">{!! $servicesLabel !!}</span>
                <h2 class="sr-heading-lg" style="line-height: 1.15;">
                    {!! $servicesHeadingLine1 !!}<br>{!! $servicesHeadingLine2 !!}, <span class="grad-text">{!! $servicesHeadingGradient !!}</span>
                </h2>
                <p class="mt-3 mb-4" style="color:var(--sr-muted); max-width:380px; font-size:14.5px; line-height: 1.6;">
                    {!! $servicesDescription !!}
                </p>
                <a href="#services" class="sr-btn-outline" style="border-color: #C7D2FE; color: var(--sr-purple) !important;">
                    {!! $servicesButtonText !!} <i class="bi bi-arrow-right me-1"></i>
                </a>
            </div>

            <div class="col-lg-8">
                <div class="row g-3 g-md-4">
                    @foreach ($servicesList as $service)
                        <div class="col-6 col-md-3">
                            <div class="sr-service-card">
                                <div class="sr-service-card-graphic">
                                    @php
                                        $serviceSvg = $loop->index;
                                    @endphp
                                    @if ($serviceSvg === 0)
                                    <svg width="140" height="90" viewBox="0 0 140 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <linearGradient id="planeGradRef" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#5843F6"/>
                                                <stop offset="100%" stop-color="#7C4DFF"/>
                                            </linearGradient>
                                            <filter id="planeShadow" x="-20%" y="-20%" width="140%" height="140%">
                                                <feDropShadow dx="2" dy="4" stdDeviation="4" flood-color="#5843F6" flood-opacity="0.3"/>
                                            </filter>
                                        </defs>
                                        <path d="M15 52C35 52 50 32 42 22C34 12 28 35 58 42C78 46 82 28 102 24" stroke="#7C4DFF" stroke-width="2" stroke-linecap="round" stroke-dasharray="2.5 4" opacity="0.65"/>
                                        <g transform="translate(75, 12) rotate(-10)" filter="url(#planeShadow)">
                                            <path d="M34 17L14 3.5V11.5L3 14.5V17.5L14 16.5V23.5L9.5 26.5V28.5L16 27.5L22 28.5V26.5L18 23.5V16.5L34 17Z" fill="url(#planeGradRef)"/>
                                        </g>
                                    </svg>
                                    @elseif ($serviceSvg === 1)
                                    <svg width="140" height="90" viewBox="0 0 140 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <linearGradient id="bldgGrad1" x1="0%" y1="0%" x2="0%" y2="100%">
                                                <stop offset="0%" stop-color="#60A5FA"/>
                                                <stop offset="100%" stop-color="#3B82F6"/>
                                            </linearGradient>
                                            <linearGradient id="bldgGrad2" x1="0%" y1="0%" x2="0%" y2="100%">
                                                <stop offset="0%" stop-color="#A78BFA"/>
                                                <stop offset="100%" stop-color="#6366F1"/>
                                            </linearGradient>
                                            <linearGradient id="bldgGrad3" x1="0%" y1="0%" x2="0%" y2="100%">
                                                <stop offset="0%" stop-color="#93C5FD"/>
                                                <stop offset="100%" stop-color="#3B82F6"/>
                                            </linearGradient>
                                            <linearGradient id="rampGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" stop-color="#2563EB"/>
                                                <stop offset="100%" stop-color="#4F46E5"/>
                                            </linearGradient>
                                            <filter id="pinShadow" x="-30%" y="-30%" width="160%" height="160%">
                                                <feDropShadow dx="0" dy="3" stdDeviation="3" flood-color="#000000" flood-opacity="0.18"/>
                                            </filter>
                                        </defs>
                                        <rect x="22" y="44" width="14" height="28" rx="2" fill="url(#bldgGrad1)" opacity="0.85"/>
                                        <rect x="39" y="26" width="16" height="46" rx="2" fill="url(#bldgGrad2)"/>
                                        <path d="M47 16L55 26H39L47 16Z" fill="url(#bldgGrad2)"/>
                                        <rect x="58" y="36" width="12" height="36" rx="2" fill="url(#bldgGrad3)" opacity="0.8"/>
                                        <rect x="73" y="20" width="18" height="52" rx="2" fill="url(#bldgGrad2)"/>
                                        <path d="M82 10L91 20H73L82 10Z" fill="url(#bldgGrad2)"/>
                                        <rect x="94" y="30" width="14" height="42" rx="2" fill="url(#bldgGrad1)"/>
                                        <rect x="43" y="32" width="3" height="4" fill="#FFFFFF" opacity="0.6"/>
                                        <rect x="49" y="32" width="3" height="4" fill="#FFFFFF" opacity="0.6"/>
                                        <rect x="77" y="26" width="4" height="5" fill="#FFFFFF" opacity="0.6"/>
                                        <rect x="83" y="26" width="4" height="5" fill="#FFFFFF" opacity="0.6"/>
                                        <path d="M12 75C45 75 75 62 118 46" stroke="url(#rampGrad)" stroke-width="3.5" stroke-linecap="round"/>
                                        <path d="M12 75C45 75 75 62 118 46L118 52C75 68 45 81 12 81Z" fill="url(#rampGrad)" opacity="0.15"/>
                                        <g transform="translate(100, 24)" filter="url(#pinShadow)">
                                            <path d="M11 0C4.92 0 0 4.92 0 11C0 19.25 11 27 11 27C11 27 22 19.25 22 11C22 4.92 17.08 0 11 0Z" fill="#FFFFFF"/>
                                            <circle cx="11" cy="11" r="5" fill="#3B82F6"/>
                                            <circle cx="11" cy="11" r="2" fill="#FFFFFF"/>
                                        </g>
                                    </svg>
                                    @elseif ($serviceSvg === 2)
                                    <svg width="140" height="90" viewBox="0 0 140 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <linearGradient id="bagBody" x1="0%" y1="0%" x2="0%" y2="100%">
                                                <stop offset="0%" stop-color="#1E293B"/>
                                                <stop offset="100%" stop-color="#0F172A"/>
                                            </linearGradient>
                                            <linearGradient id="bagStrap" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" stop-color="#8B5CF6"/>
                                                <stop offset="100%" stop-color="#3B82F6"/>
                                            </linearGradient>
                                            <filter id="bagShadow" x="-20%" y="-20%" width="140%" height="140%">
                                                <feDropShadow dx="0" dy="6" stdDeviation="5" flood-color="#0F172A" flood-opacity="0.25"/>
                                            </filter>
                                        </defs>
                                        <g filter="url(#bagShadow)">
                                            <path d="M52 24V17C52 14.24 54.24 12 57 12H83C85.76 12 88 14.24 88 17V24" stroke="#0F172A" stroke-width="4.5" stroke-linecap="round" fill="none"/>
                                            <rect x="34" y="24" width="72" height="46" rx="10" fill="url(#bagBody)"/>
                                            <path d="M34 46C56 50 84 50 106 46" stroke="url(#bagStrap)" stroke-width="3.5" stroke-linecap="round"/>
                                            <rect x="63" y="42" width="14" height="12" rx="4" fill="#60A5FA"/>
                                            <rect x="66" y="45" width="8" height="6" rx="2" fill="#1E293B"/>
                                        </g>
                                    </svg>
                                    @else
                                <svg width="140" height="90" viewBox="0 0 140 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="clockRingGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#8B5CF6"/>
                                            <stop offset="100%" stop-color="#3B82F6"/>
                                        </linearGradient>
                                        <filter id="clockShadow" x="-20%" y="-20%" width="140%" height="140%">
                                            <feDropShadow dx="0" dy="4" stdDeviation="4" flood-color="#3B82F6" flood-opacity="0.15"/>
                                        </filter>
                                    </defs>
                                    <g filter="url(#clockShadow)">
                                        <circle cx="70" cy="45" r="34" stroke="url(#clockRingGrad)" stroke-width="2" stroke-dasharray="2.5 4" opacity="0.6"/>
                                        <circle cx="70" cy="45" r="27" stroke="#0F172A" stroke-width="3" fill="none"/>
                                        <circle cx="70" cy="45" r="3" fill="url(#clockRingGrad)"/>
                                        <path d="M70 45L58 31" stroke="url(#clockRingGrad)" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M70 45L83 29" stroke="#0F172A" stroke-width="3" stroke-linecap="round"/>
                                        <circle cx="70" cy="21" r="2" fill="url(#clockRingGrad)"/>
                                        <circle cx="70" cy="69" r="2" fill="url(#clockRingGrad)"/>
                                        <circle cx="46" cy="45" r="2" fill="url(#clockRingGrad)"/>
                                        <circle cx="94" cy="45" r="2" fill="url(#clockRingGrad)"/>
                                    </g>
                                </svg>
                                    @endif
                                </div>
                                <h5>{!! $service['title'] !!}</h5>
                                <p>{!! $service['description'] !!}</p>
                                <a href="#quote" class="sr-link-arrow">Book Now <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     TRUSTED TAXI PARTNER (ABOUT US SECTION)
     ========================================================================== -->
<section class="sr-about-trusted-section py-5" id="trsued-about">
    <div class="container py-4">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-4 col-md-5">
                <div class="about-trusted-img-wrapper position-relative">
                    <img src="{{ $aboutImage }}" alt="Professional Driver opening car door" class="img-fluid rounded-4 shadow-lg w-100" style="height: 380px; object-fit: cover;">
                    <div class="about-trusted-badge position-absolute bottom-0 start-0 m-3 p-3 rounded-4 shadow-lg" style="background: rgba(7, 19, 38, 0.94); border: 1px solid rgba(255,255,255,0.15); backdrop-filter: blur(12px);">
                        <div class="d-flex align-items-center gap-3">
                            <span class="fs-2 fw-black" style="color: #4D3AE7 !important; line-height: 1; font-weight: 900;">{!! $aboutExperienceYears !!}</span>
                            <span class="text-white small fw-bold lh-sm text-uppercase" style="letter-spacing: 0.5px;">{{ nl2br($aboutExperienceText) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-7">
                <div class="about-trusted-content ps-lg-3">
                    <span class="badge px-3 py-2 rounded-2 mb-3 fw-bold text-uppercase" style="background: #EEECFE; color: #4D3AE7; font-size: 11.5px; letter-spacing: 1px; border: 1px solid rgba(77, 58, 231, 0.25);">{!! $aboutBadge !!}</span>
                    <h2 class="font-display fw-black display-6 text-dark mb-3" style="line-height: 1.15; color: #071326 !important; font-weight: 900;">
                        {!! $aboutHeadingLine1 !!} {!! $aboutHeadingLine2 !!}
                    </h2>
                    <p class="text-muted mb-4" style="font-size: 14.5px; line-height: 1.7;">
                        {!! $aboutDescription !!}
                    </p>

                    <ul class="list-unstyled mb-4">
                        @foreach ($aboutCheckmarks as $check)
                            <li class="d-flex align-items-center gap-3 mb-3" style="font-size: 14.5px; font-weight: 700; color: #1E293B;">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 24px; height: 24px; background: #EEECFE; color: #4D3AE7; font-size: 12px; border: 1px solid rgba(77, 58, 231, 0.25);">
                                    <i class="fas fa-check"></i>
                                </span>
                                {!! $check !!}
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ $aboutButtonLink }}" class="btn btn-outline-dark px-4 py-2.5 rounded-3 fw-bold d-inline-flex align-items-center gap-2" style="font-size: 14px; border-color: #CBD5E1;">
                        {!! $aboutButtonText !!} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ==========================================================================
     MAJOR AIRPORT TRANSFERS SECTION
     ========================================================================== -->
<section class="sr-section pt-0" id="airports">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-4 pb-2">
            <div>
                <span class="sr-label">{!! $airportsLabel !!}</span>
                <h2 class="sr-heading-lg" style="font-size: 2.4rem; line-height: 1.15; margin-top: 4px;">
                    {!! $airportsHeadingLine1 !!}<br>{!! $airportsHeadingLine2 !!}
                </h2>
            </div>
            <div class="d-flex flex-column align-items-end gap-3">
                <a href="#airports" class="sr-link-arrow text-decoration-none" style="font-size: 13.5px; font-weight: 700;">{!! $airportsButtonText !!} <i class="bi bi-arrow-right ms-1"></i></a>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="sr-nav-arrow" aria-label="Previous"><i class="bi bi-arrow-left"></i></button>
                    <button type="button" class="sr-nav-arrow" aria-label="Next"><i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="row g-3 g-lg-3 sr-mobile-slider" id="airportsSliderRow">
            @foreach ($airports as $airport)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="sr-airport-card">
                        <img src="{{ $airport['image'] ?? $airport['img'] ?? '' }}" alt="{{ $airport['name'] }}" loading="lazy">
                        <div class="sr-airport-info">
                            <div class="sr-airport-badge-icon"><i class="bi bi-airplane-fill"></i></div>
                            <h6>{{ $airport['name'] }}</h6>
                            <div class="location-city">{{ $airport['city'] }}</div>
                            <a href="#quote" class="sr-link-arrow">Book Now <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ==========================================================================
     UK COVERAGE SECTION
     ========================================================================== -->
<section class="sr-section">
    <div class="container">
        <div class="sr-coverage-banner">
            <div class="sr-coverage-bg-image"></div>
            <div class="sr-coverage-left-content row w-100 m-0 align-items-center">
                <div class="col-lg-4 col-md-5 text-center text-md-start mb-4 mb-md-0">
                    <img src="{{ asset('images/map.png') }}" alt="UK Coverage Map" class="sr-uk-map-img">
                </div>
                <div class="col-lg-5 col-md-7 text-center text-md-start sr-coverage-text-box">
                    <span class="sr-label on-dark">{!! $coverageLabel !!}</span>
                    <h2 class="sr-heading-lg on-dark" style="font-size: 2.3rem; line-height: 1.18; margin-top: 4px;">
                        {!! $coverageHeadingLine1 !!}<br>{!! $coverageHeadingLine2 !!}
                    </h2>
                    <p class="mt-3 mb-4" style="color:rgba(255,255,255,0.7); font-size:14.5px; line-height: 1.5;">
                        {!! $coverageDescription !!}
                    </p>
                    <a href="#airports" class="sr-btn-gradient">
                        {!! $coverageButtonText !!} <i class="bi bi-arrow-right me-1"></i>
                    </a>
                </div>
            </div>

            <div class="sr-coverage-right-float d-none d-lg-block">
                <div class="sr-city-card-float">
                    <div class="sr-city-card-icon">
                        <i class="bi bi-car-front-fill fs-5"></i>
                    </div>
                    <div>
                        <h6>{!! $coverageFloatTitle !!}</h6>
                        <div class="route-name">{!! $coverageFloatRoute !!}</div>
                        <div class="price-tag">{!! $coverageFloatPriceText !!} <strong>{!! $coverageFloatPrice !!}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ==========================================================================
     OUR FLEET SECTION
     ========================================================================== -->
<section class="sr-section pt-0" id="vehicles">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-4">
            <div>
                <span class="sr-label">{!! $fleetLabel !!}</span>
                <h2 class="sr-heading-lg">{!! $fleetHeading !!}</h2>
                <p class="mb-0 mt-1" style="color:var(--sr-muted); font-size:14.5px;">{!! $fleetSubheading !!}</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="#vehicles" class="sr-link-arrow d-none d-md-inline-flex me-2">{!! $fleetButtonText !!} <i class="bi bi-arrow-right"></i></a>
                <button type="button" class="sr-nav-arrow" aria-label="Previous"><i class="bi bi-arrow-left"></i></button>
                <button type="button" class="sr-nav-arrow" aria-label="Next"><i class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        <div class="row g-3 g-md-4 sr-mobile-slider" id="vehiclesSliderRow">
            @foreach ($fleetVehicles as $vehicle)
                <div class="col-6 col-lg-3">
                    <div class="sr-vehicle-card">
                        <div class="sr-vehicle-img-holder">
                            <img src="{{ $vehicle['image'] ?? $vehicle['img'] ?? '' }}" alt="{{ $vehicle['name'] }}" loading="lazy">
                        </div>
                        <div class="sr-vehicle-content">
                            <div class="sr-vehicle-title-specs">
                                <h5>{{ $vehicle['name'] }}</h5>
                                <div class="sr-vehicle-specs">
                                    <span><i class="bi bi-person"></i> {{ $vehicle['pax'] ?? $vehicle['seats'] ?? '' }}</span>
                                    <span><i class="bi bi-briefcase"></i> {{ $vehicle['luggage'] ?? $vehicle['lug'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>




<!-- ==========================================================================
     REVIEWS / TESTIMONIALS SECTION
     ========================================================================== -->
<section class="sr-section" id="reviews" style="background: #F8F9FE;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sr-label">{!! $reviewsLabel !!}</span>
            <h2 class="sr-heading-lg" style="font-size: 2.4rem; line-height: 1.15; margin-top: 8px;">
                {!! $reviewsHeading !!}
            </h2>
            <p style="color: #64748B; font-size: 15px; max-width: 600px; margin: 16px auto 0;">
                {!! $reviewsDescription !!}
            </p>
        </div>

        <div class="row g-4 g-lg-4">
            @foreach ($reviews as $review)
                <div class="col-lg-4">
                    <div style="background: #FFFFFF; border-radius: 16px; padding: 32px; height: 100%; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
                        <div class="mb-3">
                            <div style="color: #FFB800; font-size: 14px;">
                                @for ($i = 0; $i < floor($review['rating'] ?? 5); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if (($review['rating'] ?? 5) - floor($review['rating'] ?? 5) > 0)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                            </div>
                        </div>
                        <p style="color: #1E293B; font-size: 15px; line-height: 1.6; margin-bottom: 20px;">
                            {!! $review['text'] !!}
                        </p>
                        <div style="display: flex; align-items: center; gap: 12px; padding-top: 16px; border-top: 1px solid #E2E8F0;">
                            <div style="width: 44px; height: 44px; background: #030812; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 16px;">{{ $review['initials'] ?? strtoupper(substr($review['name'], 0, 2)) }}</div>
                            <div>
                                <div style="font-weight: 700; color: #030812; font-size: 14px;">{{ $review['name'] }}</div>
                                <div style="color: #64748B; font-size: 12px;">Verified passenger</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ==========================================================================
     FAQ SECTION
     ========================================================================== -->
<section class="sr-section sr-faq-section" id="faq">
    <div class="container">
        <div class="text-center mb-5 sr-faq-intro">
            <span class="sr-label">{!! $faqLabel !!}</span>
            <h2 class="sr-heading-lg" style="font-size: 2.4rem; line-height: 1.15; margin-top: 8px;">
                {!! $faqHeading !!}
            </h2>
            <p>
                {!! $faqDescription !!}
            </p>
        </div>

        @php
            $faqGroups = array_chunk($faqs, ceil(count($faqs) / 2));
        @endphp

        <div class="row g-3 sr-faq-accordion">
            @foreach ($faqGroups as $groupIndex => $group)
                <div class="col-lg-6">
                    <div class="accordion accordion-flush" id="faqAccordion{{ $groupIndex + 1 }}">
                        @foreach ($group as $faqIndex => $faq)
                            @php $accordionId = 'faqCollapse' . (($groupIndex * 100) + $faqIndex + 1); @endphp
                            <div class="accordion-item sr-faq-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed sr-faq-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $accordionId }}">
                                        {!! $faq['question'] !!}
                                    </button>
                                </h2>
                                <div id="{{ $accordionId }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion{{ $groupIndex + 1 }}">
                                    <div class="accordion-body sr-faq-body">
                                        {!! $faq['answer'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ==========================================================================
     CLIENT JAVASCRIPT
     ========================================================================== -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var heroStopCount = 0;
        var heroStopContainer = document.getElementById('srViaContainer');
        var heroAddStopButton = document.getElementById('srAddStopBtn');

        function addHeroStop() {
            if (!heroStopContainer || heroStopCount >= 10) return;

            heroStopCount++;
            var stopRow = document.createElement('div');
            stopRow.className = 'sr-field-group sr-via-field';
            stopRow.innerHTML = '<label class="sr-via-label" for="srStop' + heroStopCount + '">' +
                '<span><i class="fas fa-map-marker-alt me-1"></i> Stop ' + heroStopCount + '</span>' +
                '<button type="button" class="sr-via-remove"><i class="fas fa-trash-alt"></i> Remove</button>' +
                '</label>' +
                '<div class="sr-input-box">' +
                '<input type="text" id="srStop' + heroStopCount + '" name="stops[]" class="sr-via-input" placeholder="Enter via stop address" required autocomplete="off">' +
                '<i class="bi bi-sign-turn-slight-right icon"></i>' +
                '</div>';

            heroStopContainer.appendChild(stopRow);

            var stopInput = stopRow.querySelector('.sr-via-input');
            var removeButton = stopRow.querySelector('.sr-via-remove');
            if (typeof attachCustomAutocompleteToInput === 'function') {
                attachCustomAutocompleteToInput(stopInput);
            }
            removeButton.addEventListener('click', function () {
                stopRow.remove();
                heroStopCount--;
                Array.from(heroStopContainer.querySelectorAll('.sr-via-field')).forEach(function (row, index) {
                    var label = row.querySelector('.sr-via-label span');
                    var input = row.querySelector('.sr-via-input');
                    var stopNumber = index + 1;
                    label.innerHTML = '<i class="fas fa-map-marker-alt me-1"></i> Stop ' + stopNumber;
                    input.id = 'srStop' + stopNumber;
                    row.querySelector('.sr-via-label').setAttribute('for', input.id);
                });
            });
        }

        if (heroAddStopButton) {
            heroAddStopButton.addEventListener('click', addHeroStop);
        }

        // Sticky Header scroll
        var header = document.getElementById('srHeader');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 40) {
                header.classList.add('sr-scrolled');
            } else {
                header.classList.remove('sr-scrolled');
            }
        });

        // Tab toggle (One Way / Return)
        var tabBtns = document.querySelectorAll('.sr-tab-btn');
        tabBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                tabBtns.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');
            });
        });

        // Form submission behavior
        var quoteForm = document.getElementById('srQuoteForm');
        var successAlert = document.getElementById('srQuoteSuccess');

        if (quoteForm) {
            quoteForm.addEventListener('submit', function (e) {
                var fromVal = document.getElementById('srFrom').value.trim();
                var toVal = document.getElementById('srTo').value.trim();
                var stopInputs = quoteForm.querySelectorAll('.sr-via-input');
                var hasEmptyStop = Array.from(stopInputs).some(function (input) {
                    return !input.value.trim();
                });

                if (!fromVal || !toVal || hasEmptyStop) {
                    e.preventDefault();
                    alert('Please enter Pickup, Drop-off, and all added stop locations.');
                    return;
                }

                if (successAlert) {
                    successAlert.classList.add('show');
                }
            });
        }

        // Initialize autocomplete on hero form inputs if present
        const heroInputs = [document.getElementById('srFrom'), document.getElementById('srTo')].filter(Boolean);
        if (heroInputs.length) {
            heroInputs.forEach(inp => {
                if (typeof attachCustomAutocompleteToInput === 'function') {
                    attachCustomAutocompleteToInput(inp);
                }
            });
        }

        // Mobile 3-Second Auto-Slider for Major Airports & Fleet Cards
        function setupMobileAutoSlider(sliderId, intervalTime = 3000) {
            const slider = document.getElementById(sliderId);
            if (!slider) return;

            let currentIndex = 0;
            let timer = null;

            function slideNext() {
                if (window.innerWidth >= 768) return; // Only run on mobile screens
                const children = slider.children;
                if (!children.length) return;

                currentIndex = (currentIndex + 1) % children.length;
                const targetChild = children[currentIndex];

                slider.scrollTo({
                    left: targetChild.offsetLeft - slider.offsetLeft,
                    behavior: 'smooth'
                });
            }

            function startTimer() {
                if (timer) clearInterval(timer);
                timer = setInterval(slideNext, intervalTime);
            }

            function stopTimer() {
                if (timer) clearInterval(timer);
            }

            startTimer();

            slider.addEventListener('touchstart', stopTimer, { passive: true });
            slider.addEventListener('touchend', startTimer, { passive: true });
        }

        setupMobileAutoSlider('airportsSliderRow', 3000);
        setupMobileAutoSlider('vehiclesSliderRow', 1500);

        // Arrow Navigation Buttons for Airports and Fleet sliders
        document.querySelectorAll('.sr-section').forEach(function (sec) {
            const slider = sec.querySelector('.sr-mobile-slider');
            const prevBtn = sec.querySelector('.sr-nav-arrow[aria-label="Previous"]');
            const nextBtn = sec.querySelector('.sr-nav-arrow[aria-label="Next"]');

            if (slider && prevBtn && nextBtn) {
                prevBtn.addEventListener('click', function () {
                    const scrollAmount = slider.firstElementChild ? slider.firstElementChild.clientWidth : 280;
                    slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                });
                nextBtn.addEventListener('click', function () {
                    const scrollAmount = slider.firstElementChild ? slider.firstElementChild.clientWidth : 280;
                    slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                });
            }
        });
    });
</script>
@endpush

@endsection