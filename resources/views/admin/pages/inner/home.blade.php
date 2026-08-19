{{-- resources/views/admin/pages/inner/home.blade.php --}}

@extends('admin.layout.app')

@section('title', 'Website Settings')
@section('page_title', 'Website Settings')
@section('page_subtitle', 'Manage all homepage sections dynamically')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ============================================
   HOMEPAGE CMS - UNIQUE CLASSES
   Prefix: hocms- (Homepage CMS)
   ============================================ */

:root {
    --hocms-bg-primary: #f8fafc;
    --hocms-bg-secondary: #ffffff;
    --hocms-bg-tertiary: #f1f5f9;
    --hocms-border-light: #e2e8f0;
    --hocms-border-medium: #cbd5e1;
    --hocms-text-primary: #0A142E;
    --hocms-text-secondary: #475569;
    --hocms-text-muted: #64748b;
    --hocms-text-disabled: #94a3b8;
    --hocms-accent: #2E6BE6;
    --hocms-accent-dark: #2E6BE6;
    --hocms-accent-light: #EBF1FF;
    --hocms-success: #10b981;
    --hocms-success-light: #d1fae5;
    --hocms-danger: #ef4444;
    --hocms-danger-light: #fee2e2;
    --hocms-gradient-primary: linear-gradient(135deg, #2E6BE6 0%, #2E6BE6 100%);
    --hocms-shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
    --hocms-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
    --hocms-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --hocms-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --hocms-radius-sm: 0.375rem;
    --hocms-radius-md: 0.5rem;
    --hocms-radius-lg: 0.75rem;
    --hocms-radius-xl: 1rem;
    --hocms-transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
    --hocms-transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
    --hocms-transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
}

.hocms-wrapper * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.hocms-wrapper {
    font-family: 'Inter', sans-serif;
    background: var(--hocms-bg-primary);
    color: var(--hocms-text-primary);
    line-height: 1.5;
}

.hocms-shell {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 0;
    min-height: 100vh;
}

.hocms-rail {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    background: var(--hocms-bg-secondary);
    border-right: 1px solid var(--hocms-border-light);
    display: flex;
    flex-direction: column;
}

.hocms-rail-logo {
    padding: 28px 24px;
    border-bottom: 1px solid var(--hocms-border-light);
    margin-bottom: 24px;
}

.hocms-rail-logo span {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--hocms-accent);
    background: var(--hocms-accent-light);
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 12px;
}

.hocms-rail-logo strong {
    display: block;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--hocms-text-primary);
}

.hocms-nav-section-label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--hocms-text-disabled);
    padding: 0 20px;
    margin: 8px 0 12px;
}

.hocms-nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 20px;
    margin: 4px 12px;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--hocms-text-secondary);
    cursor: pointer;
    transition: var(--hocms-transition-fast);
    border: none;
    background: none;
    width: calc(100% - 24px);
    text-align: left;
    border-radius: var(--hocms-radius-md);
}

.hocms-nav-item:hover {
    background: var(--hocms-bg-tertiary);
    color: var(--hocms-text-primary);
}

.hocms-nav-item.active {
    background: var(--hocms-accent-light);
    color: var(--hocms-accent);
}

.hocms-nav-icon {
    width: 32px;
    height: 32px;
    border-radius: var(--hocms-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--hocms-bg-tertiary);
    color: var(--hocms-text-secondary);
}

.hocms-nav-item.active .hocms-nav-icon {
    background: var(--hocms-accent);
    color: white;
}

.hocms-nav-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--hocms-accent);
    margin-left: auto;
    opacity: 0;
}

.hocms-nav-item.active .hocms-nav-dot {
    opacity: 1;
}

.hocms-main {
    padding: 48px 56px 80px;
    max-width: 1200px;
}

.hocms-page-header {
    margin-bottom: 48px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.hocms-page-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.hocms-page-header p {
    font-size: 0.9375rem;
    color: var(--hocms-text-secondary);
}

.hocms-status-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border-radius: 100px;
    background: var(--hocms-success-light);
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--hocms-success);
}

.hocms-card-wrapper {
    background: var(--hocms-bg-secondary);
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-xl);
    margin-bottom: 24px;
    overflow: hidden;
}

.hocms-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 28px;
    cursor: pointer;
    border-bottom: 1px solid var(--hocms-border-light);
    transition: background var(--hocms-transition-fast);
}

.hocms-section-header:hover {
    background: var(--hocms-bg-tertiary);
}

.hocms-section-title {
    display: flex;
    align-items: center;
    gap: 16px;
}

.hocms-section-badge {
    width: 44px;
    height: 44px;
    border-radius: var(--hocms-radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    background: var(--hocms-gradient-primary);
    color: white;
}

.hocms-section-title h3 {
    font-size: 1.0625rem;
    font-weight: 600;
    margin-bottom: 4px;
}

.hocms-section-title p {
    font-size: 0.8125rem;
    color: var(--hocms-text-muted);
}

.hocms-section-meta {
    display: flex;
    align-items: center;
    gap: 12px;
}

.hocms-section-count {
    font-size: 0.75rem;

    .hocms-image-dual-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 16px;
    }

    .hocms-image-input-section {
        border: 1px solid var(--hocms-border-light);
        border-radius: var(--hocms-radius-lg);
        padding: 16px;
        background: var(--hocms-bg-secondary);
    }

    .hocms-image-input-section h5 {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--hocms-text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .hocms-image-input-section h5 i {
        color: var(--hocms-accent);
        font-size: 1rem;
    }

    .hocms-image-input-url {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .hocms-image-input-url .hocms-field-input {
        width: 100%;
    }

    .hocms-image-preview-box {
        width: 100%;
        height: 160px;
        background: var(--hocms-bg-tertiary);
        border: 1px dashed var(--hocms-border-light);
        border-radius: var(--hocms-radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: var(--hocms-text-muted);
        font-size: 0.875rem;
    }

    .hocms-image-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hocms-file-drop-text {
        font-weight: 600;
        font-size: 0.9375rem;
        color: var(--hocms-text-primary);
        margin: 0;
    }

    .hocms-file-drop-subtext {
        font-size: 0.75rem;
        color: var(--hocms-text-muted);
        margin-top: 4px;
    }

    .hocms-file-input-label {
        display: block;
        position: relative;
        cursor: pointer;
    }
    font-weight: 600;
    color: var(--hocms-accent);
    background: var(--hocms-accent-light);
    padding: 4px 10px;
    border-radius: 20px;
}

.hocms-section-toggle {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--hocms-bg-tertiary);
    border-radius: var(--hocms-radius-sm);
    transition: transform var(--hocms-transition-base);
}

.hocms-section-toggle.open {
    transform: rotate(180deg);
}

.hocms-section-body {
    padding: 28px;
    border-top: 1px solid var(--hocms-border-light);
}

.hocms-section-body.hidden {
    display: none;
}

.hocms-field-group {
    margin-bottom: 24px;
}

.hocms-field-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--hocms-text-secondary);
    margin-bottom: 8px;
}

.hocms-field-label-optional {
    font-size: 0.6875rem;
    font-weight: 400;
    background: var(--hocms-bg-tertiary);
    padding: 2px 8px;
    border-radius: 20px;
    margin-left: auto;
}

.hocms-field-input,
.hocms-field-textarea,
.hocms-field-select {
    width: 100%;
    border-radius: var(--hocms-radius-md);
    border: 1.5px solid var(--hocms-border-light);
    background: var(--hocms-bg-secondary);
    padding: 10px 14px;
    font-size: 0.875rem;
    font-family: 'Inter', sans-serif;
    outline: none;
    transition: all var(--hocms-transition-fast);
}

.hocms-field-input:focus,
.hocms-field-textarea:focus,
.hocms-field-select:focus {
    border-color: var(--hocms-accent);
    box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
}

.hocms-field-textarea {
    resize: vertical;
    min-height: 100px;
}

.hocms-field-hint {
    font-size: 0.75rem;
    color: var(--hocms-text-muted);
    margin-top: 6px;
}

.hocms-file-drop {
    position: relative;
    border: 2px dashed var(--hocms-border-light);
    border-radius: var(--hocms-radius-lg);
    padding: 28px 20px;
    text-align: center;
    cursor: pointer;
    background: var(--hocms-bg-tertiary);
    transition: all var(--hocms-transition-fast);
}

.hocms-file-drop:hover {
    border-color: var(--hocms-accent);
    background: var(--hocms-accent-light);
}

.hocms-file-drop input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.hocms-file-drop-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--hocms-radius-lg);
    background: var(--hocms-bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    color: var(--hocms-accent);
    font-size: 1.25rem;
}

.hocms-current-thumb {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
    padding: 10px;
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-md);
    background: var(--hocms-bg-tertiary);
}

.hocms-current-thumb img {
    width: 56px;
    height: 56px;
    object-fit: cover;
    border-radius: var(--hocms-radius-sm);
}

.hocms-current-thumb span {
    font-size: 0.75rem;
    color: var(--hocms-text-muted);
}

.hocms-repeat-item {
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-lg);
    margin-bottom: 16px;
    overflow: hidden;
}

.hocms-repeat-item-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: var(--hocms-bg-tertiary);
    border-bottom: 1px solid var(--hocms-border-light);
}

.hocms-repeat-item-label {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.875rem;
    font-weight: 600;
}

.hocms-repeat-num {
    width: 28px;
    height: 28px;
    border-radius: var(--hocms-radius-sm);
    background: var(--hocms-gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: white;
}

.hocms-repeat-item-body {
    padding: 20px;
}

.hocms-btn-remove {
    background: none;
    border: none;
    color: var(--hocms-danger);
    cursor: pointer;
    padding: 6px;
    border-radius: var(--hocms-radius-sm);
    transition: all var(--hocms-transition-fast);
}

.hocms-btn-remove:hover {
    background: var(--hocms-danger-light);
}

.hocms-row {
    display: grid;
    gap: 20px;
}

.hocms-row-2 {
    grid-template-columns: repeat(2, 1fr);
}

.hocms-row-3 {
    grid-template-columns: repeat(3, 1fr);
}

.hocms-row-4 {
    grid-template-columns: repeat(4, 1fr);
}

.hocms-divider {
    height: 1px;
    background: linear-gradient(to right, var(--hocms-border-light), transparent);
    margin: 24px 0;
}

.hocms-save-bar {
    position: sticky;
    bottom: 24px;
    padding: 16px 24px;
    background: var(--hocms-bg-secondary);
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-xl);
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 40px;
    box-shadow: var(--hocms-shadow-lg);
    backdrop-filter: blur(8px);
    background: rgba(255, 255, 255, 0.95);
}

.hocms-save-bar-info {
    font-size: 0.8125rem;
    color: var(--hocms-text-muted);
}

.hocms-save-bar-info i {
    margin-right: 6px;
}

.hocms-save-bar-actions {
    display: flex;
    gap: 12px;
}

.hocms-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 0 20px;
    height: 42px;
    border-radius: var(--hocms-radius-md);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--hocms-transition-fast);
}

.hocms-btn-ghost {
    background: transparent;
    border: 1.5px solid var(--hocms-border-light);
    color: var(--hocms-text-secondary);
}

.hocms-btn-ghost:hover {
    background: var(--hocms-bg-tertiary);
    transform: translateY(-1px);
}

.hocms-btn-primary {
    background: var(--hocms-gradient-primary);
    color: white;
    border: none;
}

.hocms-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--hocms-shadow-md);
}

.hocms-btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.hocms-btn.loading i {
    animation: hocmsSpin 1s linear infinite;
}

@keyframes hocmsSpin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.hocms-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 20px;
    border-radius: var(--hocms-radius-md);
    z-index: 1000;
    animation: hocmsSlideIn 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: var(--hocms-shadow-lg);
}

.hocms-notification-success {
    background: var(--hocms-success);
    color: white;
}

.hocms-notification-error {
    background: var(--hocms-danger);
    color: white;
}

@keyframes hocmsSlideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes hocmsSlideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

/* ---------- Section enable/disable toggle ---------- */
.hocms-toggle {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
}

.hocms-toggle input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.hocms-toggle-track {
    width: 40px;
    height: 22px;
    background: var(--hocms-border-medium);
    border-radius: 999px;
    position: relative;
    transition: background var(--hocms-transition-fast);
    flex-shrink: 0;
}

.hocms-toggle-thumb {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 18px;
    height: 18px;
    background: #fff;
    border-radius: 50%;
    box-shadow: var(--hocms-shadow-xs);
    transition: transform var(--hocms-transition-fast);
}

.hocms-toggle input:checked + .hocms-toggle-track {
    background: var(--hocms-success);
}

.hocms-toggle input:checked + .hocms-toggle-track .hocms-toggle-thumb {
    transform: translateX(18px);
}

.hocms-toggle input:focus-visible + .hocms-toggle-track {
    outline: 2px solid var(--hocms-accent);
    outline-offset: 2px;
}

.hocms-card-wrapper.hocms-disabled {
    opacity: 0.55;
}

.hocms-card-wrapper.hocms-disabled .hocms-section-header {
    background: var(--hocms-bg-tertiary);
}

.hocms-disabled-flag {
    font-size: 0.6875rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--hocms-danger);
    background: var(--hocms-danger-light);
    padding: 3px 9px;
    border-radius: 20px;
    display: none;
}

.hocms-card-wrapper.hocms-disabled .hocms-disabled-flag {
    display: inline-block;
}

/* ---------- Rich text editor (TinyMCE) ---------- */
.tox-tinymce {
    border-radius: var(--hocms-radius-md) !important;
    border: 1.5px solid var(--hocms-border-light) !important;
    margin-bottom: 0;
}

.tox-tinymce:focus-within {
    border-color: var(--hocms-accent) !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
}

@media (max-width: 992px) {
    .hocms-shell {
        grid-template-columns: 1fr;
    }

    .hocms-rail {
        position: relative;
        height: auto;
        display: none;
    }

    .hocms-main {
        padding: 24px;
    }

    .hocms-row-2,
    .hocms-row-3,
    .hocms-row-4 {
        grid-template-columns: 1fr;
    }

    .hocms-save-bar {
        flex-direction: column;
        gap: 16px;
    }

    .hocms-page-header {
        flex-direction: column;
        gap: 16px;
    }
}
</style>
@endsection

@section('content')

@php
    $settings = $websiteSettings ?? null;
    $sectionsEnabled = $settings->sections_enabled ?? [];
    
    // Helper function to get value with fallback
    function getSetting($settings, $key, $default = '') {
        return $settings->$key ?? $default;
    }
    
    // Helper function to decode JSON
    function decodeJson($settings, $key, $default = []) {
        $value = $settings->$key ?? null;
        if (is_string($value)) {
            return json_decode($value, true) ?? $default;
        }
        return $value ?? $default;
    }
@endphp

<div class="hocms-wrapper">
    <div class="hocms-shell">

        {{-- Sidebar --}}
        <nav class="hocms-rail">
            <span class="hocms-nav-section-label">Sections</span>

            <button type="button" class="hocms-nav-item active" data-hocms-section="hero">
                <span class="hocms-nav-icon"><i class="fas fa-plane-departure"></i></span>
                Hero
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="stats">
                <span class="hocms-nav-icon"><i class="fas fa-chart-bar"></i></span>
                Stats
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="services">
                <span class="hocms-nav-icon"><i class="fas fa-briefcase"></i></span>
                Services
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="about">
                <span class="hocms-nav-icon"><i class="fas fa-info-circle"></i></span>
                About
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="airports">
                <span class="hocms-nav-icon"><i class="fas fa-plane"></i></span>
                Airports
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="coverage">
                <span class="hocms-nav-icon"><i class="fas fa-map-marked-alt"></i></span>
                Coverage
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="fleet">
                <span class="hocms-nav-icon"><i class="fas fa-car"></i></span>
                Fleet
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="story">
                <span class="hocms-nav-icon"><i class="fas fa-book-open"></i></span>
                Story
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="reviews">
                <span class="hocms-nav-icon"><i class="fas fa-comments"></i></span>
                Reviews
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="faq">
                <span class="hocms-nav-icon"><i class="fas fa-question-circle"></i></span>
                FAQ
                <span class="hocms-nav-dot"></span>
            </button>


            <button type="button" class="hocms-nav-item" data-hocms-section="seo">
                <span class="hocms-nav-icon"><i class="fas fa-search"></i></span>
                SEO
                <span class="hocms-nav-dot"></span>
            </button>
        </nav>

        {{-- Main Content --}}
        <main class="hocms-main">
            <form action="" method="POST" enctype="multipart/form-data" id="hocmsForm">
                @csrf
                @method('PUT')

                {{-- ============ HERO ============ --}}
                <div id="hocms-hero" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-plane-departure"></i></div>
                            <div>
                                <h3>Hero Section</h3>
                                <p>Headline, subtitle, benefits and form settings</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[hero]" value="0">
                                <input type="checkbox" name="sections_enabled[hero]" value="1" {{ (($sectionsEnabled['hero'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        {{-- Hero Badge --}}
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Hero Badge Text</label>
                            <input type="text" class="hocms-field-input" name="hero_badge_text" 
                                   value="{{ getSetting($settings, 'hero_badge_text', 'PREMIUM AIRPORT TRANSFERS ACROSS THE UK') }}">
                        </div>

                        {{-- Hero Title Lines --}}
                        <div class="hocms-row hocms-row-3">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Title Line 1</label>
                                <input type="text" class="hocms-field-input" name="hero_title_line1" 
                                       value="{{ getSetting($settings, 'hero_title_line1', 'Your Journey.') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Title Line 2</label>
                                <input type="text" class="hocms-field-input" name="hero_title_line2" 
                                       value="{{ getSetting($settings, 'hero_title_line2', 'Our Priority.') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Gradient Text</label>
                                <input type="text" class="hocms-field-input" name="hero_title_gradient_text" 
                                       value="{{ getSetting($settings, 'hero_title_gradient_text', 'Priority') }}">
                            </div>
                        </div>

                        {{-- Hero Description --}}
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Hero Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="3" name="hero_description">{{ getSetting($settings, 'hero_description', 'Professional airport transfers, private taxi services and city-to-city rides with fixed fares, expert drivers and 24/7 support.') }}</textarea>
                        </div>

                        {{-- Hero Background Image --}}
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Hero Background Image</label>
                            <div class="hocms-image-dual-container">
                                <!-- URL Input -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-link"></i> Enter Image Link</h5>
                                    <div class="hocms-image-input-url">
                                        <input type="text" class="hocms-field-input" name="hero_background_image"
                                               placeholder="https://example.com/image.jpg"
                                               value="{{ getSetting($settings, 'hero_background_image') ?? '' }}"
                                               data-preview-id="heroImagePreview"
                                               onchange="hocmsPreviewImage(this.value, 'heroImagePreview')">
                                        <p class="hocms-field-hint">Full URL to the hero background image</p>
                                        <div class="hocms-image-preview-box" id="heroImagePreview">
                                            <img src="{{ getSetting($settings, 'hero_background_image') ?? '' }}" alt="Preview" 
                                                 style="display:{{ getSetting($settings, 'hero_background_image') ? 'block' : 'none' }}">
                                            <span style="display:{{ getSetting($settings, 'hero_background_image') ? 'none' : 'block' }}">Image preview</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-cloud-upload-alt"></i> Or Upload Image</h5>
                                    <label class="hocms-file-drop" ondrop="hocmsHandleDrop(event, 'heroImageUpload')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                                        <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                        <div class="hocms-file-drop-text">Click or drag image here</div>
                                        <div class="hocms-file-drop-subtext">PNG, JPG, WebP (Max 5MB)</div>
                                        <input type="file" id="heroImageUpload" name="hero_background_image_file" accept="image/*" onchange="hocmsHandleFileUpload(this, 'heroImagePreview')">
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Hero Benefits --}}
                        <div class="hocms-divider"></div>
                        <h4 style="margin-bottom:16px;font-weight:600;">Hero Benefits</h4>

                        @php
                            $benefits = decodeJson($settings, 'hero_benefits', [
                                ['title' => 'Fixed Fares', 'subtitle' => 'No hidden charges', 'icon' => 'tag'],
                                ['title' => 'Flight Monitoring', 'subtitle' => 'We track your flight', 'icon' => 'plane'],
                                ['title' => 'Meet & Greet', 'subtitle' => 'At the arrivals hall', 'icon' => 'user'],
                                ['title' => '24/7 Support', 'subtitle' => 'We\'re always here', 'icon' => 'headset']
                            ]);
                        @endphp

                        <div id="hocmsBenefitsContainer">
                            @foreach($benefits as $index => $benefit)
                            <div class="hocms-repeat-item" data-hocms-benefit-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Benefit
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-row hocms-row-3">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Title</label>
                                            <input type="text" class="hocms-field-input" name="hero_benefits[{{ $index }}][title]" value="{{ $benefit['title'] ?? '' }}" placeholder="Fixed Fares">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Subtitle</label>
                                            <input type="text" class="hocms-field-input" name="hero_benefits[{{ $index }}][subtitle]" value="{{ $benefit['subtitle'] ?? '' }}" placeholder="No hidden charges">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Icon Class</label>
                                            <input type="text" class="hocms-field-input" name="hero_benefits[{{ $index }}][icon]" value="{{ $benefit['icon'] ?? '' }}" placeholder="tag">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddBenefitItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Benefit
                        </button>

                        {{-- Hero Form Settings --}}
                        <div class="hocms-divider"></div>
                        <h4 style="margin-bottom:16px;font-weight:600;">Form Settings</h4>

                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Discount Text</label>
                                <input type="text" class="hocms-field-input" name="hero_form_discount_text" 
                                       value="{{ getSetting($settings, 'hero_form_discount_text', '5% Discount on Return Booking') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Submit Button Text</label>
                                <input type="text" class="hocms-field-input" name="hero_form_submit_text" 
                                       value="{{ getSetting($settings, 'hero_form_submit_text', 'GET AN INSTANT QUOTE') }}">
                            </div>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Form Note Text</label>
                            <input type="text" class="hocms-field-input" name="hero_form_note_text" 
                                   value="{{ getSetting($settings, 'hero_form_note_text', '5% Discount on Return Booking | Fixed prices. No hidden charges.') }}">
                        </div>
                    </div>
                </div>

                {{-- ============ STATS ============ --}}
                <div id="hocms-stats" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-chart-bar"></i></div>
                            <div>
                                <h3>Stats Section</h3>
                                <p>Statistics displayed on the homepage</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[stats]" value="0">
                                <input type="checkbox" name="sections_enabled[stats]" value="1" {{ (($sectionsEnabled['stats'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        @php
                            $stats = decodeJson($settings, 'stats', [
                                ['value' => '98%', 'label' => 'Customer Satisfaction', 'icon' => 'smile'],
                                ['value' => '5000+', 'label' => 'Trips Completed', 'icon' => 'car'],
                                ['value' => '24/7', 'label' => 'Service Available', 'icon' => 'clock'],
                                ['value' => 'Safe & Reliable', 'label' => 'Licensed Drivers', 'icon' => 'shield']
                            ]);
                        @endphp

                        <div id="hocmsStatsContainer">
                            @foreach($stats as $index => $stat)
                            <div class="hocms-repeat-item" data-hocms-stat-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Stat
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-row hocms-row-3">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Value</label>
                                            <input type="text" class="hocms-field-input" name="stats[{{ $index }}][value]" value="{{ $stat['value'] ?? '' }}" placeholder="98%">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Label</label>
                                            <input type="text" class="hocms-field-input" name="stats[{{ $index }}][label]" value="{{ $stat['label'] ?? '' }}" placeholder="Customer Satisfaction">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Icon Class</label>
                                            <input type="text" class="hocms-field-input" name="stats[{{ $index }}][icon]" value="{{ $stat['icon'] ?? '' }}" placeholder="smile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddStatItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Stat
                        </button>
                    </div>
                </div>

                {{-- ============ SERVICES ============ --}}
                <div id="hocms-services" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-briefcase"></i></div>
                            <div>
                                <h3>Services Section</h3>
                                <p>Services offered with icons and descriptions</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[services]" value="0">
                                <input type="checkbox" name="sections_enabled[services]" value="1" {{ (($sectionsEnabled['services'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Label</label>
                                <input type="text" class="hocms-field-input" name="services_label" 
                                       value="{{ getSetting($settings, 'services_label', 'OUR SERVICES') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Button Text</label>
                                <input type="text" class="hocms-field-input" name="services_button_text" 
                                       value="{{ getSetting($settings, 'services_button_text', 'VIEW ALL SERVICES') }}">
                            </div>
                        </div>
                        <div class="hocms-row hocms-row-3">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 1</label>
                                <input type="text" class="hocms-field-input" name="services_heading_line1" 
                                       value="{{ getSetting($settings, 'services_heading_line1', 'Ride Your Way,') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 2</label>
                                <input type="text" class="hocms-field-input" name="services_heading_line2" 
                                       value="{{ getSetting($settings, 'services_heading_line2', 'Anytime, Anywhere') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Gradient Text</label>
                                <input type="text" class="hocms-field-input" name="services_heading_gradient" 
                                       value="{{ getSetting($settings, 'services_heading_gradient', 'Anywhere') }}">
                            </div>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="2" name="services_description">{{ getSetting($settings, 'services_description', 'From airport pickups to business travel, we\'ve got the perfect ride for every journey.') }}</textarea>
                        </div>

                        <div class="hocms-divider"></div>
                        <h4 style="margin-bottom:16px;font-weight:600;">Services List</h4>

                        @php
                            $servicesList = decodeJson($settings, 'services_list', [
                                ['title' => 'Airport Transfers', 'description' => 'Reliable transfers to and from all major UK airports.', 'icon' => 'plane'],
                                ['title' => 'City Transfers', 'description' => 'Comfortable city-to-city private transfers.', 'icon' => 'building'],
                                ['title' => 'Business Travel', 'description' => 'Executive travel solutions for professionals.', 'icon' => 'briefcase'],
                                ['title' => 'Hourly Hire', 'description' => 'Flexible hourly hire with professional drivers.', 'icon' => 'clock']
                            ]);
                        @endphp

                        <div id="hocmsServicesListContainer">
                            @foreach($servicesList as $index => $service)
                            <div class="hocms-repeat-item" data-hocms-service-item-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Service
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-row hocms-row-3">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Title</label>
                                            <input type="text" class="hocms-field-input" name="services_list[{{ $index }}][title]" value="{{ $service['title'] ?? '' }}" placeholder="Airport Transfers">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Description</label>
                                            <input type="text" class="hocms-field-input" name="services_list[{{ $index }}][description]" value="{{ $service['description'] ?? '' }}" placeholder="Service description">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Icon Class</label>
                                            <input type="text" class="hocms-field-input" name="services_list[{{ $index }}][icon]" value="{{ $service['icon'] ?? '' }}" placeholder="plane">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddServiceItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Service
                        </button>
                    </div>
                </div>

                {{-- ============ ABOUT ============ --}}
                <div id="hocms-about" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-info-circle"></i></div>
                            <div>
                                <h3>About / Trusted Section</h3>
                                <p>About us content with checkmarks</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[about]" value="0">
                                <input type="checkbox" name="sections_enabled[about]" value="1" {{ (($sectionsEnabled['about'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Badge</label>
                                <input type="text" class="hocms-field-input" name="about_badge" 
                                       value="{{ getSetting($settings, 'about_badge', 'ABOUT US') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Button Text</label>
                                <input type="text" class="hocms-field-input" name="about_button_text" 
                                       value="{{ getSetting($settings, 'about_button_text', 'Learn More About Us') }}">
                            </div>
                        </div>
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 1</label>
                                <input type="text" class="hocms-field-input" name="about_heading_line1" 
                                       value="{{ getSetting($settings, 'about_heading_line1', 'Your Trusted Taxi') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 2</label>
                                <input type="text" class="hocms-field-input" name="about_heading_line2" 
                                       value="{{ getSetting($settings, 'about_heading_line2', 'Partner Across the UK') }}">
                            </div>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="4" name="about_description">{{ getSetting($settings, 'about_description', 'Swift-Ride-taxis is a UK-based taxi service company dedicated to providing reliable, punctual and comfortable transport solutions. Whether you\'re travelling for business, leisure or a special occasion, we are here to make your journey smooth and hassle-free.') }}</textarea>
                        </div>

                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Experience Years</label>
                                <input type="text" class="hocms-field-input" name="about_experience_years" 
                                       value="{{ getSetting($settings, 'about_experience_years', '15+') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Experience Text</label>
                                <input type="text" class="hocms-field-input" name="about_experience_text" 
                                       value="{{ getSetting($settings, 'about_experience_text', 'Years of Experience') }}">
                            </div>
                        </div>

                        {{-- About Image --}}
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">About Image</label>
                            <div class="hocms-image-dual-container">
                                <!-- URL Input -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-link"></i> Enter Image Link</h5>
                                    <div class="hocms-image-input-url">
                                        <input type="text" class="hocms-field-input" name="about_image"
                                               placeholder="https://example.com/image.jpg"
                                               value="{{ getSetting($settings, 'about_image') ?? '' }}"
                                               data-preview-id="aboutImagePreview"
                                               onchange="hocmsPreviewImage(this.value, 'aboutImagePreview')">
                                        <p class="hocms-field-hint">Full URL to the about section image</p>
                                        <div class="hocms-image-preview-box" id="aboutImagePreview">
                                            <img src="{{ getSetting($settings, 'about_image') ?? '' }}" alt="Preview" 
                                                 style="display:{{ getSetting($settings, 'about_image') ? 'block' : 'none' }}">
                                            <span style="display:{{ getSetting($settings, 'about_image') ? 'none' : 'block' }}">Image preview</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-cloud-upload-alt"></i> Or Upload Image</h5>
                                    <label class="hocms-file-drop" ondrop="hocmsHandleDrop(event, 'aboutImageUpload')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                                        <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                        <div class="hocms-file-drop-text">Click or drag image here</div>
                                        <div class="hocms-file-drop-subtext">PNG, JPG, WebP (Max 5MB)</div>
                                        <input type="file" id="aboutImageUpload" name="about_image_file" accept="image/*" onchange="hocmsHandleFileUpload(this, 'aboutImagePreview')">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Button Link</label>
                            <input type="text" class="hocms-field-input" name="about_button_link" 
                                   value="{{ getSetting($settings, 'about_button_link', '/about') }}">
                        </div>

                        {{-- About Checkmarks --}}
                        <div class="hocms-divider"></div>
                        <h4 style="margin-bottom:16px;font-weight:600;">Checkmarks</h4>

                        @php
                            $checkmarks = decodeJson($settings, 'about_checkmarks', [
                                'Licensed & Insured Services',
                                'Professional & Courteous Drivers',
                                'Real-time Flight Monitoring',
                                'No Hidden Charges – Fixed Prices'
                            ]);
                        @endphp

                        <div id="hocmsCheckmarksContainer">
                            @foreach($checkmarks as $index => $checkmark)
                            <div class="hocms-repeat-item" data-hocms-checkmark-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Checkmark
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Text</label>
                                        <input type="text" class="hocms-field-input" name="about_checkmarks[{{ $index }}]" value="{{ $checkmark }}" placeholder="Licensed & Insured Services">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddCheckmarkItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Checkmark
                        </button>
                    </div>
                </div>

                {{-- ============ AIRPORTS ============ --}}
                <div id="hocms-airports" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-plane"></i></div>
                            <div>
                                <h3>Airports Section</h3>
                                <p>Airports list with images</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[airports]" value="0">
                                <input type="checkbox" name="sections_enabled[airports]" value="1" {{ (($sectionsEnabled['airports'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Label</label>
                            <input type="text" class="hocms-field-input" name="airports_label" 
                                   value="{{ getSetting($settings, 'airports_label', 'MAJOR AIRPORT TRANSFERS') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">View All Text</label>
                            <input type="text" class="hocms-field-input" name="airports_view_all_text" 
                                   value="{{ getSetting($settings, 'airports_view_all_text', 'View all airports') }}">
                        </div>
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 1</label>
                                <input type="text" class="hocms-field-input" name="airports_heading_line1" 
                                       value="{{ getSetting($settings, 'airports_heading_line1', 'All Major Airports') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 2</label>
                                <input type="text" class="hocms-field-input" name="airports_heading_line2" 
                                       value="{{ getSetting($settings, 'airports_heading_line2', 'Across the UK') }}">
                            </div>
                        </div>

                        @php
                            $airportsList = decodeJson($settings, 'airports_list', [
                                ['name' => 'Heathrow Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=600&q=80'],
                                ['name' => 'Gatwick Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=600&q=80'],
                                ['name' => 'Stansted Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1583517786578-e1c8ffe6b3a3?auto=format&fit=crop&w=600&q=80'],
                                ['name' => 'Luton Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1517400508447-f8dd518b86db?auto=format&fit=crop&w=600&q=80'],
                                ['name' => 'London City Airport', 'city' => 'London', 'image' => 'https://images.unsplash.com/photo-1526481280693-3bfa7568e0f3?auto=format&fit=crop&w=600&q=80'],
                                ['name' => 'Manchester Airport', 'city' => 'Manchester', 'image' => 'https://images.unsplash.com/photo-1506015391300-4802dc74de2e?auto=format&fit=crop&w=600&q=80']
                            ]);
                        @endphp

                        <div id="hocmsAirportsContainer">
                            @foreach($airportsList as $index => $airport)
                            <div class="hocms-repeat-item" data-hocms-airport-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Airport
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-row hocms-row-2">
                                        <div class="hocms-field-group">
                                            <label class="hocms-field-label">Airport Image</label>
                                            @if(!empty($airport['image']))
                                            <div class="hocms-current-thumb">
                                                <img src="{{ $airport['image'] }}" alt="Airport image">
                                                <span>Current image</span>
                                            </div>
                                            @endif
                                            <div class="hocms-file-drop">
                                                <input type="file" name="airports_list[{{ $index }}][image_upload]" accept="image/*">
                                                <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                                <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image</p>
                                            </div>
                                            <input type="hidden" name="airports_list[{{ $index }}][image]" value="{{ $airport['image'] ?? '' }}">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">City</label>
                                            <input type="text" class="hocms-field-input" name="airports_list[{{ $index }}][city]" value="{{ $airport['city'] ?? '' }}" placeholder="London">
                                        </div>
                                    </div>
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Name</label>
                                        <input type="text" class="hocms-field-input" name="airports_list[{{ $index }}][name]" value="{{ $airport['name'] ?? '' }}" placeholder="Heathrow Airport">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddAirportItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Airport
                        </button>
                    </div>
                </div>

                {{-- ============ COVERAGE ============ --}}
                <div id="hocms-coverage" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-map-marked-alt"></i></div>
                            <div>
                                <h3>Coverage Section</h3>
                                <p>UK coverage with map and floating card</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[coverage]" value="0">
                                <input type="checkbox" name="sections_enabled[coverage]" value="1" {{ (($sectionsEnabled['coverage'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Label</label>
                            <input type="text" class="hocms-field-input" name="coverage_label" 
                                   value="{{ getSetting($settings, 'coverage_label', 'WIDE COVERAGE') }}">
                        </div>
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 1</label>
                                <input type="text" class="hocms-field-input" name="coverage_heading_line1" 
                                       value="{{ getSetting($settings, 'coverage_heading_line1', 'We Cover All Major Cities') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 2</label>
                                <input type="text" class="hocms-field-input" name="coverage_heading_line2" 
                                       value="{{ getSetting($settings, 'coverage_heading_line2', '& Airports Across the UK') }}">
                            </div>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="2" name="coverage_description">{{ getSetting($settings, 'coverage_description', 'Wherever you are, we\'ll get you there. Safe, on-time and comfortable.') }}</textarea>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Button Text</label>
                            <input type="text" class="hocms-field-input" name="coverage_button_text" 
                                   value="{{ getSetting($settings, 'coverage_button_text', 'EXPLORE LOCATIONS') }}">
                        </div>

                        {{-- Coverage Images --}}
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Map Image</label>
                                @if(!empty(getSetting($settings, 'coverage_map_image')))
                                <div class="hocms-current-thumb">
                                    <img src="{{ asset(getSetting($settings, 'coverage_map_image')) }}" alt="Map">
                                    <span>Current map</span>
                                </div>
                                @endif
                                <div class="hocms-file-drop">
                                    <input type="file" name="coverage_map_image" accept="image/*">
                                    <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                    <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image</p>
                                </div>
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Background Image</label>
                                @if(!empty(getSetting($settings, 'coverage_background_image')))
                                <div class="hocms-current-thumb">
                                    <img src="{{ asset(getSetting($settings, 'coverage_background_image')) }}" alt="Background">
                                    <span>Current background</span>
                                </div>
                                @endif
                                <div class="hocms-file-drop">
                                    <input type="file" name="coverage_background_image" accept="image/*">
                                    <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                    <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image</p>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Card --}}
                        <div class="hocms-divider"></div>
                        <h4 style="margin-bottom:16px;font-weight:600;">Floating Card</h4>

                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Card Title</label>
                                <input type="text" class="hocms-field-input" name="coverage_float_card_title" 
                                       value="{{ getSetting($settings, 'coverage_float_card_title', 'City to City Transfers') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Route</label>
                                <input type="text" class="hocms-field-input" name="coverage_float_card_route" 
                                       value="{{ getSetting($settings, 'coverage_float_card_route', 'London ↔ Manchester') }}">
                            </div>
                        </div>
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Price</label>
                                <input type="text" class="hocms-field-input" name="coverage_float_card_price" 
                                       value="{{ getSetting($settings, 'coverage_float_card_price', '£120') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Price Text</label>
                                <input type="text" class="hocms-field-input" name="coverage_float_card_price_text" 
                                       value="{{ getSetting($settings, 'coverage_float_card_price_text', 'From') }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============ FLEET ============ --}}
                <div id="hocms-fleet" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-car"></i></div>
                            <div>
                                <h3>Fleet Section</h3>
                                <p>Vehicle fleet with images and details</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[fleet]" value="0">
                                <input type="checkbox" name="sections_enabled[fleet]" value="1" {{ (($sectionsEnabled['fleet'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Label</label>
                            <input type="text" class="hocms-field-input" name="fleet_label" 
                                   value="{{ getSetting($settings, 'fleet_label', 'OUR FLEET') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="fleet_heading" 
                                   value="{{ getSetting($settings, 'fleet_heading', 'Travel in Comfort & Style') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Subheading</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="2" name="fleet_subheading">{{ getSetting($settings, 'fleet_subheading', 'A range of modern vehicles to suit your needs.') }}</textarea>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">View All Text</label>
                            <input type="text" class="hocms-field-input" name="fleet_view_all_text" 
                                   value="{{ getSetting($settings, 'fleet_view_all_text', 'View all vehicles') }}">
                        </div>

                        @php
                            $fleetVehicles = decodeJson($settings, 'fleet_vehicles', [
                                ['name' => 'Saloon', 'pax' => '1-4', 'luggage' => '2', 'price' => '45', 'image' => 'images/fleet_saloon.jpg'],
                                ['name' => 'Executive', 'pax' => '1-3', 'luggage' => '2', 'price' => '60', 'image' => 'images/fleet_executive.jpg'],
                                ['name' => 'MPV', 'pax' => '1-6', 'luggage' => '4', 'price' => '70', 'image' => 'images/fleet_mpv.jpg'],
                                ['name' => 'Minibus', 'pax' => '1-8', 'luggage' => '6', 'price' => '90', 'image' => 'images/fleet_minibus.jpg']
                            ]);
                        @endphp

                        <div id="hocmsFleetContainer">
                            @foreach($fleetVehicles as $index => $vehicle)
                            <div class="hocms-repeat-item" data-hocms-fleet-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Vehicle
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Vehicle Image</label>
                                        @if(!empty($vehicle['image']))
                                        <div class="hocms-current-thumb">
                                            <img src="{{ asset($vehicle['image']) }}" alt="Vehicle">
                                            <span>Current image</span>
                                        </div>
                                        @endif
                                        <div class="hocms-file-drop">
                                            <input type="file" name="fleet_vehicles[{{ $index }}][image_upload]" accept="image/*">
                                            <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                            <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image</p>
                                        </div>
                                        <input type="hidden" name="fleet_vehicles[{{ $index }}][image]" value="{{ $vehicle['image'] ?? '' }}">
                                    </div>
                                    <div class="hocms-row hocms-row-4">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Name</label>
                                            <input type="text" class="hocms-field-input" name="fleet_vehicles[{{ $index }}][name]" value="{{ $vehicle['name'] ?? '' }}" placeholder="Saloon">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Passengers</label>
                                            <input type="text" class="hocms-field-input" name="fleet_vehicles[{{ $index }}][pax]" value="{{ $vehicle['pax'] ?? '' }}" placeholder="1-4">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Luggage</label>
                                            <input type="text" class="hocms-field-input" name="fleet_vehicles[{{ $index }}][luggage]" value="{{ $vehicle['luggage'] ?? '' }}" placeholder="2">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Price (£)</label>
                                            <input type="text" class="hocms-field-input" name="fleet_vehicles[{{ $index }}][price]" value="{{ $vehicle['price'] ?? '' }}" placeholder="45">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddFleetItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Vehicle
                        </button>
                    </div>
                </div>

                {{-- ============ STORY ============ --}}
                <div id="hocms-story" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-book-open"></i></div>
                            <div>
                                <h3>Story / Values Section</h3>
                                <p>Company story and core values</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[story]" value="0">
                                <input type="checkbox" name="sections_enabled[story]" value="1" {{ (($sectionsEnabled['story'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Label</label>
                            <input type="text" class="hocms-field-input" name="story_label" 
                                   value="{{ getSetting($settings, 'story_label', 'OUR STORY') }}">
                        </div>
                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 1</label>
                                <input type="text" class="hocms-field-input" name="story_heading_line1" 
                                       value="{{ getSetting($settings, 'story_heading_line1', 'The Journey Behind') }}">
                            </div>
                            <div class="hocms-field-group">
                                <label class="hocms-field-label">Heading Line 2</label>
                                <input type="text" class="hocms-field-input" name="story_heading_line2" 
                                       value="{{ getSetting($settings, 'story_heading_line2', 'Swift-Ride-taxis') }}">
                            </div>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Paragraph 1</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="3" name="story_paragraph1">{{ getSetting($settings, 'story_paragraph1', 'We understand that travelling can be stressful. From flight delays to last-minute changes, you need a transfer service you can rely on.') }}</textarea>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Paragraph 2</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="3" name="story_paragraph2">{{ getSetting($settings, 'story_paragraph2', 'That\'s why we focus on punctuality, comfort and peace of mind — ensuring every journey is smooth from the moment you book with us.') }}</textarea>
                        </div>

                        {{-- Story Image --}}
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Story Image</label>
                            @if(!empty(getSetting($settings, 'story_image')))
                            <div class="hocms-current-thumb">
                                <img src="{{ getSetting($settings, 'story_image') }}" alt="Story Image">
                                <span>Current image</span>
                            </div>
                            @endif
                            <div class="hocms-file-drop">
                                <input type="file" name="story_image" accept="image/*">
                                <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image to replace</p>
                            </div>
                        </div>

                        {{-- Story Values --}}
                        <div class="hocms-divider"></div>
                        <h4 style="margin-bottom:16px;font-weight:600;">Core Values</h4>

                        @php
                            $storyValues = decodeJson($settings, 'story_values', [
                                ['title' => 'People First', 'description' => 'We treat every customer like a guest, not just a booking.', 'icon' => 'users'],
                                ['title' => 'Integrity', 'description' => 'Transparent pricing, honest service and no hidden surprises.', 'icon' => 'shield-alt'],
                                ['title' => 'Excellence', 'description' => 'From our drivers to our vehicles, we aim for excellence every time.', 'icon' => 'star'],
                                ['title' => 'Reliability', 'description' => 'Dependable service, every single time, whenever you need us.', 'icon' => 'handshake']
                            ]);
                        @endphp

                        <div id="hocmsValuesContainer">
                            @foreach($storyValues as $index => $value)
                            <div class="hocms-repeat-item" data-hocms-value-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Value
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-row hocms-row-3">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Title</label>
                                            <input type="text" class="hocms-field-input" name="story_values[{{ $index }}][title]" value="{{ $value['title'] ?? '' }}" placeholder="People First">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Description</label>
                                            <input type="text" class="hocms-field-input" name="story_values[{{ $index }}][description]" value="{{ $value['description'] ?? '' }}" placeholder="Value description">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Icon Class</label>
                                            <input type="text" class="hocms-field-input" name="story_values[{{ $index }}][icon]" value="{{ $value['icon'] ?? '' }}" placeholder="users">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddValueItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Value
                        </button>
                    </div>
                </div>

                {{-- ============ REVIEWS ============ --}}
                <div id="hocms-reviews" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-comments"></i></div>
                            <div>
                                <h3>Reviews / Testimonials</h3>
                                <p>Customer reviews with ratings</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[reviews]" value="0">
                                <input type="checkbox" name="sections_enabled[reviews]" value="1" {{ (($sectionsEnabled['reviews'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Label</label>
                            <input type="text" class="hocms-field-input" name="reviews_label" 
                                   value="{{ getSetting($settings, 'reviews_label', 'REVIEWS') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="reviews_heading" 
                                   value="{{ getSetting($settings, 'reviews_heading', 'What passengers are saying') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="2" name="reviews_description">{{ getSetting($settings, 'reviews_description', 'Verified reviews are collected after every completed journey to ensure genuine feedback and help maintain the highest standards of service.') }}</textarea>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Enable Reviews</label>
                            <div style="margin-top:8px;">
                                <label class="hocms-toggle">
                                    <input type="hidden" name="reviews_enabled" value="0">
                                    <input type="checkbox" name="reviews_enabled" value="1" {{ (getSetting($settings, 'reviews_enabled', true)) ? 'checked' : '' }}>
                                    <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                                    <span style="margin-left:12px;font-size:0.875rem;font-weight:500;">Show reviews section</span>
                                </label>
                            </div>
                        </div>

                        @php
                            $reviewsList = decodeJson($settings, 'reviews_list', [
                                [
                                    'name' => 'Daniel H.',
                                    'initials' => 'DH',
                                    'rating' => 5,
                                    'text' => 'Booked a 4 am pick-up for Heathrow the evening before and honestly expected a phone call at midnight saying something had gone wrong. Instead, the driver was parked outside ten minutes early. Clean car, sensible price, and I was through security before the queues built up.'
                                ],
                                [
                                    'name' => 'Sophie M.',
                                    'initials' => 'SM',
                                    'rating' => 5,
                                    'text' => 'Our flight into Gatwick landed almost an hour late after a delay in Malaga. Nobody rang us, and nobody charged us extra. The driver was simply there in arrivals with the board when we finally came through.'
                                ],
                                [
                                    'name' => 'Leon B.',
                                    'initials' => 'LB',
                                    'rating' => 4.5,
                                    'text' => 'I compared four operators for the same Manchester run and the price gap between the cheapest and the dearest was genuinely surprising. Booking took under two minutes on my phone.'
                                ]
                            ]);
                        @endphp

                        <div id="hocmsReviewsContainer">
                            @foreach($reviewsList as $index => $review)
                            <div class="hocms-repeat-item" data-hocms-review-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Review
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-row hocms-row-3">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Name</label>
                                            <input type="text" class="hocms-field-input" name="reviews_list[{{ $index }}][name]" value="{{ $review['name'] ?? '' }}" placeholder="Daniel H.">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Initials</label>
                                            <input type="text" class="hocms-field-input" name="reviews_list[{{ $index }}][initials]" value="{{ $review['initials'] ?? '' }}" placeholder="DH">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Rating (0-5)</label>
                                            <input type="number" class="hocms-field-input" min="0" max="5" step="0.5" name="reviews_list[{{ $index }}][rating]" value="{{ $review['rating'] ?? 5 }}" placeholder="5">
                                        </div>
                                    </div>
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Review Text</label>
                                        <textarea class="hocms-field-textarea hocms-rich" rows="3" name="reviews_list[{{ $index }}][text]">{{ $review['text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddReviewItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Review
                        </button>
                    </div>
                </div>

                {{-- ============ FAQ ============ --}}
                <div id="hocms-faq" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-question-circle"></i></div>
                            <div>
                                <h3>FAQ Section</h3>
                                <p>Frequently asked questions</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="sections_enabled[faq]" value="0">
                                <input type="checkbox" name="sections_enabled[faq]" value="1" {{ (($sectionsEnabled['faq'] ?? true)) ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Label</label>
                            <input type="text" class="hocms-field-input" name="faq_label" 
                                   value="{{ getSetting($settings, 'faq_label', 'COMMON QUESTIONS') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="faq_heading" 
                                   value="{{ getSetting($settings, 'faq_heading', 'Frequently Asked Questions') }}">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="2" name="faq_description">{{ getSetting($settings, 'faq_description', 'Everything you need to know before booking with Airport Rides.') }}</textarea>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Enable FAQ</label>
                            <div style="margin-top:8px;">
                                <label class="hocms-toggle">
                                    <input type="hidden" name="faq_enabled" value="0">
                                    <input type="checkbox" name="faq_enabled" value="1" {{ (getSetting($settings, 'faq_enabled', true)) ? 'checked' : '' }}>
                                    <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                                    <span style="margin-left:12px;font-size:0.875rem;font-weight:500;">Show FAQ section</span>
                                </label>
                            </div>
                        </div>

                        @php
                            $faqList = decodeJson($settings, 'faq_list', [
                                ['question' => 'How does Airport Rides UK work?', 'answer' => 'Simply enter your pickup and drop-off locations, select your date and time, and choose from our range of vehicles. We\'ll match you with a professional driver who will arrive on time, every time.'],
                                ['question' => 'Do I need an account to book a taxi online?', 'answer' => 'No, you don\'t need an account. You can book as a guest, although creating an account makes future bookings faster and lets you track your journey history.'],
                                ['question' => 'When should I reserve my airport taxi?', 'answer' => 'We recommend booking at least 48 hours in advance for better rates. However, we can often accommodate same-day bookings depending on availability.'],
                                ['question' => 'Do I have the option of changing or cancelling my booking?', 'answer' => 'Yes, you can modify or cancel your booking up to 24 hours before your scheduled pickup time with no penalty.'],
                            ]);
                        @endphp

                        <div id="hocmsFaqContainer">
                            @foreach($faqList as $index => $faq)
                            <div class="hocms-repeat-item" data-hocms-faq-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        FAQ
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Question</label>
                                        <input type="text" class="hocms-field-input" name="faq_list[{{ $index }}][question]" value="{{ $faq['question'] ?? '' }}" placeholder="Enter question">
                                    </div>
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Answer</label>
                                        <textarea class="hocms-field-textarea hocms-rich" rows="3" name="faq_list[{{ $index }}][answer]">{{ $faq['answer'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddFaqItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add FAQ
                        </button>
                    </div>
                </div>

                {{-- ============ SEO ============ --}}
                <div id="hocms-seo" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-search"></i></div>
                            <div>
                                <h3>SEO Meta Data</h3>
                                <p>Meta tags for search engine optimization</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Meta Title</label>
                            <input type="text" class="hocms-field-input" name="meta_title" 
                                   value="{{ getSetting($settings, 'meta_title', '') }}" placeholder="Page title for search engines">
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Meta Description</label>
                            <textarea class="hocms-field-textarea" rows="3" name="meta_description">{{ getSetting($settings, 'meta_description', '') }}</textarea>
                        </div>
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Meta Keywords</label>
                            <input type="text" class="hocms-field-input" name="meta_keywords" 
                                   value="{{ getSetting($settings, 'meta_keywords', '') }}" placeholder="keyword1, keyword2, keyword3">
                        </div>

                        
                    </div>
                </div>

                {{-- Save Bar --}}
                <div class="hocms-save-bar">
                    <div class="hocms-save-bar-info">
                        <i class="fas fa-clock"></i>
                        Last saved <strong id="hocmsLastSaved">just now</strong>
                    </div>
                    <div class="hocms-save-bar-actions">
                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsPreviewChanges()">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                        <button type="submit" class="hocms-btn hocms-btn-primary" id="hocmsSaveBtn">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

@endsection

@section('scripts')
<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
/* ---------------------------------------------------------
   Section enable / disable toggle
--------------------------------------------------------- */
function hocmsSyncSectionState(checkbox) {
    const card = checkbox.closest('.hocms-card-wrapper');
    if (!card) return;
    card.classList.toggle('hocms-disabled', !checkbox.checked);
}

// Apply initial disabled styling on load
document.querySelectorAll('.hocms-toggle input[type="checkbox"]').forEach(cb => hocmsSyncSectionState(cb));

/* ---------------------------------------------------------
   Rich text editor (TinyMCE)
--------------------------------------------------------- */
function hocmsEnhanceRichTextareas(scope) {
    if (typeof tinymce === 'undefined') return;
    const root = scope || document;
    root.querySelectorAll('textarea.hocms-rich').forEach((textarea) => {
        if (textarea.dataset.hocmsTinyDone) return;
        textarea.dataset.hocmsTinyDone = '1';

        if (!textarea.id) {
            textarea.id = 'hocms-editor-' + Math.random().toString(36).substring(2, 9);
        }

        tinymce.init({
            target: textarea,
            height: 260,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                'codesample', 'directionality', 'nonbreaking', 'quickbars', 'accordion'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table accordion | emoticons charmap insertdatetime | removeformat code fullscreen help',
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
            image_advtab: true,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name, alt: file.name });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            },
            content_style: 'body { font-family: Inter, Helvetica, Arial, sans-serif; font-size: 14px; color: #1e293b; line-height: 1.5; }',
            branding: false,
            promotion: false,
            setup: function(editor) {
                editor.on('change keyup NodeChange blur', function() {
                    editor.save();
                });
            }
        });
    });
}

function hocmsFlushRichTextareas() {
    if (typeof tinymce !== 'undefined') {
        tinymce.triggerSave();
    }
}

document.addEventListener('DOMContentLoaded', () => hocmsEnhanceRichTextareas(document));

// Toggle section
function hocmsToggleSection(header) {
    const body = header.nextElementSibling;
    const toggle = header.querySelector('.hocms-section-toggle');

    if (body.classList.contains('hidden')) {
        body.classList.remove('hidden');
        toggle.classList.add('open');
    } else {
        body.classList.add('hidden');
        toggle.classList.remove('open');
    }
}

// Navigation
document.querySelectorAll('.hocms-nav-item').forEach(link => {
    link.addEventListener('click', function(e) {
        const sectionId = this.getAttribute('data-hocms-section');
        if (sectionId) {
            e.preventDefault();
            const target = document.getElementById(`hocms-${sectionId}`);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
        document.querySelectorAll('.hocms-nav-item').forEach(n => n.classList.remove('active'));
        this.classList.add('active');
    });
});

// Intersection Observer for active nav
const hocmsSections = document.querySelectorAll('.hocms-card-wrapper[id]');
const hocmsNavItems = document.querySelectorAll('.hocms-nav-item');

const hocmsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            hocmsNavItems.forEach(n => n.classList.remove('active'));
            const id = entry.target.id.replace('hocms-', '');
            const active = document.querySelector(`.hocms-nav-item[data-hocms-section="${id}"]`);
            if (active) active.classList.add('active');
        }
    });
}, { threshold: 0.3 });

hocmsSections.forEach(s => hocmsObserver.observe(s));

/* ---------------------------------------------------------
   Repeater counters and functions
--------------------------------------------------------- */
const hocmsCounters = {
    benefit: {{ count(decodeJson($settings, 'hero_benefits', [])) ?: 4 }},
    stat: {{ count(decodeJson($settings, 'stats', [])) ?: 4 }},
    service: {{ count(decodeJson($settings, 'services_list', [])) ?: 4 }},
    checkmark: {{ count(decodeJson($settings, 'about_checkmarks', [])) ?: 4 }},
    airport: {{ count(decodeJson($settings, 'airports_list', [])) ?: 6 }},
    fleet: {{ count(decodeJson($settings, 'fleet_vehicles', [])) ?: 4 }},
    value: {{ count(decodeJson($settings, 'story_values', [])) ?: 4 }},
    review: {{ count(decodeJson($settings, 'reviews_list', [])) ?: 3 }},
    faq: {{ count(decodeJson($settings, 'faq_list', [])) ?: 4 }},
};

function hocmsAppend(containerId, html) {
    const container = document.getElementById(containerId);
    container.insertAdjacentHTML('beforeend', html);
    hocmsEnhanceRichTextareas(container);
}

// Add functions for each type
function hocmsAddBenefitItem() {
    const i = hocmsCounters.benefit++;
    hocmsAppend('hocmsBenefitsContainer', `
        <div class="hocms-repeat-item" data-hocms-benefit-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Benefit</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-row hocms-row-3">
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Title</label><input type="text" class="hocms-field-input" name="hero_benefits[${i}][title]" placeholder="Fixed Fares"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Subtitle</label><input type="text" class="hocms-field-input" name="hero_benefits[${i}][subtitle]" placeholder="No hidden charges"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Icon Class</label><input type="text" class="hocms-field-input" name="hero_benefits[${i}][icon]" placeholder="tag"></div>
                </div>
            </div>
        </div>`);
}

function hocmsAddStatItem() {
    const i = hocmsCounters.stat++;
    hocmsAppend('hocmsStatsContainer', `
        <div class="hocms-repeat-item" data-hocms-stat-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Stat</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-row hocms-row-3">
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Value</label><input type="text" class="hocms-field-input" name="stats[${i}][value]" placeholder="98%"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Label</label><input type="text" class="hocms-field-input" name="stats[${i}][label]" placeholder="Customer Satisfaction"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Icon Class</label><input type="text" class="hocms-field-input" name="stats[${i}][icon]" placeholder="smile"></div>
                </div>
            </div>
        </div>`);
}

function hocmsAddServiceItem() {
    const i = hocmsCounters.service++;
    hocmsAppend('hocmsServicesListContainer', `
        <div class="hocms-repeat-item" data-hocms-service-item-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Service</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-row hocms-row-3">
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Title</label><input type="text" class="hocms-field-input" name="services_list[${i}][title]" placeholder="Airport Transfers"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Description</label><input type="text" class="hocms-field-input" name="services_list[${i}][description]" placeholder="Service description"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Icon Class</label><input type="text" class="hocms-field-input" name="services_list[${i}][icon]" placeholder="plane"></div>
                </div>
            </div>
        </div>`);
}

function hocmsAddCheckmarkItem() {
    const i = hocmsCounters.checkmark++;
    hocmsAppend('hocmsCheckmarksContainer', `
        <div class="hocms-repeat-item" data-hocms-checkmark-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Checkmark</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Text</label><input type="text" class="hocms-field-input" name="about_checkmarks[${i}]" placeholder="Licensed & Insured Services"></div>
            </div>
        </div>`);
}

function hocmsAddAirportItem() {
    const i = hocmsCounters.airport++;
    hocmsAppend('hocmsAirportsContainer', `
        <div class="hocms-repeat-item" data-hocms-airport-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Airport</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-row hocms-row-2">
                    <div class="hocms-field-group">
                        <label class="hocms-field-label">Airport Image</label>
                        <div class="hocms-file-drop">
                            <input type="file" name="airports_list[${i}][image_upload]" accept="image/*">
                            <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                            <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image</p>
                        </div>
                        <input type="hidden" name="airports_list[${i}][image]" value="">
                    </div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">City</label><input type="text" class="hocms-field-input" name="airports_list[${i}][city]" placeholder="London"></div>
                </div>
                <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Name</label><input type="text" class="hocms-field-input" name="airports_list[${i}][name]" placeholder="Heathrow Airport"></div>
            </div>
        </div>`);
}

function hocmsAddFleetItem() {
    const i = hocmsCounters.fleet++;
    hocmsAppend('hocmsFleetContainer', `
        <div class="hocms-repeat-item" data-hocms-fleet-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Vehicle</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-field-group">
                    <label class="hocms-field-label">Vehicle Image</label>
                    <div class="hocms-file-drop">
                        <input type="file" name="fleet_vehicles[${i}][image_upload]" accept="image/*">
                        <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                        <p style="font-size:0.8125rem;font-weight:600;">Click or drop an image</p>
                    </div>
                    <input type="hidden" name="fleet_vehicles[${i}][image]" value="">
                </div>
                <div class="hocms-row hocms-row-4">
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Name</label><input type="text" class="hocms-field-input" name="fleet_vehicles[${i}][name]" placeholder="Saloon"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Passengers</label><input type="text" class="hocms-field-input" name="fleet_vehicles[${i}][pax]" placeholder="1-4"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Luggage</label><input type="text" class="hocms-field-input" name="fleet_vehicles[${i}][luggage]" placeholder="2"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Price (£)</label><input type="text" class="hocms-field-input" name="fleet_vehicles[${i}][price]" placeholder="45"></div>
                </div>
            </div>
        </div>`);
}

function hocmsAddValueItem() {
    const i = hocmsCounters.value++;
    hocmsAppend('hocmsValuesContainer', `
        <div class="hocms-repeat-item" data-hocms-value-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Value</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-row hocms-row-3">
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Title</label><input type="text" class="hocms-field-input" name="story_values[${i}][title]" placeholder="People First"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Description</label><input type="text" class="hocms-field-input" name="story_values[${i}][description]" placeholder="Value description"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Icon Class</label><input type="text" class="hocms-field-input" name="story_values[${i}][icon]" placeholder="users"></div>
                </div>
            </div>
        </div>`);
}

function hocmsAddReviewItem() {
    const i = hocmsCounters.review++;
    hocmsAppend('hocmsReviewsContainer', `
        <div class="hocms-repeat-item" data-hocms-review-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> Review</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-row hocms-row-3">
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Name</label><input type="text" class="hocms-field-input" name="reviews_list[${i}][name]" placeholder="Daniel H."></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Initials</label><input type="text" class="hocms-field-input" name="reviews_list[${i}][initials]" placeholder="DH"></div>
                    <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Rating (0-5)</label><input type="number" class="hocms-field-input" min="0" max="5" step="0.5" name="reviews_list[${i}][rating]" value="5"></div>
                </div>
                <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Review Text</label><textarea class="hocms-field-textarea hocms-rich" rows="3" name="reviews_list[${i}][text]"></textarea></div>
            </div>
        </div>`);
}

function hocmsAddFaqItem() {
    const i = hocmsCounters.faq++;
    hocmsAppend('hocmsFaqContainer', `
        <div class="hocms-repeat-item" data-hocms-faq-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label"><span class="hocms-repeat-num">${i + 1}</span> FAQ</span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-field-group"><label class="hocms-field-label">Question</label><input type="text" class="hocms-field-input" name="faq_list[${i}][question]" placeholder="Enter question"></div>
                <div class="hocms-field-group" style="margin-bottom:0;"><label class="hocms-field-label">Answer</label><textarea class="hocms-field-textarea hocms-rich" rows="3" name="faq_list[${i}][answer]"></textarea></div>
            </div>
        </div>`);
}

// Remove item function
function hocmsRemoveItem(button) {
    const item = button.closest('.hocms-repeat-item');
    if (item && confirm('Are you sure you want to remove this item?')) {
        const textareas = item.querySelectorAll('textarea.hocms-rich');
        textareas.forEach(textarea => {
            if (textarea.id && typeof tinymce !== 'undefined') {
                const editor = tinymce.get(textarea.id);
                if (editor) {
                    editor.remove();
                }
            }
        });
        const container = item.parentElement;
        item.remove();
        const items = container.querySelectorAll('.hocms-repeat-item');
        items.forEach((el, idx) => {
            const numSpan = el.querySelector('.hocms-repeat-num');
            if (numSpan) numSpan.textContent = idx + 1;
        });
    }
}

// Form Submission
const hocmsForm = document.getElementById('hocmsForm');
const hocmsSaveBtn = document.getElementById('hocmsSaveBtn');
const hocmsLastSavedSpan = document.getElementById('hocmsLastSaved');

hocmsForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    hocmsFlushRichTextareas();

    hocmsSaveBtn.classList.add('loading');
    hocmsSaveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    hocmsSaveBtn.disabled = true;

    const formData = new FormData(hocmsForm);

    try {
        const response = await fetch(hocmsForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const result = await response.json();

        if (result.success) {
            const now = new Date();
            hocmsLastSavedSpan.textContent = now.toLocaleTimeString();
            hocmsShowNotification('Changes saved successfully!', 'success');

            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            hocmsShowNotification(result.message || 'Error saving changes', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        hocmsShowNotification('An error occurred while saving', 'error');
    } finally {
        hocmsSaveBtn.classList.remove('loading');
        hocmsSaveBtn.innerHTML = '<i class="fas fa-save"></i> Save Changes';
        hocmsSaveBtn.disabled = false;
    }
});

// Show Notification
function hocmsShowNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `hocms-notification hocms-notification-${type}`;
    notification.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i><span>${message}</span>`;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'hocmsSlideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

/* Image Preview & Upload */
function hocmsPreviewImage(imageSrc, previewElementId) {
    const preview = document.getElementById(previewElementId);
    if (!preview) return;

    const img = preview.querySelector('img');
    const span = preview.querySelector('span');

    if (imageSrc && imageSrc.trim()) {
        img.src = imageSrc;
        img.onload = () => {
            img.style.display = 'block';
            if (span) span.style.display = 'none';
        };
        img.onerror = () => {
            img.style.display = 'none';
            if (span) span.style.display = 'block';
        };
    } else {
        img.style.display = 'none';
        if (span) span.style.display = 'block';
    }
}

function hocmsHandleFileUpload(input, previewElementId) {
    const file = input.files && input.files[0];
    if (!file) return;

    // File size validation (5MB)
    if (file.size > 5 * 1024 * 1024) {
        hocmsShowNotification('File size exceeds 5MB. Please choose a smaller file.', 'error');
        input.value = '';
        return;
    }

    // File type validation
    if (!file.type.startsWith('image/')) {
        hocmsShowNotification('Please select a valid image file.', 'error');
        input.value = '';
        return;
    }

    // Create a preview using FileReader
    const reader = new FileReader();
    reader.onload = (e) => {
        const preview = document.getElementById(previewElementId);
        if (!preview) return;

        const img = preview.querySelector('img');
        const span = preview.querySelector('span');

        img.src = e.target.result;
        img.style.display = 'block';
        if (span) span.style.display = 'none';

        hocmsShowNotification(`Image "${file.name}" selected for upload`, 'success');
    };
    reader.readAsDataURL(file);
}

function hocmsHandleDrop(event, inputId) {
    event.preventDefault();
    event.stopPropagation();

    const files = event.dataTransfer.files;
    if (files && files[0]) {
        const input = document.getElementById(inputId);
        if (input) {
            input.files = files;
            
            // Determine which preview element based on input ID
            let correctPreviewId;
            if (inputId === 'heroImageUpload') correctPreviewId = 'heroImagePreview';
            else if (inputId === 'aboutImageUpload') correctPreviewId = 'aboutImagePreview';
            else correctPreviewId = inputId.replace('Upload', 'Preview');

            hocmsHandleFileUpload(input, correctPreviewId);
        }
    }
}

// Preview Changes
function hocmsPreviewChanges() {
    window.open('{{ route("home") }}', '_blank');
}
</script>
@endsection