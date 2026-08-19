@extends('layout.app')

@section('title', 'Search Results - Compare Taxi Quotes')

@push('styles')
<style>
    :root {
        --primary: #5843F6;
        --primary-light: #7B68FF;
        --primary-dark: #4332D9;
        --accent: #5843F6;
        --accent-hover: #4332D9;
        --gray-50: #f8fafc;
        --gray-100: #f1f4f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --white: #ffffff;
        --shadow-sm: 0 1px 3px rgba(26, 43, 109, 0.08);
        --shadow-md: 0 4px 20px rgba(26, 43, 109, 0.12);
        --shadow-lg: 0 10px 40px rgba(26, 43, 109, 0.15);
        --shadow-xl: 0 20px 60px rgba(26, 43, 109, 0.2);
        --radius: 16px;
        --radius-sm: 10px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        margin: 0;
        min-height: 100vh;
    }

    /* ===== TOP BAR ===== */
    .results-topbar {
        background: var(--primary);
        color: white;
        padding: 20px 0;
        border-bottom: 3px solid var(--accent);
        margin-bottom: 30px;
    }

    .results-topbar .container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .results-topbar h1 {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .results-topbar h1 i {
        color: var(--accent);
        font-size: 28px;
    }

    .results-topbar .badge {
        background: rgba(255,255,255,0.15);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 500;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .results-topbar .badge i {
        margin-right: 6px;
        color: var(--accent);
    }

    /* ===== LAYOUT ===== */
    .search-layout {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 32px;
        max-width: 1300px;
        margin: 0 auto 50px;
        padding: 0 20px;
    }

    @media (max-width: 992px) {
        .search-layout {
            grid-template-columns: 1fr;
            gap: 24px;
        }
    }

    /* ===== SIDEBAR ===== */
    .sidebar-widget {
        background: var(--white);
        border-radius: var(--radius);
        padding: 28px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(26, 43, 109, 0.06);
        position: sticky;
        top: 24px;
        transition: var(--transition);
    }

    .sidebar-widget:hover {
        box-shadow: var(--shadow-lg);
    }

    .sidebar-heading {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .sidebar-heading i {
        color: var(--accent);
        font-size: 18px;
    }

    .locations-block {
        background: var(--gray-50);
        border-radius: var(--radius-sm);
        padding: 16px 16px 8px;
        border: 1px solid var(--gray-200);
        position: relative;
    }

    .location-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        position: relative;
    }

    .location-row label {
        font-size: 11px;
        font-weight: 700;
        width: 36px;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .location-dot {
        position: absolute;
        left: -20px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid var(--accent);
        background: white;
        box-shadow: 0 0 0 3px rgba(88, 67, 246, 0.15);
    }

    .location-dot.dropoff-dot {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(26, 43, 109, 0.12);
    }

    .location-input-wrapper {
        position: relative;
        flex: 1;
    }

    .location-input-wrapper input {
        width: 100%;
        padding: 10px 34px 10px 14px;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        font-size: 13px;
        font-weight: 500;
        background: white;
        transition: var(--transition);
        color: var(--gray-800);
    }

    .location-input-wrapper input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(88, 67, 246, 0.12);
    }

    .location-input-wrapper input::placeholder {
        color: var(--gray-400);
        font-weight: 400;
    }

    .clear-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        cursor: pointer;
        font-size: 12px;
        padding: 4px;
        transition: var(--transition);
        border-radius: 50%;
    }

    .clear-icon:hover {
        color: var(--gray-700);
        background: var(--gray-100);
    }

    .via-row {
        animation: slideDown 0.25s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .locations-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 4px 0 16px;
        padding: 0 4px;
    }

    .via-toggle {
        color: var(--primary);
        font-weight: 600;
        font-size: 12.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 6px 12px;
        border-radius: 50px;
        transition: var(--transition);
        background: rgba(26, 43, 109, 0.06);
    }

    .via-toggle:hover {
        background: rgba(26, 43, 109, 0.12);
        color: var(--primary-dark);
    }

    .via-toggle i {
        font-size: 13px;
    }

    .swap-btn {
        color: var(--gray-500);
        cursor: pointer;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid var(--gray-200);
        background: white;
        transition: var(--transition);
    }

    .swap-btn:hover {
        color: var(--primary);
        border-color: var(--primary);
        background: rgba(26, 43, 109, 0.04);
        transform: rotate(180deg);
    }

    .estimated-time {
        font-size: 12px;
        color: var(--gray-500);
        text-align: right;
        margin: 10px 0 18px;
        padding: 12px 16px;
        background: var(--gray-50);
        border-radius: var(--radius-sm);
        border: 1px dashed var(--gray-200);
    }

    .estimated-time strong {
        color: var(--primary);
        font-weight: 700;
    }

    .trip-type-row {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 10px;
        align-items: center;
        margin: 16px 0;
    }

    .radio-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-700);
        cursor: pointer;
        padding: 6px 14px;
        border-radius: 50px;
        transition: var(--transition);
        background: var(--gray-50);
        border: 1px solid transparent;
    }

    .radio-label.active {
        background: rgba(26, 43, 109, 0.06);
        border-color: var(--primary);
        color: var(--primary);
    }

    .radio-label input[type="radio"] {
        accent-color: var(--accent);
        width: 16px;
        height: 16px;
        margin: 0;
    }

    .date-input, .time-input {
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 8px 12px;
        font-size: 13px;
        background: white;
        transition: var(--transition);
        color: var(--gray-700);
    }

    .date-input:focus, .time-input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
    }

    .date-input:disabled, .time-input:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    #return-container {
        transition: var(--transition);
        margin-top: -4px;
    }

    .options-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin: 18px 0 22px;
    }

    .option-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .option-group span {
        font-size: 11px;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .options-row select {
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-sm);
        padding: 9px 12px;
        font-size: 13px;
        background: white;
        transition: var(--transition);
        color: var(--gray-700);
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 34px;
    }

    .options-row select:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
    }

    .btn-update {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
        color: white;
        border: none;
        width: 100%;
        padding: 14px;
        font-size: 15px;
        font-weight: 700;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: var(--transition);
        letter-spacing: 0.3px;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 166, 35, 0.4);
    }

    .btn-update:active {
        transform: translateY(0);
    }

    .share-box {
        background: var(--white);
        border-radius: var(--radius);
        padding: 20px 24px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(26, 43, 109, 0.06);
        margin-top: 16px;
    }

    .share-box p {
        font-size: 12px;
        font-weight: 700;
        color: var(--gray-500);
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .social-icons {
        display: flex;
        gap: 8px;
    }

    .social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: 1px solid var(--gray-200);
        border-radius: 50%;
        color: var(--gray-600);
        text-decoration: none;
        transition: var(--transition);
        background: white;
    }

    .social-icons a:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(26, 43, 109, 0.2);
    }

    /* ===== MAIN CONTENT ===== */
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
        background: white;
        padding: 16px 24px;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(26, 43, 109, 0.06);
    }

    .summary-text {
        font-size: 14px;
        color: var(--gray-600);
    }

    .summary-text p {
        margin: 0;
    }

    .summary-text strong {
        color: var(--primary);
        font-weight: 700;
    }

    .summary-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .btn-search-again {
        background: var(--gray-50);
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-search-again:hover {
        background: var(--gray-100);
        border-color: var(--gray-300);
    }

    .sort-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sort-btn:hover {
        background: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(26, 43, 109, 0.25);
    }

    /* ===== HIGHLIGHT CARDS ===== */
    .highlight-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }

    @media (max-width: 768px) {
        .highlight-cards {
            grid-template-columns: 1fr;
        }
    }

    .highlight-card {
        background: white;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(26, 43, 109, 0.06);
        position: relative;
    }

    .highlight-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-4px);
    }

    .hc-content {
        padding: 20px 20px 16px;
        text-align: center;
    }

    .hc-icon {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, rgba(88, 67, 246, 0.12), rgba(88, 67, 246, 0.05));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        color: var(--accent);
        font-size: 22px;
        border: 2px solid rgba(88, 67, 246, 0.15);
    }

    .hc-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .hc-operator {
        font-size: 12px;
        color: var(--gray-500);
        margin-bottom: 6px;
    }

    .hc-rating {
        color: var(--accent);
        font-size: 12px;
        font-weight: 600;
    }

    .hc-rating span {
        color: var(--gray-600);
        background: var(--gray-50);
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 11px;
        margin-left: 4px;
    }

    .hc-price-btn {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 14px;
        font-weight: 700;
        font-size: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
    }

    .hc-price-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
    }

    .hc-price-btn span {
        font-size: 11px;
        font-weight: 400;
        opacity: 0.8;
    }

    .hc-price-old {
        font-size: 12px;
        text-decoration: line-through;
        color: rgba(255,255,255,0.4);
        font-weight: 400;
    }

    .sale-tag {
        position: absolute;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 28px;
        transform: rotate(-45deg);
        top: 14px;
        left: -28px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    /* ===== RESULT LIST ===== */
    .list-results {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .result-row {
        background: white;
        border-radius: var(--radius);
        display: grid;
        grid-template-columns: 140px 1fr auto;
        gap: 20px;
        align-items: center;
        padding: 16px 20px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(26, 43, 109, 0.06);
        position: relative;
    }

    .result-row:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .result-row:hover::before {
        opacity: 1;
    }

    @media (max-width: 640px) {
        .result-row {
            grid-template-columns: 1fr;
            gap: 12px;
            padding: 16px;
        }
        .result-row::before {
            display: none;
        }
    }

    .result-media {
        width: 140px;
        min-width: 140px;
    }

    .result-media img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .result-media img:hover {
        transform: scale(1.02);
    }

    .result-media .placeholder-img {
        width: 100%;
        height: 100px;
        background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        font-size: 12px;
        border: 1px solid var(--gray-200);
    }

    .row-operator {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 4px 0;
    }

    .row-operator strong {
        font-size: 17px;
        color: var(--gray-800);
        font-weight: 700;
    }

    .row-operator .location {
        font-size: 11px;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .row-operator .location i {
        color: var(--accent);
        font-size: 12px;
    }

    .row-operator .result-description {
        font-size: 13px;
        color: var(--gray-500);
        line-height: 1.5;
        margin: 2px 0;
    }

    .row-operator .result-meta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 4px;
    }

    .row-operator .result-meta span {
        font-size: 11px;
        color: var(--gray-400);
        display: flex;
        align-items: center;
        gap: 4px;
        background: var(--gray-50);
        padding: 2px 10px;
        border-radius: 50px;
    }

    .row-operator .result-meta i {
        font-size: 11px;
    }

    .row-price-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    @media (max-width: 768px) {
        .row-price-actions {
            width: 100%;
            flex-direction: column;
        }
        .row-price-btn {
            width: 100%;
            min-width: unset;
        }
    }

    .row-price-btn {
        position: relative;
        padding: 10px 16px;
        border-radius: var(--radius-sm);
        font-weight: 700;
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        min-width: 130px;
        transition: var(--transition);
        text-decoration: none;
        border: 2px solid transparent;
    }

    .row-price-btn.btn-oneway {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        box-shadow: 0 4px 14px rgba(26, 43, 109, 0.2);
    }

    .row-price-btn.btn-oneway:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(26, 43, 109, 0.3);
        color: white;
    }

    .row-price-btn.btn-return {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-hover) 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.25);
    }

    .row-price-btn.btn-return:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 166, 35, 0.4);
        color: white;
    }

    .row-price-btn.selected-trip {
        border-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.35);
    }

    .btn-trip-badge {
        font-size: 10.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.95;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .discount-badge-label {
        position: absolute;
        top: -10px;
        right: -4px;
        background: #ef4444;
        color: white;
        font-size: 9.5px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 50px;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.4);
        display: flex;
        align-items: center;
        gap: 3px;
        letter-spacing: 0.3px;
    }

    .return-price-stack {
        display: flex;
        flex-direction: column;
        align-items: center;
        line-height: 1.15;
    }

    .original-strike-price {
        font-size: 11px;
        text-decoration: line-through;
        opacity: 0.8;
        font-weight: 500;
    }

    .btn-amount {
        font-size: 18px;
        font-weight: 800;
        line-height: 1.2;
    }

    .btn-action-text {
        font-size: 11px;
        font-weight: 600;
        opacity: 0.9;
        margin-top: 3px;
    }

    /* ===== NO RESULTS ===== */
    .no-results {
        background: white;
        padding: 60px 30px;
        text-align: center;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(26, 43, 109, 0.06);
    }

    .no-results i {
        font-size: 56px;
        color: var(--gray-300);
        margin-bottom: 20px;
        display: block;
    }

    .no-results h3 {
        color: var(--gray-800);
        margin: 0 0 8px;
        font-size: 20px;
    }

    .no-results p {
        color: var(--gray-500);
        margin: 0;
        font-size: 14px;
    }

    .no-results .btn-retry {
        margin-top: 20px;
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-size: 14px;
    }

    .no-results .btn-retry:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(26, 43, 109, 0.25);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .results-topbar h1 {
            font-size: 18px;
        }
        .results-topbar .badge {
            font-size: 11px;
            padding: 4px 12px;
        }
        .sidebar-widget {
            padding: 20px;
        }
        .summary-row {
            padding: 14px 18px;
        }
        .trip-type-row {
            grid-template-columns: 1fr;
            gap: 8px;
        }
        .options-row {
            grid-template-columns: 1fr 1fr;
        }
        .result-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .result-media {
            width: 100%;
            min-width: unset;
        }
        .result-media img {
            height: 140px;
        }
        .row-price-btn {
            width: 100%;
            min-width: unset;
            padding: 14px;
        }
    }

    @media (max-width: 480px) {
        .search-layout {
            padding: 0 12px;
        }
        .summary-row {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        .summary-actions {
            justify-content: stretch;
        }
        .summary-actions button {
            flex: 1;
            justify-content: center;
        }
        .options-row {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 10px !important;
        }
        .social-icons {
            flex-wrap: wrap;
        }
    }

    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: var(--gray-100);
    }
    ::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }

    /* Loading shimmer effect */
    .shimmer {
        background: linear-gradient(90deg, var(--gray-100) 25%, var(--gray-200) 50%, var(--gray-100) 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    /* ===== SEARCH HERO BANNER ===== */
    .search-hero-banner {
        position: relative;
        padding: 130px 0 50px;
        background: linear-gradient(180deg, rgba(7, 19, 38, 0.94) 0%, rgba(3, 8, 18, 0.97) 100%),
                    url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
        overflow: hidden;
        color: #FFFFFF;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 40px;
    }

    .search-hero-tag {
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: #4A6CFE;
        background: rgba(74, 108, 254, 0.12);
        border: 1px solid rgba(74, 108, 254, 0.3);
        padding: 4px 12px;
        border-radius: 6px;
        margin-bottom: 14px;
        display: inline-block;
    }

    .search-hero-title {
        font-family: var(--sr-font-display);
        font-size: clamp(1.6rem, 3.2vw, 2.5rem);
        font-weight: 800;
        color: #FFFFFF;
        line-height: 1.25;
        margin-bottom: 14px;
    }

    .search-hero-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.8);
        flex-wrap: wrap;
        font-weight: 600;
    }

    .search-hero-meta i {
        color: #4A6CFE;
    }

    .search-hero-breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 8px 16px;
        border-radius: 50px;
    }

    .search-hero-breadcrumb a {
        color: #4A6CFE;
        transition: color 0.2s ease;
    }

    .search-hero-breadcrumb a:hover {
        color: #FFFFFF;
    }
</style>
@endpush

@section('content')

    {{-- ===== SEARCH HERO BANNER ===== --}}
    <section class="search-hero-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="search-hero-tag"><i class="fas fa-route me-1"></i> TRIP OVERVIEW</span>
                    <h1 class="search-hero-title">
                        {{ $pickup ?: 'Pickup Location' }} <i class="fas fa-arrow-right mx-2 fs-4 text-primary"></i> {{ $dropoff ?: 'Dropoff Location' }}
                    </h1>
                    <div class="search-hero-meta">
                        <span><i class="far fa-calendar-alt me-1"></i> {{ $pickupDate ? \Carbon\Carbon::parse($pickupDate)->format('D, d M Y') : 'Today' }} {{ $pickupTime }}</span>
                        @if(!empty($distance))
                            <span><i class="fas fa-road me-1"></i> {{ $distance }} Miles</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <div class="search-hero-breadcrumb">
                        <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Home</a>
                        <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                        <span class="text-white fw-semibold">Search Quotes</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="search-layout">

    <!-- SIDEBAR -->
    <aside>
        <div class="sidebar-widget">
            <p class="sidebar-heading">
                <i class="fas fa-sliders-h"></i> Refine Journey
            </p>

            <form action="{{ route('search') }}" method="GET" id="sidebar-search-form">
                <input type="hidden" name="trip_type" id="trip_type_input" value="{{ $tripType }}">

                <div class="locations-block">
                    <div class="location-row">
                        <span class="location-dot"></span>
                        <label>From</label>
                        <div class="location-input-wrapper">
                            <input type="text" name="pickup" id="pickup" value="{{ $pickup }}" placeholder="Enter pickup location" required>
                            <i class="fas fa-times clear-icon" onclick="document.getElementById('pickup').value=''"></i>
                        </div>
                    </div>

                    <div id="via-container"></div>

                    <div class="location-row">
                        <span class="location-dot dropoff-dot"></span>
                        <label>To</label>
                        <div class="location-input-wrapper">
                            <input type="text" name="dropoff" id="dropoff" value="{{ $dropoff }}" placeholder="Enter destination" required>
                            <i class="fas fa-times clear-icon" onclick="document.getElementById('dropoff').value=''"></i>
                        </div>
                    </div>
                </div>

                <div class="locations-toolbar">
                    <button type="button" class="via-toggle" id="via-toggle-btn" onclick="addViaField()">
                        <i class="fas fa-plus-circle"></i> Add a stop
                    </button>
                    <span class="swap-btn" title="Swap pickup and drop-off" onclick="swapLocations()">
                        <i class="fas fa-exchange-alt"></i>
                    </span>
                </div>

                <div class="estimated-time">
                    <i class="fas fa-clock" style="margin-right: 6px;"></i>
                    Est. travel time: <strong>{{ isset($distance) && $distance > 0 ? round($distance / 30) . 'h ' . round(($distance % 30) * 2) . 'm' : '--' }}</strong>
                </div>
                <button type="submit" class="btn-update">
                    <i class="fas fa-sync-alt" style="margin-right: 8px;"></i>
                    Update Quotes
                </button>
            </form>
        </div>

        @php
            $setting = $setting ?? \App\Models\Setting::first();
        @endphp
        <div class="share-box">
            <p><i class="fas fa-share-alt" style="margin-right: 8px;"></i> Share this quote</p>
            <div class="social-icons">
                <a href="javascript:void(0)" onclick="if(navigator.clipboard){navigator.clipboard.writeText(window.location.href); alert('Quote link copied!');}" title="Copy link"><i class="fas fa-link"></i></a>
                @if(!empty($setting?->company_email))
                    <a href="mailto:{{ $setting->company_email }}?subject=Airport%20Ride%20Quote" title="Email"><i class="fas fa-envelope"></i></a>
                @endif
                @if(!empty($setting?->facebook))
                    <a href="{{ $setting->facebook }}" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($setting?->twitter))
                    <a href="{{ $setting->twitter }}" target="_blank" rel="noopener" title="Twitter"><i class="fab fa-twitter"></i></a>
                @endif
                @if(!empty($setting?->instagram))
                    <a href="{{ $setting->instagram }}" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($setting?->linkedin))
                    <a href="{{ $setting->linkedin }}" target="_blank" rel="noopener" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if(!empty($setting?->youtube))
                    <a href="{{ $setting->youtube }}" target="_blank" rel="noopener" title="YouTube"><i class="fab fa-youtube"></i></a>
                @endif
                @if(!empty($setting?->tiktok))
                    <a href="{{ $setting->tiktok }}" target="_blank" rel="noopener" title="TikTok"><i class="fab fa-tiktok"></i></a>
                @endif
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main>
        @if(isset($cars) && count($cars) > 0)
            @php
                $cheapest = collect($cars)->sortBy('calculated_price')->first();
                $recommended = collect($cars)->sortByDesc('rating')->first() ?? $cars[0] ?? null;
                $electric = collect($cars)->filter(function($c) { return str_contains(strtolower($c['name'] ?? ''), 'electric'); })->sortBy('calculated_price')->first() ?? (count($cars) > 1 ? collect($cars)->sortByDesc('calculated_price')->first() : ($cars[0] ?? null));
            @endphp

            <!-- SUMMARY ROW -->
            <div class="summary-row">
                <div class="summary-text">
                    <p><i class="fas fa-check-circle" style="color: #22c55e; margin-right: 8px;"></i> 
                        <strong>{{ count($cars) }}</strong> quotes available
                    </p>
                </div>
                <div class="summary-actions">
                    <button class="btn-search-again" type="button" onclick="scrollToSearch()">
                        <i class="fas fa-search"></i> Modify Search
                    </button>
                    <button class="sort-btn">
                        <i class="fas fa-arrow-down"></i> Price
                    </button>
                </div>
            </div>



            <!-- RESULTS LIST -->
            <div class="list-results" id="results-list">
                @foreach($cars as $car)
                    @php
                        $bookingQuery = [
                            'car' => $car['name'] ?? 'Unknown',
                            'pickup' => $pickup,
                            'dropoff' => $dropoff,
                            'distance' => $distance ?? 0,
                            'trip_type' => $tripType,
                            'price' => $car['calculated_price'] ?? 0,
                        ];
                        if (!empty($car['id'])) $bookingQuery['car_id'] = $car['id'];
                        if (!empty($pickupDate)) $bookingQuery['pickup_date'] = $pickupDate;
                        if (!empty($pickupTime)) $bookingQuery['pickup_time'] = $pickupTime;
                        if (!empty($returnDate)) $bookingQuery['return_date'] = $returnDate;
                        if (!empty($returnTime)) $bookingQuery['return_time'] = $returnTime;
                        if (!empty($passengers)) $bookingQuery['passengers'] = $passengers;
                        if (!empty($luggage)) $bookingQuery['luggage'] = $luggage;
                        if (!empty($stops) && count($stops) > 0) {
                            $bookingQuery['stops'] = $stops;
                        } elseif (!empty($via) && count($via) > 0) {
                            $bookingQuery['via'] = $via;
                        }
                        $rating = $car['rating'] ?? rand(4, 5) . '.' . rand(0, 9);
                        $reviews = $car['reviews'] ?? rand(50, 200);
                    @endphp
                    <div class="result-row">
                        <div class="result-media">
                            @if(isset($car['image_url']) && $car['image_url'])
                                <img src="{{ $car['image_url'] }}" alt="{{ $car['name'] }}" loading="lazy">
                            @else
                                <div class="placeholder-img">
                                    <i class="fas fa-car" style="font-size: 28px; opacity: 0.3;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="row-operator">
                            <strong>{{ $car['name'] ?? 'Unknown Vehicle' }}</strong>
                            <div class="result-description">{{ $car['description'] ?? 'Professional taxi service with great reviews.' }}</div>
                        </div>
                        @php
                            $onewayQuery = array_merge($bookingQuery, [
                                'trip_type' => 'one_way',
                                'price' => $car['oneway_price'] ?? $car['calculated_price'] ?? 0
                            ]);
                            $returnQuery = array_merge($bookingQuery, [
                                'trip_type' => 'return',
                                'price' => $car['return_price'] ?? (($car['oneway_price'] ?? $car['calculated_price']) * 2 * 0.95)
                            ]);
                        @endphp
                        <div class="row-price-actions">
                            <a href="{{ route('book', $onewayQuery) }}" class="row-price-btn btn-oneway {{ $tripType === 'one_way' ? 'selected-trip' : '' }}">
                                <span class="btn-amount">£ {{ number_format($car['oneway_price'] ?? $car['calculated_price'], 2) }}</span>
                                <span class="btn-action-text">Book One Way</span>
                            </a>

                            <a href="{{ route('book', $returnQuery) }}" class="row-price-btn btn-return {{ $tripType === 'return' ? 'selected-trip' : '' }}">
                                <span class="discount-badge-label">5% OFF</span>
                                <div class="return-price-stack">
                                    <span class="original-strike-price">£ {{ number_format($car['return_original_price'] ?? (($car['oneway_price'] ?? $car['calculated_price']) * 2), 2) }}</span>
                                    <span class="btn-amount">£ {{ number_format($car['return_price'] ?? (($car['oneway_price'] ?? $car['calculated_price']) * 2 * 0.95), 2) }}</span>
                                </div>
                                <span class="btn-action-text">Book Return</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3>No vehicles available</h3>
                <p>We couldn't find any quotes for this route. Try adjusting your search parameters.</p>
                <button class="btn-retry" onclick="scrollToSearch()">
                    <i class="fas fa-sliders-h"></i> Modify Search
                </button>
            </div>
        @endif
    </main>

</div>
@endsection

@push('scripts')
<script>
    let viaCount = 0;
    const MAX_VIA_STOPS = 10;
    const existingVias = @json($stops ?? $via ?? []);

    function addViaField(prefillValue = '') {
        if (viaCount >= MAX_VIA_STOPS) {
            showToast('Maximum 10 stops allowed', 'warning');
            return;
        }
        viaCount++;

        const container = document.getElementById('via-container');
        const row = document.createElement('div');
        row.className = 'location-row via-row';
        row.dataset.viaId = viaCount;
        row.innerHTML = `
            <span class="location-dot" style="border-color:#94a3b8; left: -20px;"></span>
            <label>Via</label>
            <div class="location-input-wrapper">
                <input type="text" name="stops[]" class="via-input" placeholder="Add intermediate stop" value="${prefillValue.replace(/"/g, '&quot;')}">
                <i class="fas fa-times clear-icon" onclick="removeViaField(this)"></i>
            </div>
        `;
        container.appendChild(row);

        const viaInput = row.querySelector('.via-input');
        attachCustomAutocompleteToInput(viaInput);
        updateViaToggleState();
    }

    function removeViaField(icon) {
        const row = icon.closest('.via-row');
        if (row) {
            row.style.animation = 'slideDown 0.2s reverse';
            setTimeout(() => {
                row.remove();
                viaCount--;
                updateViaToggleState();
            }, 200);
        }
    }

    function updateViaToggleState() {
        const btn = document.getElementById('via-toggle-btn');
        if (!btn) return;

        if (viaCount >= MAX_VIA_STOPS) {
            btn.style.opacity = '0.5';
            btn.style.pointerEvents = 'none';
            btn.innerHTML = '<i class="fas fa-ban"></i> Max stops reached';
        } else {
            btn.style.opacity = '1';
            btn.style.pointerEvents = 'auto';
            btn.innerHTML = viaCount > 0
                ? '<i class="fas fa-plus-circle"></i> Add another stop'
                : '<i class="fas fa-plus-circle"></i> Add a stop';
        }
    }

    function swapLocations() {
        const p = document.getElementById('pickup');
        const d = document.getElementById('dropoff');
        [p.value, d.value] = [d.value, p.value];
        // Animate the swap
        [p, d].forEach(el => {
            el.style.transition = 'all 0.3s ease';
            el.style.transform = 'scale(0.95)';
            setTimeout(() => el.style.transform = 'scale(1)', 150);
        });
    }

    function toggleReturn(isReturn) {
        const tInput = document.getElementById('trip_type_input');
        if (tInput) tInput.value = isReturn ? 'return' : 'oneway';
        const rDate = document.getElementById('return_date');
        const rTime = document.getElementById('return_time');
        const container = document.getElementById('return-container');

        if (rDate && rTime && container) {
            if (isReturn) {
                rDate.disabled = false;
                rTime.disabled = false;
                container.style.opacity = '1';
            } else {
                rDate.disabled = true;
                rTime.disabled = true;
                container.style.opacity = '0.5';
            }
        }
    }

    function attachCustomAutocompleteToInput(input) {
        if (!input || input.dataset.autocompleteBound) return;
        input.dataset.autocompleteBound = 'true';

        let dropdown = null;
        let debounceTimer = null;
        let activeIndex = -1;

        const wrapper = input.closest('.location-input-wrapper') || input.closest('.input-wrap') || input.parentElement;
        if (wrapper && getComputedStyle(wrapper).position === 'static') {
            wrapper.style.position = 'relative';
        }

        function createDropdown() {
            if (dropdown) return dropdown;
            dropdown = document.createElement('div');
            dropdown.className = 'custom-autocomplete-dropdown';
            dropdown.style.cssText = `
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                margin-top: 6px;
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                box-shadow: 0 16px 36px rgba(10, 20, 46, 0.18);
                max-height: 280px;
                overflow-y: auto;
                z-index: 99999;
                display: none;
            `;
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
                dd.innerHTML = '<div style="padding:12px 16px; font-size:13px; color:#64748b; text-align:center;">No locations found</div>';
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
                } else if (label.toLowerCase().includes('hotel')) {
                    iconClass = 'fa-hotel';
                }

                const itemEl = document.createElement('div');
                itemEl.className = 'custom-autocomplete-item';
                itemEl.style.cssText = `
                    padding: 10px 14px;
                    font-size: 13.5px;
                    color: #0A142E;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    border-bottom: 1px solid #f1f5f9;
                    transition: background 0.15s ease;
                `;
                itemEl.innerHTML = `
                    <i class="fas ${iconClass}" style="color:#2E6BE6; font-size:13px; width:16px; text-align:center;"></i>
                    <span style="flex:1; font-weight:500;">${escapeHtml(label)}</span>
                    ${postcode ? `<span style="font-size:11px; background:#e0f2fe; color:#0369a1; padding:2px 6px; border-radius:4px; font-weight:600;">${escapeHtml(postcode)}</span>` : ''}
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
                    el.style.background = '#EBF1FF';
                } else {
                    el.style.background = '#ffffff';
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
                return;
            }

            const dd = createDropdown();
            dd.innerHTML = '<div style="padding:12px 16px; font-size:13px; color:#64748b; text-align:center;"><i class="fas fa-spinner fa-spin" style="margin-right:6px; color:#2E6BE6;"></i> Searching locations...</div>';
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

    function initSearchAutocomplete() {
        const p = document.getElementById('pickup');
        const d = document.getElementById('dropoff');
        if (p) attachCustomAutocompleteToInput(p);
        if (d) attachCustomAutocompleteToInput(d);
        document.querySelectorAll('.via-input').forEach(attachCustomAutocompleteToInput);
    }

    function scrollToSearch() {
        const formSection = document.getElementById('sidebar-search-form');
        if (!formSection) return;
        formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        setTimeout(() => {
            document.getElementById('pickup')?.focus();
        }, 500);
    }

    function scrollToResult() {
        const firstResult = document.querySelector('.result-row');
        if (firstResult) {
            firstResult.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstResult.style.borderColor = 'var(--accent)';
            firstResult.style.boxShadow = 'var(--shadow-lg)';
            setTimeout(() => {
                firstResult.style.borderColor = '';
                firstResult.style.boxShadow = '';
            }, 2000);
        }
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(100px);
            padding: 14px 28px; border-radius: 12px; background: #1e293b; color: white;
            font-size: 14px; font-weight: 500; box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            z-index: 9999; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 90%; text-align: center;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        requestAnimationFrame(() => {
            toast.style.transform = 'translateX(-50%) translateY(0)';
        });
        setTimeout(() => {
            toast.style.transform = 'translateX(-50%) translateY(100px)';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (Array.isArray(existingVias) && existingVias.length > 0) {
            existingVias.forEach(value => addViaField(value));
        }

        initSearchAutocomplete();

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });
</script>
@endpush