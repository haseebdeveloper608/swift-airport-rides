<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::latest()->get();
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'mileage_pricing' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $validated['image'] = $path;
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $concessions = \App\Models\ConcessionCharge::where('car_id', $car->id)->get();
        return view('admin.cars.show', compact('car', 'concessions'));
    }

    /**
     * Show pricing editor for a specific car (separate route).
     */
    public function editPricing(Car $car)
    {
        $concessions = \App\Models\ConcessionCharge::where('car_id', $car->id)->get();
        return view('admin.cars.show', compact('car', 'concessions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'mileage_pricing' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $validated['image'] = $path;
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Vehicle deleted successfully.');
    }
}
