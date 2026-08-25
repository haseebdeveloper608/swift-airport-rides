@extends('admin.layout.app')

@section('title', 'Manage Car Pricing')
@section('page_title', 'Car Pricing Management')
@section('page_subtitle', 'Manage your vehicle fleet.')

@section('content')
    <style>
        :root {
            --ink-900: #101828;
            --ink-700: #344054;
            --ink-500: #667085;
            --ink-400: #98a2b3;
            --border: #e4e7ec;
            --border-soft: #eef1f5;
            --surface: #ffffff;
            --bg: #f7f8fa;
            --accent: #155e75;
            --accent-dark: #0e4a5e;
            --accent-soft: #ecf6f8;
            --success-bg: #ecfdf3;
            --success-text: #05603a;
            --success-border: #abefc6;
            --danger-bg: #fef3f2;
            --danger-text: #912018;
            --danger-border: #fecdca;
            --radius-lg: 12px;
            --radius-md: 8px;
            --radius-sm: 6px;
            --shadow-card: 0 1px 2px rgba(16, 24, 40, 0.04), 0 1px 3px rgba(16, 24, 40, 0.06);
        }

        /* main container */
        .dashboard {
            max-width: 1440px;
            margin: 0 auto;
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            padding: 1.75rem 2rem 2.25rem;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--ink-900);
            letter-spacing: -0.01em;
            display: inline-block;
            margin-bottom: 0.2rem;
        }

        .sub {
            color: var(--ink-500);
            border-left: 3px solid var(--accent);
            padding-left: 12px;
            margin: 0.4rem 0 1.75rem 0;
            font-size: 0.9rem;
            font-weight: 450;
        }

        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            border-radius: var(--radius-md);
            font-size: 0.87rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            border: 1px solid;
        }
        .alert-success { background: var(--success-bg); border-color: var(--success-border); color: var(--success-text); }
        .alert-error { background: var(--danger-bg); border-color: var(--danger-border); color: var(--danger-text); }

        /* form card style */
        .form-card {
            background: var(--bg);
            border-radius: var(--radius-lg);
            padding: 1.5rem 1.6rem;
            margin-bottom: 2.25rem;
            border: 1px solid var(--border);
        }

        .form-card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--ink-500);
            margin-bottom: 1.1rem;
        }

        /* Airport Quick Select Buttons */
        .airport-quick-select {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 1rem;
            max-height: 200px;
            overflow-y: auto;
            padding: 4px 2px;
        }

        .airport-quick-select::-webkit-scrollbar {
            width: 6px;
        }

        .airport-quick-select::-webkit-scrollbar-track {
            background: var(--border-soft);
            border-radius: 3px;
        }

        .airport-quick-select::-webkit-scrollbar-thumb {
            background: var(--ink-400);
            border-radius: 3px;
        }

        .airport-btn {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--ink-700);
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            white-space: nowrap;
        }

        .airport-btn:hover {
            background: var(--accent-soft);
            border-color: var(--accent);
            color: var(--accent-dark);
        }

        .airport-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        .airport-btn .airport-code {
            font-weight: 600;
            font-size: 0.7rem;
            background: var(--bg);
            padding: 1px 6px;
            border-radius: 4px;
            color: var(--ink-500);
            margin-left: 4px;
        }

        .airport-btn.active .airport-code {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .airport-btn .terminal-badge {
            font-size: 0.6rem;
            background: var(--accent-soft);
            padding: 1px 5px;
            border-radius: 3px;
            margin-left: 3px;
            color: var(--accent-dark);
        }

        .airport-btn.active .terminal-badge {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1rem 1.4rem;
            align-items: end;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .input-group label {
            font-weight: 600;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--ink-700);
        }

        .input-group input, .input-group select {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 9px 12px;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
            color: var(--ink-900);
        }

        .input-group input::placeholder { color: var(--ink-400); font-weight: 400; }

        .input-group input:focus, .input-group select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(21, 94, 117, 0.12);
        }

        .save-btn {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.15s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .save-btn:hover { background: var(--accent-dark); }
        .save-btn:disabled { opacity: 0.65; cursor: default; }

        /* table section */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 1.1rem;
        }

        .entries-control {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.82rem;
            color: var(--ink-500);
        }

        .entries-control select {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 5px 10px;
            font-weight: 500;
            font-size: 0.82rem;
            color: var(--ink-900);
        }

        #recordCount {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ink-700);
            background: var(--border-soft);
            padding: 5px 12px;
            border-radius: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            background: var(--surface);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        th {
            text-align: left;
            padding: 0.8rem 1rem;
            background: var(--bg);
            color: var(--ink-500);
            font-weight: 600;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid var(--border-soft);
            vertical-align: middle;
            color: var(--ink-700);
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: var(--bg); }

        td strong { color: var(--ink-900); font-weight: 600; }

        .coord {
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            font-size: 0.72rem;
            color: var(--ink-400);
        }

        .amount { font-variant-numeric: tabular-nums; font-weight: 600; color: var(--ink-900); }

        .action-btn {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            font-weight: 600;
            cursor: pointer;
            font-size: 0.78rem;
            padding: 6px 12px;
            border-radius: var(--radius-sm);
            transition: background 0.15s;
            display: inline-flex;
            align-items: center;
        }

        .action-btn:hover { background: #fde3e1; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: var(--accent-soft);
            color: var(--accent-dark);
            border: 1px solid rgba(21, 94, 117, 0.15);
        }

        .badge-pickup { background: #eff8ff; color: #175cd3; border-color: rgba(23, 92, 211, 0.15); }
        .badge-dropoff { background: #f4f3ff; color: #5925dc; border-color: rgba(89, 37, 220, 0.15); }
        .badge-both { background: #ecfdf3; color: #05603a; border-color: rgba(5, 96, 58, 0.15); }

        .empty-row td {
            text-align: center;
            padding: 2.75rem;
            color: var(--ink-400);
            font-size: 0.88rem;
        }

        footer {
            margin-top: 1.5rem;
            text-align: right;
            font-size: 0.72rem;
            color: var(--ink-400);
        }

        .pagination-btn {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 6px 16px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--ink-700);
            transition: background 0.15s;
        }
        .pagination-btn:hover:not([disabled]) { background: var(--bg); }
        .pagination-btn[disabled] { opacity: 0.45; cursor: default; }

        .pagination-status {
            font-size: 0.82rem;
            color: var(--ink-500);
            padding: 6px 4px;
        }

        /* Autocomplete dropdown styles */
        .autocomplete-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 var(--radius-sm) var(--radius-sm);
            max-height: 240px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .autocomplete-results.active {
            display: block;
        }
        .autocomplete-item {
            padding: 9px 14px;
            border-bottom: 1px solid var(--border-soft);
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--ink-700);
            transition: background 0.15s;
        }
        .autocomplete-item:hover {
            background: var(--accent-soft);
            color: var(--accent-dark);
        }

        @media (max-width: 700px) {
            .dashboard { padding: 1rem; }
            .form-card { padding: 1rem; }
            th, td { padding: 0.7rem; }
        }
    </style>

<div class="dashboard">

    <h1>{{ $car->name ?? 'Vehicle' }} Pricing</h1>
    <div class="sub">Configure location-specific fare rules and pricing adjustments for {{ $car->name ?? 'this vehicle' }}.</div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Add / Edit Form Section -->
    <div class="form-card">
        <div class="form-card-header">New Fare Rule</div>

        <form id="fareForm" method="POST" action="{{ route('admin.concession-charges.store') }}">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <div class="form-grid">
                <div class="input-group" style="position: relative;">
                    <label>UK Airport / Location</label>
                    <input type="text" id="placeName" name="place" placeholder="Search UK Airport or location..." required autocomplete="off" oninput="searchAirportAddress(this.value)">
                    <div id="airport_results" class="autocomplete-results"></div>
                </div>
                <input type="hidden" id="latitude" name="lat">
                <input type="hidden" id="longitude" name="lng">
                <div class="input-group">
                    <label>Radius (Miles) <span style="font-weight: 400; color: var(--ink-400);">(Optional)</span></label>
                    <input type="number" step="0.1" id="radius" name="radius" placeholder="e.g., 5.0">
                </div>
                <div class="input-group">
                    <label>Post Code</label>
                    <input type="text" id="postCode" name="post_code" placeholder="e.g., RH6 0NP">
                </div>
                <div class="input-group">
                    <label>Fare Type</label>
                    <select id="fareType" name="fare_type">
                        <option value="Fixed">Fixed</option>
                        <option value="Variable">Variable</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Fare Amount (£)</label>
                    <input type="number" step="0.01" id="fareAmount" name="amount" placeholder="0.00" required>
                </div>
                <div class="input-group">
                    <label>Apply To</label>
                    <select id="applyTo" name="applies">
                        <option value="Pickup">Pickup</option>
                        <option value="Dropoff">Dropoff</option>
                        <option value="Both">Both</option>
                    </select>
                </div>
                <div class="input-group" style="justify-content: flex-end;">
                    <button type="submit" class="save-btn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Save Fare Rule
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table with entries per page + data -->
    <div class="table-header">
        <div class="entries-control">
            <span>Entries per page</span>
            <select id="entriesPerPage">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
        <div>
            <span id="recordCount">0 rules</span>
        </div>
    </div>

    <div class="table-wrapper">
        <table id="fareTable">
            <thead>
                <tr>
                    <th>Place</th><th>Post Code</th><th>Radius (Miles)</th><th>Fare Type</th><th>Amount (£)</th><th>Applies</th><th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @if(isset($concessions) && $concessions->count())
                    @foreach($concessions as $c)
                        <tr>
                            <td>
                                <strong>{{ $c->place }}</strong><br>
                                <span class="coord">lat:{{ $c->lat ?? '—' }} lon:{{ $c->lng ?? '—' }}</span>
                            </td>
                            <td>{{ $c->post_code ?? '—' }}</td>
                            <td>{{ number_format($c->radius, 2) }} mi</td>
                            <td><span class="badge">{{ $c->fare_type }}</span></td>
                            <td class="amount">£{{ number_format($c->amount, 2) }}</td>
                            <td>
                                @if($c->applies === 'Pickup') <span class="badge badge-pickup">Pickup</span>
                                @elseif($c->applies === 'Dropoff') <span class="badge badge-dropoff">Dropoff</span>
                                @else <span class="badge badge-both">Both</span>
                                @endif
                            </td>
                            <td>
                                <button class="action-btn delete-btn" data-id="{{ $c->id }}" aria-label="Delete">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6h18M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6M10 11v6M14 11v6M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="empty-row"><td colspan="7">No pricing rules yet. Create your first rule using the form above.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
    <div style="display: flex; justify-content: center; align-items:center; gap: 12px; margin-top: 20px;" id="paginationControls"></div>
    <footer>Pricing rules apply to pickup / dropoff zones. Use 'Both' for round trips.</footer>
</div>

<script>
    // Store fare data from server
    let fareData = {!! isset($concessions) ? $concessions->toJson() : '[]' !!};

    // Pagination state
    let currentPage = 1;
    let entriesPerPage = 10;

    // DOM elements
    const tableBody = document.getElementById('tableBody');
    const entriesPerPageSelect = document.getElementById('entriesPerPage');
    const paginationDiv = document.getElementById('paginationControls');
    const recordCountSpan = document.getElementById('recordCount');
    const fareForm = document.getElementById('fareForm');
    const submitBtn = fareForm.querySelector('.save-btn');

    // Helper: Escape HTML
    function escapeHtml(str) {
        if (!str) return '';
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    // Render table with current data
    function renderTable() {
        const startIdx = (currentPage - 1) * entriesPerPage;
        const endIdx = startIdx + entriesPerPage;
        const paginatedEntries = fareData.slice(startIdx, endIdx);

        recordCountSpan.innerText = `${fareData.length} rule${fareData.length !== 1 ? 's' : ''}`;

        if (fareData.length === 0) {
            tableBody.innerHTML = '<tr class="empty-row"><td colspan="7">No fare rules yet. Create your first rule using the form above.</td></tr>';
            renderPaginationControls();
            return;
        }

        let html = '';
        for (let item of paginatedEntries) {
            let appliesBadge = '';
            if (item.applies === 'Pickup') appliesBadge = '<span class="badge badge-pickup">Pickup</span>';
            else if (item.applies === 'Dropoff') appliesBadge = '<span class="badge badge-dropoff">Dropoff</span>';
            else appliesBadge = '<span class="badge badge-both">Both</span>';

            const radiusVal = parseFloat(item.radius) || 0;
            const amountVal = parseFloat(item.amount) || 0;

            html += `
                <tr data-id="${item.id}">
                    <td><strong>${escapeHtml(item.place)}</strong><br><span class="coord">lat:${item.lat || '—'} lon:${item.lng || '—'}</span></td>
                    <td>${escapeHtml(item.post_code || '—')}</td>
                    <td>${radiusVal.toFixed(2)} mi</td>
                    <td><span class="badge">${item.fare_type}</span></td>
                    <td class="amount">£${amountVal.toFixed(2)}</td>
                    <td>${appliesBadge}</td>
                    <td><button class="action-btn delete-btn" data-id="${item.id}" aria-label="Delete">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6h18M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6M10 11v6M14 11v6M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button></td>
                </tr>
            `;
        }
        tableBody.innerHTML = html;

        // Attach delete event listeners
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                deleteFareById(id);
            });
        });

        renderPaginationControls();
    }

    // Render pagination controls
    function renderPaginationControls() {
        const totalPages = Math.ceil(fareData.length / entriesPerPage);
        if (totalPages <= 1) {
            paginationDiv.innerHTML = fareData.length === 0 ? '' : `<button class="pagination-btn" disabled>← Prev</button><span class="pagination-status">Page 1 of 1</span><button class="pagination-btn" disabled>Next →</button>`;
            return;
        }

        paginationDiv.innerHTML = `
            <button class="pagination-btn" ${currentPage === 1 ? 'disabled' : ''} id="prevPageBtn">← Prev</button>
            <span class="pagination-status">Page ${currentPage} of ${totalPages}</span>
            <button class="pagination-btn" ${currentPage === totalPages ? 'disabled' : ''} id="nextPageBtn">Next →</button>
        `;

        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');
        if (prevBtn && !prevBtn.disabled) prevBtn.addEventListener('click', () => { if (currentPage > 1) { currentPage--; renderTable(); } });
        if (nextBtn && !nextBtn.disabled) nextBtn.addEventListener('click', () => { if (currentPage < totalPages) { currentPage++; renderTable(); } });
    }

    // Delete fare rule via AJAX
    async function deleteFareById(id) {
        if (!confirm('Are you sure you want to delete this fare rule?')) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(`/admin/concession-charges/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (response.ok && (result.success || response.status === 200)) {
                // Remove from local array
                const index = fareData.findIndex(item => item.id == id);
                if (index !== -1) fareData.splice(index, 1);

                // Adjust current page if needed
                const totalPagesAfter = Math.ceil(fareData.length / entriesPerPage);
                if (currentPage > totalPagesAfter && totalPagesAfter > 0) currentPage = totalPagesAfter;
                if (fareData.length === 0) currentPage = 1;

                renderTable();

                // Show success message
                showMessage(result.message || 'Fare rule deleted successfully!', 'success');
            } else {
                throw new Error(result.message || 'Delete failed');
            }
        } catch (err) {
            console.error('Delete error:', err);
            showMessage(err.message || 'Unable to delete rule. Please try again.', 'error');
        }
    }

    // Dynamic Address Search for UK Airport / Location
    let airportSearchTimeout = null;
    async function searchAirportAddress(text) {
        const resultsDiv = document.getElementById('airport_results');
        if (!text || text.trim().length < 2) {
            resultsDiv.classList.remove('active');
            return;
        }

        clearTimeout(airportSearchTimeout);
        airportSearchTimeout = setTimeout(async () => {
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const findAddressUrl = "{{ Route::has('find.address') ? route('find.address') : (Route::has('find-address') ? route('find-address') : url('/find-address')) }}";
                const response = await fetch(findAddressUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams({ text: text })
                });

                const data = await response.json();
                resultsDiv.innerHTML = '';

                const list = data.data || data.results || (Array.isArray(data) ? data : []);

                if (list && list.length > 0) {
                    resultsDiv.classList.add('active');
                    list.forEach(item => {
                        const place = item.label || item.value || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.waypoint_address) || item.name;
                        const lat = item.lat || item.latitude || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.latitude) || item.geometry?.location?.lat || '';
                        const lng = item.lng || item.longitude || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.longitude) || item.geometry?.location?.lng || '';
                        const postcode = item.postcode || item.post_code || item.postal_code || (item.legacy && item.legacy.waypoint && item.legacy.waypoint.postcode) || '';

                        if (place) {
                            const div = document.createElement('div');
                            div.classList.add('autocomplete-item');
                            div.innerHTML = escapeHtml(place);
                            div.onclick = () => {
                                document.getElementById('placeName').value = place;
                                if (lat) document.getElementById('latitude').value = lat;
                                if (lng) document.getElementById('longitude').value = lng;

                                let pc = postcode;
                                if (!pc && place) {
                                    const match = place.match(/\b([A-Za-z]{1,2}\d[A-Za-z\d]?\s*\d[A-Za-z]{2})\b/);
                                    if (match) pc = match[1].toUpperCase();
                                }
                                if (pc) document.getElementById('postCode').value = pc;

                                resultsDiv.classList.remove('active');
                            };
                            resultsDiv.appendChild(div);
                        }
                    });
                } else {
                    resultsDiv.classList.remove('active');
                }
            } catch (error) {
                console.error('Error fetching location suggestions:', error);
                resultsDiv.classList.remove('active');
            }
        }, 350);
    }

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.input-group')) {
            document.querySelectorAll('.autocomplete-results').forEach(el => {
                el.classList.remove('active');
            });
        }
    });

    // Function to fill form with airport data
    function fillAirportData(name, lat, lng, radius, postcode, applies = 'Both') {
        document.getElementById('placeName').value = name;
        
        // Set hidden fields
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        
        // Set visible fields
        document.getElementById('radius').value = radius;
        document.getElementById('postCode').value = postcode;
        document.getElementById('applyTo').value = applies;
        
        // Highlight active airport button
        document.querySelectorAll('.airport-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.name === name) {
                btn.classList.add('active');
            }
        });
    }

    // Airport quick select buttons
    document.querySelectorAll('.airport-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const name = this.dataset.name;
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            const radius = parseFloat(this.dataset.radius);
            const postcode = this.dataset.postcode;
            const applies = this.dataset.applies || 'Both';
            
            fillAirportData(name, lat, lng, radius, postcode, applies);
        });
    });

    // Submit form via AJAX
    async function handleFormSubmit(event) {
        event.preventDefault();

        // Validate required fields
        const place = document.getElementById('placeName').value.trim();
        if (!place) {
            showMessage('Please select an airport', 'error');
            return;
        }

        const radiusStr = document.getElementById('radius').value.trim();
        if (radiusStr !== '') {
            const radius = parseFloat(radiusStr);
            if (isNaN(radius) || radius < 0) {
                showMessage('Please enter a valid Radius (positive number)', 'error');
                return;
            }
        }

        const amount = parseFloat(document.getElementById('fareAmount').value);
        if (isNaN(amount) || amount <= 0) {
            showMessage('Please enter a valid Fare Amount (positive number)', 'error');
            return;
        }

        // Show loading state
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = 'Saving…';
        submitBtn.disabled = true;

        const formData = new FormData(fareForm);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const storeUrl = "{{ route('admin.concession-charges.store') }}";
            const response = await fetch(storeUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && (result.success || response.status === 200)) {
                // Add new rule to local data
                if (result.data) {
                    fareData.push(result.data);
                }

                // Reset form but keep car_id
                const carId = document.querySelector('input[name="car_id"]').value;
                fareForm.reset();
                document.querySelector('input[name="car_id"]').value = carId;
                document.getElementById('radius').value = '';
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';

                // Go to last page to show new entry
                const totalPagesNew = Math.ceil(fareData.length / entriesPerPage);
                currentPage = totalPagesNew > 0 ? totalPagesNew : 1;
                renderTable();

                showMessage(result.message || 'Fare rule saved successfully!', 'success');
            } else {
                let errText = result.message || 'Failed to save fare rule';
                if (result.errors) {
                    errText = Object.values(result.errors).flat().join(', ');
                }
                throw new Error(errText);
            }
        } catch (err) {
            console.error('Submit error:', err);
            showMessage(err.message || 'An error occurred. Please try again.', 'error');
        } finally {
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
        }
    }

    // Show temporary message
    function showMessage(message, type = 'success') {
        const existingMessage = document.querySelector('.floating-message');
        if (existingMessage) existingMessage.remove();

        const messageDiv = document.createElement('div');
        messageDiv.className = 'floating-message';
        messageDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 18px;
            background: ${type === 'success' ? '#ecfdf3' : '#fef3f2'};
            border: 1px solid ${type === 'success' ? '#abefc6' : '#fecdca'};
            color: ${type === 'success' ? '#05603a' : '#912018'};
            border-radius: 8px;
            font-family: 'Inter', -apple-system, sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            z-index: 9999;
            animation: slideIn 0.25s ease;
            box-shadow: 0 4px 12px rgba(16,24,40,0.12);
        `;
        messageDiv.textContent = message;
        document.body.appendChild(messageDiv);

        setTimeout(() => {
            messageDiv.style.opacity = '0';
            setTimeout(() => messageDiv.remove(), 300);
        }, 3000);
    }

    // Entries per page change handler
    function setupEntriesListener() {
        entriesPerPageSelect.addEventListener('change', (e) => {
            entriesPerPage = parseInt(e.target.value, 10);
            currentPage = 1;
            renderTable();
        });
    }

    // Add CSS animation for messages
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);

    // Initialize application
    function initialize() {
        setupEntriesListener();
        fareForm.addEventListener('submit', handleFormSubmit);
        renderTable();
    }

    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
</script>

@endsection