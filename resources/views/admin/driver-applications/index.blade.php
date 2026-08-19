@extends('admin.layout.app')

@section('title', 'Driver Applications')
@section('page_title', 'Driver Applications')
@section('page_subtitle', 'Review and manage driver registration submissions.')

@section('styles')
<style>
    .card-panel {
        background: #fff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
        font-size: 0.9rem;
    }

    .table-custom th {
        background: #f8fafc;
        color: #0A142E;
        font-weight: 700;
        text-align: left;
        padding: 14px 16px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-custom td {
        padding: 14px 16px;
        border-bottom: 1px solid #edf2f7;
        color: #334155;
        vertical-align: middle;
    }

    .status-pill {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pending { background: #fef3c7; color: #d97706; }
    .status-reviewed { background: #e0e7ff; color: #3730a3; }
    .status-approved { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: #fff;
        color: #475569;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
    }

    .btn-action:hover {
        background: #f1f5f9;
        color: #0A142E;
    }

    .btn-danger-sm {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fca5a5;
    }

    .btn-danger-sm:hover {
        background: #ef4444;
        color: #fff;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10, 20, 46, 0.6);
        z-index: 999;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
</style>
@endsection

@section('content')

@if(session('success'))
<div style="background:#dcfce7; color:#15803d; padding:14px 20px; border-radius:12px; margin-bottom:24px; font-weight:600; display:flex; align-items:center; gap:10px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="card-panel">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h3 style="font-size:1.1rem; font-weight:800; color:#0A142E;">
            <i class="fas fa-id-card" style="color:#2E6BE6; margin-right:8px;"></i> Driver Applications List
        </h3>
        <span style="font-size:0.85rem; color:#64748b;">Total: <strong>{{ $applications->total() }}</strong> submissions</span>
    </div>

    @if($applications->isEmpty())
    <div style="text-align:center; padding:40px; background:#f8fafc; border-radius:12px; color:#64748b;">
        <i class="fas fa-user-plus" style="font-size:2.5rem; color:#cbd5e1; margin-bottom:12px;"></i>
        <p>No driver applications received yet.</p>
    </div>
    @else
    <div style="overflow-x:auto;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Applicant Name</th>
                    <th>Contact</th>
                    <th>Vehicle Option</th>
                    <th>PCO License</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr>
                    <td>
                        <strong>{{ $app->full_name }}</strong>
                        <div style="font-size:0.75rem; color:#64748b;">DOB: {{ $app->date_of_birth ?? 'N/A' }}</div>
                    </td>
                    <td>
                        <div><a href="mailto:{{ $app->email }}" style="color:#2E6BE6; font-weight:600;">{{ $app->email }}</a></div>
                        <div style="font-size:0.8rem; color:#64748b;">{{ $app->phone }}</div>
                    </td>
                    <td>
                        <span style="font-size:0.85rem; font-weight:600;">{{ $app->vehicle_option }}</span>
                    </td>
                    <td>
                        <span>{{ $app->pco_license ?: 'N/A' }}</span>
                    </td>
                    <td>
                        <form action="{{ route('admin.driver-applications.update-status', $app->id) }}" method="POST" style="margin:0;">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="status-pill status-{{ $app->status }}" style="border:none; cursor:pointer;">
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ $app->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="approved" {{ $app->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </td>
                    <td style="font-size:0.82rem; color:#64748b;">
                        {{ $app->created_at->format('d M Y') }}
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex; justify-content:flex-end; gap:6px;">
                            <button type="button" class="btn-action" onclick="viewDetails({{ json_encode($app) }})"><i class="fas fa-eye"></i> View</button>
                            <form action="{{ route('admin.driver-applications.destroy', $app->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Delete this driver application?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-danger-sm"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top:24px;">
        {{ $applications->links() }}
    </div>
    @endif
</div>

<!-- VIEW DETAILS MODAL -->
<div class="modal-overlay" id="viewModal">
    <div class="modal-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid #e2e8f0; padding-bottom:12px;">
            <h4 style="font-size:1.2rem; font-weight:800; color:#0A142E; margin:0;"><i class="fas fa-user-id-card" style="color:#2E6BE6;"></i> Application Details</h4>
            <button type="button" class="btn-action" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>

        <div id="modalBody" style="font-size:0.9rem; line-height:1.8;"></div>
    </div>
</div>

<script>
function viewDetails(app) {
    let html = `
        <table style="width:100%; border-collapse:collapse;">
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b; width:40%;">Full Name:</td><td><strong>${app.first_name} ${app.middle_name || ''} ${app.last_name}</strong></td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Email Address:</td><td><a href="mailto:${app.email}" style="color:#2E6BE6;">${app.email}</a></td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Mobile Phone:</td><td><a href="tel:${app.phone}">${app.phone}</a></td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Date of Birth:</td><td>${app.date_of_birth || 'N/A'}</td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Driven for Us Before:</td><td>${app.previous_driver}</td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Vehicle Option:</td><td>${app.vehicle_option}</td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">PCO License Badge:</td><td>${app.pco_license || 'Not provided'}</td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Vehicle Details:</td><td>${app.vehicle_details || 'Not provided'}</td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">IP Address:</td><td>${app.ip_address || 'N/A'}</td></tr>
            <tr><td style="padding:6px 0; font-weight:700; color:#64748b;">Submitted At:</td><td>${new Date(app.created_at).toLocaleString()}</td></tr>
        </table>
    `;
    document.getElementById('modalBody').innerHTML = html;
    document.getElementById('viewModal').classList.add('active');
}

function closeModal() {
    document.getElementById('viewModal').classList.remove('active');
}
</script>
@endsection
