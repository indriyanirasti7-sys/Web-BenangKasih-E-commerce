<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['activeProducts'])->orderBy('sort_order')->get();

        $query = Product::with('category')->active();

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $products  = $query->orderBy('is_featured', 'desc')->orderBy('sort_order')->paginate(12)->withQueryString();
        $featured  = Product::with('category')->active()->featured()->latest()->take(3)->get();

        return view('public.index', compact('categories', 'products', 'featured'));
    }

    public function show(string $slug)
    {
        $product  = Product::with('category')->active()->where('slug', $slug)->firstOrFail();
        $related  = Product::with('category')
            ->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('public.show', compact('product', 'related'));
    }
}