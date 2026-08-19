<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use App\Models\Page;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index()
    {
        NavigationItem::seedDefaultIfEmpty();

        $menuTree = NavigationItem::whereNull('parent_id')
            ->with(['children' => function ($q) {
                $q->orderBy('order', 'asc')->with(['children' => function ($q2) {
                    $q2->orderBy('order', 'asc');
                }]);
            }])
            ->orderBy('order', 'asc')
            ->get();

        $allMenuItems = NavigationItem::with('parent')->orderBy('order', 'asc')->get();
        $pages = Page::orderBy('name', 'asc')->get();

        return view('admin.navigation.index', compact('menuTree', 'allMenuItems', 'pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'target' => 'nullable|in:_self,_blank',
        ]);

        $maxOrder = NavigationItem::where('parent_id', $request->parent_id ?: null)->max('order') ?? 0;

        NavigationItem::create([
            'parent_id' => $request->parent_id ?: null,
            'label' => $request->label,
            'url' => $request->url,
            'target' => $request->target ?: '_self',
            'order' => $maxOrder + 1,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.navigation.index')->with('success', 'Navigation menu item added successfully!');
    }

    public function update(Request $request, NavigationItem $navigation)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'target' => 'nullable|in:_self,_blank',
            'order' => 'nullable|integer',
        ]);

        if ($request->parent_id == $navigation->id) {
            return back()->with('error', 'A menu item cannot be its own parent.');
        }

        $navigation->update([
            'parent_id' => $request->parent_id ?: null,
            'label' => $request->label,
            'url' => $request->url,
            'target' => $request->target ?: '_self',
            'order' => $request->filled('order') ? (int)$request->order : $navigation->order,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.navigation.index')->with('success', 'Navigation menu item updated successfully!');
    }

    public function updateParent(Request $request, NavigationItem $navigation)
    {
        $parentId = $request->parent_id ?: null;

        if ($parentId == $navigation->id) {
            return back()->with('error', 'A menu item cannot be its own parent.');
        }

        // Prevent setting a child item as parent (circular reference)
        $childIds = $navigation->children->pluck('id')->toArray();
        if (in_array($parentId, $childIds)) {
            return back()->with('error', 'Cannot assign a sub-menu item as a parent.');
        }

        $maxOrder = NavigationItem::where('parent_id', $parentId)->max('order') ?? 0;

        $navigation->update([
            'parent_id' => $parentId,
            'order' => $maxOrder + 1,
        ]);

        return redirect()->route('admin.navigation.index')->with('success', '"' . $navigation->label . '" hierarchy updated successfully!');
    }

    public function destroy(NavigationItem $navigation)
    {
        $navigation->delete();

        return redirect()->route('admin.navigation.index')->with('success', 'Navigation menu item deleted successfully!');
    }

    public function move(Request $request, NavigationItem $navigation, $direction)
    {
        $currentOrder = $navigation->order;

        if ($direction === 'up') {
            $swapWith = NavigationItem::where('parent_id', $navigation->parent_id)
                ->where('order', '<', $currentOrder)
                ->orderBy('order', 'desc')
                ->first();
        } else {
            $swapWith = NavigationItem::where('parent_id', $navigation->parent_id)
                ->where('order', '>', $currentOrder)
                ->orderBy('order', 'asc')
                ->first();
        }

        if ($swapWith) {
            $navigation->update(['order' => $swapWith->order]);
            $swapWith->update(['order' => $currentOrder]);
        }

        return redirect()->route('admin.navigation.index')->with('success', 'Menu order updated.');
    }
}
