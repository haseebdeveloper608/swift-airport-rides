@extends('admin.layout.app')

@section('title', 'Manage Car Pricing')
@section('page_title', 'Car Pricing Management')
@section('page_subtitle', 'Manage your vehicle fleet.')

@section('content')
    <style>
        /* main container */
        .dashboard {
            max-width: 1440px;
            margin: 0 auto;
            background: white;
            border-radius: 32px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 1.8rem 2rem 2.5rem 2rem;
        }

        h1 {
            font-size: 1.9rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1e3c72, #2b4b8f);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
            display: inline-block;
            margin-bottom: 0.25rem;
        }

        .sub {
            color: #5b6e8c;
            border-left: 4px solid #2b4b8f;
            padding-left: 12px;
            margin: 0.5rem 0 1.8rem 0;
            font-weight: 450;
        }

        /* form card style */
        .form-card {
            background: #f8fafd;
            border-radius: 28px;
            padding: 1.6rem 1.8rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02), 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2edf7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1.2rem 1.8rem;
            align-items: end;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .input-group label {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #2c3e66;
        }

        .input-group input, .input-group select {
            background: white;
            border: 1.5px solid #dce5ef;
            border-radius: 18px;
            padding: 10px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            outline: none;
            color: #1a2c3e;
        }

        .input-group input:focus, .input-group select:focus {
            border-color: #2b4b8f;
            box-shadow: 0 0 0 3px rgba(43, 75, 143, 0.15);
        }

        .double-group {
            display: flex;
            gap: 12px;
        }
        .double-group .input-group {
            flex: 1;
        }

        .save-btn {
            background: #1e466e;
            color: white;
            border: none;
            border-radius: 40px;
            padding: 10px 22px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .save-btn:hover {
            background: #0f3557;
            transform: scale(0.98);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* table section */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
            margin-top: 0.5rem;
        }

        .entries-control {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f1f5f9;
            padding: 5px 14px;
            border-radius: 40px;
        }

        .entries-control select {
            background: white;
            border: 1px solid #cbdde9;
            border-radius: 30px;
            padding: 6px 12px;
            font-weight: 500;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 24px;
            border: 1px solid #eef2f8;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        th {
            text-align: left;
            padding: 1rem 1rem;
            background: #f2f6fc;
            color: #1f3b62;
            font-weight: 700;
            border-bottom: 1px solid #e0eaf3;
        }

        td {
            padding: 1rem 1rem;
            border-bottom: 1px solid #ecf3f9;
            vertical-align: middle;
            color: #2c3f55;
        }

        .action-btn {
            background: none;
            border: none;
            color: #bc3f2e;
            font-weight: 700;
            cursor: pointer;
            font-size: 0.8rem;
            background: #fee9e6;
            padding: 6px 14px;
            border-radius: 30px;
            transition: 0.2s;
        }

        .action-btn:hover {
            background: #fadbd4;
            color: #a12514;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
            background: #EBF1FF;
            color: #1e3c72;
        }

        .badge-pickup {
            background: #e1f5fe;
            color: #026aa7;
        }
        .badge-dropoff {
            background: #e8f0fe;
            color: #155fa0;
        }
        .badge-both {
            background: #e0f2e9;
            color: #1e6f3f;
        }

        .empty-row td {
            text-align: center;
            padding: 3rem;
            color: #7e95b0;
            font-style: italic;
        }

        footer {
            margin-top: 1.8rem;
            text-align: right;
            font-size: 0.7rem;
            color: #8ba0bc;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        @media (max-width: 700px) {
            .dashboard {
                padding: 1rem;
            }
            .form-card {
                padding: 1rem;
            }
            th, td {
                padding: 0.75rem;
            }
        }
    </style>

<div class="dashboard">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <div>
            <h1>📍 Mileage Pricing</h1>
            <div class="sub">Manage airport, station & zone fares — fixed rates per location</div>
        </div>
    </div>

    @if(session('success'))
        <div style="margin-top:12px; padding:10px 14px; background:#e6ffed; border:1px solid #b7f2c7; color:#114b2b; border-radius:8px; margin-bottom:1rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="margin-top:12px; padding:10px 14px; background:#ffe6e6; border:1px solid #fcc7c7; color:#8b1a1a; border-radius:8px; margin-bottom:1rem;">
            {{ session('error') }}
        </div>
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Add / Edit Form Section -->
    <div class="form-card">
        <form id="fareForm" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="_method" value="POST">
            <div class="form-grid">
                <div class="input-group">
                    <label>Search Place (Airport / Station / Area)</label>
                    <input type="text" id="placeName" name="place" placeholder="e.g., Gatwick North Terminal" required>
                </div>
                <div class="input-group">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="lat" placeholder="51.1561">
                </div>
                <div class="input-group">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="lng" placeholder="-0.1603">
                </div>
                <div class="input-group">
                    <label>Radius (KM)</label>
                    <input type="number" step="0.1" id="radius" name="radius" placeholder="0.00">
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
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="margin-right:8px;">
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
            <span>📄 Entries per page</span>
            <select id="entriesPerPage">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
        <div>
            <span id="recordCount" style="font-size: 0.8rem; background: #eef2fa; padding: 4px 12px; border-radius: 20px;">0 rules</span>
        </div>
    </div>

    <div class="table-wrapper">
        <table id="fareTable">
            <thead>
                <tr>
                    <th>Place</th><th>Post Code</th><th>Radius (KM)</th><th>Fare Type</th><th>Amount (£)</th><th>Applies</th><th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @if(isset($concessions) && $concessions->count())
                    @foreach($concessions as $c)
                        <tr>
                            <td>
                                <strong>{{ $c->place }}</strong><br>
                                <span style="font-size:0.7rem; color:#6f8fae;">lat:{{ $c->lat ?? '—' }} lon:{{ $c->lng ?? '—' }}</span>
                            </td>
                            <td>{{ $c->post_code ?? '—' }}</td>
                            <td>{{ number_format($c->radius, 2) }} KM</td>
                            <td><span class="badge">{{ $c->fare_type }}</span></td>
                            <td>£{{ number_format($c->amount, 2) }}</td>
                            <td>
                                @if($c->applies === 'Pickup') <span class="badge badge-pickup">Pickup</span>
                                @elseif($c->applies === 'Dropoff') <span class="badge badge-dropoff">Dropoff</span>
                                @else <span class="badge badge-both">Both</span>
                                @endif
                            </td>
                            <td>
                                <button class="action-btn delete-btn" data-id="{{ $c->id }}" aria-label="Delete">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6h18M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6M10 11v6M14 11v6M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" stroke="#bc3f2e" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="empty-row"><td colspan="7">✨ No pricing rules yet. Create your first rule using the form above ✨</td></tr>
                @endif
            </tbody>
        </table>
    </div>
    <div style="display: flex; justify-content: center; gap: 12px; margin-top: 22px;" id="paginationControls"></div>
    <footer>📍 Pricing rules apply to pickup / dropoff zones. Use 'Both' for round trips.</footer>
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
            tableBody.innerHTML = '<tr class="empty-row"><td colspan="7">✨ No fare rules yet. Create your first rule using the form above ✨</td></tr>';
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
                    <td><strong>${escapeHtml(item.place)}</strong><br><span style="font-size:0.7rem; color:#6f8fae;">lat:${item.lat || '—'} lon:${item.lng || '—'}</span></td>
                    <td>${escapeHtml(item.post_code || '—')}</td>
                    <td>${radiusVal.toFixed(2)} KM</td>
                    <td><span class="badge">${item.fare_type}</span></td>
                    <td>£${amountVal.toFixed(2)}</td>
                    <td>${appliesBadge}</td>
                    <td><button class="action-btn delete-btn" data-id="${item.id}" aria-label="Delete">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6h18M8 6v14a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V6M10 11v6M14 11v6M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" stroke="#bc3f2e" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
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
            paginationDiv.innerHTML = fareData.length === 0 ? '' : `<button disabled style="opacity:0.5">← Prev</button><span style="padding:0 10px">Page 1 of 1</span><button disabled>Next →</button>`;
            return;
        }
        
        paginationDiv.innerHTML = `
            <button class="paginate-btn" ${currentPage === 1 ? 'disabled' : ''} id="prevPageBtn" style="background:#f0f4fa; border:none; padding:6px 18px; border-radius:40px; cursor:pointer; font-weight:600;">← Prev</button>
            <span style="background:#eef2fa; padding:6px 18px; border-radius:40px;">Page ${currentPage} of ${totalPages}</span>
            <button class="paginate-btn" ${currentPage === totalPages ? 'disabled' : ''} id="nextPageBtn" style="background:#f0f4fa; border:none; padding:6px 18px; border-radius:40px; cursor:pointer; font-weight:600;">Next →</button>
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
            
            if (response.ok && result.success) {
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
    
    // Submit form via AJAX
    async function handleFormSubmit(event) {
        event.preventDefault();
        
        // Validate required fields
        const place = document.getElementById('placeName').value.trim();
        if (!place) {
            showMessage('Please enter a valid Place name', 'error');
            return;
        }
        
        const amount = parseFloat(document.getElementById('fareAmount').value);
        if (isNaN(amount) || amount <= 0) {
            showMessage('Please enter a valid Fare Amount (positive number)', 'error');
            return;
        }
        
        // Show loading state
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = '⏳ Saving...';
        submitBtn.disabled = true;
        
        const formData = new FormData(fareForm);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        try {
            const response = await fetch('{{ route("admin.concession-charges.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const result = await response.json();
            
            if (response.ok && result.success) {
                // Add new rule to local data
                if (result.data) {
                    fareData.push(result.data);
                }
                
                // Reset form
                fareForm.reset();
                document.getElementById('radius').value = '0';
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
                
                // Go to last page to show new entry
                const totalPagesNew = Math.ceil(fareData.length / entriesPerPage);
                currentPage = totalPagesNew;
                renderTable();
                
                showMessage(result.message || 'Fare rule saved successfully!', 'success');
            } else {
                throw new Error(result.message || 'Failed to save fare rule');
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
            padding: 12px 20px;
            background: ${type === 'success' ? '#e6ffed' : '#ffe6e6'};
            border: 1px solid ${type === 'success' ? '#b7f2c7' : '#fcc7c7'};
            color: ${type === 'success' ? '#114b2b' : '#8b1a1a'};
            border-radius: 8px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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

    // Auto-fill airport radius and applies value based on the place text
    function autoFillAirportFields(placeText) {
        const normalizedText = (placeText || '').toLowerCase();
        const airportRadiusMap = {
            'heathrow': 8,
            'gatwick': 10,
            'stansted': 10,
            'luton': 8,
            'london city': 6,
            'southend': 8,
            'manchester': 12,
            'birmingham': 10,
            'edinburgh': 12,
            'glasgow': 12,
        };

        const airportMatch = Object.keys(airportRadiusMap).find(key => normalizedText.includes(key));
        if (airportMatch) {
            document.getElementById('radius').value = airportRadiusMap[airportMatch];
            document.getElementById('applyTo').value = 'Both';
            return true;
        }
        return false;
    }
    
    // Google Places Autocomplete
    function initAutocomplete() {
        const input = document.getElementById('placeName');
        if (!input) return;
        
        try {
            const autocomplete = new google.maps.places.Autocomplete(input, { 
                types: ['geocode'],
                fields: ['address_components', 'geometry', 'formatted_address', 'name', 'types']
            });
            
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place || !place.geometry) return;
                
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                
                const components = place.address_components || [];
                const postcodeComp = components.find(c => c.types && c.types.includes('postal_code'));
                if (postcodeComp) {
                    document.getElementById('postCode').value = postcodeComp.long_name;
                }
                
                if (place.formatted_address) {
                    document.getElementById('placeName').value = place.formatted_address;
                }

                // Auto-fill radius and applies for airports
                const placeText = `${place.name || ''} ${place.formatted_address || ''}`;
                const matchedAirport = autoFillAirportFields(placeText);
                if (!matchedAirport && place.types && place.types.includes('airport')) {
                    document.getElementById('radius').value = 5;
                    document.getElementById('applyTo').value = 'Both';
                }
            });

            // Also handle manual typing/blurring
            input.addEventListener('blur', () => {
                const placeText = input.value.trim();
                if (placeText) {
                    autoFillAirportFields(placeText);
                }
            });
        } catch (e) {
            console.warn('Google Maps Places error:', e);
        }
    }
    
    // Add CSS animation for messages
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .paginate-btn:hover:not([disabled]) { 
            background: #e2eaf5 !important; 
            transform: scale(0.97); 
        }
        .paginate-btn[disabled] { 
            opacity: 0.4; 
            cursor: default; 
        }
        button { 
            transition: all 0.1s ease; 
        }
    `;
    document.head.appendChild(style);
    
    // Initialize application
    function initialize() {
        setupEntriesListener();
        fareForm.addEventListener('submit', handleFormSubmit);
        renderTable();
        
        // Initialize autocomplete if Google Maps is available
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            initAutocomplete();
        }
    }
    
    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
</script>

<!-- Load Google Maps Places API if key is provided -->
@if(env('GOOGLE_MAPS_API_KEY'))
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initAutocomplete" async defer></script>
@endif

@endsection