<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverApplication;
use Illuminate\Http\Request;

class DriverApplicationController extends Controller
{
    public function index()
    {
        $applications = DriverApplication::latest()->paginate(15);

        return view('admin.driver-applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, DriverApplication $driverApplication)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
        ]);

        $driverApplication->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.driver-applications.index')
            ->with('success', 'Application status updated to ' . ucfirst($request->status));
    }

    public function destroy(DriverApplication $driverApplication)
    {
        $driverApplication->delete();

        return redirect()->route('admin.driver-applications.index')
            ->with('success', 'Driver application deleted successfully.');
    }
}
