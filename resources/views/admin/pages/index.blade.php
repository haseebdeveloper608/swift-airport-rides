@extends('admin.layout.app')

@section('title', 'Pages Management')
@section('page_title', 'Pages')
@section('page_subtitle', 'Manage site pages and content.')

@section('styles')
<style>
    .action-btn {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-add {
        background: #2E6BE6;
        color: white;
    }
    .btn-add:hover { background: #2E6BE6; }

    .table-container {
        background: white;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
        border: 1px solid #edf2f7;
    }
    .pages-table {
        width: 100%;
        border-collapse: collapse;
    }
    .pages-table th {
        text-align: left;
        padding: 16px;
        border-bottom: 1px solid #eef2f6;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .pages-table td {
        padding: 16px;
        border-bottom: 1px solid #f8fafc;
        vertical-align: top;
    }
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }
    .badge-draft { background: #FFF9E0; color: #b45309; border: 1px solid #fed7aa; }
    .badge-published { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .actions {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .icon-link {
        color: #94a3b8;
        text-decoration: none;
        transition: 0.2s;
    }
    .icon-link-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        color: #94a3b8;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .icon-link-btn:hover { color: #2E6BE6; }
    .danger-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        color: #94a3b8;
        transition: 0.2s;
    }
    .danger-btn:hover { color: #ef4444; }
    .muted { color: #64748b; font-size: 0.85rem; }
</style>
@endsection

@section('content')
<div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap;">
    <div class="muted">
        @if(session('success'))
            <span style="color:#15803d;font-weight:600;">{{ session('success') }}</span>
        @endif
    </div>
    <a href="{{ route('admin.pages.create') }}" class="action-btn btn-add">
        <i class="fas fa-plus"></i> Add New Page
    </a>
</div>

<div class="table-container">
    <table class="pages-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Header Menu</th>
                <th>Status</th>
                <th>Updated</th>
                <th style="width:120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:700;color:#0A142E;">Home</td>
                <td>
                    <div>/</div>
                    <div style="margin-top:6px;">
                        <a class="icon-link" href="{{ url('/') }}" target="_blank" rel="noopener">
                            <i class="fas fa-arrow-up-right-from-square"></i> View
                        </a>
                    </div>
                </td>
                <td>
                    <span class="badge badge-published">Yes</span>
                </td>
                <td>
                    <span class="badge badge-published">Published</span>
                </td>
                <td class="muted">-</td>
                <td>
                    <div class="actions">
                        <a class="icon-link" href="{{ route('admin.homepage.index') }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="icon-link-btn" onclick="openDuplicateModal('homepage', '', 'Copy of Homepage')" title="Duplicate Homepage">
                            <i class="fas fa-copy" style="color:#2E6BE6;"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="font-weight:700;color:#0A142E;">About Us</td>
                <td>
                    <div>/about-us</div>
                    <div style="margin-top:6px;">
                        <a class="icon-link" href="{{ url('/about-us') }}" target="_blank" rel="noopener">
                            <i class="fas fa-arrow-up-right-from-square"></i> View
                        </a>
                    </div>
                </td>
                <td>
                    <span class="badge badge-published">Yes</span>
                </td>
                <td>
                    <span class="badge badge-published">Published</span>
                </td>
                <td class="muted">-</td>
                <td>
                    <div class="actions">
                        <a class="icon-link" href="{{ route('admin.pages.about.show') }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @forelse($pages as $page)
            <tr>
                <td style="font-weight:700;color:#0A142E;">{{ $page->name }}</td>
                <td class="muted">
                    <div>{{ $page->slug }}</div>
                    <div style="margin-top:6px;">
                        <a class="icon-link" href="{{ url('/' . $page->slug) }}" target="_blank" rel="noopener">
                            <i class="fas fa-arrow-up-right-from-square"></i> View
                        </a>
                    </div>
                </td>
                <td>
                    <span class="badge badge-published">Yes</span>
                </td>
                <td>
                    <span class="badge badge-published">Published</span>
                </td>
                <td class="muted">{{ optional($page->updated_at)->format('Y-m-d H:i') }}</td>
                <td>
                    <div class="actions">
                        <a class="icon-link" href="{{ route('admin.pages.edit', $page->id) }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="icon-link-btn" onclick="openDuplicateModal('page', '{{ $page->id }}', 'Copy of {{ addslashes($page->name) }}')" title="Duplicate Page">
                            <i class="fas fa-copy" style="color:#2E6BE6;"></i>
                        </button>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Delete this page?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="danger-btn" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="muted">No pages yet. Click “Add New Page”.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Duplicate Page Modal Popup -->
<div id="duplicateModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(10,20,46,0.6); backdrop-filter:blur(4px); z-index:99999; align-items:center; justify-content:center;">
    <div style="background:#ffffff; border-radius:20px; width:100%; max-width:480px; padding:28px; box-shadow:0 20px 50px rgba(0,0,0,0.25); position:relative;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h3 style="margin:0; font-size:1.2rem; font-weight:800; color:#0A142E; display:flex; align-items:center; gap:10px;">
                <i class="fas fa-copy" style="color:#2E6BE6;"></i> Duplicate Page
            </h3>
            <button type="button" onclick="closeDuplicateModal()" style="background:none; border:none; font-size:18px; color:#94a3b8; cursor:pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('admin.pages.duplicate') }}" method="POST" id="duplicateForm">
            @csrf
            <input type="hidden" name="source_type" id="dup_source_type" value="homepage">
            <input type="hidden" name="source_id" id="dup_source_id" value="">

            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#334155; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">Page Title :</label>
                <input type="text" name="title" id="dup_title" required placeholder="e.g. Heathrow Airport Taxi" style="width:100%; padding:12px 16px; border:1.5px solid #e2e8f0; border-radius:12px; font-size:14px; font-weight:600; color:#0A142E;" oninput="autoSlugify(this.value)">
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#334155; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">Page Slug :</label>
                <input type="text" name="slug" id="dup_slug" required placeholder="e.g. heathrow-airport-taxi" style="width:100%; padding:12px 16px; border:1.5px solid #e2e8f0; border-radius:12px; font-size:14px; color:#0A142E;">
            </div>

            <div style="display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" onclick="closeDuplicateModal()" style="padding:10px 20px; border-radius:10px; border:1px solid #e2e8f0; background:#f8fafc; font-weight:600; color:#475569; cursor:pointer;">Cancel</button>
                <button type="submit" style="padding:10px 24px; border-radius:10px; border:none; background:#2E6BE6; color:white; font-weight:700; cursor:pointer; box-shadow: 0 4px 14px rgba(46,107,230,0.3);">Duplicate Page</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDuplicateModal(sourceType, sourceId, defaultTitle) {
        document.getElementById('dup_source_type').value = sourceType;
        document.getElementById('dup_source_id').value = sourceId || '';
        document.getElementById('dup_title').value = defaultTitle || '';
        document.getElementById('dup_slug').value = slugify(defaultTitle || '');

        const modal = document.getElementById('duplicateModal');
        modal.style.display = 'flex';
        setTimeout(() => document.getElementById('dup_title').focus(), 100);
    }

    function closeDuplicateModal() {
        document.getElementById('duplicateModal').style.display = 'none';
    }

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    function autoSlugify(val) {
        const slugInput = document.getElementById('dup_slug');
        slugInput.value = slugify(val);
    }
</script>
@endsection

