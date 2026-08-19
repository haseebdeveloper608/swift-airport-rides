<?php
// app/Http/Controllers/Admin/SettingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'favicon' => 'nullable|image|mimes:png,ico',
        ]);

        // Logo Upload
        if ($request->hasFile('logo')) {
            $logo = time().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/settings'), $logo);
            $setting->logo = 'uploads/settings/'.$logo;
        }

        // Favicon Upload
        if ($request->hasFile('favicon')) {
            $favicon = time().'_favicon.'.$request->favicon->extension();
            $request->favicon->move(public_path('uploads/settings'), $favicon);
            $setting->favicon = 'uploads/settings/'.$favicon;
        }

        $setting->site_name = $request->site_name;
        $setting->header_code = $request->header_code;
        $setting->footer_code = $request->footer_code;
        $setting->google_analytics_id = $request->google_analytics_id;
        $setting->facebook_pixel_id = $request->facebook_pixel_id;
        $setting->copyright_text = $request->copyright_text;

        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->twitter = $request->twitter;
        $setting->linkedin = $request->linkedin;
        $setting->tiktok = $request->tiktok;
        $setting->pinterest = $request->pinterest;
        $setting->quora = $request->quora;
        $setting->company_email   = $request->company_email;
        $setting->company_phone   = $request->company_phone;
        $setting->company_address = $request->company_address;
        $setting->footer_about    = $request->footer_about;

        $setting->save();

        // Update .env file for advanced settings
        $envUpdates = [
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
            'STRIPE_KEY' => $request->STRIPE_KEY,
            'STRIPE_SECRET' => $request->STRIPE_SECRET,
            'STRIPE_WEBHOOK_SECRET' => $request->STRIPE_WEBHOOK_SECRET,
            'GOOGLE_MAPS_API_KEY' => $request->GOOGLE_MAPS_API_KEY,
        ];

        foreach ($envUpdates as $key => $value) {
            if ($value !== null) {
                $this->updateEnv($key, $value);
            }
        }

        return back()->with('success', 'Settings Updated Successfully');
    }

    private function updateEnv($key, $value)
    {
        $path = base_path('.env');

        if (File::exists($path)) {
            $content = File::get($path);
            
            // Check if key exists
            if (str_contains($content, "{$key}=")) {
                // Replace existing value, handling cases with and without quotes
                $content = preg_replace(
                    "/^{$key}=(.*)$/m",
                    "{$key}=\"{$value}\"",
                    $content
                );
            } else {
                // Add new key
                $content .= "\n{$key}=\"{$value}\"";
            }

            File::put($path, $content);
        }
    }
}