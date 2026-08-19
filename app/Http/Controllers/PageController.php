<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Car;
use App\Models\Pages as Homepage;
use App\Models\about;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutShow()
    {
        $aboutPage = about::first();
        return view('about', compact('aboutPage'));
    }

    public function show(Request $request, $slug)
    {
        $homepage = Homepage::where('slug', $slug)->firstOrFail();

        $cars = Car::all()->map(function ($car) {
            $image = $car->image ?: null;

            if ($image && !str_starts_with($image, 'http://') && !str_starts_with($image, 'https://')) {
                $image = asset('storage/' . ltrim($image, '/'));
            }

            return [
                'name' => $car->name,
                'tag' => $car->destination ?? '',
                'seats' => $car->seats ?? 4,
                'bags' => $car->bags ?? 2,
                'desc' => $car->description ?? '',
                'features' => $car->features ?? [],
                'image' => $image ?: 'https://pngimg.com/uploads/mercedes/mercedes_PNG80190.png',
                'calculated_price' => $car->calculated_price ?? $car->price ?? $car->base_price ?? 0,
            ];
        });

        $blogs = Blog::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', [
            'fleetCards' => $cars,
            'blogs' => $blogs,
            'homepage' => $homepage,
        ]);
    }
}
