<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    /**
     * Fetch bookings via AJAX
     */
    public function ajaxList(Request $request)
    {
        $query = Order::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%")
                    ->orWhere('customer_email', 'like', "%$search%")
                    ->orWhere('customer_phone', 'like', "%$search%")
                    ->orWhere('pickup', 'like', "%$search%")
                    ->orWhere('dropoff', 'like', "%$search%");
            });
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate
        $perPage = $request->get('per_page', 15);
        $bookings = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $bookings->items(),
            'pagination' => [
                'current_page' => $bookings->currentPage(),
                'per_page' => $bookings->perPage(),
                'total' => $bookings->total(),
                'last_page' => $bookings->lastPage(),
                'from' => $bookings->firstItem(),
                'to' => $bookings->lastItem(),
            ]
        ]);
    }

    /**
     * Show a specific booking
     */
    public function show(Order $order)
    {
        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    /**
     * Delete a booking
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully'
        ]);
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string'
        ]);

        $order->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $order
        ]);
    }
}
