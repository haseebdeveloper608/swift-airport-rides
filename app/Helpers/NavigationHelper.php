<?php

namespace App\Helpers;

use App\Models\NavigationItem;
use Illuminate\Support\Facades\Request;

class NavigationHelper
{
    /**
     * Get active top-level navigation items with children.
     */
    public static function getTree()
    {
        try {
            return NavigationItem::getTree();
        } catch (\Exception $e) {
            return collect();
        }
    }

    /**
     * Determine if a menu URL matches the current request URL.
     */
    public static function isActive($url)
    {
        if (empty($url)) {
            return false;
        }

        $currentPath = trim(Request::path(), '/');
        $itemPath = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');

        if ($itemPath === '' && $currentPath === '') {
            return true;
        }

        if ($itemPath !== '' && $currentPath === $itemPath) {
            return true;
        }

        return false;
    }
}
