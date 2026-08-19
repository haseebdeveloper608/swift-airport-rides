@extends('admin.layout.app')

@section('title', 'Bookings')
@section('page_title', 'Bookings Management')
@section('page_subtitle', 'View and manage all customer bookings')

@section('content')
<div class="bookings-container">
    <!-- Filters Section -->
    <div class="filter-section">
        <div class="filter-group">
            <input 
                type="text" 
                id="searchInput" 
                class="form-control" 
                placeholder="Search by name, email, phone, or location..."
            >
        </div>
        <div class="filter-group">
            <select id="statusFilter" class="form-control">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <button id="filterBtn" class="btn btn-primary">
            <i class="fas fa-filter"></i> Filter
        </button>
        <button id="resetBtn" class="btn btn-secondary">
            <i class="fas fa-redo"></i> Reset
        </button>
    </div>

    <!-- Bookings Table -->
    <div class="table-container">
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Route</th>
                    <th>Pickup Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="bookingsTableBody">
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px;">
                        <i class="fas fa-spinner fa-spin"></i> Loading bookings...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-section" id="paginationContainer"></div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Booking Details</h2>
            <button class="modal-close" onclick="closeModal('bookingModal')">&times;</button>
        </div>
        <div id="modalBody" class="modal-body">
            <!-- Details will be loaded here -->
        </div>
    </div>
</div>

<style>
    .bookings-container {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }

    .filter-section {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #2E6BE6;
        box-shadow: 0 0 0 3px rgba(46, 107, 230,0.1);
    }

    .btn {
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: #2E6BE6;
        color: white;
    }

    .btn-primary:hover {
        background: #2E6BE6;
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #101E45;
    }

    .btn-secondary:hover {
        background: #cbd5e1;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
    }

    .btn-view {
        background: #2E6BE6;
        color: white;
    }

    .btn-view:hover {
        background: #2E6BE6;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    .table-container {
        overflow-x: auto;
        margin-bottom: 24px;
    }

    .bookings-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .bookings-table thead {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
    }

    .bookings-table th {
        padding: 14px;
        text-align: left;
        font-weight: 600;
        color: #101E45;
    }

    .bookings-table td {
        padding: 14px;
        border-bottom: 1px solid #e9eef3;
    }

    .bookings-table tbody tr:hover {
        background: #f8fafc;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .status-pending {
        background: #FFF6CC;
        color: #7A6200;
    }

    .status-confirmed {
        background: #D9E4FA;
        color: #0c4a6e;
    }

    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .pagination-section {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pagination-btn {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        background: white;
        color: #101E45;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
    }

    .pagination-btn:hover {
        border-color: #2E6BE6;
        color: #2E6BE6;
    }

    .pagination-btn.active {
        background: #2E6BE6;
        color: white;
        border-color: #2E6BE6;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Modal Styles */
    .modal {
        display: flex;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s;
    }

    .modal.hidden {
        display: none;
    }

    .modal-content {
        background-color: white;
        padding: 24px;
        border-radius: 12px;
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 16px;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #101E45;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 2rem;
        cursor: pointer;
        color: #64748b;
    }

    .modal-body {
        color: #101E45;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #e9eef3;
    }

    .detail-label {
        font-weight: 600;
        color: #64748b;
    }

    .detail-value {
        text-align: right;
    }

    .loading {
        text-align: center;
        padding: 40px;
        color: #64748b;
    }

    .error {
        background: #fee2e2;
        color: #991b1b;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        text-align: center;
    }

    .success {
        background: #dcfce7;
        color: #15803d;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
        }

        .filter-group {
            min-width: auto;
        }

        .bookings-table {
            font-size: 0.85rem;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 10px;
        }
    }
</style>

<script>
    let currentPage = 1;
    let perPage = 15;

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadBookings();

        // Event listeners
        document.getElementById('filterBtn').addEventListener('click', () => {
            currentPage = 1;
            loadBookings();
        });

        document.getElementById('resetBtn').addEventListener('click', () => {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            currentPage = 1;
            loadBookings();
        });

        // Allow Enter key to search
        document.getElementById('searchInput').addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                currentPage = 1;
                loadBookings();
            }
        });
    });

    function loadBookings(page = 1) {
        currentPage = page;
        
        const search = document.getElementById('searchInput').value;
        const status = document.getElementById('statusFilter').value;
        const url = new URL('{{ route('admin.orders.ajax-list') }}', window.location.origin);
        url.searchParams.append('search', search);
        url.searchParams.append('status', status);
        url.searchParams.append('page', page);
        url.searchParams.append('per_page', perPage);

        fetch(url.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderBookingsTable(data.data);
                renderPagination(data.pagination);
            } else {
                showError('Failed to load bookings');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Error loading bookings');
        });
    }

    function renderBookingsTable(bookings) {
        const tbody = document.getElementById('bookingsTableBody');
        
        if (bookings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 40px;">No bookings found</td></tr>';
            return;
        }

        tbody.innerHTML = bookings.map(booking => `
            <tr>
                <td>#${booking.id}</td>
                <td>${booking.customer_name || 'N/A'}</td>
                <td>${booking.customer_email || 'N/A'}</td>
                <td>${booking.customer_phone || 'N/A'}</td>
                <td>${booking.pickup} → ${booking.dropoff}</td>
                <td>${formatDate(booking.pickup_date)}</td>
                <td>${booking.currency} ${booking.amount}</td>
                <td>
                    <span class="status-badge status-${booking.status || 'pending'}">
                        ${(booking.status || 'pending').toUpperCase()}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-view" onclick="viewBookingDetails(${booking.id})">
                        <i class="fas fa-eye"></i> View
                    </button>
                    <button class="btn btn-sm btn-delete" onclick="deleteBooking(${booking.id})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
        `).join('');
    }

    function renderPagination(pagination) {
        const container = document.getElementById('paginationContainer');
        
        if (pagination.last_page === 1) {
            container.innerHTML = '';
            return;
        }

        let html = '';

        // Previous button
        if (pagination.current_page > 1) {
            html += `<button class="pagination-btn" onclick="loadBookings(${pagination.current_page - 1})">← Previous</button>`;
        }

        // Page numbers
        for (let i = 1; i <= pagination.last_page; i++) {
            if (i === pagination.current_page) {
                html += `<button class="pagination-btn active">${i}</button>`;
            } else if (i <= 3 || i > pagination.last_page - 2 || Math.abs(i - pagination.current_page) <= 1) {
                html += `<button class="pagination-btn" onclick="loadBookings(${i})">${i}</button>`;
            } else if (i === 4 || i === pagination.last_page - 3) {
                html += `<span style="padding: 8px;">...</span>`;
            }
        }

        // Next button
        if (pagination.current_page < pagination.last_page) {
            html += `<button class="pagination-btn" onclick="loadBookings(${pagination.current_page + 1})">Next →</button>`;
        }

        container.innerHTML = html;
    }

    function viewBookingDetails(bookingId) {
        const showUrl = `{{ url('admin/orders') }}/${bookingId}`;
        fetch(showUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const booking = data.data;
                const modalBody = document.getElementById('modalBody');
                
                modalBody.innerHTML = `
                    <div class="detail-row">
                        <span class="detail-label">Booking ID:</span>
                        <span class="detail-value">#${booking.id}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Customer Name:</span>
                        <span class="detail-value">${booking.customer_name || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">${booking.customer_email || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Phone:</span>
                        <span class="detail-value">${booking.customer_phone || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Car:</span>
                        <span class="detail-value">${booking.car_name || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Pickup:</span>
                        <span class="detail-value">${booking.pickup}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Dropoff:</span>
                        <span class="detail-value">${booking.dropoff}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Pickup Date:</span>
                        <span class="detail-value">${formatDate(booking.pickup_date)}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Pickup Time:</span>
                        <span class="detail-value">${booking.pickup_time || 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Return Date:</span>
                        <span class="detail-value">${booking.return_date ? formatDate(booking.return_date) : 'N/A'}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Trip Type:</span>
                        <span class="detail-value">${(booking.trip_type || 'one-way').toUpperCase()}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Miles:</span>
                        <span class="detail-value">${booking.miles || 0}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Amount:</span>
                        <span class="detail-value">${booking.currency} ${booking.amount}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value">
                            <span class="status-badge status-${booking.status || 'pending'}">
                                ${(booking.status || 'pending').toUpperCase()}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Notes:</span>
                        <span class="detail-value">${booking.notes || 'N/A'}</span>
                    </div>
                `;
                
                document.getElementById('bookingModal').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Failed to load booking details');
        });
    }

    function deleteBooking(bookingId) {
        if (!confirm('Are you sure you want to delete this booking?')) {
            return;
        }

        const destroyUrl = `{{ url('admin/orders') }}/${bookingId}`;
        fetch(destroyUrl, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess('Booking deleted successfully');
                loadBookings(currentPage);
            } else {
                showError('Failed to delete booking');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Error deleting booking');
        });
    }

    function formatDate(date) {
        if (!date) return 'N/A';
        const d = new Date(date);
        return d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function showError(message) {
        const container = document.querySelector('.bookings-container');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error';
        errorDiv.textContent = message;
        container.insertBefore(errorDiv, container.firstChild);
        setTimeout(() => errorDiv.remove(), 5000);
    }

    function showSuccess(message) {
        const container = document.querySelector('.bookings-container');
        const successDiv = document.createElement('div');
        successDiv.className = 'success';
        successDiv.textContent = message;
        container.insertBefore(successDiv, container.firstChild);
        setTimeout(() => successDiv.remove(), 5000);
    }

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        const modal = document.getElementById('bookingModal');
        if (e.target === modal) {
            closeModal('bookingModal');
        }
    });
</script>
@endsection
