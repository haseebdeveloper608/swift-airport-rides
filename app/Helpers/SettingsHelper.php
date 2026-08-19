<?php
// app/Helpers/SettingsHelper.php

use App\Models\Setting;

class SettingsHelper
{
    public static function get($key, $default = null)
    {
        static $settings = null;

        if ($settings === null) {
            $settings = Setting::first()?->toArray() ?? [];
        }

        return $settings[$key] ?? $default;
    }
    
    public static function getSocialLinks()
    {
        return [
            'facebook' => self::get('facebook'),
            'instagram' => self::get('instagram'),
            'youtube' => self::get('youtube'),
            'linkedin' => self::get('linkedin'),
        ];
    }
    
    public static function getAnalytics()
    {
        return [
            'google_analytics_id' => self::get('google_analytics_id'),
            'facebook_pixel_id' => self::get('facebook_pixel_id'),
        ];
    }
    
    public static function getContactInfo()
    {
        return [
            'email' => self::get('company_email'),
            'phone' => self::get('company_phone'),
            'address' => self::get('company_address'),
            'copyright' => self::get('copyright_text'),
            'footer_about' => self::get('footer_about'),
        ];
    }
}