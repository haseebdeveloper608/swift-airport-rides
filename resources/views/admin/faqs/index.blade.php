@extends('admin.layout.app')

@section('title', 'FAQs Management')
@section('page_title', 'FAQs Management')
@section('page_subtitle', 'Create, update, and manage frequently asked questions for your website.')

@section('styles')
<style>
    :root {
        --primary: #2E6BE6;
        --primary-light: #EBF1FF;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #0f172a;
        --gray: #64748b;
        --light: #f8fafc;
        --border: #e2e8f0;
    }

    .action-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .search-filter-box {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-input {
        padding: 0.6rem 1rem 0.6rem 2.2rem;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 0.875rem;
        outline: none;
        width: 250px;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        padding: 0.65rem 1.25rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-primary:hover {
        background: #1e40af;
        color: white;
    }

    .card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .table th {
        background: #f8fafc;
        padding: 1rem 1.25rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--gray);
        border-bottom: 1px solid var(--border);
    }
    .table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border);
        font-size: 0.875rem;
        color: var(--dark);
        vertical-align: middle;
    }

    .badge-cat {
        background: var(--primary-light);
        color: var(--primary);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }

    .badge-status {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
    .badge-status.active { background: #d1fae5; color: #065f46; }
    .badge-status.inactive { background: #fee2e2; color: #991b1b; }

    .action-buttons {
        display: flex;
        gap: 8px;
    }
    .action-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        border: 1px solid var(--border);
        transition: all 0.2s;
        text-decoration: none;
        background: white;
    }
    .action-icon:hover {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--primary);
    }
    .action-icon.delete:hover {
        background: #fee2e2;
        color: var(--danger);
        border-color: var(--danger);
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
@endsection

@section('content')

@if(session('success'))
<div class="alert-success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="action-header">
    <form method="GET" action="{{ route('admin.faqs.index') }}" class="search-filter-box">
        <div style="position: relative;">
            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--gray);"></i>
            <input type="text" name="search" class="search-input" placeholder="Search questions..." value="{{ request('search') }}">
        </div>

        @if(count($categories) > 0)
        <select name="category" onchange="this.form.submit()" style="padding: 0.6rem 1rem; border-radius: 10px; border: 1px solid var(--border); outline: none; font-size: 0.875rem;">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        @endif

        @if(request('search') || request('category'))
            <a href="{{ route('admin.faqs.index') }}" class="btn-primary" style="background: #64748b;">Reset</a>
        @endif
    </form>

    <a href="{{ route('admin.faqs.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Add New FAQ
    </a>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px;">Order</th>
                <th>Question</th>
                <th>Category</th>
                <th>Status</th>
                <th>Updated</th>
                <th style="width: 130px; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($faqs as $faq)
            <tr>
                <td style="font-weight: 600; text-align: center;">{{ $faq->sort_order }}</td>
                <td>
                    <div style="font-weight: 600; color: var(--dark); margin-bottom: 4px;">{{ $faq->question }}</div>
                    <div style="font-size: 0.8rem; color: var(--gray);">{{ Str::limit(strip_tags($faq->answer), 80) }}</div>
                </td>
                <td><span class="badge-cat">{{ $faq->category }}</span></td>
                <td>
                    <form action="{{ route('admin.faqs.toggle-status', $faq->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" style="background:none; border:none; cursor:pointer; padding:0;">
                            <span class="badge-status {{ $faq->is_active ? 'active' : 'inactive' }}">
                                <i class="fas {{ $faq->is_active ? 'fa-check' : 'fa-times' }}"></i> {{ $faq->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </button>
                    </form>
                </td>
                <td style="font-size: 0.8rem; color: var(--gray);">{{ $faq->updated_at ? $faq->updated_at->format('M d, Y') : 'N/A' }}</td>
                <td style="text-align: center;">
                    <div class="action-buttons">
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="action-icon" title="Edit FAQ">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" title="Delete FAQ">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray);">
                    <i class="fas fa-folder-open" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block; opacity: 0.5;"></i>
                    No FAQ items found. <a href="{{ route('admin.faqs.create') }}" style="color: var(--primary); text-decoration: underline;">Create your first FAQ</a>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $faqs->links() }}
</div>

@endsection
