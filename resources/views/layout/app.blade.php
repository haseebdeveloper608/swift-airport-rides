<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Swift Ride Taxis | Premium Airport Transfers Across the UK')</title>
    <meta name="description" content="@yield('meta_description', 'Professional airport transfers, private taxi services and city-to-city rides across the UK. Fixed fares, expert drivers, 24/7 support.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        :root {
            --sr-navy-deep: #020914;
            --sr-navy-dark: #071326;
            --sr-purple: #5843F6;
            --sr-blue: #5843F6;
            --sr-white: #FFFFFF;
            --sr-bg-light: #F7F8FC;
            --sr-muted: #667085;
            --sr-gradient: linear-gradient(135deg, #5843F6 0%, #4332D9 100%);
            --sr-font-display: 'Plus Jakarta Sans', sans-serif;
            --sr-font-body: 'Manrope', sans-serif;
        }

        /* ==========================================================================
           CUSTOM FLATPICKR CALENDAR & TIME PICKER DESIGN SYSTEM
           ========================================================================== */
        .flatpickr-calendar {
            background: #ffffff !important;
            border-radius: 20px !important;
            box-shadow: 0 24px 50px rgba(10, 20, 46, 0.22), 0 6px 18px rgba(0, 0, 0, 0.06) !important;
            border: 1px solid #E2E8F0 !important;
            padding: 14px 16px !important;
            font-family: var(--sr-font-display), sans-serif !important;
            width: 320px !important;
            margin-top: 8px !important;
            animation: fpPopIn 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }

        @keyframes fpPopIn {
            from { opacity: 0; transform: translateY(-10px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .flatpickr-calendar.arrowTop::before,
        .flatpickr-calendar.arrowTop::after {
            border-bottom-color: #0A142E !important;
        }
        .flatpickr-calendar.arrowBottom::before,
        .flatpickr-calendar.arrowBottom::after {
            border-top-color: #ffffff !important;
        }

        .flatpickr-months {
            background: linear-gradient(135deg, #0A142E 0%, #162B4E 100%) !important;
            border-radius: 14px !important;
            padding: 10px 14px !important;
            margin-bottom: 12px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            box-shadow: 0 4px 14px rgba(10, 20, 46, 0.25) !important;
        }

        .flatpickr-months .flatpickr-month {
            color: #ffffff !important;
            height: 38px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .flatpickr-current-month {
            font-weight: 800 !important;
            font-size: 15px !important;
            color: #ffffff !important;
            padding: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            font-weight: 800 !important;
            font-size: 15px !important;
            background: transparent !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 3px 8px !important;
            cursor: pointer !important;
            border: none !important;
            outline: none !important;
        }
        .flatpickr-current-month .flatpickr-monthDropdown-months:hover {
            background: rgba(255, 255, 255, 0.15) !important;
        }
        .flatpickr-current-month .flatpickr-monthDropdown-months option {
            background: #0A142E !important;
            color: #ffffff !important;
        }

        .flatpickr-current-month input.cur-year {
            font-weight: 800 !important;
            font-size: 15px !important;
            color: #ffffff !important;
            border: none !important;
            background: transparent !important;
            padding: 2px 4px !important;
            border-radius: 6px !important;
        }
        .flatpickr-current-month input.cur-year:hover {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .flatpickr-months .flatpickr-prev-month,
        .flatpickr-months .flatpickr-next-month {
            color: #ffffff !important;
            fill: #ffffff !important;
            padding: 6px 10px !important;
            border-radius: 10px !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 32px !important;
            width: 32px !important;
            background: rgba(255, 255, 255, 0.08) !important;
        }

        .flatpickr-months .flatpickr-prev-month:hover,
        .flatpickr-months .flatpickr-next-month:hover {
            background: rgba(255, 255, 255, 0.25) !important;
            transform: scale(1.05) !important;
        }

        .flatpickr-months .flatpickr-prev-month svg,
        .flatpickr-months .flatpickr-next-month svg {
            fill: #ffffff !important;
            width: 12px !important;
            height: 12px !important;
        }

        .flatpickr-weekdays {
            margin-bottom: 8px !important;
            height: 28px !important;
        }

        span.flatpickr-weekday {
            color: #64748B !important;
            font-weight: 800 !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.6px !important;
        }

        .dayContainer {
            min-width: 288px !important;
            max-width: 288px !important;
            width: 288px !important;
            justify-content: space-around !important;
        }

        .flatpickr-day {
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 13.5px !important;
            color: #0F172A !important;
            height: 38px !important;
            line-height: 38px !important;
            max-width: 38px !important;
            margin: 2px 0 !important;
            transition: all 0.18s ease !important;
            border: none !important;
        }

        .flatpickr-day:hover {
            background: #F0F6FF !important;
            color: #2563EB !important;
            transform: scale(1.08) !important;
        }

        .flatpickr-day.today {
            border: 2px solid #2563EB !important;
            color: #2563EB !important;
            font-weight: 800 !important;
            background: transparent !important;
        }

        .flatpickr-day.selected,
        .flatpickr-day.selected:hover,
        .flatpickr-day.selected:focus {
            background: linear-gradient(135deg, #4A6CFE 0%, #2563EB 100%) !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4) !important;
            transform: scale(1.05) !important;
        }

        .flatpickr-day.flatpickr-disabled,
        .flatpickr-day.flatpickr-disabled:hover {
            color: #CBD5E1 !important;
            background: transparent !important;
            cursor: not-allowed !important;
            text-decoration: line-through !important;
            opacity: 0.5 !important;
            transform: none !important;
        }

        /* Time Picker Custom Theme */
        .flatpickr-time {
            border-top: 1.5px solid #E2E8F0 !important;
            padding-top: 12px !important;
            margin-top: 10px !important;
            max-height: 54px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 4px !important;
        }

        .flatpickr-time .numInputWrapper {
            height: 38px !important;
            border-radius: 10px !important;
            overflow: hidden !important;
        }

        .flatpickr-time input {
            font-weight: 800 !important;
            font-size: 16px !important;
            color: #0A142E !important;
            background: #F8FAFC !important;
            border-radius: 10px !important;
            border: 1.5px solid #E2E8F0 !important;
            height: 38px !important;
            transition: all 0.2s ease !important;
        }

        .flatpickr-time input:hover,
        .flatpickr-time input:focus {
            background: #F0F6FF !important;
            border-color: #2563EB !important;
            color: #2563EB !important;
        }

        .flatpickr-time .flatpickr-time-separator {
            font-weight: 900 !important;
            color: #2563EB !important;
            font-size: 18px !important;
            height: 38px !important;
            line-height: 36px !important;
            display: inline-flex !important;
            align-items: center !important;
        }

        .flatpickr-time .flatpickr-am-pm {
            font-weight: 800 !important;
            font-size: 13px !important;
            color: #ffffff !important;
            background: linear-gradient(135deg, #4A6CFE 0%, #2563EB 100%) !important;
            border-radius: 10px !important;
            padding: 0 12px !important;
            height: 38px !important;
            line-height: 38px !important;
            margin-left: 8px !important;
            cursor: pointer !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
            transition: all 0.2s ease !important;
        }

        .flatpickr-time .flatpickr-am-pm:hover {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
            transform: translateY(-1px) !important;
        }

        .input-with-icon-wrap {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .input-with-icon-wrap input {
            width: 100%;
            padding-right: 42px !important;
            cursor: pointer;
        }

        .input-with-icon-wrap .input-icon {
            position: absolute;
            right: 14px;
            color: #4A6CFE;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .input-with-icon-wrap input:focus + .input-icon,
        .input-with-icon-wrap input.active + .input-icon {
            color: #2563EB;
        }
            --sr-bg-light: #F7F8FC;
            --sr-muted: #667085;
            --sr-gradient: linear-gradient(135deg, #5843F6 0%, #4332D9 100%);
            --sr-font-display: 'Plus Jakarta Sans', sans-serif;
            --sr-font-body: 'Manrope', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--sr-font-body);
            color: var(--sr-navy-dark);
            background-color: var(--sr-white);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--sr-font-display);
        }

        a {
            text-decoration: none;
        }

        img {
            max-width: 100%;
        }

        .text-gradient {
            background: var(--sr-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.001ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* ===== CUSTOM AUTOCOMPLETE DROPDOWN ===== */
        .custom-autocomplete-dropdown {
            position: absolute !important;
            top: calc(100% + 6px) !important;
            left: 0 !important;
            right: 0 !important;
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 14px !important;
            box-shadow: 0 16px 36px rgba(10, 20, 46, 0.18) !important;
            max-height: 280px !important;
            overflow-y: auto !important;
            z-index: 999999 !important;
            display: none;
        }

        .custom-autocomplete-dropdown::-webkit-scrollbar {
            width: 6px;
        }
        .custom-autocomplete-dropdown::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .custom-autocomplete-dropdown::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .custom-autocomplete-dropdown::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .custom-autocomplete-item {
            padding: 11px 16px !important;
            font-size: 13.5px !important;
            color: #0F172A !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
            border-bottom: 1px solid #f1f5f9 !important;
            transition: background 0.15s ease !important;
        }

        .custom-autocomplete-item:last-child {
            border-bottom: none !important;
        }

        .custom-autocomplete-item:hover,
        .custom-autocomplete-item.active {
            background: #F0EEFF !important;
        }

        .custom-autocomplete-item i {
            color: #5843F6 !important;
            font-size: 14px !important;
            width: 18px !important;
            text-align: center !important;
        }

        .custom-autocomplete-item span.loc-label {
            flex: 1 !important;
            font-weight: 600 !important;
            line-height: 1.3 !important;
        }

        .custom-autocomplete-item span.loc-postcode {
            font-size: 11px !important;
            background: #e0f2fe !important;
            color: #0369a1 !important;
            padding: 2px 7px !important;
            border-radius: 6px !important;
            font-weight: 700 !important;
        }

        .custom-autocomplete-loading,
        .custom-autocomplete-empty {
            padding: 14px 16px !important;
            font-size: 13.5px !important;
            color: #64748b !important;
            text-align: center !important;
        }

        :focus-visible {
            outline: 2px solid var(--sr-blue);
            outline-offset: 2px;
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
            margin-top: 12px;
            margin-bottom: 16px;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.08);
            transition: all 0.3s ease;
        }
        .booking-mileage-badge i { color: #2563eb; font-size: 16px; }
        .booking-mileage-badge strong { color: #1e3a8a; font-weight: 800; font-size: 15px; }

        .input-verified {
            border-color: #16a34a !important;
            background: #f0fdf4 !important;
        }

        /* ==========================================================================
           HEADER & NAVIGATION STYLES
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
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .sr-brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #091932 0%, #162B4E 100%);
            border: 1.5px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            position: relative;
        }
        .sr-brand-mark span.cr-logo {
            font-family: var(--sr-font-display);
            font-weight: 900;
            font-size: 18px;
            background: linear-gradient(135deg, #5843F6 0%, #4332D9 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        .sr-brand-text {
            display: flex;
            flex-direction: column;
        }
        .sr-brand-text .name {
            font-family: var(--sr-font-display);
            font-weight: 900;
            font-size: 19px;
            letter-spacing: 0.5px;
            color: #FFFFFF;
            line-height: 1;
        }
        .sr-brand-text .tag-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 8.5px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #FFB800;
            margin-top: 4px;
            background: rgba(255, 184, 0, 0.12);
            border: 1px solid rgba(255, 184, 0, 0.25);
            padding: 2px 7px;
            border-radius: 4px;
            width: fit-content;
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
            transition: transform 0.2s ease;
        }
        .sr-nav-dropdown {
            position: relative;
        }
        .sr-nav-dropdown:hover a i.chevron {
            transform: rotate(180deg);
        }
        .sr-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            background: rgba(7, 19, 38, 0.98);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 8px 0;
            margin-top: 6px;
            list-style: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            display: none;
            z-index: 1000;
        }
        .sr-nav-dropdown:hover .sr-dropdown-menu {
            display: block;
            animation: srSlideDown .2s ease;
        }
        .sr-dropdown-menu li a {
            padding: 9px 18px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            font-weight: 600;
            display: block;
            transition: all 0.2s ease;
        }
        .sr-dropdown-menu li a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #4A6CFE;
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
           FOOTER STYLES
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

        @media (max-width: 575.98px) {
            .sr-footer { padding: 50px 0 25px; }
            .sr-footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('layout.header')

    @yield('content')

    @include('layout.footer')

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sticky Header Scroll JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var header = document.getElementById('srHeader');
            if (header) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 40) {
                        header.classList.add('sr-scrolled');
                    } else {
                        header.classList.remove('sr-scrolled');
                    }
                });
            }
        });
    </script>

    <!-- Global Autocomplete & Mileage Calculation JS -->
    <script>
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

        function initGlobalLocationAutocomplete() {
            const inputs = [
                document.getElementById('pickup'), 
                document.getElementById('dropoff'),
                document.getElementById('srFrom'),
                document.getElementById('srTo')
            ].filter(Boolean);
            
            inputs.forEach(input => attachCustomAutocompleteToInput(input));
            document.querySelectorAll('.via-input').forEach(input => attachCustomAutocompleteToInput(input));
        }

        // Mobile Sidebar Link Handler
        document.addEventListener('DOMContentLoaded', function () {
            initGlobalLocationAutocomplete();
            initCustomDateAndTimePickers();

            const sidebar = document.getElementById('srMobileSidebar');
            if (sidebar) {
                const links = sidebar.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', function (e) {
                        const href = this.getAttribute('href');
                        if (!href || href === '#' || this.getAttribute('target') === '_blank') return;

                        const bsOffcanvas = bootstrap.Offcanvas.getInstance(sidebar);
                        if (bsOffcanvas) {
                            bsOffcanvas.hide();
                        }

                        if (href.includes('#')) {
                            const hashParts = href.split('#');
                            const targetHash = '#' + hashParts[1];
                            const isSamePage = !hashParts[0] || window.location.pathname === hashParts[0] || hashParts[0] === '{{ route("home") }}';
                            
                            if (isSamePage) {
                                const targetElem = document.querySelector(targetHash);
                                if (targetElem) {
                                    e.preventDefault();
                                    setTimeout(() => {
                                        targetElem.scrollIntoView({ behavior: 'smooth' });
                                    }, 250);
                                }
                            }
                        }
                    });
                });
            }
        });
    </script>

    <!-- Flatpickr JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Global Flatpickr Date & Time Pickers Initializer
        function initCustomDateAndTimePickers() {
            if (typeof flatpickr === 'undefined') return;

            // Date Pickers
            const dateInputs = document.querySelectorAll('.custom-datepicker, input[type="date"]');
            dateInputs.forEach(function(el) {
                if (el.dataset.fpInitialized) return;
                el.dataset.fpInitialized = 'true';

                const initialVal = el.value || el.getAttribute('value') || '';

                if (el.type === 'date') {
                    el.type = 'text';
                }

                flatpickr(el, {
                    dateFormat: 'Y-m-d',
                    altInput: true,
                    altFormat: 'D, j M Y',
                    altInputClass: (el.className ? el.className.replace('custom-datepicker', '') : '') + ' custom-datepicker-alt',
                    minDate: 'today',
                    disableMobile: true,
                    monthSelectorType: 'dropdown',
                    defaultDate: initialVal || null,
                    onChange: function(selectedDates, dateStr, instance) {
                        el.value = dateStr;
                        el.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });

            // Time Pickers
            const timeInputs = document.querySelectorAll('.custom-timepicker, input[type="time"]');
            timeInputs.forEach(function(el) {
                if (el.dataset.fpInitialized) return;
                el.dataset.fpInitialized = 'true';

                const initialVal = el.value || el.getAttribute('value') || '10:00';

                if (el.type === 'time') {
                    el.type = 'text';
                }

                flatpickr(el, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                    altInput: true,
                    altFormat: 'h:i K',
                    altInputClass: (el.className ? el.className.replace('custom-timepicker', '') : '') + ' custom-timepicker-alt',
                    time_24hr: false,
                    disableMobile: true,
                    defaultDate: initialVal || null,
                    onChange: function(selectedDates, dateStr, instance) {
                        el.value = dateStr;
                        el.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        }
    </script>

    @stack('scripts')
</body>
</html>