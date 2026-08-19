{{-- resources/views/admin/cars/index.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Cars Management')
@section('page_title', 'Cars')
@section('page_subtitle', 'Manage your vehicle fleet.')

@section('styles')
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #6c757d;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #F2C400;
        --info: #2E6BE6;
        --dark: #101E45;
        --light: #f8fafc;
        --border: #e2e8f0;
    }

    /* Page Header */
    .page-header-modern {
        margin-bottom: 2rem;
    }

    .page-header-modern h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 0.25rem 0;
    }

    .page-header-modern p {
        color: #64748b;
        margin: 0;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.08);
    }

    .stat-info h4 {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin: 0 0 0.5rem 0;
    }

    .stat-number {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.5rem;
    }

    /* Add Button */
    .btn-add-modern {
        background: var(--primary);
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.875rem;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        text-decoration: none;
        box-shadow: 0 2px 5px rgba(67, 97, 238, 0.2);
    }

    .btn-add-modern:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(67, 97, 238, 0.25);
        color: white;
    }

    /* Table Container */
    .table-container-modern {
        background: white;
        border-radius: 24px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    /* Table */
    .car-table-modern {
        width: 100%;
        border-collapse: collapse;
    }

    .car-table-modern th {
        text-align: left;
        padding: 1rem 1.5rem;
        background: #fefefe;
        border-bottom: 1px solid var(--border);
        color: #475569;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .car-table-modern td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        color: var(--dark);
        font-size: 0.9rem;
    }

    .car-table-modern tr:last-child td {
        border-bottom: none;
    }

    .car-table-modern tr:hover td {
        background-color: #fafcff;
    }

    /* Car Image */
    .car-image {
        width: 80px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid var(--border);
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .no-image-placeholder {
        width: 80px;
        height: 60px;
        background: #f1f5f9;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        font-weight: 600;
        color: #94a3b8;
        border: 1px dashed #cbd5e1;
    }

    /* Car Name */
    .car-name {
        font-weight: 600;
        color: var(--dark);
    }

    /* Manage Button */
    .btn-manage {
        background: #f1f5f9;
        color: #101E45;
        padding: 0.4rem 1rem;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s;
        border: 1px solid transparent;
    }

    .btn-manage:hover {
        background: white;
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Description */
    .description-text {
        color: #475569;
        font-size: 0.85rem;
        line-height: 1.4;
        max-width: 260px;
    }

    /* Action Icons */
    .action-icons-modern {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
    }

    .action-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: #f8fafc;
        color: #64748b;
        transition: all 0.2s;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .action-icon:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .action-icon.delete:hover {
        background: var(--danger);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .car-table-modern th,
        .car-table-modern td {
            padding: 0.75rem 1rem;
        }
        
        .description-text {
            max-width: 180px;
        }
        
        .car-image, .no-image-placeholder {
            width: 60px;
            height: 45px;
        }
        
        .action-icons-modern {
            gap: 0.4rem;
        }
    }

    .page-header-modern {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
</style>
@endsection

@section('content')
{{-- Header with stats --}}
<div class="page-header-modern d-flex justify-content-between align-items-center flex-wrap">
    <div>
        <h2><i class="fas fa-car" style="color: var(--primary); margin-right: 0.5rem;"></i> Car Fleet</h2>
        <p>Manage, edit, and configure your vehicle inventory</p>
    </div>
    <div>
        <a href="{{ route('admin.cars.create') }}" class="btn-add-modern">
            <i class="fas fa-plus"></i> Add New Car
        </a>
    </div>
</div>

{{-- Main Table --}}
<div class="table-container-modern">
    @if($cars->count() > 0)
    <table class="car-table-modern">
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Name</th>
                <th>Pricing & Details</th>
                <th>Description</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                {{-- Image Column --}}
                <td>
                    @if($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" class="car-image" alt="{{ $car->name }}">
                    @else
                        <div class="no-image-placeholder">
                            <i class="fas fa-image" style="margin-right: 4px;"></i> No img
                        </div>
                    @endif
                </td>
                
                {{-- Name Column --}}
                <td class="car-name">{{ $car->name }}</td>
                
                {{-- Manage Pricing Column --}}
                <td>
                    <a href="{{ route('admin.cars.show', $car->id) }}" class="btn-manage">
                        <i class="fas fa-tag"></i> Manage Pricing
                    </a>
                </td>
                
                {{-- Description Column --}}
                <td>
                    <div class="description-text">
                        {{ \Illuminate\Support\Str::limit($car->description ?? 'No description provided.', 70) }}
                    </div>
                </td>
                
                {{-- Actions Column --}}
                <td style="text-align: center;">
                    <div class="action-icons-modern">
                        <a href="{{ route('admin.cars.edit', $car->id) }}" class="action-icon" title="Edit Car">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('⚠️ Are you sure you want to delete this car? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" title="Delete Car">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    {{-- Empty State --}}
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-car-side"></i>
        </div>
        <p>No cars found in your fleet. Start by adding your first vehicle.</p>
        <a href="{{ route('admin.cars.create') }}" class="btn-add-modern" style="display: inline-flex;">
            <i class="fas fa-plus"></i> Add Your First Car
        </a>
    </div>
    @endif
</div>

{{-- Pagination (if needed) --}}
@if(method_exists($cars, 'links') && $cars->hasPages())
<div style="margin-top: 1.5rem;">
    {{ $cars->links() }}
</div>
@endif
@endsection