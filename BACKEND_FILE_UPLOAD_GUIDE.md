# Backend File Upload Implementation Guide

## Overview
This guide shows how to update your Laravel controllers to handle file uploads from the dual image input forms.

## Step 1: Ensure Storage Symlink Exists

Run this command in your Laravel project root:

```bash
php artisan storage:link
```

This creates a symlink from `public/storage` → `storage/app/public` so files are publicly accessible.

## Step 2: Create Images Directory

```bash
# Windows (PowerShell)
New-Item -ItemType Directory -Path "storage/app/public/images" -Force

# Or through file explorer: storage/app/public/images/
```

Set permissions:
```bash
chmod 755 storage/app/public/images
```

## Step 3: Update Your Controllers

### Option A: Homepage Settings Controller

If using `app/Http/Controllers/Admin/HomepageController.php`:

```php
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;

class HomepageController extends Controller
{
    /**
     * Update homepage settings with file upload support
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // Image fields that support dual input (URL + upload)
        $imageFields = [
            'hero_background_image',
            'about_image',
            'coverage_map_image',
            'coverage_background_image',
            // Add more as needed
        ];

        // Process each image field
        foreach ($imageFields as $field) {
            $fileField = $field . '_file'; // e.g., hero_background_image_file

            // Check if file was uploaded
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                
                // Validate file
                if (!$file->isValid()) {
                    return response()->json([
                        'success' => false,
                        'message' => "Invalid file for $field"
                    ], 422);
                }

                // Store the file and get path
                $path = $this->storeImage($file, $field);
                $data[$field] = '/storage/' . $path;
            } elseif (isset($data[$field]) && empty($data[$field])) {
                // Empty string means remove/clear the image
                $data[$field] = null;
            }
            // else: if no file uploaded and URL provided, use the URL from $data

            // Remove the file field from data (don't save to DB)
            unset($data[$fileField]);
        }

        // Handle array fields (airports, fleet, etc.) with nested image uploads
        if (isset($data['airports_list']) && is_array($data['airports_list'])) {
            foreach ($data['airports_list'] as $index => $airport) {
                if (isset($airport['image_upload'])) {
                    $file = $request->file("airports_list.$index.image_upload");
                    if ($file && $file->isValid()) {
                        $path = $this->storeImage($file, "airport_$index");
                        $data['airports_list'][$index]['image'] = '/storage/' . $path;
                    }
                    unset($data['airports_list'][$index]['image_upload']);
                }
            }
        }

        // Convert array fields to JSON for storage
        $jsonFields = [
            'hero_benefits', 'services_list', 'airports_list', 
            'coverage_cities', 'fleet_vehicles', 'reviews', 'faqs'
        ];
        
        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = json_encode($data[$field]);
            }
        }

        // Save to database
        $settings = WebsiteSetting::firstOrCreate([]);
        $settings->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Homepage settings updated successfully',
            'data' => $settings
        ]);
    }

    /**
     * Store image file and return relative path
     * 
     * @param UploadedFile $file
     * @param string $field
     * @return string Path relative to storage/app/public
     */
    private function storeImage($file, $field)
    {
        // Generate unique filename
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = sprintf(
            '%s_%s_%s.%s',
            str_slug($field),
            date('Ymd_His'),
            substr(uniqid(), -4),
            $extension
        );

        // Store file
        $path = $file->storeAs('images', $filename, 'public');

        return $path;
    }

    /**
     * Delete an image file
     */
    public function deleteImage(Request $request)
    {
        $imagePath = $request->input('path');
        
        // Security: only allow deleting from images directory
        if (!str_starts_with($imagePath, 'images/')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid path'
            ], 403);
        }

        \Storage::disk('public')->delete($imagePath);

        return response()->json(['success' => true]);
    }
}
```

### Option B: Page-Specific Controller (About Page)

If using separate `app/Http/Controllers/Admin/AboutPageController.php`:

```php
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\About; // or whatever your model is

class AboutPageController extends Controller
{
    /**
     * Update about page settings
     */
    public function update(Request $request, About $about)
    {
        $data = $request->except(['_token', '_method']);

        // Image fields supporting upload
        $imageFields = [
            'hero_background_image',
            'story_main_image',
            'story_overlap_image',
            'mission_background_image'
        ];

        // Process image uploads
        foreach ($imageFields as $field) {
            $fileField = $field . '_file';

            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                if ($file->isValid()) {
                    // Store and get URL
                    $path = $file->storeAs(
                        'images/about',
                        $this->generateFilename($field, $file),
                        'public'
                    );
                    $data[$field] = '/storage/' . $path;
                }
            }

            // Remove file input from data
            unset($data[$fileField]);
        }

        // Handle repeatable items (story pillars, stats, etc.)
        foreach (['story_pillars', 'stats', 'values'] as $repeaterField) {
            if (isset($data[$repeaterField]) && is_array($data[$repeaterField])) {
                $data[$repeaterField] = json_encode($data[$repeaterField]);
            }
        }

        // Update model
        $about->update($data);

        return response()->json([
            'success' => true,
            'message' => 'About page updated successfully'
        ]);
    }

    /**
     * Generate unique filename for uploaded image
     */
    private function generateFilename($fieldName, $file)
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        return sprintf(
            '%s_%s.%s',
            str_slug($fieldName),
            date('Ymd_His'),
            $ext
        );
    }
}
```

### Option C: Generic Handler (Standalone)

If you prefer a dedicated upload handler:

```php
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class ImageUploadController extends Controller
{
    /**
     * Upload image and return URL
     * 
     * @return json { success: bool, url: string, message: string }
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // 5MB
            'field' => 'required|string'
        ]);

        $file = $request->file('image');
        
        $filename = sprintf(
            '%s_%s.%s',
            str_slug($request->input('field')),
            Str::random(8),
            $file->getClientOriginalExtension()
        );

        $path = $file->storeAs('images', $filename, 'public');

        return response()->json([
            'success' => true,
            'url' => '/storage/' . $path,
            'message' => 'Image uploaded successfully'
        ]);
    }

    /**
     * Delete image
     */
    public function delete(Request $request)
    {
        $path = $request->input('path');

        // Security check
        if (!str_starts_with($path, '/storage/images/')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid path'
            ], 403);
        }

        $relativePath = str_replace('/storage/', '', $path);
        Storage::disk('public')->delete($relativePath);

        return response()->json(['success' => true]);
    }
}
```

## Step 4: Update Routes

Add route for file upload (if using standalone controller):

```php
// routes/web.php

Route::middleware('auth')->group(function () {
    Route::post('/admin/upload-image', [ImageUploadController::class, 'store'])->name('image.upload');
    Route::delete('/admin/image/{id}', [ImageUploadController::class, 'delete'])->name('image.delete');
    
    // Or if using existing controllers:
    Route::put('/admin/homepage', [HomepageController::class, 'update'])->name('admin.homepage.update');
    Route::put('/admin/about', [AboutPageController::class, 'update'])->name('admin.about.update');
});
```

## Step 5: Update Model Fillable Attributes

Ensure your models include all image fields:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        // Hero section
        'hero_background_image',
        'hero_title_line1',
        'hero_title_line2',
        'hero_benefits',
        
        // About section
        'about_image',
        'about_badge',
        'about_heading_line1',
        'about_heading_line2',
        
        // Story section
        'story_main_image',
        'story_overlap_image',
        'mission_background_image',
        
        // Coverage section
        'coverage_map_image',
        'coverage_background_image',
        
        // ... other fields
    ];

    protected $casts = [
        'hero_benefits' => 'json',
        'services_list' => 'json',
        'airports_list' => 'json',
        // ... other json fields
    ];
}
```

## Step 6: Handle Old Images Cleanup (Optional)

Add a cleanup method to prevent orphaned files:

```php
/**
 * Delete old image when updating
 */
private function deleteOldImage($field, $oldValue)
{
    if ($oldValue && str_starts_with($oldValue, '/storage/')) {
        $path = str_replace('/storage/', '', $oldValue);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

// Usage in update():
if ($request->hasFile($fileField)) {
    $this->deleteOldImage($field, $about->$field);
    // ... store new file
}
```

## Troubleshooting

### Images not uploading
- Check `storage/app/public/images` exists and is writable
- Verify `php artisan storage:link` was run
- Check PHP `upload_max_filesize` in php.ini (should be >= 5MB)

### URL shows `/storage/` but images not visible
- Run `php artisan storage:link` again
- Check `.env`: `FILESYSTEM_DISK=public`
- Verify `public/storage` is a valid symlink

### Files stored but database not updated
- Check model `$fillable` includes the image field
- Verify JSON fields are cast properly
- Check for validation errors in browser console

### Performance issues with large images
- Add image compression before storage
- Set maximum dimensions in validation
- Use queue for large uploads

## Security Best Practices

1. **Validate file type**
   ```php
   'image' => 'required|mimes:jpeg,png,webp|max:5120'
   ```

2. **Use unique filenames** (prevents overwrites)
   ```php
   $filename = Str::random(40) . '.' . $file->extension();
   ```

3. **Store outside public** (optional, for sensitive files)
   ```php
   $path = $file->store('images', 'private');
   // Access via: Storage::disk('private')->download($path);
   ```

4. **Restrict upload directory**
   ```php
   if (!str_starts_with($path, 'images/')) {
       abort(403);
   }
   ```

5. **Add CSRF protection** (Blade forms handle this automatically)

## Next Steps

1. Choose which controller pattern fits your app structure
2. Add the `storeImage()` method and update logic
3. Test file upload with various image types
4. Monitor `storage/app/public/images/` disk usage
5. Set up cleanup cronjob for orphaned files (optional)

---

**Questions?** Check Laravel documentation:
- Storage: https://laravel.com/docs/11.x/filesystem
- Uploads: https://laravel.com/docs/11.x/requests#uploaded-files
- Validation: https://laravel.com/docs/11.x/validation
