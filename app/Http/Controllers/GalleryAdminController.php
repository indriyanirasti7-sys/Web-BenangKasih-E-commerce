<?php
// app/Http/Controllers/Admin/GalleryAdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('product')->orderBy('sort_order')->paginate(20);
        $products  = Product::active()->orderBy('name')->get();
        return view('admin.gallery.index', compact('galleries', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*'   => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'product_id' => 'nullable|exists:products,id',
            'caption'    => 'nullable|string|max:255',
        ]);

        foreach ($request->file('images') as $file) {
            Gallery::create([
                'image'      => $file->store('gallery', 'public'),
                'product_id' => $request->product_id,
                'caption'    => $request->caption,
                'alt'        => $request->caption ?? 'Foto rajutan handmade',
                'is_featured'=> $request->boolean('is_featured'),
            ]);
        }

        return back()->with('success', count($request->file('images')) . ' foto berhasil diupload!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Foto dihapus.');
    }
}