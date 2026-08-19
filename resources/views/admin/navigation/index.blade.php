@extends('admin.layout.app')

@section('title', 'Header Navigation Manager')
@section('page_title', 'Header Navigation')
@section('page_subtitle', 'Manage and customize your site header links, multi-column mega menus & dropdown sub-menus.')

@section('styles')
<style>
    .nav-manager-grid {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 28px;
        align-items: start;
    }

    .card-panel {
        background: #fff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        margin-bottom: 24px;
    }

    .card-panel h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0A142E;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-panel h3 i {
        color: #2E6BE6;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1.5px solid #cbd5e1;
        font-size: 0.9rem;
        outline: none;
        transition: border-color .2s;
    }

    .form-control:focus {
        border-color: #2E6BE6;
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
    }

    .btn-submit {
        background: #2E6BE6;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: background .2s, transform .15s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit:hover {
        background: #1E4FC2;
        transform: translateY(-1px);
    }

    .quick-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 220px;
        overflow-y: auto;
        padding-right: 4px;
    }

    .quick-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #f1f5f9;
        font-size: 0.86rem;
    }

    .quick-item button {
        background: #e0e7ff;
        color: #2E6BE6;
        border: none;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }

    .quick-item button:hover {
        background: #2E6BE6;
        color: #fff;
    }

    /* Menu Tree List */
    .menu-tree {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .menu-card {
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        transition: border-color .2s;
        flex-wrap: wrap;
        gap: 12px;
    }

    .menu-card:hover {
        border-color: #94a3b8;
    }

    .menu-card.sub-item-l2 {
        margin-left: 32px;
        border-left: 4px solid #2E6BE6;
        background: #f8fafc;
    }

    .menu-card.sub-item-l3 {
        margin-left: 64px;
        border-left: 4px solid #10b981;
        background: #f0fdf4;
    }

    .menu-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .menu-handle {
        color: #94a3b8;
        font-size: 1.1rem;
    }

    .menu-title {
        font-weight: 700;
        color: #0A142E;
        font-size: 0.95rem;
    }

    .menu-url {
        font-size: 0.8rem;
        color: #64748b;
        font-family: monospace;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 4px;
        margin-left: 6px;
    }

    .badge-status {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .04em;
    }

    .badge-active { background: #dcfce7; color: #15803d; }
    .badge-hidden { background: #fee2e2; color: #b91c1c; }
    .badge-dropdown { background: #e0e7ff; color: #3730a3; }
    .badge-subitem { background: #d1fae5; color: #047857; }

    .menu-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all .2s;
    }

    .btn-icon:hover {
        background: #f1f5f9;
        color: #0A142E;
    }

    .btn-icon.delete:hover {
        background: #fee2e2;
        color: #ef4444;
        border-color: #fca5a5;
    }

    .parent-select-inline {
        font-size: 0.82rem;
        padding: 5px 10px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: #fff;
        cursor: pointer;
        color: #334155;
        font-weight: 500;
        outline: none;
        max-width: 220px;
    }

    .parent-select-inline:hover {
        border-color: #2E6BE6;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10, 20, 46, 0.5);
        z-index: 999;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        width: 100%;
        max-width: 520px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0A142E;
    }
</style>
@endsection

@section('content')

@if(session('success'))
<div style="background:#dcfce7; color:#15803d; padding:14px 20px; border-radius:12px; margin-bottom:24px; font-weight:600; display:flex; align-items:center; gap:10px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background:#fee2e2; color:#b91c1c; padding:14px 20px; border-radius:12px; margin-bottom:24px; font-weight:600; display:flex; align-items:center; gap:10px;">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
</div>
@endif

<div class="nav-manager-grid">
    <!-- LEFT COLUMN: QUICK ADD & CUSTOM LINK FORM -->
    <div>
        <!-- Custom Link Panel -->
        <div class="card-panel">
            <h3><i class="fas fa-plus-circle"></i> Add Menu Item</h3>
            <form action="{{ route('admin.navigation.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Menu Label <span style="color:#ef4444">*</span></label>
                    <input type="text" name="label" class="form-control" placeholder="e.g. London Taxi or Locations" required>
                </div>

                <div class="form-group">
                    <label>URL / Path <span style="color:#ef4444">*</span></label>
                    <input type="text" name="url" class="form-control" placeholder="e.g. /london-taxi or #" required>
                </div>

                <div class="form-group">
                    <label>Parent Item (For Multi-Level / Mega Dropdowns)</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- Main Navbar (Top Level) --</option>
                        @foreach($allMenuItems as $potentialParent)
                            <option value="{{ $potentialParent->id }}">
                                {{ $potentialParent->parent_id ? '  └── ' : '📁 ' }} {{ $potentialParent->label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Open Target</label>
                    <select name="target" class="form-control">
                        <option value="_self">Same Tab (_self)</option>
                        <option value="_blank">New Tab (_blank)</option>
                    </select>
                </div>

                <div class="form-group" style="display:flex; align-items:center; gap:8px;">
                    <input type="checkbox" name="is_active" id="is_active_custom" value="1" checked style="width:18px; height:18px;">
                    <label for="is_active_custom" style="margin:0; cursor:pointer;">Visible in Header</label>
                </div>

                <button type="submit" class="btn-submit"><i class="fas fa-plus"></i> Add to Header</button>
            </form>
        </div>

        <!-- Quick System Routes -->
        <div class="card-panel">
            <h3><i class="fas fa-bolt"></i> Quick Add System Pages</h3>
            <div class="quick-list">
                @php
                $systemRoutes = [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Services', 'url' => '/#services'],
                    ['label' => 'Locations', 'url' => '/#locations'],
                    ['label' => 'Fleet', 'url' => '/#fleet'],
                    ['label' => 'About Us', 'url' => '/about-us'],
                    ['label' => 'FAQs', 'url' => '/faqs'],
                    ['label' => 'Contact Us', 'url' => '/contact-us'],
                    ['label' => 'Blog', 'url' => '/blog'],
                    ['label' => 'Drive With Us', 'url' => '/drive-with-us'],
                    ['label' => 'Book Taxi', 'url' => '/book'],
                ];
                @endphp

                @foreach($systemRoutes as $route)
                <div class="quick-item">
                    <div>
                        <strong>{{ $route['label'] }}</strong>
                        <div style="font-size:0.75rem; color:#64748b;">{{ $route['url'] }}</div>
                    </div>
                    <form action="{{ route('admin.navigation.store') }}" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="label" value="{{ $route['label'] }}">
                        <input type="hidden" name="url" value="{{ $route['url'] }}">
                        <input type="hidden" name="is_active" value="1">
                        <button type="submit"><i class="fas fa-plus"></i> Add</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick CMS Pages -->
        @if($pages->isNotEmpty())
        <div class="card-panel">
            <h3><i class="fas fa-file-alt"></i> Quick Add Custom Pages</h3>
            <div class="quick-list">
                @foreach($pages as $page)
                <div class="quick-item">
                    <div>
                        <strong>{{ $page->name }}</strong>
                        <div style="font-size:0.75rem; color:#64748b;">/{{ $page->slug }}</div>
                    </div>
                    <form action="{{ route('admin.navigation.store') }}" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="label" value="{{ $page->name }}">
                        <input type="hidden" name="url" value="/{{ $page->slug }}">
                        <input type="hidden" name="is_active" value="1">
                        <button type="submit"><i class="fas fa-plus"></i> Add</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- RIGHT COLUMN: STRUCTURE TREE -->
    <div class="card-panel">
        <h3><i class="fas fa-list-ol"></i> Header Menu Structure</h3>
        <p style="font-size:0.88rem; color:#64748b; margin-bottom:20px;">
            Support for <strong>Multi-Level & Mega Menus</strong>! Make any item a sub-menu or sub-category. Items with many sub-links render automatically as a full-width Mega Menu.
        </p>

        @if($menuTree->isEmpty())
        <div style="text-align:center; padding:40px; background:#f8fafc; border-radius:12px; color:#64748b;">
            <i class="fas fa-compass" style="font-size:2.5rem; color:#cbd5e1; margin-bottom:12px;"></i>
            <p>No header menu items found. Click Quick Add on the left to add your first link!</p>
        </div>
        @else
        <div class="menu-tree">
            @foreach($menuTree as $item)
            <!-- Level 1 (Top Level Item) -->
            <div>
                <div class="menu-card">
                    <div class="menu-info">
                        <i class="fas fa-folder menu-handle" style="color:#2E6BE6;"></i>
                        <div>
                            <span class="menu-title">{{ $item->label }}</span>
                            <span class="menu-url">{{ $item->url }}</span>
                            @if($item->children->isNotEmpty())
                                <span class="badge-status badge-dropdown">{{ $item->children->count() }} Sub-items</span>
                            @endif
                        </div>
                    </div>

                    <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                        <!-- Inline Parent Selector -->
                        <form action="{{ route('admin.navigation.parent', $item->id) }}" method="POST" style="margin:0;">
                            @csrf
                            <select name="parent_id" onchange="this.form.submit()" class="parent-select-inline" title="Move Parent">
                                <option value="">-- Main Navbar (Top Level) --</option>
                                @foreach($allMenuItems as $potentialParent)
                                    @if($potentialParent->id != $item->id)
                                        <option value="{{ $potentialParent->id }}" {{ $item->parent_id == $potentialParent->id ? 'selected' : '' }}>
                                            Submenu of: {{ $potentialParent->label }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </form>

                        <span class="badge-status {{ $item->is_active ? 'badge-active' : 'badge-hidden' }}">
                            {{ $item->is_active ? 'Active' : 'Hidden' }}
                        </span>

                        <div class="menu-actions">
                            <form action="{{ route('admin.navigation.move', ['navigation' => $item->id, 'direction' => 'up']) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-icon" title="Move Up"><i class="fas fa-arrow-up"></i></button>
                            </form>

                            <form action="{{ route('admin.navigation.move', ['navigation' => $item->id, 'direction' => 'down']) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-icon" title="Move Down"><i class="fas fa-arrow-down"></i></button>
                            </form>

                            <button type="button" class="btn-icon" title="Edit Item" onclick="openEditModal({{ json_encode($item) }})">
                                <i class="fas fa-edit"></i>
                            </button>

                            <form action="{{ route('admin.navigation.destroy', $item->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Delete {{ $item->label }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Delete Item"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Level 2 Sub-Items -->
                @if($item->children->isNotEmpty())
                    @foreach($item->children as $child)
                    <div style="margin-top:8px;">
                        <div class="menu-card sub-item-l2">
                            <div class="menu-info">
                                <i class="fas fa-level-up-alt fa-rotate-90" style="color:#2E6BE6; font-size:1.1rem; margin-right:4px;"></i>
                                <div>
                                    <span class="menu-title">{{ $child->label }}</span>
                                    <span class="menu-url">{{ $child->url }}</span>
                                    @if($child->children->isNotEmpty())
                                        <span class="badge-status badge-subitem">{{ $child->children->count() }} Nested Links</span>
                                    @else
                                        <span class="badge-status badge-dropdown" style="font-size:0.68rem;">Dropdown Link</span>
                                    @endif
                                </div>
                            </div>

                            <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                                <!-- Inline Parent Selector -->
                                <form action="{{ route('admin.navigation.parent', $child->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <select name="parent_id" onchange="this.form.submit()" class="parent-select-inline" title="Move Parent">
                                        <option value="">-- Main Navbar (Top Level) --</option>
                                        @foreach($allMenuItems as $potentialParent)
                                            @if($potentialParent->id != $child->id)
                                                <option value="{{ $potentialParent->id }}" {{ $child->parent_id == $potentialParent->id ? 'selected' : '' }}>
                                                    Submenu of: {{ $potentialParent->label }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>

                                <span class="badge-status {{ $child->is_active ? 'badge-active' : 'badge-hidden' }}">
                                    {{ $child->is_active ? 'Active' : 'Hidden' }}
                                </span>

                                <div class="menu-actions">
                                    <form action="{{ route('admin.navigation.move', ['navigation' => $child->id, 'direction' => 'up']) }}" method="POST" style="margin:0;">
                                        @csrf
                                        <button type="submit" class="btn-icon" title="Move Up"><i class="fas fa-arrow-up"></i></button>
                                    </form>

                                    <form action="{{ route('admin.navigation.move', ['navigation' => $child->id, 'direction' => 'down']) }}" method="POST" style="margin:0;">
                                        @csrf
                                        <button type="submit" class="btn-icon" title="Move Down"><i class="fas fa-arrow-down"></i></button>
                                    </form>

                                    <button type="button" class="btn-icon" title="Edit Sub Item" onclick="openEditModal({{ json_encode($child) }})">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('admin.navigation.destroy', $child->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Delete {{ $child->label }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Level 3 Sub-Items -->
                        @if($child->children->isNotEmpty())
                            @foreach($child->children as $subChild)
                            <div class="menu-card sub-item-l3" style="margin-top:6px;">
                                <div class="menu-info">
                                    <i class="fas fa-angle-double-right" style="color:#10b981; font-size:1rem; margin-right:4px;"></i>
                                    <div>
                                        <span class="menu-title">{{ $subChild->label }}</span>
                                        <span class="menu-url">{{ $subChild->url }}</span>
                                        <span class="badge-status badge-subitem" style="font-size:0.68rem;">Level 3 Sublink</span>
                                    </div>
                                </div>

                                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                                    <form action="{{ route('admin.navigation.parent', $subChild->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        <select name="parent_id" onchange="this.form.submit()" class="parent-select-inline" title="Move Parent">
                                            <option value="">-- Main Navbar (Top Level) --</option>
                                            @foreach($allMenuItems as $potentialParent)
                                                @if($potentialParent->id != $subChild->id)
                                                    <option value="{{ $potentialParent->id }}" {{ $subChild->parent_id == $potentialParent->id ? 'selected' : '' }}>
                                                        Submenu of: {{ $potentialParent->label }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </form>

                                    <span class="badge-status {{ $subChild->is_active ? 'badge-active' : 'badge-hidden' }}">
                                        {{ $subChild->is_active ? 'Active' : 'Hidden' }}
                                    </span>

                                    <div class="menu-actions">
                                        <form action="{{ route('admin.navigation.move', ['navigation' => $subChild->id, 'direction' => 'up']) }}" method="POST" style="margin:0;">
                                            @csrf
                                            <button type="submit" class="btn-icon" title="Move Up"><i class="fas fa-arrow-up"></i></button>
                                        </form>

                                        <form action="{{ route('admin.navigation.move', ['navigation' => $subChild->id, 'direction' => 'down']) }}" method="POST" style="margin:0;">
                                            @csrf
                                            <button type="submit" class="btn-icon" title="Move Down"><i class="fas fa-arrow-down"></i></button>
                                        </form>

                                        <button type="button" class="btn-icon" title="Edit Level 3 Item" onclick="openEditModal({{ json_encode($subChild) }})">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('admin.navigation.destroy', $subChild->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Delete {{ $subChild->label }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @endforeach
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- EDIT ITEM MODAL -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fas fa-edit" style="color:#2E6BE6;"></i> Edit Menu Item</h4>
            <button type="button" class="btn-icon" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
        </div>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Menu Label <span style="color:#ef4444">*</span></label>
                <input type="text" name="label" id="edit_label" class="form-control" required>
            </div>

            <div class="form-group">
                <label>URL / Path <span style="color:#ef4444">*</span></label>
                <input type="text" name="url" id="edit_url" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Parent Item (Make Dropdown Sub-menu)</label>
                <select name="parent_id" id="edit_parent_id" class="form-control">
                    <option value="">-- Main Navbar (Top Level) --</option>
                    @foreach($allMenuItems as $potentialParent)
                        <option value="{{ $potentialParent->id }}">
                            {{ $potentialParent->parent_id ? '  └── ' : '📁 ' }} {{ $potentialParent->label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Open Target</label>
                <select name="target" id="edit_target" class="form-control">
                    <option value="_self">Same Tab (_self)</option>
                    <option value="_blank">New Tab (_blank)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Display Order</label>
                <input type="number" name="order" id="edit_order" class="form-control" min="1">
            </div>

            <div class="form-group" style="display:flex; align-items:center; gap:8px;">
                <input type="checkbox" name="is_active" id="edit_is_active" value="1" style="width:18px; height:18px;">
                <label for="edit_is_active" style="margin:0; cursor:pointer;">Visible in Header</label>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:24px;">
                <button type="button" class="btn-icon" style="width:auto; padding:10px 18px;" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(item) {
    const form = document.getElementById('editForm');
    form.action = '/admin/navigation/' + item.id;

    document.getElementById('edit_label').value = item.label;
    document.getElementById('edit_url').value = item.url;
    document.getElementById('edit_parent_id').value = item.parent_id || '';
    document.getElementById('edit_target').value = item.target || '_self';
    document.getElementById('edit_order').value = item.order || 1;
    document.getElementById('edit_is_active').checked = Boolean(item.is_active);

    document.getElementById('editModal').classList.add('active');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('active');
}
</script>
@endsection
