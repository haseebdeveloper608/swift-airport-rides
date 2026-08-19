@extends('admin.layout.app')

@section('title', 'Messages')
@section('page_title', 'Contact Messages')
@section('page_subtitle', 'View and manage customer inquiries')

@section('content')
<div class="messages-container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="messages-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td><strong>{{ $message->first_name }} {{ $message->last_name }}</strong></td>
                        <td><a href="mailto:{{ $message->email }}" style="color:#2E6BE6;">{{ $message->email }}</a></td>
                        <td>{{ $message->phone ?? 'N/A' }}</td>
                        <td><span class="badge-subject">{{ $message->subject }}</span></td>
                        <td>{{ str()->limit($message->message, 70) }}</td>
                        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-view" onclick="openMessageModal({{ json_encode([
                                    'id' => $message->id,
                                    'name' => ($message->first_name . ' ' . $message->last_name),
                                    'email' => $message->email,
                                    'phone' => $message->phone ?? 'N/A',
                                    'subject' => $message->subject,
                                    'message' => $message->message,
                                    'date' => $message->created_at->format('d M Y, H:i')
                                ]) }})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No contact messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container" style="margin-top:20px;">
        {{ $messages->links() }}
    </div>
</div>

<!-- VIEW MESSAGE MODAL -->
<div class="modal-overlay" id="messageModal" onclick="closeMessageModalOutside(event)">
    <div class="modal-card">
        <div class="modal-header">
            <h3><i class="fas fa-envelope-open-text" style="color:#2E6BE6;margin-right:8px;"></i> Contact Message Details</h3>
            <button type="button" class="modal-close" onclick="closeMessageModal()">✕</button>
        </div>
        <div class="modal-body">
            <div class="msg-meta-grid">
                <div>
                    <label>Sender Name</label>
                    <div id="modal-name" class="msg-val-highlight">-</div>
                </div>
                <div>
                    <label>Email Address</label>
                    <div id="modal-email" class="msg-val">-</div>
                </div>
                <div>
                    <label>Phone Number</label>
                    <div id="modal-phone" class="msg-val">-</div>
                </div>
                <div>
                    <label>Received Date</label>
                    <div id="modal-date" class="msg-val">-</div>
                </div>
            </div>
            <div style="margin-top:16px;">
                <label style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Subject</label>
                <div id="modal-subject" style="font-size:15px;font-weight:700;color:#0A142E;margin-top:4px;">-</div>
            </div>
            <div style="margin-top:18px;">
                <label style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">Full Message Body</label>
                <div id="modal-message" class="msg-content-box"></div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="modal-reply-btn" href="#" class="btn btn-reply" target="_blank"><i class="fas fa-paper-plane"></i> Reply via Email</a>
            <button type="button" class="btn btn-secondary" onclick="closeMessageModal()">Close</button>
        </div>
    </div>
</div>

<style>
    .messages-container {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #e2e8f0;
    }
    .table-container {
        overflow-x: auto;
    }
    .messages-table {
        width: 100%;
        border-collapse: collapse;
    }
    .messages-table th,
    .messages-table td {
        padding: 12px 14px;
        border-bottom: 1px solid #e9eef3;
        text-align: left;
        vertical-align: middle;
        font-size: 14px;
    }
    .messages-table th {
        background: #f8fafc;
        font-weight: 700;
        color: #0A142E;
    }
    .badge-subject {
        background: #ebf1ff;
        color: #1e4fc2;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
    }
    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn {
        padding: 7px 12px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 12.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    .btn-view {
        background: #2E6BE6;
        color: white;
    }
    .btn-view:hover {
        background: #1E4FC2;
    }
    .btn-delete {
        background: #fee2e2;
        color: #ef4444;
    }
    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }
    .alert-success {
        padding: 12px 14px;
        background: #dcfce7;
        color: #166534;
        border-radius: 8px;
        margin-bottom: 16px;
    }
    .text-center {
        text-align: center;
    }

    /* Modal Styling */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10, 20, 46, 0.55);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-overlay.active {
        display: flex;
    }
    .modal-card {
        background: #fff;
        border-radius: 18px;
        max-width: 620px;
        width: 100%;
        box-shadow: 0 20px 50px rgba(0,0,0,0.25);
        overflow: hidden;
    }
    .modal-header {
        background: #0A142E;
        color: #fff;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
    }
    .modal-close {
        background: rgba(255,255,255,0.15);
        border: none;
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }
    .modal-body {
        padding: 24px;
    }
    .msg-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        background: #f8fafc;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    .msg-meta-grid label {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
    }
    .msg-val {
        font-size: 13.5px;
        color: #334155;
        font-weight: 500;
    }
    .msg-val-highlight {
        font-size: 14.5px;
        font-weight: 700;
        color: #0A142E;
    }
    .msg-content-box {
        margin-top: 6px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 16px;
        font-size: 14px;
        line-height: 1.6;
        color: #1e293b;
        white-space: pre-wrap;
        max-height: 240px;
        overflow-y: auto;
    }
    .modal-footer {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .btn-reply {
        background: #FFD426;
        color: #0A142E;
        text-decoration: none;
    }
    .btn-reply:hover {
        background: #f2c400;
    }
    .btn-secondary {
        background: #e2e8f0;
        color: #334155;
    }
    .btn-secondary:hover {
        background: #cbd5e1;
    }
</style>

<script>
function openMessageModal(data) {
    document.getElementById('modal-name').textContent = data.name;
    document.getElementById('modal-email').textContent = data.email;
    document.getElementById('modal-phone').textContent = data.phone;
    document.getElementById('modal-date').textContent = data.date;
    document.getElementById('modal-subject').textContent = data.subject;
    document.getElementById('modal-message').textContent = data.message;
    
    document.getElementById('modal-reply-btn').href = 'mailto:' + encodeURIComponent(data.email) + '?subject=' + encodeURIComponent('RE: ' + data.subject);
    
    document.getElementById('messageModal').classList.add('active');
}

function closeMessageModal() {
    document.getElementById('messageModal').classList.remove('active');
}

function closeMessageModalOutside(e) {
    if (e.target === document.getElementById('messageModal')) {
        closeMessageModal();
    }
}
</script>
@endsection

