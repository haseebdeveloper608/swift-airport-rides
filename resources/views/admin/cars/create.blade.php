{{-- resources/views/admin/cars/create.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Add New Car')
@section('page_title', 'Add Car')
@section('page_subtitle', 'Enter vehicle details and set up custom pricing.')

@section('styles')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --danger: #ef4444;
        --dark: #101E45;
        --border: #e2e8f0;
    }

    .form-container {
        background: white;
        border-radius: 28px;
        padding: 32px;
        max-width: 1000px;
        margin: 0 auto;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--border);
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-title i {
        color: var(--primary);
        font-size: 1.4rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
        font-size: 0.875rem;
    }

    .form-group label .required {
        color: var(--danger);
        margin-left: 2px;
    }

    .form-group input, 
    .form-group select, 
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        outline: none;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
    }

    .form-group input:focus, 
    .form-group select:focus, 
    .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    /* Image Preview */
    .image-upload-area {
        border: 2px dashed var(--border);
        border-radius: 16px;
        padding: 1rem;
        background: #fafcff;
        transition: all 0.2s;
        cursor: pointer;
    }

    .image-upload-area:hover {
        border-color: var(--primary);
        background: #f8fafc;
    }

    .image-preview-container {
        margin-top: 1rem;
        position: relative;
        width: 100%;
        max-width: 280px;
        border-radius: 16px;
        overflow: hidden;
        background: #f1f5f9;
        display: none;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
    }

    .image-preview-container img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .image-placeholder {
        text-align: center;
        padding: 2rem;
        color: #94a3b8;
    }

    .image-placeholder i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    /* Pricing Card */
    .pricing-card {
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        margin-top: 1.5rem;
    }

    .pricing-header {
        display: flex;
    justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .pricing-header h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pricing-header h5 i {
        color: var(--primary);
    }

    .pricing-row {
        background: white;
        padding: 1rem;
        border-radius: 14px;
        border: 1px solid var(--border);
        margin-bottom: 0.75rem;
        display: grid;
        grid-template-columns: 1fr 1fr 1.5fr 50px;
        gap: 1rem;
        align-items: center;
        transition: all 0.2s;
    }

    .pricing-row:hover {
        border-color: var(--primary);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .pricing-row small {
        display: block;
        font-size: 0.7rem;
        color: #64748b;
        margin-bottom: 0.35rem;
        font-weight: 500;
    }

    .pricing-row input {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 0.85rem;
    }

    .pricing-row input:focus {
        border-color: var(--primary);
        outline: none;
    }

    .remove-btn {
        background: #fef2f2;
        color: var(--danger);
        border: 1px solid #fee2e2;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .remove-btn:hover {
        background: var(--danger);
        color: white;
        transform: scale(1.02);
    }

    .add-btn {
        background: #101E45;
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 40px;
        font-weight: 600;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-btn:hover {
        background: var(--primary);
        transform: translateY(-1px);
    }

    /* Action Buttons */
    .form-actions {
        margin-top: 2rem;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-save {
        background: var(--primary);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 40px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .btn-save:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(67, 97, 238, 0.25);
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        padding: 0.875rem 1.75rem;
        border-radius: 40px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: var(--dark);
    }

    /* Error Styling */
    .is-invalid {
        border-color: var(--danger) !important;
    }

    .error-message {
        color: var(--danger);
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
        
        .row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .pricing-row {
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }
        
        .pricing-row div:first-child {
            grid-column: span 2;
        }
        
        .pricing-row .remove-btn {
            grid-column: span 2;
            width: 100%;
        }
        
        .form-actions {
            flex-direction: column-reverse;
        }
        
        .btn-save, .btn-cancel {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-title">
        <i class="fas fa-plus-circle"></i>
        Add New Vehicle
    </div>

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" id="carForm">
        @csrf
        
        <div class="row">
            <div class="form-group">
                <label>Vehicle Name <span class="required">*</span></label>
                <input type="text" name="name" required placeholder="e.g., Mercedes-Benz V-Class" value="{{ old('name') }}">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Starting Price (£) <span class="required">*</span></label>
                <input type="number" name="price" step="0.01" min="0" required placeholder="e.g., 45.00" value="{{ old('price', 15.00) }}">
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Vehicle Image</label>
            <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                <div class="image-placeholder">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Click to upload or drag and drop</p>
                    <small style="color: #94a3b8;">PNG, JPG, JPEG up to 5MB</small>
                </div>
            </div>
            <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(this)" style="display: none;">
            <div id="imagePreviewContainer" class="image-preview-container">
                <img id="imagePreview" src="">
            </div>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4" placeholder="Luxury minibus, climate control, premium leather seats, WiFi, and more...">{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mileage Pricing Section -->
        <div class="pricing-card">
            <div class="pricing-header">
                <h5>
                    <i class="fas fa-chart-line"></i>
                    Mileage-Based Pricing
                </h5>
                <button type="button" class="add-btn" onclick="addPricingRow()">
                    <i class="fas fa-plus"></i> Add Range
                </button>
            </div>
            
            <div id="pricingWrapper">
                <div class="pricing-row" data-row="0">
                    <div>
                        <small>Min Miles (from)</small>
                        <input type="number" name="mileage_pricing[0][min]" value="{{ old('mileage_pricing.0.min', 0) }}" step="any" required placeholder="0">
                    </div>
                    <div>
                        <small>Max Miles (to)</small>
                        <input type="number" name="mileage_pricing[0][max]" value="{{ old('mileage_pricing.0.max', 1) }}" step="any" required placeholder="e.g., 50">
                    </div>
                    <div>
                        <small>Fixed Price (£)</small>
                        <input type="number" step="0.01" name="mileage_pricing[0][price]" value="{{ old('mileage_pricing.0.price', 15.00) }}" required placeholder="0.00">
                    </div>
                    <div>
                        <button type="button" class="remove-btn" disabled style="opacity:0.5; cursor:not-allowed;" title="Base range cannot be removed">
                            <i class="fas fa-lock"></i>
                        </button>
                    </div>
                </div>
            </div>

            @error('mileage_pricing')
                <div class="error-message" style="margin-top: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.cars.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Save Vehicle
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let pricingRowCount = 1;

    function addPricingRow() {
        const wrapper = document.getElementById('pricingWrapper');
        const rowCount = pricingRowCount;
        
        const row = document.createElement('div');
        row.className = 'pricing-row';
        row.setAttribute('data-row', rowCount);
        row.innerHTML = `
            <div>
                <small>Min Miles (from)</small>
                <input type="number" name="mileage_pricing[${rowCount}][min]" step="any" placeholder="e.g., 50" required>
            </div>
            <div>
                <small>Max Miles (to)</small>
                <input type="number" name="mileage_pricing[${rowCount}][max]" step="any" placeholder="e.g., 100" required>
            </div>
            <div>
                <small>Fixed Price (£)</small>
                <input type="number" step="0.01" name="mileage_pricing[${rowCount}][price]" placeholder="0.00" required>
            </div>
            <div>
                <button type="button" class="remove-btn" onclick="this.closest('.pricing-row').remove()">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        `;
        
        wrapper.appendChild(row);
        pricingRowCount++;
    }

    function previewImage(input) {
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImg = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.style.display = 'flex';
                previewContainer.style.alignItems = 'center';
                previewContainer.style.justifyContent = 'center';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.style.display = 'none';
            previewImg.src = '';
        }
    }

    // Form validation before submit
    document.getElementById('carForm').addEventListener('submit', function(e) {
        const pricingRows = document.querySelectorAll('#pricingWrapper .pricing-row');
        let isValid = true;
        
        pricingRows.forEach((row, index) => {
            const minInput = row.querySelector('input[name*="[min]"]');
            const maxInput = row.querySelector('input[name*="[max]"]');
            const priceInput = row.querySelector('input[name*="[price]"]');
            
            if (minInput && maxInput && priceInput) {
                const min = parseFloat(minInput.value);
                const max = parseFloat(maxInput.value);
                const price = parseFloat(priceInput.value);
                
                if (isNaN(min) || isNaN(max)) {
                    isValid = false;
                    alert(`Please enter valid mile ranges for row ${index + 1}`);
                    e.preventDefault();
                    return;
                }
                
                if (min >= max) {
                    isValid = false;
                    alert(`In row ${index + 1}: Minimum miles must be less than maximum miles.`);
                    e.preventDefault();
                    return;
                }
                
                if (isNaN(price) || price < 0) {
                    isValid = false;
                    alert(`Please enter a valid price for row ${index + 1}`);
                    e.preventDefault();
                    return;
                }
            }
        });
        
        // Check for overlapping ranges
        const ranges = [];
        pricingRows.forEach(row => {
            const min = parseFloat(row.querySelector('input[name*="[min]"]')?.value);
            const max = parseFloat(row.querySelector('input[name*="[max]"]')?.value);
            if (!isNaN(min) && !isNaN(max)) {
                ranges.push({ min, max, element: row });
            }
        });
        
        for (let i = 0; i < ranges.length; i++) {
            for (let j = i + 1; j < ranges.length; j++) {
                if (ranges[i].min < ranges[j].max && ranges[j].min < ranges[i].max) {
                    isValid = false;
                    alert(`Pricing ranges overlap. Please ensure mileage ranges do not overlap.`);
                    e.preventDefault();
                    return;
                }
            }
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
</script>
@endsection