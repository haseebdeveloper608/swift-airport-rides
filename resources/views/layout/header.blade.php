@php
    $headerNavItems = \App\Models\NavigationItem::getTree();
    $siteName = SettingsHelper::get('site_name', 'Swift-Ride-taxis');
    $siteLogo = SettingsHelper::get('logo', 'images/logo.png');
    $companyPhone = SettingsHelper::get('company_phone', '02033751609');
    $companyEmail = SettingsHelper::get('company_email', 'hoponcars@gmail.com');
@endphp

<!-- ==========================================================================
     HEADER / NAVBAR
     ========================================================================== -->
<header class="sr-header" id="srHeader">
    <!-- Topbar -->
    <div class="sr-topbar border-bottom border-white border-opacity-10 pb-2 pt-1 mb-2" style="background: rgba(2, 7, 16, 0); font-size: 12px;">
        <div class="container px-2 px-sm-3">
            <div class="d-flex align-items-center justify-content-center justify-content-md-between flex-wrap flex-md-nowrap gap-2 text-center text-md-start">
                <!-- Phone & Email (Left on Desktop, Centered on Mobile) -->
                <div class="d-flex align-items-center justify-content-center justify-content-md-start flex-wrap flex-md-nowrap gap-3 gap-sm-4 w-100 w-md-auto">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $companyPhone) }}" class="text-white text-decoration-none d-inline-flex align-items-center gap-1.5 fw-semibold" style="white-space: nowrap;">
                        <i class="bi bi-telephone-fill" style="color: #FF9900;"></i> {{ $companyPhone }}
                    </a>
                    <a href="mailto:{{ $companyEmail }}" class="text-white text-decoration-none d-inline-flex align-items-center gap-1.5 fw-semibold" style="white-space: nowrap;">
                        <i class="bi bi-envelope-fill" style="color: #FF9900;"></i> {{ $companyEmail }}
                    </a>
                </div>

                <!-- 24/7 Support Badge (Right on Desktop, Centered on Mobile) -->
                <div class="d-flex justify-content-center justify-content-md-end w-100 w-md-auto">
                    <span class="sr-topbar-pill" style="border: 1px solid rgba(132, 204, 22, 0.4); background: rgba(132, 204, 22, 0.08); color: #F1F5F9; font-size: 10.5px; font-weight: 700; padding: 3px 12px; border-radius: 50px; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                        <i class="bi bi-radar" style="color: #84CC16;"></i> 24/7 Support &bull; Live Flight Monitoring
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="sr-brand">
                <img src="{{ asset($siteLogo) }}" alt="{{ $siteName }}" class="sr-logo-img">
            </a>

            <!-- Desktop Nav Links (Database Driven) -->
            <ul class="sr-nav-links d-none d-xl-flex">
                @foreach($headerNavItems as $navItem)
                    @if($navItem->hasActiveChildren())
                        <li class="sr-nav-dropdown">
                            <a href="{{ $navItem->url }}" target="{{ $navItem->target }}">
                                {{ $navItem->label }} <i class="bi bi-chevron-down chevron"></i>
                            </a>
                            <ul class="sr-dropdown-menu">
                                @foreach($navItem->activeChildren as $childItem)
                                    <li>
                                        <a href="{{ $childItem->url }}" target="{{ $childItem->target }}">
                                            {{ $childItem->label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ $navItem->url }}" target="{{ $navItem->target }}">
                                {{ $navItem->label }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Header Right Action -->
            <div class="sr-header-right d-none d-md-flex">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $companyPhone) }}" class="sr-phone-box text-decoration-none">
                    <span class="sr-phone-icon"><i class="bi bi-telephone-fill"></i></span>
                    <span class="sr-phone-text">
                        <span class="num d-block">{{ $companyPhone }}</span>
                        <span class="sup">24/7 Support</span>
                    </span>
                </a>
                <a href="{{ route('home') }}#quote" class="sr-header-cta">GET A QUOTE</a>
            </div>

            <!-- Mobile Offcanvas Sidebar Toggler -->
            <button class="sr-navbar-toggler d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#srMobileSidebar" aria-controls="srMobileSidebar" aria-label="Toggle navigation">
                <i class="bi bi-list fs-3"></i>
            </button>
        </div>
    </div>
</header>

<!-- ==========================================================================
     MOBILE OFFCANVAS SIDEBAR DRAWER
     ========================================================================== -->
<div class="offcanvas offcanvas-end sr-offcanvas-sidebar" tabindex="-1" id="srMobileSidebar" aria-labelledby="srMobileSidebarLabel">
    <div class="offcanvas-header border-bottom border-secondary border-opacity-25 pb-3 pt-4 px-4">
        <a href="{{ route('home') }}" class="sr-brand">
            <img src="{{ asset($siteLogo) }}" alt="{{ $siteName }}" class="sr-logo-img">
        </a>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between p-4">
        <!-- Mobile Nav Links (Database Driven) -->
        <ul class="sr-sidebar-nav list-unstyled">
            @foreach($headerNavItems as $navItem)
                @if($navItem->hasActiveChildren())
                    <li class="mb-2">
                        <div class="d-flex align-items-center justify-content-between py-1">
                            <a href="{{ $navItem->url }}" target="{{ $navItem->target }}" class="fw-bold text-white text-decoration-none">
                                {{ $navItem->label }}
                            </a>
                        </div>
                        <ul class="list-unstyled ps-3 mt-1 border-start border-secondary border-opacity-25">
                            @foreach($navItem->activeChildren as $childItem)
                                <li class="py-1">
                                    <a href="{{ $childItem->url }}" target="{{ $childItem->target }}" class="text-white-50 small text-decoration-none">
                                        {{ $childItem->label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="py-2">
                        <a href="{{ $navItem->url }}" target="{{ $navItem->target }}" class="text-white text-decoration-none fw-semibold fs-6">
                            {{ $navItem->label }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        <div class="sr-sidebar-footer pt-3 border-top border-secondary border-opacity-25">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $companyPhone) }}" class="sr-phone-box mb-3 d-flex align-items-center text-decoration-none">
                <span class="sr-phone-icon me-3"><i class="bi bi-telephone-fill"></i></span>
                <span class="sr-phone-text">
                        <span class="num d-block text-white">{{ $companyPhone }}</span>
                    <span class="sup text-white-50">24/7 Customer Support</span>
                </span>
            </a>
            <a href="{{ route('home') }}#quote" class="sr-header-cta d-block text-center w-100 py-3">GET A QUOTE</a>
        </div>
    </div>
</div>
