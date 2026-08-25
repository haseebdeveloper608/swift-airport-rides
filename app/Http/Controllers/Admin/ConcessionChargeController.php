<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConcessionCharge;

class ConcessionChargeController extends Controller
{
    /**
     * Store a newly created concession charge in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('radius') && $request->input('radius') === '') {
            $request->merge(['radius' => 0]);
        }

        $data = $request->validate([
            'car_id' => 'nullable|exists:cars,id',
            'place' => 'required|string|max:255',
            'post_code' => 'nullable|string|max:50',
            'radius' => 'nullable|numeric|min:0',
            'fare_type' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'applies' => 'required|string|in:Pickup,Dropoff,Both',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
        ]);

        $charge = ConcessionCharge::create([
            'car_id' => $data['car_id'] ?? null,
            'place' => $data['place'],
            'post_code' => $data['post_code'] ?? null,
            'radius' => $data['radius'] ?? 0,
            'fare_type' => $data['fare_type'],
            'amount' => $data['amount'],
            'applies' => $data['applies'],
            'lat' => $data['lat'] ?? null,
            'lng' => $data['lng'] ?? null,
        ]);

        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Fare rule saved successfully!',
                'data' => $charge,
            ]);
        }

        return back()->with('success', 'Fare rule saved successfully!');
    }

    /**
     * Remove the specified concession charge.
     */
    public function destroy($id)
    {
        $charge = ConcessionCharge::find($id);
        if (!$charge) {
            return response()->json(['success' => false, 'message' => 'Fare rule not found'], 404);
        }
        $charge->delete();
        return response()->json(['success' => true, 'message' => 'Fare rule deleted successfully!'], 200);
    }
}
