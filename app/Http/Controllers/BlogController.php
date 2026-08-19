<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')
            ->latest('created_at')
            ->paginate(6);

        return view('blog.index', compact('blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('blog.show', compact('blog'));
    }
}
