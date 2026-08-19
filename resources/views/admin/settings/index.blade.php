{{-- PROFESSIONAL SETTINGS PAGE --}}
{{-- resources/views/admin/settings/index.blade.php --}}

@extends('admin.layout.app')

@section('title', 'Website Settings')
@section('page_title', 'Settings')
@section('page_subtitle', 'Configure your website appearance, integrations and SEO')

@section('styles')
<style>
    /* ============================================
       SETTINGS PAGE UNIQUE STYLES - OTS CUSTOM
    ============================================ */
    
    /* Root Variables - Settings Specific */
    :root {
        --ots-settings-primary: #2E6BE6;
        --ots-settings-primary-dark: #2E6BE6;
        --ots-settings-primary-light: #EBF1FF;
        --ots-settings-success: #10b981;
        --ots-settings-warning: #F2C400;
        --ots-settings-danger: #ef4444;
        --ots-settings-dark: #0A142E;
        --ots-settings-gray: #64748b;
        --ots-settings-gray-light: #94a3b8;
        --ots-settings-light: #f8fafc;
        --ots-settings-border: #e2e8f0;
        --ots-settings-card-bg: #ffffff;
        --ots-settings-sidebar-bg: #fafbfc;
    }

    /* Main Container */
    .ots-settings-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Header Section */
    .ots-settings-header {
        margin-bottom: 2rem;
    }

    .ots-settings-header h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--ots-settings-dark);
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .ots-settings-header p {
        color: var(--ots-settings-gray);
        font-size: 0.875rem;
    }

    /* Alert Message */
    .ots-settings-alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--ots-settings-success);
        color: white;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        animation: otsSettingsSlideDown 0.3s ease;
    }

    @keyframes otsSettingsSlideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .ots-settings-alert i {
        font-size: 1.25rem;
    }

    .ots-settings-alert-close {
        margin-left: auto;
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .ots-settings-alert-close:hover {
        opacity: 1;
    }

    /* Main Grid Layout */
    .ots-settings-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 1.5rem;
        background: transparent;
    }

    /* Sidebar Navigation */
    .ots-settings-sidebar {
        background: var(--ots-settings-card-bg);
        border-radius: 20px;
        border: 1px solid var(--ots-settings-border);
        padding: 1rem;
        position: sticky;
        top: 2rem;
        height: fit-content;
    }

    .ots-settings-nav-group {
        margin-bottom: 1.5rem;
    }

    .ots-settings-nav-group:last-child {
        margin-bottom: 0;
    }

    .ots-settings-nav-group-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--ots-settings-gray-light);
        padding: 0.5rem 0.75rem;
        margin-bottom: 0.25rem;
    }

    .ots-settings-nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: none;
        background: transparent;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--ots-settings-gray);
        cursor: pointer;
        transition: all 0.2s;
        text-align: left;
    }

    .ots-settings-nav-item i {
        width: 20px;
        font-size: 1rem;
        color: var(--ots-settings-gray-light);
        transition: all 0.2s;
    }

    .ots-settings-nav-item:hover {
        background: var(--ots-settings-light);
        color: var(--ots-settings-dark);
    }

    .ots-settings-nav-item:hover i {
        color: var(--ots-settings-primary);
    }

    .ots-settings-nav-item.active {
        background: var(--ots-settings-primary-light);
        color: var(--ots-settings-primary);
    }

    .ots-settings-nav-item.active i {
        color: var(--ots-settings-primary);
    }

    /* Main Content Area */
    .ots-settings-content {
        background: var(--ots-settings-card-bg);
        border-radius: 20px;
        border: 1px solid var(--ots-settings-border);
        overflow: hidden;
    }

    /* Settings Sections */
    .ots-settings-section {
        display: none;
        padding: 2rem;
        animation: otsSettingsFadeIn 0.3s ease;
    }

    .ots-settings-section.active {
        display: block;
    }

    @keyframes otsSettingsFadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Section Headers */
    .ots-settings-section-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--ots-settings-border);
    }

    .ots-settings-section-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--ots-settings-dark);
        margin-bottom: 0.25rem;
    }

    .ots-settings-section-header p {
        font-size: 0.875rem;
        color: var(--ots-settings-gray);
    }

    /* Form Groups */
    .ots-settings-form-group {
        margin-bottom: 1.5rem;
    }

    .ots-settings-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--ots-settings-dark);
        margin-bottom: 0.5rem;
    }

    .ots-settings-form-label i {
        margin-right: 0.5rem;
        color: var(--ots-settings-primary);
        font-size: 0.875rem;
    }

    .ots-settings-form-input,
    .ots-settings-form-textarea,
    .ots-settings-form-select {
        width: 100%;
        padding: 0.625rem 1rem;
        border: 1.5px solid var(--ots-settings-border);
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.2s;
        outline: none;
        font-family: inherit;
    }

    .ots-settings-form-input:focus,
    .ots-settings-form-textarea:focus,
    .ots-settings-form-select:focus {
        border-color: var(--ots-settings-primary);
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
    }

    .ots-settings-form-textarea {
        min-height: 100px;
        resize: vertical;
        font-family: 'Courier New', monospace;
    }

    .ots-settings-form-hint {
        font-size: 0.75rem;
        color: var(--ots-settings-gray-light);
        margin-top: 0.375rem;
    }

    .ots-settings-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    /* Upload Area */
    .ots-settings-upload-area {
        border: 2px dashed var(--ots-settings-border);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: var(--ots-settings-light);
    }

    .ots-settings-upload-area:hover {
        border-color: var(--ots-settings-primary);
        background: var(--ots-settings-primary-light);
    }

    .ots-settings-upload-icon {
        font-size: 2rem;
        color: var(--ots-settings-primary);
        margin-bottom: 0.5rem;
        display: block;
    }

    .ots-settings-upload-title {
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .ots-settings-upload-subtitle {
        font-size: 0.75rem;
        color: var(--ots-settings-gray-light);
    }

    /* Image Preview */
    .ots-settings-image-preview {
        margin-top: 1rem;
        padding: 1rem;
        background: var(--ots-settings-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .ots-settings-image-preview img {
        max-width: 120px;
        max-height: 60px;
        object-fit: contain;
    }

    .ots-settings-favicon-preview img {
        width: 32px;
        height: 32px;
    }

    .ots-settings-preview-info {
        flex: 1;
    }

    .ots-settings-preview-info strong {
        display: block;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .ots-settings-preview-info span {
        font-size: 0.75rem;
        color: var(--ots-settings-gray);
    }

    /* Code Editor */
    .ots-settings-code-editor {
        font-family: 'Courier New', 'Monaco', monospace;
        font-size: 0.8rem;
        background: #1e1e2e;
        color: #e2e8f0;
        border: none;
    }

    /* Dividers */
    .ots-settings-divider {
        border: none;
        border-top: 1px solid var(--ots-settings-border);
        margin: 1.5rem 0;
    }

    /* Footer Actions */
    .ots-settings-section-footer {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--ots-settings-border);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    /* Buttons */
    .ots-settings-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.5rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        font-family: inherit;
    }

    .ots-settings-btn-primary {
        background: var(--ots-settings-primary);
        color: white;
    }

    .ots-settings-btn-primary:hover {
        background: var(--ots-settings-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(46, 107, 230, 0.3);
    }

    .ots-settings-btn-secondary {
        background: white;
        color: var(--ots-settings-gray);
        border: 1.5px solid var(--ots-settings-border);
    }

    .ots-settings-btn-secondary:hover {
        border-color: var(--ots-settings-primary);
        color: var(--ots-settings-primary);
        background: var(--ots-settings-primary-light);
    }

    .ots-settings-btn-danger {
        background: white;
        color: var(--ots-settings-danger);
        border: 1.5px solid var(--ots-settings-danger);
    }

    .ots-settings-btn-danger:hover {
        background: var(--ots-settings-danger);
        color: white;
    }

    /* Loading State */
    .ots-settings-btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .ots-settings-btn.loading i {
        animation: otsSettingsSpin 1s linear infinite;
    }

    @keyframes otsSettingsSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Badge */
    .ots-settings-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.75rem;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--ots-settings-primary-light);
        color: var(--ots-settings-primary);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .ots-settings-wrapper {
            padding: 1rem;
        }

        .ots-settings-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .ots-settings-sidebar {
            position: static;
            padding: 0.75rem;
        }

        .ots-settings-section {
            padding: 1.5rem;
        }

        .ots-settings-form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .ots-settings-section-footer {
            flex-direction: column-reverse;
        }

        .ots-settings-btn {
            width: 100%;
            justify-content: center;
        }

        .ots-settings-nav-group {
            display: inline-block;
            margin-right: 0.5rem;
        }

        .ots-settings-nav-group-title {
            display: none;
        }

        .ots-settings-nav-item {
            display: inline-flex;
            width: auto;
        }
    }

    /* Custom Scrollbar */
    .ots-settings-wrapper::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .ots-settings-wrapper::-webkit-scrollbar-track {
        background: var(--ots-settings-light);
    }

    .ots-settings-wrapper::-webkit-scrollbar-thumb {
        background: var(--ots-settings-border);
        border-radius: 4px;
    }

    .ots-settings-wrapper::-webkit-scrollbar-thumb:hover {
        background: var(--ots-settings-gray-light);
    }
</style>
@endsection

@section('content')
<div class="ots-settings-wrapper">
    {{-- Header --}}
    <div class="ots-settings-header">
        <h1>Website Settings</h1>
        <p>Configure your website appearance, integrations and SEO</p>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="ots-settings-alert" id="otsSettingsAlert">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button class="ots-settings-alert-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="otsSettingsForm">
        @csrf

        <div class="ots-settings-grid">
            {{-- Sidebar Navigation --}}
            <div class="ots-settings-sidebar">
                <div class="ots-settings-nav-group">
                    <div class="ots-settings-nav-group-title">General</div>
                    <button type="button" class="ots-settings-nav-item active" data-ots-tab="basic">
                        <i class="fas fa-info-circle"></i>
                        Basic Info
                    </button>
                    <button type="button" class="ots-settings-nav-item" data-ots-tab="branding">
                        <i class="fas fa-palette"></i>
                        Branding
                    </button>
                </div>

                <div class="ots-settings-nav-group">
                    <div class="ots-settings-nav-group-title">Integrations</div>
                    <button type="button" class="ots-settings-nav-item" data-ots-tab="social">
                        <i class="fas fa-share-alt"></i>
                        Social Links
                    </button>
                    <button type="button" class="ots-settings-nav-item" data-ots-tab="analytics">
                        <i class="fas fa-chart-line"></i>
                        Analytics
                    </button>
                </div>

                <div class="ots-settings-nav-group">
                    <div class="ots-settings-nav-group-title">Advanced</div>
                    <button type="button" class="ots-settings-nav-item" data-ots-tab="code">
                        <i class="fas fa-code"></i>
                        Custom Code
                    </button>
                    <button type="button" class="ots-settings-nav-item" data-ots-tab="advanced">
                        <i class="fas fa-database"></i>
                        System Config
                    </button>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="ots-settings-content">
                {{-- Basic Info Section --}}
                <div class="ots-settings-section active" id="otsTabBasic">
                    <div class="ots-settings-section-header">
                        <h2>Basic Information</h2>
                        <p>Core settings that define your website identity</p>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-globe"></i> Site Name</label>
                        <input type="text" name="site_name" class="ots-settings-form-input" value="{{ $setting->site_name ?? '' }}" placeholder="Your Website Name">
                        <div class="ots-settings-form-hint">Appears in browser tabs, headers, and email subjects</div>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-copyright"></i> Copyright Text</label>
                        <input type="text" name="copyright_text" class="ots-settings-form-input" value="{{ $setting->copyright_text ?? '' }}" placeholder="© 2024 Your Company. All rights reserved.">
                        <div class="ots-settings-form-hint">Displayed in the footer of your website</div>
                    </div>

                    <div class="ots-settings-form-row">
                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fas fa-envelope"></i> Company Email</label>
                            <input type="email" name="company_email" class="ots-settings-form-input" value="{{ $setting->company_email ?? '' }}" placeholder="contact@example.com">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fas fa-phone"></i> Company Phone</label>
                            <input type="text" name="company_phone" class="ots-settings-form-input" value="{{ $setting->company_phone ?? '' }}" placeholder="+1 234 567 8900">
                        </div>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-map-marker-alt"></i> Company Address</label>
                        <input type="text" name="company_address" class="ots-settings-form-input" value="{{ $setting->company_address ?? '' }}" placeholder="123 Business St, City, Country">
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-info-circle"></i> Footer About</label>
                        <textarea name="footer_about" class="ots-settings-form-textarea" placeholder="Write a brief description about your company...">{{ $setting->footer_about ?? '' }}</textarea>
                        <div class="ots-settings-form-hint">Short description shown in the footer section</div>
                    </div>

                    <div class="ots-settings-section-footer">
                        <button type="button" class="ots-settings-btn ots-settings-btn-secondary" onclick="otsSettingsResetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="ots-settings-btn ots-settings-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>

                {{-- Branding Section --}}
                <div class="ots-settings-section" id="otsTabBranding">
                    <div class="ots-settings-section-header">
                        <h2>Branding Assets</h2>
                        <p>Upload your logo and favicon</p>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-image"></i> Website Logo</label>
                        <div class="ots-settings-upload-area" onclick="document.getElementById('otsLogoInput').click()">
                            <input type="file" name="logo" id="otsLogoInput" accept="image/*" style="display: none;">
                            <i class="fas fa-cloud-upload-alt ots-settings-upload-icon"></i>
                            <div class="ots-settings-upload-title">Click to upload logo</div>
                            <div class="ots-settings-upload-subtitle">PNG, JPG, SVG up to 2MB</div>
                        </div>
                        @if(!empty($setting->logo))
                        <div class="ots-settings-image-preview" id="otsLogoPreview">
                            <img src="{{ asset($setting->logo) }}" alt="Logo">
                            <div class="ots-settings-preview-info">
                                <strong>Current Logo</strong>
                                <span>Active</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="ots-settings-divider"></div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-star"></i> Favicon</label>
                        <div class="ots-settings-upload-area" onclick="document.getElementById('otsFaviconInput').click()">
                            <input type="file" name="favicon" id="otsFaviconInput" accept="image/png,image/x-icon" style="display: none;">
                            <i class="fas fa-cloud-upload-alt ots-settings-upload-icon"></i>
                            <div class="ots-settings-upload-title">Click to upload favicon</div>
                            <div class="ots-settings-upload-subtitle">PNG, ICO up to 1MB (32x32px recommended)</div>
                        </div>
                        @if(!empty($setting->favicon))
                        <div class="ots-settings-image-preview ots-settings-favicon-preview" id="otsFaviconPreview">
                            <img src="{{ asset($setting->favicon) }}" alt="Favicon">
                            <div class="ots-settings-preview-info">
                                <strong>Current Favicon</strong>
                                <span>Active</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="ots-settings-section-footer">
                        <button type="button" class="ots-settings-btn ots-settings-btn-secondary" onclick="otsSettingsResetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="ots-settings-btn ots-settings-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>

                {{-- Social Links Section --}}
                <div class="ots-settings-section" id="otsTabSocial">
                    <div class="ots-settings-section-header">
                        <h2>Social Media Links</h2>
                        <p>Connect your website with social platforms</p>
                    </div>

                    <div class="ots-settings-form-row">
                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-facebook-f"></i> Facebook</label>
                            <input type="url" name="facebook" class="ots-settings-form-input" value="{{ $setting->facebook ?? '' }}" placeholder="https://facebook.com/yourpage">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-x-twitter"></i> X (Twitter)</label>
                            <input type="url" name="twitter" class="ots-settings-form-input" value="{{ $setting->twitter ?? '' }}" placeholder="https://x.com/yourhandle">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-linkedin-in"></i> LinkedIn</label>
                            <input type="url" name="linkedin" class="ots-settings-form-input" value="{{ $setting->linkedin ?? '' }}" placeholder="https://linkedin.com/company/yourco">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-youtube"></i> YouTube</label>
                            <input type="url" name="youtube" class="ots-settings-form-input" value="{{ $setting->youtube ?? '' }}" placeholder="https://youtube.com/@yourchannel">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-instagram"></i> Instagram</label>
                            <input type="url" name="instagram" class="ots-settings-form-input" value="{{ $setting->instagram ?? '' }}" placeholder="https://instagram.com/yourhandle">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-pinterest"></i> Pinterest</label>
                            <input type="url" name="pinterest" class="ots-settings-form-input" value="{{ $setting->pinterest ?? '' }}" placeholder="https://pinterest.com/yourhandle">
                        </div>

                        <div class="ots-settings-form-group">
                            <label class="ots-settings-form-label"><i class="fab fa-quora"></i> Quora</label>
                            <input type="url" name="quora" class="ots-settings-form-input" value="{{ $setting->quora ?? '' }}" placeholder="https://quora.com/profile/yourprofile">
                        </div>
                    </div>

                    <div class="ots-settings-section-footer">
                        <button type="button" class="ots-settings-btn ots-settings-btn-secondary" onclick="otsSettingsResetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="ots-settings-btn ots-settings-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>

                {{-- Analytics Section --}}
                <div class="ots-settings-section" id="otsTabAnalytics">
                    <div class="ots-settings-section-header">
                        <h2>Analytics & Tracking</h2>
                        <p>Monitor your website traffic and user behavior</p>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fab fa-google"></i> Google Analytics ID</label>
                        <input type="text" name="google_analytics_id" class="ots-settings-form-input" value="{{ $setting->google_analytics_id ?? '' }}" placeholder="G-XXXXXXXXXX or UA-XXXXX-X">
                        <div class="ots-settings-form-hint">GA4 format: <code>G-XXXXXXXXXX</code> | Universal: <code>UA-XXXXX-X</code></div>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fab fa-facebook-f"></i> Meta Pixel ID</label>
                        <input type="text" name="facebook_pixel_id" class="ots-settings-form-input" value="{{ $setting->facebook_pixel_id ?? '' }}" placeholder="123456789012345">
                        <div class="ots-settings-form-hint">Numeric ID from Meta Events Manager</div>
                    </div>

                    <div class="ots-settings-section-footer">
                        <button type="button" class="ots-settings-btn ots-settings-btn-secondary" onclick="otsSettingsResetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="ots-settings-btn ots-settings-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>

                {{-- Custom Code Section --}}
                <div class="ots-settings-section" id="otsTabCode">
                    <div class="ots-settings-section-header">
                        <h2>Custom Code</h2>
                        <p>Add custom scripts, styles, or tracking codes</p>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-code"></i> Header Code</label>
                        <textarea name="header_code" class="ots-settings-form-textarea ots-settings-code-editor" placeholder="<!-- Add scripts, meta tags, or styles that go in <head> -->">{{ $setting->header_code ?? '' }}</textarea>
                        <div class="ots-settings-form-hint">Injected before closing <code>&lt;/head&gt;</code> tag</div>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-code"></i> Footer Code</label>
                        <textarea name="footer_code" class="ots-settings-form-textarea ots-settings-code-editor" placeholder="<!-- Add analytics, chat widgets, or other scripts -->">{{ $setting->footer_code ?? '' }}</textarea>
                        <div class="ots-settings-form-hint">Injected before closing <code>&lt;/body&gt;</code> tag</div>
                    </div>

                    <div class="ots-settings-section-footer">
                        <button type="button" class="ots-settings-btn ots-settings-btn-secondary" onclick="otsSettingsResetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="ots-settings-btn ots-settings-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>

                {{-- Advanced Settings Section --}}
                <div class="ots-settings-section" id="otsTabAdvanced">
                    <div class="ots-settings-section-header">
                        <h2>System Configuration</h2>
                        <p>Advanced settings for email, payment, and API integrations</p>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-envelope"></i> SMTP Configuration</label>
                        <div class="ots-settings-form-row">
                            <input type="text" name="MAIL_HOST" class="ots-settings-form-input" placeholder="Mail Host" value="{{ env('MAIL_HOST') }}">
                            <input type="text" name="MAIL_PORT" class="ots-settings-form-input" placeholder="Port" value="{{ env('MAIL_PORT') }}">
                            <input type="text" name="MAIL_USERNAME" class="ots-settings-form-input" placeholder="Username" value="{{ env('MAIL_USERNAME') }}">
                            <input type="password" name="MAIL_PASSWORD" class="ots-settings-form-input" placeholder="Password" value="{{ env('MAIL_PASSWORD') }}">
                            <input type="text" name="MAIL_ENCRYPTION" class="ots-settings-form-input" placeholder="Encryption (tls/ssl)" value="{{ env('MAIL_ENCRYPTION') }}">
                            <input type="email" name="MAIL_FROM_ADDRESS" class="ots-settings-form-input" placeholder="From Address" value="{{ env('MAIL_FROM_ADDRESS') }}">
                        </div>
                    </div>

                    <div class="ots-settings-divider"></div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fab fa-stripe"></i> Stripe Integration</label>
                        <div class="ots-settings-form-row">
                            <input type="text" name="STRIPE_KEY" class="ots-settings-form-input" placeholder="Publishable Key" value="{{ env('STRIPE_KEY') }}">
                            <input type="password" name="STRIPE_SECRET" class="ots-settings-form-input" placeholder="Secret Key" value="{{ env('STRIPE_SECRET') }}">
                            <input type="password" name="STRIPE_WEBHOOK_SECRET" class="ots-settings-form-input" placeholder="Webhook Secret" value="{{ env('STRIPE_WEBHOOK_SECRET') }}">
                        </div>
                    </div>

                    <div class="ots-settings-divider"></div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-map-marked-alt"></i> Google Maps API</label>
                        <input type="text" name="GOOGLE_MAPS_API_KEY" class="ots-settings-form-input" placeholder="API Key" value="{{ env('GOOGLE_MAPS_API_KEY') }}">
                        <div class="ots-settings-form-hint">Required for location features and maps integration</div>
                    </div>

                    <div class="ots-settings-form-group">
                        <label class="ots-settings-form-label"><i class="fas fa-edit"></i> TinyMCE API Key</label>
                        <input type="text" name="TINYMCE_API_KEY" class="ots-settings-form-input" placeholder="API Key" value="{{ env('TINYMCE_API_KEY') }}">
                        <div class="ots-settings-form-hint">Required for the rich text editor. Get your free key at <a href="https://www.tiny.cloud/" target="_blank">https://www.tiny.cloud/</a></div>
                    </div>

                    <div class="ots-settings-section-footer">
                        <button type="button" class="ots-settings-btn ots-settings-btn-secondary" onclick="otsSettingsResetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="ots-settings-btn ots-settings-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const otsNavItems = document.querySelectorAll('.ots-settings-nav-item');
    const otsSections = document.querySelectorAll('.ots-settings-section');

    otsNavItems.forEach(item => {
        item.addEventListener('click', function() {
            const tabId = this.dataset.otsTab;
            
            // Update active states
            otsNavItems.forEach(nav => nav.classList.remove('active'));
            otsSections.forEach(section => section.classList.remove('active'));
            
            this.classList.add('active');
            const activeSection = document.getElementById(`otsTab${tabId.charAt(0).toUpperCase() + tabId.slice(1)}`);
            if (activeSection) {
                activeSection.classList.add('active');
            }
        });
    });

    // Logo preview
    const otsLogoInput = document.getElementById('otsLogoInput');
    if (otsLogoInput) {
        otsLogoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    let preview = document.getElementById('otsLogoPreview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'otsLogoPreview';
                        preview.className = 'ots-settings-image-preview';
                        otsLogoInput.parentElement.after(preview);
                    }
                    preview.innerHTML = `
                        <img src="${ev.target.result}" alt="Logo Preview">
                        <div class="ots-settings-preview-info">
                            <strong>New Logo</strong>
                            <span>Pending save</span>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Favicon preview
    const otsFaviconInput = document.getElementById('otsFaviconInput');
    if (otsFaviconInput) {
        otsFaviconInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    let preview = document.getElementById('otsFaviconPreview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'otsFaviconPreview';
                        preview.className = 'ots-settings-image-preview ots-settings-favicon-preview';
                        otsFaviconInput.parentElement.after(preview);
                    }
                    preview.innerHTML = `
                        <img src="${ev.target.result}" alt="Favicon Preview">
                        <div class="ots-settings-preview-info">
                            <strong>New Favicon</strong>
                            <span>Pending save</span>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Form submission loading state
    const otsForm = document.getElementById('otsSettingsForm');
    otsForm.addEventListener('submit', function() {
        const submitBtn = document.querySelector('.ots-settings-btn-primary');
        if (submitBtn) {
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Saving...';
        }
    });

    // Auto-dismiss alert
    const otsAlert = document.getElementById('otsSettingsAlert');
    if (otsAlert) {
        setTimeout(() => {
            otsAlert.style.opacity = '0';
            setTimeout(() => otsAlert.remove(), 300);
        }, 5000);
    }
});

// Reset form function
function otsSettingsResetForm() {
    if (confirm('Are you sure you want to reset all unsaved changes?')) {
        document.getElementById('otsSettingsForm').reset();
        // Also clear image previews
        const logoPreview = document.getElementById('otsLogoPreview');
        const faviconPreview = document.getElementById('otsFaviconPreview');
        if (logoPreview && logoPreview.innerHTML.includes('Pending save')) {
            logoPreview.remove();
        }
        if (faviconPreview && faviconPreview.innerHTML.includes('Pending save')) {
            faviconPreview.remove();
        }
    }
}

// Keyboard shortcut (Ctrl+S)
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        document.getElementById('otsSettingsForm').requestSubmit();
    }
});
</script>
@endsection