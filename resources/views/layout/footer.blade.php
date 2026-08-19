@php
    $siteName = SettingsHelper::get('site_name', 'Swift-Ride-taxis');
    $companyPhone = SettingsHelper::get('company_phone', '020 1234 5678');
    $companyEmail = SettingsHelper::get('company_email', 'support@swiftridetaxis.co.uk');
    $companyAddress = SettingsHelper::get('company_address');
    $footerAbout = SettingsHelper::get('footer_about', 'Professional airport transfers, private taxi services and city-to-city rides across the UK.');
    $copyrightText = SettingsHelper::get('copyright_text', $siteName . '. All Rights Reserved.');
    $socialLinks = [
        'facebook' => ['label' => 'Facebook', 'icon' => 'bi-facebook'],
        'twitter' => ['label' => 'Twitter', 'icon' => 'bi-twitter-x'],
        'linkedin' => ['label' => 'LinkedIn', 'icon' => 'bi-linkedin'],
        'youtube' => ['label' => 'YouTube', 'icon' => 'bi-youtube'],
        'instagram' => ['label' => 'Instagram', 'icon' => 'bi-instagram'],
        'pinterest' => ['label' => 'Pinterest', 'icon' => 'bi-pinterest'],
        'quora' => ['label' => 'Quora', 'icon' => 'bi-quora'],
    ];
    $footerPages = [
        ['label' => 'About Us', 'route' => 'about'],
        ['label' => 'Contact Us', 'route' => 'contact'],
        ['label' => 'FAQs', 'route' => 'faqs'],
        ['label' => 'Blog', 'route' => 'blog.index'],
    ];
    $footerPages = array_values(array_filter($footerPages, fn ($page) => \Illuminate\Support\Facades\Route::has($page['route'])));
@endphp

<!-- ==========================================================================
     FOOTER
     ========================================================================== -->
<footer class="sr-footer" id="contact">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('home') }}" class="sr-brand mb-3">
                    <span class="sr-brand-mark">
                        <span class="cr-logo">SR</span>
                    </span>
                    <span class="sr-brand-text">
                        <span class="name">{{ $siteName }}</span>
                        <span class="tag-badge"><i class="bi bi-shield-check me-1"></i> PREMIUM AIRPORT TRANSFERS</span>
                    </span>
                </a>
                <p class="mt-3 text-white-50" style="font-size:14px; max-width:320px;">
                    {{ $footerAbout }}
                </p>
                @if(array_filter(array_map(fn ($social) => SettingsHelper::get($social), array_keys($socialLinks))))
                    <div class="d-flex gap-2 mt-3">
                        @foreach($socialLinks as $key => $social)
                            @if(SettingsHelper::get($key))
                                <a href="{{ SettingsHelper::get($key) }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}" class="text-white-50">
                                    <i class="bi {{ $social['icon'] }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6>Services</h6>
                <ul>
                    <li><a href="{{ route('home') }}#services">Airport Transfers</a></li>
                    <li><a href="{{ route('home') }}#services">City Transfers</a></li>
                    <li><a href="{{ route('home') }}#services">Business Travel</a></li>
                    <li><a href="{{ route('home') }}#services">Hourly Hire</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 col-6">
                <h6>Quick Links</h6>
                <ul>
                    @foreach($footerPages as $page)
                        <li><a href="{{ route($page['route']) }}">{{ $page['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6>Contact &amp; Support</h6>
                <ul>
                    <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $companyPhone) }}"><i class="bi bi-telephone-fill text-primary me-2"></i> {{ $companyPhone }}</a></li>
                    <li><a href="#"><i class="bi bi-clock-fill text-primary me-2"></i> 24/7 Customer Support</a></li>
                    <li><a href="mailto:{{ $companyEmail }}"><i class="bi bi-envelope-fill text-primary me-2"></i> {{ $companyEmail }}</a></li>
                    @if($companyAddress)
                        <li><span><i class="bi bi-geo-alt-fill text-primary me-2"></i> {{ $companyAddress }}</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="sr-footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $copyrightText }}</span>
            <div class="d-flex gap-4">
                <a href="{{ route('privacy') }}" class="text-white-50 text-decoration-none">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-white-50 text-decoration-none">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
