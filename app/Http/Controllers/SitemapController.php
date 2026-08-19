<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Pages;
use App\Models\about;

class SitemapController extends Controller
{
    public function index()
    {
        // 1. Static main pages
        $staticUrls = [
            [
                'loc' => route('home'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('about'),
                'lastmod' => optional(about::first())->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('contact'),
                'lastmod' => now()->startOfMonth()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('faqs'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('book'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('privacy'),
                'lastmod' => now()->startOfYear()->toAtomString(),
                'changefreq' => 'yearly',
                'priority' => '0.5',
            ],
            [
                'loc' => route('terms'),
                'lastmod' => now()->startOfYear()->toAtomString(),
                'changefreq' => 'yearly',
                'priority' => '0.5',
            ],
            [
                'loc' => route('blog.index'),
                'lastmod' => optional(Blog::where('status', 'published')->latest('updated_at')->first())->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
        ];

        // 2. Published Blog Posts
        $blogs = Blog::where('status', 'published')
            ->whereNotNull('slug')
            ->get();

        $blogUrls = $blogs->map(function ($blog) {
            return [
                'loc' => route('blog.show', $blog->slug),
                'lastmod' => $blog->updated_at ? $blog->updated_at->toAtomString() : now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        });

        // 3. Dynamic CMS Landing Pages
        $pages = Pages::whereNotNull('slug')
            ->where('slug', '!=', '')
            ->get();

        $reservedSlugs = ['home', 'about-us', 'contact-us', 'privacy-policy', 'terms-and-conditions', 'book', 'blog', 'search', 'login', 'admin'];

        $cmsUrls = $pages->reject(function ($page) use ($reservedSlugs) {
            return in_array(strtolower(trim($page->slug)), $reservedSlugs);
        })->map(function ($page) {
            return [
                'loc' => url($page->slug),
                'lastmod' => $page->updated_at ? $page->updated_at->toAtomString() : now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        });

        $urls = collect($staticUrls)->merge($cmsUrls)->merge($blogUrls)->unique('loc');

        $content = view('sitemap', compact('urls'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
