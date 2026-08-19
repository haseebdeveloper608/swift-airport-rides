@extends('admin.layout.app')

@section('title', 'Blogs Management')
@section('page_title', 'Blogs')
@section('page_subtitle', 'Manage your news and articles.')

@section('styles')
<style>
    :root {
        --primary: #2E6BE6;
        --primary-dark: #2E6BE6;
        --primary-light: #EBF1FF;
        --success: #10b981;
        --warning: #F2C400;
        --danger: #ef4444;
        --dark: #0A142E;
        --gray: #64748b;
        --light: #f8fafc;
        --border: #e2e8f0;
    }

    /* Header Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 1.25rem 1.5rem;
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
        color: var(--gray);
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
        background: rgba(46, 107, 230, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.5rem;
    }

    /* Action Button */
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
        box-shadow: 0 2px 5px rgba(46, 107, 230, 0.2);
    }

    .btn-add-modern:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(46, 107, 230, 0.25);
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

    /* Alert Messages */
    .alert-modern {
        padding: 1rem 1.25rem;
        border-radius: 16px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border: 1px solid transparent;
    }

    .alert-success {
        background: #ecfdf5;
        color: #059669;
        border-color: #d1fae5;
    }

    .alert-success i {
        color: #10b981;
    }

    .alert-danger {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fee2e2;
    }

    .alert-danger i {
        color: #ef4444;
    }

    /* Table Styles */
    .blog-table-modern {
        width: 100%;
        border-collapse: collapse;
    }

    .blog-table-modern th {
        text-align: left;
        padding: 1rem 1.5rem;
        background: #fefefe;
        border-bottom: 1px solid var(--border);
        color: var(--gray);
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .blog-table-modern td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        color: var(--dark);
        font-size: 0.9rem;
    }

    .blog-table-modern tr:last-child td {
        border-bottom: none;
    }

    .blog-table-modern tr:hover td {
        background-color: #fafcff;
    }

    /* Blog Thumbnail */
    .blog-thumb-modern {
        width: 70px;
        height: 50px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid var(--border);
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .no-image-placeholder {
        width: 70px;
        height: 50px;
        background: var(--light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray);
        border: 1px dashed var(--border);
    }

    /* Title */
    .blog-title {
        font-weight: 600;
        color: var(--dark);
        max-width: 250px;
    }

    /* Slug */
    .blog-slug {
        color: var(--gray);
        font-size: 0.8rem;
        font-family: monospace;
        background: var(--light);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        display: inline-block;
    }

    /* Status Badges */
    .badge-status {
        padding: 0.25rem 0.75rem;
        border-radius: 99px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        width: fit-content;
    }

    .status-published {
        background: #ecfdf5;
        color: #059669;
    }

    .status-draft {
        background: #f1f5f9;
        color: var(--gray);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .action-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: var(--light);
        color: var(--gray);
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

    /* Pagination */
    .pagination-modern {
        margin-top: 1.5rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
    }

    .pagination-modern nav {
        display: flex;
        justify-content: center;
    }

    .pagination-modern .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination-modern .page-item {
        display: inline-block;
    }

    .pagination-modern .page-link {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        background: white;
        color: var(--gray);
        text-decoration: none;
        border: 1px solid var(--border);
        transition: all 0.2s;
        font-size: 0.875rem;
    }

    .pagination-modern .page-item.active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .pagination-modern .page-link:hover {
        background: var(--primary-light);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--border);
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: var(--gray);
        margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .blog-table-modern th,
        .blog-table-modern td {
            padding: 0.75rem 1rem;
        }
        
        .blog-title {
            max-width: 150px;
            font-size: 0.85rem;
        }
        
        .blog-thumb-modern, .no-image-placeholder {
            width: 50px;
            height: 40px;
        }
        
        .action-buttons {
            gap: 0.4rem;
        }
        
        .blog-slug {
            font-size: 0.7rem;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }

    @media (max-width: 640px) {
        .blog-table-modern th:nth-child(4),
        .blog-table-modern td:nth-child(4),
        .blog-table-modern th:nth-child(5),
        .blog-table-modern td:nth-child(5) {
            display: none;
        }
    }

    /* Tooltip */
    [data-tooltip] {
        position: relative;
        cursor: pointer;
    }

    [data-tooltip]:before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 0.25rem 0.5rem;
        background: var(--dark);
        color: white;
        font-size: 0.7rem;
        border-radius: 6px;
        white-space: nowrap;
        display: none;
        z-index: 10;
        margin-bottom: 5px;
    }

    [data-tooltip]:hover:before {
        display: block;
    }
</style>
@endsection

@section('content')
{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h4>Total Posts</h4>
            <div class="stat-number">{{ $totalPosts ?? $blogs->total() }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-newspaper"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Published</h4>
            <div class="stat-number">{{ $publishedCount ?? $blogs->where('status', 'published')->count() }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Drafts</h4>
            <div class="stat-number">{{ $draftCount ?? $blogs->where('status', 'draft')->count() }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-pencil-alt"></i>
        </div>
    </div>
</div>

{{-- Header with Add Button --}}
<div style="margin-bottom: 1.5rem; display: flex; justify-content: flex-end;">
    <a href="{{ route('admin.blogs.create') }}" class="btn-add-modern">
        <i class="fas fa-plus"></i> Create New Post
    </a>
</div>

<div class="table-container-modern">
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert-modern alert-success" style="margin: 1.5rem 1.5rem 0 1.5rem;">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-modern alert-danger" style="margin: 1.5rem 1.5rem 0 1.5rem;">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($blogs->count() > 0)
    <table class="blog-table-modern">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                {{-- Image Column --}}
                <td>
                    @if($blog->image && Storage::disk('public')->exists($blog->image))
                        <img src="{{ asset('storage/' . $blog->image) }}" class="blog-thumb-modern" alt="{{ $blog->title }}">
                    @else
                        <div class="no-image-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </td>
                
                {{-- Title Column --}}
                <td>
                    <div class="blog-title" data-tooltip="{{ $blog->title }}">
                        {{ Str::limit($blog->title, 50) }}
                    </div>
                </td>
                
                {{-- Slug Column --}}
                <td>
                    <code class="blog-slug">/{{ Str::limit($blog->slug, 30) }}</code>
                </td>
                
                {{-- Status Column --}}
                <td>
                    <span class="badge-status status-{{ $blog->status }}">
                        @if($blog->status == 'published')
                            <i class="fas fa-check-circle"></i>
                        @else
                            <i class="fas fa-clock"></i>
                        @endif
                        {{ ucfirst($blog->status) }}
                    </span>
                </td>
                
                {{-- Date Column --}}
                <td>
                    <div data-tooltip="{{ $blog->created_at->format('F d, Y H:i A') }}">
                        <i class="far fa-calendar-alt" style="color: var(--gray); margin-right: 0.25rem;"></i>
                        {{ $blog->created_at->format('M d, Y') }}
                    </div>
                </td>
                
                {{-- Actions Column --}}
                <td style="text-align: center;">
                    <div class="action-buttons">
                        {{-- View Button (Optional) --}}
                        <a href="{{ route('blog.show', $blog->slug) }}" class="action-icon" data-tooltip="View Post">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        {{-- Edit Button --}}
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="action-icon" data-tooltip="Edit Post">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        
                        {{-- Delete Form --}}
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(event, '{{ $blog->title }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" data-tooltip="Delete Post">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($blogs->hasPages())
    <div class="pagination-modern">
        {{ $blogs->links() }}
    </div>
    @endif

    @else
    {{-- Empty State --}}
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-blog"></i>
        </div>
        <p>No blog posts found. Start writing your first article!</p>
        <a href="{{ route('admin.blogs.create') }}" class="btn-add-modern" style="display: inline-flex;">
            <i class="fas fa-plus"></i> Create Your First Post
        </a>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Sweet confirmation for delete
    function confirmDelete(event, blogTitle) {
        event.preventDefault();
        
        if (confirm(`⚠️ Are you sure you want to delete "${blogTitle}"?\n\nThis action cannot be undone.`)) {
            event.target.submit();
        }
        
        return false;
    }
    
    // Optional: Add fade out effect for alerts
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-modern');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.style.display = 'none';
                    }
                }, 300);
            }, 5000);
        });
    });
</script>
@endsection