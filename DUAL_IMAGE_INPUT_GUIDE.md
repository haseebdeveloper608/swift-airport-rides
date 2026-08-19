# Dual Image Input System (URL + Upload)

## Overview
The admin pages now support **dual image input** - users can either paste an image URL or upload a file directly. The system automatically handles both methods.

## ✅ Implemented Features

### 1. About Page (`resources/views/admin/pages/inner/about.blade.php`)
Updated image fields now have dual input:
- **Hero Background Image** - URL or upload
- **Story Main Image** - URL or upload  
- **Story Overlap Image** - URL or upload
- **Mission Background Image** - URL or upload

Each field has:
- Left side: **URL input** with live preview
- Right side: **Upload zone** with drag & drop support

### 2. JavaScript Functions Added
```javascript
// Preview image from URL
hocmsPreviewImage(imageSrc, previewElementId)

// Handle file upload with validation
hocmsHandleFileUpload(input, previewElementId)

// Handle drag & drop
hocmsHandleDrop(event, inputId)
```

### 3. File Validation
- **Maximum size**: 5MB
- **Allowed types**: JPG, PNG, WebP
- **Real-time preview** in both modes

---

## 🔧 Backend Setup Required

### Step 1: Update Controller
Your controller needs to handle both URL and uploaded file inputs.

**Example: `app/Http/Controllers/Admin/PageController.php`**

```php
// In your update() or store() method:

public function update(Request $request, $id)
{
    // Process image fields - prioritize uploaded files over URLs
    $imageFields = [
        'hero_background_image',
        'about_image',
        'story_main_image',
        'story_overlap_image',
        'mission_background_image',
    ];

    $data = $request->except($imageFields);

    foreach ($imageFields as $field) {
        $fileField = $field . '_file';
        
        // Check if file was uploaded
        if ($request->hasFile($fileField)) {
            $file = $request->file($fileField);
            
            // Store file and get path
            $path = $file->store('images', 'public');
            $data[$field] = '/storage/' . $path;
        } else {
            // Use URL if provided
            $data[$field] = $request->input($field);
        }
    }

    // Save to database
    $model->update($data);
    
    return response()->json(['success' => true, 'message' => 'Saved successfully']);
}
```

### Step 2: Setup File Storage
```bash
# Create storage symlink (if not already done)
php artisan storage:link

# Ensure directory permissions
chmod 755 storage/app/public
```

### Step 3: Update Model Fillable
Make sure your model includes all image fields:

```php
// app/Models/About.php or app/Models/Page.php

protected $fillable = [
    'hero_background_image',
    'about_image',
    'story_main_image',
    'story_overlap_image',
    'mission_background_image',
    // ... other fields
];
```

---

## 📝 Using the Dual Input in Your Forms

### HTML Structure
```html
<div class="hocms-field-group">
    <label class="hocms-field-label">Image Title</label>
    <div class="hocms-image-dual-container">
        
        <!-- URL Input Side -->
        <div class="hocms-image-input-section">
            <h5><i class="fas fa-link"></i> Enter Image Link</h5>
            <div class="hocms-image-input-url">
                <input type="text" class="hocms-field-input" 
                       name="field_name"
                       placeholder="https://example.com/image.jpg"
                       value="{{ $model->field_name ?? '' }}"
                       data-preview-id="fieldPreview"
                       onchange="hocmsPreviewImage(this.value, 'fieldPreview')">
                <p class="hocms-field-hint">Full URL to the image</p>
                <div class="hocms-image-preview-box" id="fieldPreview">
                    <img src="{{ $model->field_name ?? '' }}" alt="Preview" 
                         style="display:{{ $model->field_name ? 'block' : 'none' }}">
                    <span style="display:{{ $model->field_name ? 'none' : 'block' }}">Image preview</span>
                </div>
            </div>
        </div>

        <!-- File Upload Side -->
        <div class="hocms-image-input-section">
            <h5><i class="fas fa-cloud-upload-alt"></i> Or Upload Image</h5>
            <label class="hocms-file-drop" 
                   ondrop="hocmsHandleDrop(event, 'fieldUpload')"
                   ondragover="event.preventDefault()"
                   ondragleave="event.preventDefault()">
                <div class="hocms-file-drop-icon"><i class="fas fa-image"></i></div>
                <div class="hocms-file-drop-text">Click or drag image here</div>
                <div class="hocms-file-drop-subtext">PNG, JPG, WebP (Max 5MB)</div>
                <input type="file" id="fieldUpload" 
                       name="field_name_file" 
                       accept="image/*"
                       onchange="hocmsHandleFileUpload(this, 'fieldPreview')">
            </label>
        </div>
    </div>
</div>
```

---

## 🎯 How It Works

1. **User enters a URL** → Image preview updates immediately
2. **User uploads a file** → File is validated and previewed
3. **Form is submitted** → Both URL and file data are sent
4. **Controller decides**: 
   - If file was uploaded → Use the uploaded file
   - Else if URL provided → Use the URL
   - Else → Keep existing image

---

## 🚀 Extending to More Fields

To add dual image input to any field:

1. **Wrap field in** `hocms-image-dual-container`
2. **Add two sub-sections**:
   - Left: URL input + preview
   - Right: File upload zone
3. **Add corresponding `_file` field** in form
4. **Update controller** to check for uploaded file first

---

## 📋 Checklist for Homepage

Apply to [resources/views/admin/pages/inner/home.blade.php]:
- [ ] Hero Background Image
- [ ] About Image
- [ ] Story Images
- [ ] Coverage Background Image
- [ ] Airport Images (in repeater)
- [ ] Fleet Vehicle Images (in repeater)

---

## ❌ Troubleshooting

**Images not uploading?**
- Check `storage/app/public` permissions
- Run `php artisan storage:link`
- Verify `FILESYSTEM_DISK=public` in `.env`

**Preview not showing?**
- Check browser console for errors
- Verify CORS if URL is external
- Ensure image URL is accessible

**File size error?**
- Increase PHP `upload_max_filesize` in `php.ini`
- Check Laravel `config/app.php` limits
- Validate in JS (currently 5MB)

---

## 🎨 CSS Classes

| Class | Purpose |
|-------|---------|
| `.hocms-image-dual-container` | Grid layout for both inputs |
| `.hocms-image-input-section` | Individual input section |
| `.hocms-image-input-url` | URL input wrapper |
| `.hocms-image-preview-box` | Image preview area |
| `.hocms-file-drop` | Drag & drop zone |
| `.hocms-file-drop-text` | Upload instruction text |

---

## 📞 Support

If you need to extend this to more fields or customize behavior, refer to the JavaScript functions in the `@section('scripts')` of your Blade files.
