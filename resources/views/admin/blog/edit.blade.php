@extends('admin.layout.app')

@section('title', 'Edit Blog Post')
@section('page_title', 'Edit Article')
@section('page_subtitle', 'Update your blog post content and SEO.')

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

    /* Main Container */
    .form-container {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 1.75rem;
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
        margin-left: 0.25rem;
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
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        font-size: 0.9rem;
        background: white;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1);
    }

    /* Row Layout */
    .row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 0;
    }

    /* Image Upload Section */
    .current-image {
        margin-bottom: 1rem;
        padding: 1rem;
        background: var(--light);
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .current-image-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        margin-bottom: 0.5rem;
        display: block;
    }

    .current-image-wrapper {
        position: relative;
        display: inline-block;
    }

    .current-image-wrapper img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .image-upload-wrapper {
        border: 2px dashed var(--border);
        border-radius: 16px;
        padding: 1rem;
        background: var(--light);
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
        margin-top: 1rem;
    }

    .image-upload-wrapper:hover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .image-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-align: center;
        padding: 1rem;
    }

    .image-upload-label i {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .image-upload-label span {
        color: var(--gray);
        font-size: 0.875rem;
    }

    .image-upload-label small {
        color: #94a3b8;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }

    .image-preview {
        margin-top: 1rem;
        width: 100%;
        max-height: 250px;
        background: #f1f5f9;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        display: none;
    }

    .image-preview.active {
        display: block;
    }

    .image-preview img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .image-preview .remove-image {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.7);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .image-preview .remove-image:hover {
        background: var(--danger);
    }

    /* Status Badge Styling */
    .status-select select {
        cursor: pointer;
    }

    select option[value="published"] {
        color: var(--success);
    }

    select option[value="draft"] {
        color: var(--warning);
    }

    /* TinyMCE Customization */
    .tox-tinymce {
        border-radius: 12px !important;
        border: 1.5px solid var(--border) !important;
    }

    .tox-tinymce:focus-within {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(46, 107, 230, 0.1) !important;
    }

    /* SEO Card */
    .seo-card {
        background: linear-gradient(135deg, var(--light) 0%, white 100%);
        border-radius: 20px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        margin: 2rem 0 1rem;
        transition: all 0.2s;
    }

    .seo-card:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .seo-card h5 {
        margin-bottom: 1.5rem;
        color: var(--dark);
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .seo-card h5 i {
        color: var(--primary);
        font-size: 1.2rem;
    }

    /* Character Counter */
    .char-counter {
        font-size: 0.7rem;
        color: var(--gray);
        margin-top: 0.25rem;
        text-align: right;
    }

    .char-counter.warning {
        color: var(--warning);
    }

    .char-counter.danger {
        color: var(--danger);
    }

    /* Action Buttons */
    .form-actions {
        margin-top: 2rem;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(46, 107, 230, 0.3);
    }

    .btn-secondary {
        background: white;
        color: var(--gray);
        padding: 0.75rem 2rem;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .btn-secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-light);
    }

    /* Error Messages */
    .error-message {
        color: var(--danger);
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .error-message i {
        font-size: 0.7rem;
    }

    input.is-invalid,
    select.is-invalid,
    textarea.is-invalid {
        border-color: var(--danger) !important;
    }

    /* Slug Preview */
    .slug-preview {
        background: var(--light);
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid var(--border);
    }

    .slug-preview i {
        color: var(--primary);
    }

    .slug-preview span {
        color: var(--dark);
        font-family: monospace;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
        
        .row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        
        .form-actions {
            flex-direction: column-reverse;
        }
        
        .btn-primary,
        .btn-secondary {
            justify-content: center;
            width: 100%;
        }
    }

    /* Loading State */
    .btn-primary.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-primary.loading i {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Tooltip */
    .info-tooltip {
        display: inline-block;
        margin-left: 0.5rem;
        color: var(--gray);
        cursor: help;
        font-size: 0.8rem;
    }

    .info-tooltip:hover {
        color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Title <span class="required">*</span></label>
                    <input type="text" name="title" id="blogTitle" placeholder="Enter your captivating post title" required value="{{ old('title', $blog->title) }}">
                    @error('title')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Slug (URL) <span class="required">*</span></label>
                    <input type="text" name="slug" id="blogSlug" placeholder="enter-your-post-url-slug" required value="{{ old('slug', $blog->slug) }}">
                    <div class="slug-preview">
                        <i class="fas fa-link"></i>
                        <span>{{ url('/blog') }}/</span>
                        <span id="slugValue">{{ old('slug', $blog->slug) }}</span>
                    </div>
                    @error('slug')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="status-select">
                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>📄 Draft</option>
                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>✅ Published</option>
                    </select>
                    @error('status')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Featured Image</label>
            
            @if($blog->image)
            <div class="current-image">
                <div class="current-image-label">Current Image:</div>
                <div class="current-image-wrapper">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                </div>
            </div>
            @endif
            
            <div class="image-upload-wrapper" onclick="document.getElementById('imageInput').click()">
                <div class="image-upload-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Click to upload new image</span>
                    <small>PNG, JPG, JPEG up to 5MB (leave empty to keep current)</small>
                </div>
            </div>
            <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)" style="display: none;">
            
            <div class="image-preview" id="imagePreview">
                <img id="previewImg" src="">
                <button type="button" class="remove-image" onclick="removeImage()">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
            @error('image')
                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Content <span class="required">*</span></label>
            <textarea name="content" id="editor">{{ old('content', $blog->content) }}</textarea>
            @error('content')
                <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="seo-card">
            <h5>
                <i class="fas fa-chart-line"></i>
                SEO Settings
                <span class="info-tooltip" title="Optimize your post for search engines">
                    <i class="fas fa-question-circle"></i>
                </span>
            </h5>
            
            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="meta_title" id="metaTitle" placeholder="SEO Title (60-70 characters recommended)" value="{{ old('meta_title', $blog->meta_title) }}" maxlength="70">
                <div class="char-counter" id="metaTitleCounter">
                    <span id="metaTitleLength">{{ strlen(old('meta_title', $blog->meta_title)) }}</span>/70 characters
                </div>
                @error('meta_title')
                    <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="meta_description" id="metaDescription" rows="3" placeholder="Brief summary for search engines (150-160 characters recommended)" maxlength="160">{{ old('meta_description', $blog->meta_description) }}</textarea>
                <div class="char-counter" id="metaDescCounter">
                    <span id="metaDescLength">{{ strlen(old('meta_description', $blog->meta_description)) }}</span>/160 characters
                </div>
                @error('meta_description')
                    <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-top: 1.5rem; margin-bottom: 0;">
                <label><i class="fas fa-code"></i> Schema Markup (JSON-LD)</label>
                <textarea name="schema_markup" id="schemaMarkup" rows="4" style="font-family: monospace; font-size: 0.85rem;" placeholder='<script type="application/ld+json">
{
  "&#64;context": "https://schema.org",
  "&#64;type": "BlogPosting",
  "headline": "Post Title"
}
</script>'>{{ old('schema_markup', $blog->schema_markup) }}</textarea>
                <small style="color: #64748b; margin-top: 4px; display: block;">Paste valid JSON-LD schema markup code here. It will be rendered in the header of the public blog page.</small>
                @error('schema_markup')
                    <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.blogs.index') }}" class="btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
            <button type="submit" class="btn-primary" id="submitBtn">
                <i class="fas fa-save"></i> Update Blog Post
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- TinyMCE CDN with API key from env -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#editor',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | table | link image media | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px } table { width:100% !important; max-width:100%; border-collapse:collapse; } th, td { padding:8px 12px; border:1px solid #e2e8f0; }',
        table_responsive_width: true,
        branding: false,
        promotion: false,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            if (meta.filetype === 'image') {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name, alt: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            }
        },
        
        // Setup callback to get content for validation
        setup: function(editor) {
            window.tinymceEditor = editor;
        }
    });

    // Auto-generate slug from title
    const titleInput = document.getElementById('blogTitle');
    const slugInput = document.getElementById('blogSlug');
    const slugValue = document.getElementById('slugValue');

    titleInput.addEventListener('input', function() {
        const title = this.value;
        let slug = title.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        
        // Only auto-generate if slug hasn't been manually edited
        if (!slugInput.hasAttribute('data-manual')) {
            slugInput.value = slug;
            slugValue.textContent = slug || 'your-post-slug';
        }
    });

    // Manual slug edit - mark as manually edited
    slugInput.addEventListener('input', function() {
        let slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        
        this.value = slug;
        slugValue.textContent = slug || 'your-post-slug';
        this.setAttribute('data-manual', 'true');
    });

    // Image preview
    function previewImage(input) {
        const previewContainer = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                input.value = '';
                return;
            }
            
            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please upload an image file (PNG, JPG, JPEG)');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.add('active');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        imageInput.value = '';
        previewImg.src = '';
        previewContainer.classList.remove('active');
    }

    // Character counters for SEO fields
    const metaTitle = document.getElementById('metaTitle');
    const metaDesc = document.getElementById('metaDescription');
    const metaTitleLength = document.getElementById('metaTitleLength');
    const metaDescLength = document.getElementById('metaDescLength');
    const metaTitleCounter = document.getElementById('metaTitleCounter');
    const metaDescCounter = document.getElementById('metaDescCounter');

    function updateCharCounter(input, counterElement, counterContainer, maxLength) {
        const length = input.value.length;
        counterElement.textContent = length;
        
        if (length > maxLength) {
            counterContainer.classList.add('danger');
            counterContainer.classList.remove('warning');
        } else if (length > maxLength * 0.9) {
            counterContainer.classList.add('warning');
            counterContainer.classList.remove('danger');
        } else {
            counterContainer.classList.remove('warning', 'danger');
        }
    }

    if (metaTitle) {
        metaTitle.addEventListener('input', () => updateCharCounter(metaTitle, metaTitleLength, metaTitleCounter, 70));
    }

    if (metaDesc) {
        metaDesc.addEventListener('input', () => updateCharCounter(metaDesc, metaDescLength, metaDescCounter, 160));
    }

    // Form validation before submit
    document.getElementById('blogForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim();
        
        // Get TinyMCE content
        let content = '';
        if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
            content = tinymce.activeEditor.getContent().trim();
        } else {
            content = document.querySelector('#editor').value.trim();
        }
        
        if (!title) {
            e.preventDefault();
            alert('Please enter a blog post title');
            titleInput.focus();
            return;
        }
        
        if (!slug) {
            e.preventDefault();
            alert('Please enter a valid slug URL');
            slugInput.focus();
            return;
        }
        
        if (!content || content === '<p><br></p>' || content === '') {
            e.preventDefault();
            alert('Please add content to your blog post');
            return;
        }
        
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Updating...';
    });
</script>
@endsection