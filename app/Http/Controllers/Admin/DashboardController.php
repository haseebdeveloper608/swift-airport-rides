<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Car;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Pages;
use App\Models\about;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for stats cards
        $totalOrders = Order::count();
        $totalCars = Car::count();
        $totalPages = Pages::count();
        $totalBlogs = Blog::count();
        $totalContactMessages = ContactMessage::count();

        // Get recent orders
        $recentOrders = Order::latest()->take(5)->get();

        // Get recent blogs
        $recentBlogs = Blog::latest()->take(5)->get();

        // Get recent contact messages
        $recentMessages = ContactMessage::latest()->take(5)->get();

        // Get order statistics
        $todayOrders = Order::whereDate('created_at', today())->count();
        $thisMonthOrders = Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Get total revenue (if price column exists)
        $totalRevenue = 0;
        try {
            $totalRevenue = Order::sum('total_price') ?? 0;
        } catch (\Exception $e) {
            // Handle if column doesn't exist
        }

        // Get contact message status counts
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        // Get about page status
        $aboutPageExists = about::exists();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalCars',
            'totalPages',
            'totalBlogs',
            'totalContactMessages',
            'recentOrders',
            'recentBlogs',
            'recentMessages',
            'todayOrders',
            'thisMonthOrders',
            'totalRevenue',
            'unreadMessages',
            'aboutPageExists'
        ));
    }
}
