@extends('admin.layout.app')

@section('content')
<style>
    .dashboard-header {
        margin-bottom: 32px;
    }
    .dashboard-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #0A142E;
        margin-bottom: 8px;
    }
    .dashboard-header p {
        color: #64748b;
        font-size: 14px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 12px;
        background: #f1f5f9;
    }

    .stat-icon.blue { background: #EBF1FF; color: #2E6BE6; }
    .stat-icon.green { background: #D1FAE5; color: #10b981; }
    .stat-icon.orange { background: #FED7AA; color: #f97316; }
    .stat-icon.purple { background: #E9D5FF; color: #a855f7; }
    .stat-icon.red { background: #FEE2E2; color: #ef4444; }
    .stat-icon.cyan { background: #FFFBEB; color: #FFD426; }

    .stat-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #0A142E;
        margin-bottom: 8px;
    }

    .stat-change {
        font-size: 12px;
        color: #10b981;
    }

    .stat-change.negative {
        color: #ef4444;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #0A142E;
        margin-bottom: 16px;
        margin-top: 32px;
    }

    .table-wrapper {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-wrapper table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-wrapper th {
        background: #f8fafc;
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-wrapper td {
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 13px;
        color: #475569;
    }

    .table-wrapper tbody tr:hover {
        background: #f8fafc;
    }

    .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge.success {
        background: #D1FAE5;
        color: #10b981;
    }

    .status-badge.pending {
        background: #FED7AA;
        color: #f97316;
    }

    .status-badge.info {
        background: #D1E7FF;
        color: #2E6BE6;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 32px;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 14px;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .alert {
        padding: 14px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid;
        font-size: 13px;
    }

    .alert.info {
        background: #EBF1FF;
        border-left-color: #2E6BE6;
        color: #1E4FC2;
    }

    .alert.success {
        background: #DCFCE7;
        border-left-color: #22C55E;
        color: #166534;
    }

    .alert.error {
        background: #FEE2E2;
        border-left-color: #EF4444;
        color: #991B1B;
    }

    .alert.warning {
        background: #FEF3C7;
        border-left-color: #F59E0B;
        color: #92400E;
    }

    .alert i {
        margin-right: 8px;
    }
</style>

<div class="dashboard-header">
    <h1>Welcome back, Admin! 👋</h1>
    <p>Here's what's happening with your site today.</p>
</div>

@if(session('success'))
<div class="alert success">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert error">
    <i class="fas fa-exclamation-circle"></i>
    {{ session('error') }}
</div>
@endif

@if(session('warning'))
<div class="alert warning">
    <i class="fas fa-exclamation-triangle"></i>
    {{ session('warning') }}
</div>
@endif

@if(!$aboutPageExists)
<div class="alert info">
    <i class="fas fa-info-circle"></i>
    <strong>Heads up:</strong> The About page hasn't been configured yet. <a href="{{ route('admin.pages.about.show') }}" style="color: inherit; font-weight: 600; text-decoration: underline;">Set it up now</a>
</div>
@endif

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-value">{{ $totalOrders }}</div>
        <div class="stat-change"><strong>{{ $todayOrders }}</strong> today</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-car"></i></div>
        <div class="stat-label">Fleet Vehicles</div>
        <div class="stat-value">{{ $totalCars }}</div>
        <div class="stat-change"><a href="{{ route('admin.cars.index') }}" style="color: #2E6BE6; text-decoration: none;">Manage fleet</a></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-file-alt"></i></div>
        <div class="stat-label">Pages</div>
        <div class="stat-value">{{ $totalPages }}</div>
        <div class="stat-change"><a href="{{ route('admin.pages.index') }}" style="color: #2E6BE6; text-decoration: none;">Manage pages</a></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-blog"></i></div>
        <div class="stat-label">Blog Posts</div>
        <div class="stat-value">{{ $totalBlogs }}</div>
        <div class="stat-change"><a href="{{ route('admin.blogs.index') }}" style="color: #2E6BE6; text-decoration: none;">View blogs</a></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-envelope"></i></div>
        <div class="stat-label">Contact Messages</div>
        <div class="stat-value">{{ $totalContactMessages }}</div>
        <div class="stat-change">{{ $unreadMessages }} unread</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon cyan"><i class="fas fa-pound-sign"></i></div>
        <div class="stat-label">Total Revenue</div>
        <div class="stat-value">£{{ number_format($totalRevenue, 0) }}</div>
        <div class="stat-change">This month: {{ $thisMonthOrders }} orders</div>
    </div>
</div>

<!-- Recent Orders -->
<h2 class="section-title">Recent Orders</h2>
@if($recentOrders->count() > 0)
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Passenger</th>
                <th>Route</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr>
                <td><strong>#{{ $order->id }}</strong></td>
                <td>{{ $order->first_name ?? 'N/A' }} {{ $order->last_name ?? '' }}</td>
                <td>{{ $order->pickup_location ?? 'N/A' }} → {{ $order->dropoff_location ?? 'N/A' }}</td>
                <td>£{{ number_format($order->total_price ?? 0, 2) }}</td>
                <td>{{ $order->created_at?->format('M d, Y') }}</td>
                <td>
                    @php
                        $status = $order->status ?? 'pending';
                        $statusClass = match($status) {
                            'completed' => 'success',
                            'cancelled' => 'pending',
                            default => 'info'
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($status) }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="text-align: right; margin-top: 16px;">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">View All Orders</a>
</div>
@else
<div class="empty-state">
    <i class="fas fa-inbox"></i>
    <p>No orders yet. Bookings will appear here.</p>
</div>
@endif

<!-- Recent Blog Posts -->
<h2 class="section-title">Recent Blog Posts</h2>
@if($recentBlogs->count() > 0)
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Published</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentBlogs as $blog)
            <tr>
                <td><strong>{{ $blog->title }}</strong></td>
                <td>{{ $blog->author ?? 'Admin' }}</td>
                <td>{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at?->format('M d, Y') }}</td>
                <td>
                    <span class="status-badge {{ $blog->status === 'published' ? 'success' : 'pending' }}">
                        {{ ucfirst($blog->status ?? 'draft') }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="text-align: right; margin-top: 16px;">
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">View All Blogs</a>
</div>
@else
<div class="empty-state">
    <i class="fas fa-file-alt"></i>
    <p>No blog posts yet. Start creating content!</p>
</div>
@endif

<!-- Recent Contact Messages -->
<h2 class="section-title">Recent Contact Messages</h2>
@if($recentMessages->count() > 0)
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>From</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentMessages as $msg)
            <tr>
                <td><strong>{{ $msg->first_name }} {{ $msg->last_name }}</strong></td>
                <td>{{ $msg->subject }}</td>
                <td>{{ Str::limit($msg->message, 40) }}</td>
                <td>{{ $msg->created_at?->format('M d, Y') }}</td>
                <td>
                    <span class="status-badge {{ $msg->read ? 'info' : 'pending' }}">
                        {{ $msg->read ? 'Read' : 'New' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="text-align: right; margin-top: 16px;">
    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-primary">View All Messages</a>
</div>
@else
<div class="empty-state">
    <i class="fas fa-envelope"></i>
    <p>No contact messages yet.</p>
</div>
@endif

@endsection
