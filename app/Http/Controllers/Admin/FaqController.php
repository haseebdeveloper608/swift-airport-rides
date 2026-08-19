<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $faqs = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $categories = Faq::select('category')->distinct()->pluck('category');

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $existingCategories = Faq::select('category')->distinct()->pluck('category');
        return view('admin.faqs.create', compact('existingCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->is_active : true;

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ item created successfully!');
    }

    public function edit(Faq $faq)
    {
        $existingCategories = Faq::select('category')->distinct()->pluck('category');
        return view('admin.faqs.edit', compact('faq', 'existingCategories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? (bool) $request->is_active : false;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ item updated successfully!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ item deleted successfully!');
    }

    public function toggleStatus(Faq $faq)
    {
        $faq->is_active = !$faq->is_active;
        $faq->save();

        return redirect()->back()->with('success', 'FAQ status updated successfully!');
    }
}
