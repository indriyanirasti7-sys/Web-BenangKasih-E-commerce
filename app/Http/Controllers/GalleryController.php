<?php
// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries   = Gallery::with('product.category')
                              ->orderBy('is_featured', 'desc')
                              ->orderBy('sort_order')
                              ->paginate(24);
        $featured    = Gallery::with('product')
                              ->where('is_featured', true)
                              ->take(6)
                              ->get();
        $categories  = Category::withCount('activeProducts')->get();

        return view('public.gallery', compact('galleries', 'featured', 'categories'));
    }
}