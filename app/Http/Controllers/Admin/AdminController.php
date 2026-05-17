<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ─── Dashboard ────────────────────────────────────────────────────────────
    public function dashboard()
    {
        $stats = [
            'total_products'  => Product::count(),
            'ready_stock'     => Product::where('status', 'ready_stock')->count(),
            'pre_order'       => Product::where('status', 'pre_order')->count(),
            'total_categories'=> Category::count(),
            'featured'        => Product::where('is_featured', true)->count(),
            'inactive'        => Product::where('is_active', false)->count(),
        ];
        $recent = Product::with('category')->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recent'));
    }

    // ─── Products CRUD ────────────────────────────────────────────────────────
    public function products(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products   = $query->orderBy('sort_order')->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function createProduct()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'material'       => 'nullable|string',
            'yarn_type'      => 'nullable|string|max:100',
            'yarn_weight'    => 'nullable|string|max:100',
            'price'          => 'required|numeric|min:0',
            'status'         => 'required|in:ready_stock,pre_order',
            'stock'          => 'required|integer|min:0',
            'estimated_days' => 'nullable|integer|min:1',
            'size'           => 'nullable|string|max:255',
            'colors'         => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'sort_order'     => 'integer',
        ]);

        $validated['slug']       = Str::slug($validated['name']);
        $validated['is_featured']= $request->boolean('is_featured');
        $validated['is_active']  = $request->boolean('is_active', true);
        $validated['colors']     = $request->filled('colors')
            ? array_filter(array_map('trim', explode(',', $request->colors)))
            : null;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('products/gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan! 🎉');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'material'       => 'nullable|string',
            'yarn_type'      => 'nullable|string|max:100',
            'yarn_weight'    => 'nullable|string|max:100',
            'price'          => 'required|numeric|min:0',
            'status'         => 'required|in:ready_stock,pre_order',
            'stock'          => 'required|integer|min:0',
            'estimated_days' => 'nullable|integer|min:1',
            'size'           => 'nullable|string|max:255',
            'colors'         => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured'    => 'boolean',
            'is_active'      => 'boolean',
            'sort_order'     => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');
        $validated['colors']      = $request->filled('colors')
            ? array_filter(array_map('trim', explode(',', $request->colors)))
            : null;

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            if ($product->gallery) {
                foreach ($product->gallery as $old) Storage::disk('public')->delete($old);
            }
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('products/gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui! ✨');
    }

    public function destroyProduct(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        if ($product->gallery) {
            foreach ($product->gallery as $img) Storage::disk('public')->delete($img);
        }
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    // ─── Categories CRUD ──────────────────────────────────────────────────────
    public function categories()
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'icon'        => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);
        Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'icon'        => $request->icon,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $category->update([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
    public function customerView()
    {
    // Admin bisa preview tampilan customer
    return redirect()->route('home')->with('admin_preview', true);
    }
}