{{-- resources/views/admin/pages/inner/about.blade.php --}}

@extends('admin.layout.app')

@section('title', 'About Page Content')
@section('page_title', 'About Page')
@section('page_subtitle', 'Manage About page sections dynamically')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
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
    --hocms-accent-dark: #1E4FC2;
    --hocms-accent-light: #EBF1FF;
    --hocms-success: #10b981;
    --hocms-success-light: #d1fae5;
    --hocms-danger: #ef4444;
    --hocms-danger-light: #fee2e2;
    --hocms-cyan: #FFD426;
    --hocms-cyan-light: #FFFBEB;
    --hocms-gradient-primary: linear-gradient(135deg, #2E6BE6 0%, #1E4FC2 100%);
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

/* Sidebar */
.hocms-rail {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
    background: var(--hocms-bg-secondary);
    border-right: 1px solid var(--hocms-border-light);
    display: flex;
    flex-direction: column;
    z-index: 10;
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

/* Main Content */
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

/* Cards */
.hocms-card-wrapper {
    background: var(--hocms-bg-secondary);
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-xl);
    margin-bottom: 24px;
    overflow: hidden;
    transition: all var(--hocms-transition-fast);
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
    flex: 1;
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
    flex-shrink: 0;
}

.hocms-section-badge.cyan {
    background: var(--hocms-cyan);
    color: var(--hocms-text-primary);
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

/* Toggle Switch */
.hocms-toggle {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    flex-shrink: 0;
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

/* Form Fields */
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

/* Dual Image Input (URL + Upload) */
.hocms-image-dual-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
}

.hocms-image-input-section {
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-lg);
    padding: 16px;
    background: var(--hocms-bg-tertiary);
}

.hocms-image-input-section h5 {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--hocms-text-secondary);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.hocms-image-input-url {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.hocms-image-input-url .hocms-field-input {
    margin-bottom: 0;
}

.hocms-image-preview-box {
    width: 100%;
    height: 120px;
    border: 1.5px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-md);
    overflow: hidden;
    background: var(--hocms-bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--hocms-text-muted);
    font-size: 0.75rem;
    margin-top: 8px;
}

.hocms-image-preview-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* File Upload */
.hocms-file-drop {
    position: relative;
    border: 2px dashed var(--hocms-border-light);
    border-radius: var(--hocms-radius-lg);
    padding: 28px 20px;
    text-align: center;
    cursor: pointer;
    background: var(--hocms-bg-secondary);
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
    background: var(--hocms-bg-tertiary);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    color: var(--hocms-accent);
    font-size: 1.25rem;
}

.hocms-file-drop-text {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--hocms-text-primary);
    margin-bottom: 4px;
}

.hocms-file-drop-subtext {
    font-size: 0.75rem;
    color: var(--hocms-text-muted);
}

.hocms-current-thumb {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
    padding: 10px;
    border: 1px solid var(--hocms-border-light);
    border-radius: var(--hocms-radius-md);
    background: var(--hocms-bg-secondary);
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

.hocms-file-input-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--hocms-text-secondary);
    margin-bottom: 8px;
    display: block;
}

/* Repeater Items */
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
    flex-shrink: 0;
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

/* Grid */
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

/* Buttons */
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
    border: none;
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
}

.hocms-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--hocms-shadow-md);
}

.hocms-btn-cyan {
    background: var(--hocms-cyan);
    color: var(--hocms-text-primary);
}

.hocms-btn-cyan:hover {
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

/* Save Bar */
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
    z-index: 20;
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

/* Notification */
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

/* TinyMCE */
.tox-tinymce {
    border-radius: var(--hocms-radius-md) !important;
    border: 1.5px solid var(--hocms-border-light) !important;
    margin-bottom: 0;
}

.tox-tinymce:focus-within {
    border-color: var(--hocms-accent) !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
}

/* Responsive */
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
    // Decode JSON fields from database
    $storyPillars = $aboutPage?->story_pillars ?? [
        ['icon' => 'fas fa-users', 'title' => 'People First', 'description' => 'We treat every customer like a guest, not just a booking.'],
        ['icon' => 'fas fa-shield-halved', 'title' => 'Integrity', 'description' => 'Transparent pricing, honest service and no hidden surprises.'],
        ['icon' => 'fas fa-star', 'title' => 'Excellence', 'description' => 'From our drivers to our vehicles, we aim for excellence every time.'],
    ];

    $statsItems = $aboutPage?->stats ?? [
        ['icon' => 'fas fa-headset', 'number' => '24/7', 'label' => 'Service Available', 'description' => "We're here whenever you need us."],
        ['icon' => 'fas fa-shield-check', 'number' => '100%', 'label' => 'Commitment', 'description' => 'Your safety and comfort come first.'],
        ['icon' => 'fas fa-calendar-check', 'number' => 'On-Time', 'label' => 'Every Time', 'description' => 'We value your time as much as you do.'],
        ['icon' => 'fas fa-map-location-dot', 'number' => 'Across', 'label' => 'the UK', 'description' => 'From major airports to every city.'],
    ];

    $valuesItems = $aboutPage?->values ?? [
        ['icon' => 'fas fa-steering-wheel', 'title' => 'Safety', 'description' => 'We follow the highest standards to ensure every journey is safe and secure.'],
        ['icon' => 'fas fa-thumbs-up', 'title' => 'Reliability', 'description' => 'You can count on us for punctual pickups and smooth transfers.'],
        ['icon' => 'fas fa-user-tie', 'title' => 'Professionalism', 'description' => 'Our drivers are experienced, courteous and dedicated to providing the best service.'],
        ['icon' => 'fas fa-car-side', 'title' => 'Comfort', 'description' => 'Modern vehicles, well-maintained for a premium travel experience.'],
        ['icon' => 'fas fa-comment-dots', 'title' => 'Customer Care', 'description' => 'We listen, we care and we go the extra mile for our customers.'],
    ];

    // Visibility flags (using default true if not set)
    $sectionsEnabled = [
        'hero' => $aboutPage?->is_active ?? true,
        'story' => $aboutPage?->is_active ?? true,
        'stats' => $aboutPage?->stats_visible ?? true,
        'values' => $aboutPage?->values_visible ?? true,
        'mission' => $aboutPage?->mission_visible ?? true,
        'cta' => $aboutPage?->cta_visible ?? true,
    ];
@endphp

<div class="hocms-wrapper">
    <div class="hocms-shell">

        {{-- Sidebar --}}
        <nav class="hocms-rail">
            <div class="hocms-rail-logo">
                <span>About Page</span>
                <strong>Content Manager</strong>
            </div>

            <span class="hocms-nav-section-label">Sections</span>

            <button type="button" class="hocms-nav-item active" data-hocms-section="hero">
                <span class="hocms-nav-icon"><i class="fas fa-flag-checkered"></i></span>
                Hero
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="story">
                <span class="hocms-nav-icon"><i class="fas fa-book-open"></i></span>
                Our Story
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="stats">
                <span class="hocms-nav-icon"><i class="fas fa-chart-bar"></i></span>
                Stats Dashboard
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="values">
                <span class="hocms-nav-icon"><i class="fas fa-gem"></i></span>
                Values
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="mission">
                <span class="hocms-nav-icon"><i class="fas fa-bullseye"></i></span>
                Mission
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="cta">
                <span class="hocms-nav-icon"><i class="fas fa-bullhorn"></i></span>
                CTA
                <span class="hocms-nav-dot"></span>
            </button>

            <button type="button" class="hocms-nav-item" data-hocms-section="seo">
                <span class="hocms-nav-icon"><i class="fas fa-search"></i></span>
                SEO Meta
                <span class="hocms-nav-dot"></span>
            </button>
        </nav>

        {{-- Main Content --}}
        <main class="hocms-main">
            <div class="hocms-page-header">
                <div>
                    <h1>About Page Content</h1>
                    <p>Manage all sections of the About page dynamically</p>
                </div>
                <span class="hocms-status-pill">
                    <i class="fas fa-circle" style="font-size:8px;"></i>
                    {{ $aboutPage?->is_active ? 'Active' : 'Draft' }}
                </span>
            </div>

            <form action="{{ route('admin.pages.about.store') }}" method="POST" enctype="multipart/form-data" id="hocmsForm">
                @csrf
                @method('PUT')

                {{-- ============ HERO ============ --}}
                <div id="hocms-hero" class="hocms-card-wrapper {{ !$sectionsEnabled['hero'] ? 'hocms-disabled' : '' }}">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-flag-checkered"></i></div>
                            <div>
                                <h3>Hero Section</h3>
                                <p>Main heading, subtitle, tag, and quote</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ $sectionsEnabled['hero'] ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-count">8 fields</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <!-- Hero Tag -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Hero Tag</label>
                            <input type="text" class="hocms-field-input" name="hero_tag"
                                   value="{{ $aboutPage?->hero_tag ?? 'ABOUT US' }}">
                            <p class="hocms-field-hint">Small tag above the main heading</p>
                        </div>

                        <!-- Hero Heading -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Main Heading</label>
                            <input type="text" class="hocms-field-input" name="hero_heading"
                                   value="{{ $aboutPage?->hero_heading ?? 'Driven by Values.' }}">
                            <p class="hocms-field-hint">Main hero heading text</p>
                        </div>

                        <!-- Hero Highlight Text -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Highlight Text</label>
                            <input type="text" class="hocms-field-input" name="hero_highlight_text"
                                   value="{{ $aboutPage?->hero_highlight_text ?? 'You.' }}">
                            <p class="hocms-field-hint">The word that appears in gold/blue color</p>
                        </div>

                        <!-- Hero Subtitle -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Subtitle / Lead Text</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="3" name="hero_subtitle">{{ $aboutPage?->hero_subtitle ?? 'Swift-Ride-taxis was built with a simple mission — to redefine airport transfers in the UK with professionalism, reliability and a customer-first approach.' }}</textarea>
                        </div>

                        <!-- Hero Background Image -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Hero Background Image</label>
                            <div class="hocms-image-dual-container">
                                <!-- URL Input -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-link"></i> Enter Image Link</h5>
                                    <div class="hocms-image-input-url">
                                        <input type="text" class="hocms-field-input" name="hero_background_image"
                                               placeholder="https://example.com/image.jpg"
                                               value="{{ $aboutPage?->hero_background_image ?? 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop' }}"
                                               data-preview-id="heroImagePreview"
                                               onchange="hocmsPreviewImage(this.value, 'heroImagePreview')">
                                        <p class="hocms-field-hint">Full URL to the hero background image (JPG, PNG, WebP)</p>
                                        <div class="hocms-image-preview-box" id="heroImagePreview">
                                            <img src="{{ $aboutPage?->hero_background_image ?? '' }}" alt="Preview" style="display:{{ $aboutPage?->hero_background_image ? 'block' : 'none' }}">
                                            <span style="display:{{ $aboutPage?->hero_background_image ? 'none' : 'block' }}">Image preview</span>
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

                        <div class="hocms-divider"></div>

                        <!-- Quote Section -->
                        <p style="font-size:0.8125rem;font-weight:600;color:var(--hocms-text-secondary);margin-bottom:16px;">Hero Quote Card</p>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Quote Text</label>
                            <textarea class="hocms-field-textarea" rows="3" name="hero_quote_text">{{ $aboutPage?->hero_quote_text ?? 'We understand that travelling can be stressful. From flight delays to last-minute changes, you need a transfer service you can rely on.' }}</textarea>
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Quote Author</label>
                            <input type="text" class="hocms-field-input" name="hero_quote_author"
                                   value="{{ $aboutPage?->hero_quote_author ?? 'Founder, Swift-Ride-taxis' }}">
                        </div>

                        <div class="hocms-field-group" style="margin-bottom:0;">
                            <label class="hocms-field-label">
                                <input type="hidden" name="hero_quote_visible" value="0">
                                <input type="checkbox" name="hero_quote_visible" value="1" {{ $aboutPage?->hero_quote_visible !== false ? 'checked' : '' }}>
                                Show Quote Card
                            </label>
                        </div>
                    </div>
                </div>

                {{-- ============ OUR STORY ============ --}}
                <div id="hocms-story" class="hocms-card-wrapper {{ !$sectionsEnabled['story'] ? 'hocms-disabled' : '' }}">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-book-open"></i></div>
                            <div>
                                <h3>Our Story</h3>
                                <p>Journey so far — images, headings, paragraphs, pillars</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ $sectionsEnabled['story'] ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-count">9 fields</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <!-- Story Eyebrow -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Eyebrow Tag</label>
                            <input type="text" class="hocms-field-input" name="story_eyebrow"
                                   value="{{ $aboutPage?->story_eyebrow ?? 'OUR STORY' }}">
                        </div>

                        <!-- Story Heading -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="story_heading"
                                   value="{{ $aboutPage?->story_heading ?? 'The Journey Behind Swift-Ride-taxis' }}">
                        </div>

                        <!-- Story Paragraphs -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Paragraph 1</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="4" name="story_paragraph_1">{{ $aboutPage?->story_paragraph_1 ?? 'We understand that travelling can be stressful. From flight delays to last-minute changes, you need a transfer service you can rely on.' }}</textarea>
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Paragraph 2</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="4" name="story_paragraph_2">{{ $aboutPage?->story_paragraph_2 ?? 'That\'s why we focus on punctuality, comfort and peace of mind — ensuring every journey is smooth from the moment you book with us.' }}</textarea>
                        </div>

                        <div class="hocms-divider"></div>

                        <!-- Story Images -->
                        <p style="font-size:0.8125rem;font-weight:600;color:var(--hocms-text-secondary);margin-bottom:16px;">Story Images</p>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Main Image</label>
                            <div class="hocms-image-dual-container">
                                <!-- URL Input -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-link"></i> Enter Image Link</h5>
                                    <div class="hocms-image-input-url">
                                        <input type="text" class="hocms-field-input" name="story_main_image"
                                               placeholder="https://example.com/image.jpg"
                                               value="{{ $aboutPage?->story_main_image ?? 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=800&auto=format&fit=crop' }}"
                                               data-preview-id="storyMainImagePreview"
                                               onchange="hocmsPreviewImage(this.value, 'storyMainImagePreview')">
                                        <p class="hocms-field-hint">Full URL to the main story image</p>
                                        <div class="hocms-image-preview-box" id="storyMainImagePreview">
                                            <img src="{{ $aboutPage?->story_main_image ?? '' }}" alt="Preview" style="display:{{ $aboutPage?->story_main_image ? 'block' : 'none' }}">
                                            <span style="display:{{ $aboutPage?->story_main_image ? 'none' : 'block' }}">Image preview</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-cloud-upload-alt"></i> Or Upload Image</h5>
                                    <label class="hocms-file-drop" ondrop="hocmsHandleDrop(event, 'storyMainImageUpload')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                                        <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                        <div class="hocms-file-drop-text">Click or drag image here</div>
                                        <div class="hocms-file-drop-subtext">PNG, JPG, WebP (Max 5MB)</div>
                                        <input type="file" id="storyMainImageUpload" name="story_main_image_file" accept="image/*" onchange="hocmsHandleFileUpload(this, 'storyMainImagePreview')">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Overlap Image</label>
                            <div class="hocms-image-dual-container">
                                <!-- URL Input -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-link"></i> Enter Image Link</h5>
                                    <div class="hocms-image-input-url">
                                        <input type="text" class="hocms-field-input" name="story_overlap_image"
                                               placeholder="https://example.com/image.jpg"
                                               value="{{ $aboutPage?->story_overlap_image ?? 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=600&auto=format&fit=crop' }}"
                                               data-preview-id="storyOverlapImagePreview"
                                               onchange="hocmsPreviewImage(this.value, 'storyOverlapImagePreview')">
                                        <p class="hocms-field-hint">Full URL to the overlapping image</p>
                                        <div class="hocms-image-preview-box" id="storyOverlapImagePreview">
                                            <img src="{{ $aboutPage?->story_overlap_image ?? '' }}" alt="Preview" style="display:{{ $aboutPage?->story_overlap_image ? 'block' : 'none' }}">
                                            <span style="display:{{ $aboutPage?->story_overlap_image ? 'none' : 'block' }}">Image preview</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-cloud-upload-alt"></i> Or Upload Image</h5>
                                    <label class="hocms-file-drop" ondrop="hocmsHandleDrop(event, 'storyOverlapImageUpload')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                                        <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                        <div class="hocms-file-drop-text">Click or drag image here</div>
                                        <div class="hocms-file-drop-subtext">PNG, JPG, WebP (Max 5MB)</div>
                                        <input type="file" id="storyOverlapImageUpload" name="story_overlap_image_file" accept="image/*" onchange="hocmsHandleFileUpload(this, 'storyOverlapImagePreview')">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Badge Text</label>
                            <input type="text" class="hocms-field-input" name="story_badge_text"
                                   value="{{ $aboutPage?->story_badge_text ?? 'CUSTOMER FIRST APPROACH' }}">
                        </div>

                        <div class="hocms-divider"></div>

                        <!-- Story Pillars (3 items) -->
                        <p style="font-size:0.8125rem;font-weight:600;color:var(--hocms-text-secondary);margin-bottom:16px;">Story Pillars (3 items)</p>

                        <div id="hocmsPillarsContainer">
                            @foreach($storyPillars as $index => $pillar)
                            <div class="hocms-repeat-item" data-hocms-pillar-index="{{ $index }}">
                                <div class="hocms-repeat-item-header">
                                    <span class="hocms-repeat-item-label">
                                        <span class="hocms-repeat-num">{{ $index + 1 }}</span>
                                        Pillar
                                    </span>
                                    <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="hocms-repeat-item-body">
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Icon Class</label>
                                        <input type="text" class="hocms-field-input" name="story_pillars[{{ $index }}][icon]" value="{{ $pillar['icon'] ?? 'fas fa-users' }}" placeholder="fas fa-users">
                                    </div>
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Title</label>
                                        <input type="text" class="hocms-field-input" name="story_pillars[{{ $index }}][title]" value="{{ $pillar['title'] ?? '' }}" placeholder="People First">
                                    </div>
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Description</label>
                                        <textarea class="hocms-field-textarea" rows="2" name="story_pillars[{{ $index }}][description]" placeholder="Description...">{{ $pillar['description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="hocms-btn hocms-btn-ghost" onclick="hocmsAddPillarItem()" style="margin-top:8px;width:100%;">
                            <i class="fas fa-plus"></i> Add Pillar
                        </button>
                    </div>
                </div>

                {{-- ============ STATS DASHBOARD ============ --}}
                <div id="hocms-stats" class="hocms-card-wrapper {{ !$sectionsEnabled['stats'] ? 'hocms-disabled' : '' }}">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-chart-bar"></i></div>
                            <div>
                                <h3>Stats Dashboard</h3>
                                <p>Live readout strip with key metrics</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="stats_visible" value="0">
                                <input type="checkbox" name="stats_visible" value="1" {{ $sectionsEnabled['stats'] ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-count">{{ count($statsItems) }} stats</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div id="hocmsStatsContainer">
                            @foreach($statsItems as $index => $stat)
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
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Icon Class</label>
                                        <input type="text" class="hocms-field-input" name="stats[{{ $index }}][icon]" value="{{ $stat['icon'] ?? 'fas fa-headset' }}" placeholder="fas fa-headset">
                                    </div>
                                    <div class="hocms-row hocms-row-2">
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Number/Value</label>
                                            <input type="text" class="hocms-field-input" name="stats[{{ $index }}][number]" value="{{ $stat['number'] ?? '' }}" placeholder="24/7">
                                        </div>
                                        <div class="hocms-field-group" style="margin-bottom:0;">
                                            <label class="hocms-field-label">Label</label>
                                            <input type="text" class="hocms-field-input" name="stats[{{ $index }}][label]" value="{{ $stat['label'] ?? '' }}" placeholder="Service Available">
                                        </div>
                                    </div>
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Description</label>
                                        <input type="text" class="hocms-field-input" name="stats[{{ $index }}][description]" value="{{ $stat['description'] ?? '' }}" placeholder="We're here whenever you need us.">
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

                {{-- ============ VALUES ============ --}}
                <div id="hocms-values" class="hocms-card-wrapper {{ !$sectionsEnabled['values'] ? 'hocms-disabled' : '' }}">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-gem"></i></div>
                            <div>
                                <h3>Values</h3>
                                <p>Core values that drive the company</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="values_visible" value="0">
                                <input type="checkbox" name="values_visible" value="1" {{ $sectionsEnabled['values'] ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-count">{{ count($valuesItems) }} values</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <!-- Values Eyebrow -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Eyebrow Tag</label>
                            <input type="text" class="hocms-field-input" name="values_eyebrow"
                                   value="{{ $aboutPage?->values_eyebrow ?? 'OUR VALUES' }}">
                        </div>

                        <!-- Values Heading -->
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="values_heading"
                                   value="{{ $aboutPage?->values_heading ?? 'What Drives Us Every Day' }}">
                        </div>

                        <div class="hocms-divider"></div>

                        <div id="hocmsValuesContainer">
                            @foreach($valuesItems as $index => $value)
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
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Icon Class</label>
                                        <input type="text" class="hocms-field-input" name="values[{{ $index }}][icon]" value="{{ $value['icon'] ?? 'fas fa-star' }}" placeholder="fas fa-star">
                                    </div>
                                    <div class="hocms-field-group">
                                        <label class="hocms-field-label">Title</label>
                                        <input type="text" class="hocms-field-input" name="values[{{ $index }}][title]" value="{{ $value['title'] ?? '' }}" placeholder="Safety">
                                    </div>
                                    <div class="hocms-field-group" style="margin-bottom:0;">
                                        <label class="hocms-field-label">Description</label>
                                        <textarea class="hocms-field-textarea" rows="2" name="values[{{ $index }}][description]" placeholder="Description...">{{ $value['description'] ?? '' }}</textarea>
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

                {{-- ============ MISSION ============ --}}
                <div id="hocms-mission" class="hocms-card-wrapper {{ !$sectionsEnabled['mission'] ? 'hocms-disabled' : '' }}">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-bullseye"></i></div>
                            <div>
                                <h3>Mission</h3>
                                <p>Company mission statement</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="mission_visible" value="0">
                                <input type="checkbox" name="mission_visible" value="1" {{ $sectionsEnabled['mission'] ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-count">4 fields</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Eyebrow Tag</label>
                            <input type="text" class="hocms-field-input" name="mission_eyebrow"
                                   value="{{ $aboutPage?->mission_eyebrow ?? 'OUR MISSION' }}">
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="mission_heading"
                                   value="{{ $aboutPage?->mission_heading ?? 'To be the UK\'s most trusted airport transfer company' }}">
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Description</label>
                            <textarea class="hocms-field-textarea hocms-rich" rows="4" name="mission_description">{{ $aboutPage?->mission_description ?? 'We are committed to providing exceptional service, ensuring every journey is safe, comfortable, and reliable.' }}</textarea>
                        </div>

                        <div class="hocms-field-group" style="margin-bottom:0;">
                            <label class="hocms-field-label">Background Image</label>
                            <div class="hocms-image-dual-container">
                                <!-- URL Input -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-link"></i> Enter Image Link</h5>
                                    <div class="hocms-image-input-url">
                                        <input type="text" class="hocms-field-input" name="mission_background_image"
                                               placeholder="https://example.com/image.jpg"
                                               value="{{ $aboutPage?->mission_background_image ?? '' }}"
                                               data-preview-id="missionImagePreview"
                                               onchange="hocmsPreviewImage(this.value, 'missionImagePreview')">
                                        <p class="hocms-field-hint">Full URL to the mission background image (JPG, PNG, WebP)</p>
                                        <div class="hocms-image-preview-box" id="missionImagePreview">
                                            <img src="{{ $aboutPage?->mission_background_image ?? '' }}" alt="Preview" style="display:{{ $aboutPage?->mission_background_image ? 'block' : 'none' }}">
                                            <span style="display:{{ $aboutPage?->mission_background_image ? 'none' : 'block' }}">Image preview</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="hocms-image-input-section">
                                    <h5><i class="fas fa-cloud-upload-alt"></i> Or Upload Image</h5>
                                    <label class="hocms-file-drop" ondrop="hocmsHandleDrop(event, 'missionImageUpload')" ondragover="event.preventDefault()" ondragleave="event.preventDefault()">
                                        <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                                        <div class="hocms-file-drop-text">Click or drag image here</div>
                                        <div class="hocms-file-drop-subtext">PNG, JPG, WebP (Max 5MB)</div>
                                        <input type="file" id="missionImageUpload" name="mission_background_image_file" accept="image/*" onchange="hocmsHandleFileUpload(this, 'missionImagePreview')">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============ CTA ============ --}}
                <div id="hocms-cta" class="hocms-card-wrapper {{ !$sectionsEnabled['cta'] ? 'hocms-disabled' : '' }}">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-bullhorn"></i></div>
                            <div>
                                <h3>CTA / Call to Action</h3>
                                <p>Final call to action section</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-disabled-flag">Disabled</span>
                            <label class="hocms-toggle" onclick="event.stopPropagation()" title="Enable/disable this section on the live page">
                                <input type="hidden" name="cta_visible" value="0">
                                <input type="checkbox" name="cta_visible" value="1" {{ $sectionsEnabled['cta'] ? 'checked' : '' }} onchange="hocmsSyncSectionState(this)">
                                <span class="hocms-toggle-track"><span class="hocms-toggle-thumb"></span></span>
                            </label>
                            <span class="hocms-section-count">6 fields</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Heading</label>
                            <input type="text" class="hocms-field-input" name="cta_heading"
                                   value="{{ $aboutPage?->cta_heading ?? 'Have Questions?' }}">
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Subheading</label>
                            <input type="text" class="hocms-field-input" name="cta_subheading"
                                   value="{{ $aboutPage?->cta_subheading ?? 'We\'re here to help 24/7' }}">
                        </div>

                        <div class="hocms-divider"></div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Phone Label</label>
                            <input type="text" class="hocms-field-input" name="cta_phone_label"
                                   value="{{ $aboutPage?->cta_phone_label ?? 'CALL 020 1234 5678' }}">
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Phone Number</label>
                            <input type="text" class="hocms-field-input" name="cta_phone_number"
                                   value="{{ $aboutPage?->cta_phone_number ?? '02012345678' }}">
                            <p class="hocms-field-hint">For the tel: link (no spaces or special characters)</p>
                        </div>

                        <div class="hocms-row hocms-row-2">
                            <div class="hocms-field-group" style="margin-bottom:0;">
                                <label class="hocms-field-label">Button Text</label>
                                <input type="text" class="hocms-field-input" name="cta_button_text"
                                       value="{{ $aboutPage?->cta_button_text ?? 'GET IN TOUCH' }}">
                            </div>
                            <div class="hocms-field-group" style="margin-bottom:0;">
                                <label class="hocms-field-label">Button URL</label>
                                <input type="text" class="hocms-field-input" name="cta_button_url"
                                       value="{{ $aboutPage?->cta_button_url ?? '/contact' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============ SEO META ============ --}}
                <div id="hocms-seo" class="hocms-card-wrapper">
                    <div class="hocms-section-header" onclick="hocmsToggleSection(this)">
                        <div class="hocms-section-title">
                            <div class="hocms-section-badge"><i class="fas fa-search"></i></div>
                            <div>
                                <h3>SEO Meta</h3>
                                <p>Meta title, description, and keywords</p>
                            </div>
                        </div>
                        <div class="hocms-section-meta">
                            <span class="hocms-section-count">3 fields</span>
                            <span class="hocms-section-toggle open">▼</span>
                        </div>
                    </div>

                    <div class="hocms-section-body">
                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Meta Title</label>
                            <input type="text" class="hocms-field-input" name="seo_title"
                                   value="{{ $aboutPage?->seo_title ?? 'About Us | Swift-Ride-taxis - Driven by Values' }}">
                            <p class="hocms-field-hint">Recommended: 50-60 characters</p>
                        </div>

                        <div class="hocms-field-group">
                            <label class="hocms-field-label">Meta Description</label>
                            <textarea class="hocms-field-textarea" rows="3" name="seo_description">{{ $aboutPage?->seo_description ?? 'Swift-Ride-taxis was built to redefine airport transfers in the UK with professionalism, reliability and a customer-first approach.' }}</textarea>
                            <p class="hocms-field-hint">Recommended: 150-160 characters</p>
                        </div>

                        <div class="hocms-field-group" style="margin-bottom:0;">
                            <label class="hocms-field-label">Meta Keywords</label>
                            <input type="text" class="hocms-field-input" name="seo_keywords"
                                   value="{{ $aboutPage?->seo_keywords ?? '' }}">
                            <p class="hocms-field-hint">Comma-separated keywords (optional)</p>
                        </div>
                    </div>
                </div>


                {{-- Save Bar --}}
                <div class="hocms-save-bar">
                    <div class="hocms-save-bar-info">
                        <i class="fas fa-clock"></i>
                        Last saved <strong id="hocmsLastSaved">{{ $aboutPage?->updated_at?->diffForHumans() ?? 'just now' }}</strong>
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
document.querySelectorAll('.hocms-toggle input[type="checkbox"]').forEach(cb => {
    hocmsSyncSectionState(cb);
});

/* ---------------------------------------------------------
   Rich text editor (TinyMCE)
--------------------------------------------------------- */
function hocmsEnhanceRichTextareas(scope) {
    if (typeof tinymce === 'undefined') {
        console.warn('TinyMCE not loaded');
        return;
    }

    const root = scope || document;
    root.querySelectorAll('textarea.hocms-rich').forEach((textarea) => {
        if (textarea.dataset.hocmsTinyDone) return;
        textarea.dataset.hocmsTinyDone = '1';

        if (!textarea.id) {
            textarea.id = 'hocms-editor-' + Math.random().toString(36).substring(2, 9);
        }

        // Remove existing instance if any
        if (tinymce.get(textarea.id)) {
            tinymce.get(textarea.id).remove();
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

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        hocmsEnhanceRichTextareas(document);
    }, 500);
});

/* ---------------------------------------------------------
   Toggle section
--------------------------------------------------------- */
function hocmsToggleSection(header) {
    const body = header.nextElementSibling;
    const toggle = header.querySelector('.hocms-section-toggle');

    if (!body) return;

    if (body.classList.contains('hidden')) {
        body.classList.remove('hidden');
        if (toggle) toggle.classList.add('open');
    } else {
        body.classList.add('hidden');
        if (toggle) toggle.classList.remove('open');
    }
}

/* ---------------------------------------------------------
   Navigation
--------------------------------------------------------- */
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

if (hocmsSections.length > 0 && hocmsNavItems.length > 0) {
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
}

/* ---------------------------------------------------------
   Repeater engine
--------------------------------------------------------- */
let hocmsCounters = {
    pillar: document.querySelectorAll('#hocmsPillarsContainer .hocms-repeat-item').length || 0,
    stat: document.querySelectorAll('#hocmsStatsContainer .hocms-repeat-item').length || 0,
    value: document.querySelectorAll('#hocmsValuesContainer .hocms-repeat-item').length || 0,
};

function hocmsAppend(containerId, html) {
    const container = document.getElementById(containerId);
    if (!container) return;
    container.insertAdjacentHTML('beforeend', html);

    // Re-initialize TinyMCE for the new textareas
    const newItems = container.lastElementChild;
    if (newItems) {
        setTimeout(() => {
            hocmsEnhanceRichTextareas(newItems);
        }, 200);
    }
}

function hocmsAddPillarItem() {
    const i = hocmsCounters.pillar++;
    hocmsAppend('hocmsPillarsContainer', `
        <div class="hocms-repeat-item" data-hocms-pillar-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label">
                    <span class="hocms-repeat-num">${i + 1}</span>
                    Pillar
                </span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-field-group">
                    <label class="hocms-field-label">Icon Class</label>
                    <input type="text" class="hocms-field-input" name="story_pillars[${i}][icon]" placeholder="fas fa-users">
                </div>
                <div class="hocms-field-group">
                    <label class="hocms-field-label">Title</label>
                    <input type="text" class="hocms-field-input" name="story_pillars[${i}][title]" placeholder="People First">
                </div>
                <div class="hocms-field-group" style="margin-bottom:0;">
                    <label class="hocms-field-label">Description</label>
                    <textarea class="hocms-field-textarea" rows="2" name="story_pillars[${i}][description]" placeholder="Description..."></textarea>
                </div>
            </div>
        </div>`);
}

function hocmsAddStatItem() {
    const i = hocmsCounters.stat++;
    hocmsAppend('hocmsStatsContainer', `
        <div class="hocms-repeat-item" data-hocms-stat-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label">
                    <span class="hocms-repeat-num">${i + 1}</span>
                    Stat
                </span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-field-group">
                    <label class="hocms-field-label">Icon Class</label>
                    <input type="text" class="hocms-field-input" name="stats[${i}][icon]" placeholder="fas fa-headset">
                </div>
                <div class="hocms-row hocms-row-2">
                    <div class="hocms-field-group" style="margin-bottom:0;">
                        <label class="hocms-field-label">Number/Value</label>
                        <input type="text" class="hocms-field-input" name="stats[${i}][number]" placeholder="24/7">
                    </div>
                    <div class="hocms-field-group" style="margin-bottom:0;">
                        <label class="hocms-field-label">Label</label>
                        <input type="text" class="hocms-field-input" name="stats[${i}][label]" placeholder="Service Available">
                    </div>
                </div>
                <div class="hocms-field-group" style="margin-bottom:0;">
                    <label class="hocms-field-label">Description</label>
                    <input type="text" class="hocms-field-input" name="stats[${i}][description]" placeholder="We're here whenever you need us.">
                </div>
            </div>
        </div>`);
}

function hocmsAddValueItem() {
    const i = hocmsCounters.value++;
    hocmsAppend('hocmsValuesContainer', `
        <div class="hocms-repeat-item" data-hocms-value-index="${i}">
            <div class="hocms-repeat-item-header">
                <span class="hocms-repeat-item-label">
                    <span class="hocms-repeat-num">${i + 1}</span>
                    Value
                </span>
                <button type="button" class="hocms-btn-remove" onclick="hocmsRemoveItem(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            <div class="hocms-repeat-item-body">
                <div class="hocms-field-group">
                    <label class="hocms-field-label">Icon Class</label>
                    <input type="text" class="hocms-field-input" name="values[${i}][icon]" placeholder="fas fa-star">
                </div>
                <div class="hocms-field-group">
                    <label class="hocms-field-label">Title</label>
                    <input type="text" class="hocms-field-input" name="values[${i}][title]" placeholder="Safety">
                </div>
                <div class="hocms-field-group" style="margin-bottom:0;">
                    <label class="hocms-field-label">Description</label>
                    <textarea class="hocms-field-textarea" rows="2" name="values[${i}][description]" placeholder="Description..."></textarea>
                </div>
            </div>
        </div>`);
}

function hocmsRemoveItem(button) {
    const item = button.closest('.hocms-repeat-item');
    if (item && confirm('Are you sure you want to remove this item?')) {
        // Clean up TinyMCE instances
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

        // Renumber remaining items
        const items = container.querySelectorAll('.hocms-repeat-item');
        items.forEach((el, idx) => {
            const numSpan = el.querySelector('.hocms-repeat-num');
            if (numSpan) {
                const text = numSpan.textContent;
                if (text.length > 2 && !isNaN(text)) {
                    numSpan.textContent = idx + 1;
                } else if (text.length >= 2 && text.match(/^\d{2}/)) {
                    numSpan.textContent = String(idx + 1).padStart(2, '0');
                } else {
                    numSpan.textContent = idx + 1;
                }
            }
        });
    }
}

/* ---------------------------------------------------------
   Form Submission
--------------------------------------------------------- */
const hocmsForm = document.getElementById('hocmsForm');
const hocmsSaveBtn = document.getElementById('hocmsSaveBtn');
const hocmsLastSavedSpan = document.getElementById('hocmsLastSaved');

if (hocmsForm) {
    hocmsForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Flush TinyMCE content
        hocmsFlushRichTextareas();

        // Process dual image inputs (prioritize uploaded files over URLs)
        const imageFields = [
            { urlField: 'hero_background_image', fileField: 'hero_background_image_file' },
            { urlField: 'story_main_image', fileField: 'story_main_image_file' },
            { urlField: 'story_overlap_image', fileField: 'story_overlap_image_file' },
            { urlField: 'mission_background_image', fileField: 'mission_background_image_file' },
        ];

        imageFields.forEach(({ urlField, fileField }) => {
            const fileInput = hocmsForm.querySelector(`input[name="${fileField}"]`);
            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                // File was uploaded, so mark URL field for removal to use file
                const urlInput = hocmsForm.querySelector(`input[name="${urlField}"]`);
                if (urlInput) {
                    urlInput.dataset.hocmsUseFile = 'true';
                }
            }
        });

        hocmsSaveBtn.classList.add('loading');
        hocmsSaveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        hocmsSaveBtn.disabled = true;

        const formData = new FormData(hocmsForm);

        try {
            const response = await fetch(hocmsForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || ''
                }
            });

            const result = await response.json();

            if (result.success) {
                const now = new Date();
                hocmsLastSavedSpan.textContent = now.toLocaleTimeString();
                hocmsShowNotification('Changes saved successfully!', 'success');

                setTimeout(() => {
                    location.reload();
                }, 1500);
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
}

/* ---------------------------------------------------------
   Notification
--------------------------------------------------------- */
function hocmsShowNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `hocms-notification hocms-notification-${type}`;
    notification.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i><span>${message}</span>`;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'hocmsSlideOut 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) notification.remove();
        }, 300);
    }, 3000);
}

/* ---------------------------------------------------------
   Image Preview & Upload
--------------------------------------------------------- */
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
            const previewId = input.id.replace('Upload', 'Preview').replace('hero', 'hero').replace('story', 'story').replace('mission', 'mission');
            
            // Determine which preview element based on input ID
            let correctPreviewId;
            if (inputId === 'heroImageUpload') correctPreviewId = 'heroImagePreview';
            else if (inputId === 'storyMainImageUpload') correctPreviewId = 'storyMainImagePreview';
            else if (inputId === 'storyOverlapImageUpload') correctPreviewId = 'storyOverlapImagePreview';
            else if (inputId === 'missionImageUpload') correctPreviewId = 'missionImagePreview';
            else correctPreviewId = previewId;

            hocmsHandleFileUpload(input, correctPreviewId);
        }
    }
}

/* ---------------------------------------------------------
   Preview
--------------------------------------------------------- */
function hocmsPreviewChanges() {
    window.open('{{ route("about") }}', '_blank');
}
</script>
@endsection