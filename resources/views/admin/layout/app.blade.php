{{-- resources/views/admin/layout/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>@yield('title', 'Admin Dashboard') | Heathrow Airport Rides</title>
    <!-- Google Fonts + Font Awesome CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js CDN for modern charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6fa;
            color: #101E45;
            overflow-x: hidden;
        }

        /* === LAYOUT GRID === */
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 260px;
            background: linear-gradient(165deg, #101E45 0%, #0A142E 100%);
            border-right: 1px solid rgba(255,255,255,0.06);
            color: #e2e8f0;
            transition: all 0.2s ease;
            flex-shrink: 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 10;
        }

        .sidebar-header {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: white;
        }

        .logo i {
            font-size: 1.8rem;
            color: #FFD426;
            background: rgba(255, 212, 38, 0.14);
            padding: 8px;
            border-radius: 14px;
        }

        .logo span {
            background: linear-gradient(135deg, #fff, #94a3b8);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-menu {
            list-style: none;
            padding: 0 16px;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            border-radius: 14px;
            font-weight: 500;
            color: #cbd5e1;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.2rem;
            text-align: center;
        }

        .nav-link:hover {
            background: rgba(255, 212, 38, 0.10);
            color: white;
        }

        .nav-link.active {
            background: #FFD426;
            color: #0A142E;
            font-weight: 600;
            box-shadow: 0 8px 16px -8px rgba(242, 196, 0, 0.55);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Top navbar */
        .top-nav {
            background: white;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e9eef3;
            backdrop-filter: blur(2px);
            flex-wrap: wrap;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .page-title h1 {
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #101E45, #2d3a4e);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .page-title p {
            font-size: 0.85rem;
            color: #5b6e8c;
            margin-top: 4px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-badge {
            position: relative;
            cursor: pointer;
        }

        .notification-badge i {
            font-size: 1.4rem;
            color: #4b5563;
        }

        .badge-dot {
            position: absolute;
            top: -2px;
            right: -5px;
            width: 9px;
            height: 9px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f8fafc;
            padding: 6px 14px 6px 10px;
            border-radius: 40px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(145deg, #2E6BE6, #16295E);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1rem;
        }

        .dashboard-content {
            padding: 28px 32px;
        }

        footer {
            margin-top: auto;
            text-align: center;
            font-size: 0.75rem;
            color: #5b6e8c;
            padding: 20px;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 80px;
                overflow: visible;
            }
            .sidebar .logo span, .sidebar .nav-link span:not(.icon-only) {
                display: none;
            }
            .sidebar-header {
                padding: 20px 12px;
                justify-content: center;
            }
            .logo i {
                margin: 0 auto;
            }
            .nav-link {
                justify-content: center;
            }
            .nav-link i {
                margin: 0;
            }
            .dashboard-content {
                padding: 20px;
            }
        }

        @media (max-width: 650px) {
            .top-nav {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .logo img {
            height: auto;
            width: 200px;
            border-radius: 5px;
        }
    </style>
    @yield('styles')
</head>
<body>
<div class="dashboard-wrapper">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Heathrow Airport Rides">
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.cars.index') }}" class="nav-link {{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
                    <i class="fas fa-car"></i><span>Cars</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <i class="fas fa-file-lines"></i><span>Pages</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i><span>Bookings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i><span>Messages</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="fas fa-blog"></i><span>Blogs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <i class="fas fa-circle-question"></i><span>FAQs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i><span>Users</span>
                </a>
            </li>
            
            
            <li class="nav-item">
                <a href="{{ route('admin.driver-applications.index') }}" class="nav-link {{ request()->routeIs('admin.driver-applications.*') ? 'active' : '' }}">
                    <i class="fas fa-id-card"></i><span>Driver Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.navigation.index') }}" class="nav-link {{ request()->routeIs('admin.navigation.*') ? 'active' : '' }}">
                    <i class="fas fa-compass"></i><span>Header Navigation</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i><span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/clear-all') }}" class="nav-link">
                    <i class="fas fa-trash-alt"></i><span>Clear Cache</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>

    <!-- MAIN PANEL -->
    <div class="main-content">
        <div class="top-nav">
            <div class="page-title">
                <h1>@yield('page_title', 'Dashboard')</h1>
                <p>@yield('page_subtitle', 'Welcome back, Alex — here’s what’s happening today.')</p>
            </div>
            <div class="user-profile">
                    <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'Admin', 0, 2)) }}</div>
                    <span style="font-weight:500;">{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </div>

        <div class="dashboard-content">
            @yield('content')
            
            <footer>
                <i class="far fa-copyright"></i> Heathrow Airport Rides {{ date('Y') }} — All rights reserved. Design & Developed by <a href="https://altectechnologies.com/" style="color: #2E6BE6;text-decoration: none;" target="_blank">Altec Technologies</a>
            </footer>
        </div>
    </div>
</div>

@yield('scripts')
<script>
    // simple notification bell feedback
    const bell = document.querySelector('.notification-badge');
    if(bell) {
        bell.addEventListener('click', () => {
            alert('🔔 You have 3 unread notifications (demo)');
        });
    }
</script>
</body>
</html>