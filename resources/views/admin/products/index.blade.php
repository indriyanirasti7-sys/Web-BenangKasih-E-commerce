@extends('layouts.admin')
@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk 🧶')

@section('admin-content')

{{-- Header Actions --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <form method="GET" class="flex gap-2 flex-1 max-w-lg">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
               class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
        <select name="category" class="border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="status" class="border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none">
            <option value="">Semua Status</option>
            <option value="ready_stock" {{ request('status') === 'ready_stock' ? 'selected' : '' }}>Ready Stock</option>
            <option value="pre_order"   {{ request('status') === 'pre_order'   ? 'selected' : '' }}>Pre-Order</option>
        </select>
        <button class="bg-gray-700 text-white px-4 rounded-xl text-sm hover:bg-gray-800">Filter</button>
    </form>
    <a href="{{ route('admin.products.create') }}"
       class="bg-[#C4704F] hover:bg-[#A85A3A] text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2 transition-colors shadow-sm">
        ➕ Tambah Produk
    </a>
</div>

{{-- Products Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-5 py-3 text-left">Produk</th>
                    <th class="px-5 py-3 text-left">Kategori</th>
                    <th class="px-5 py-3 text-left">Harga</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-left">Stok/Estimasi</th>
                    <th class="px-5 py-3 text-left">Aktif</th>
                    <th class="px-5 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($products as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-14 h-14 rounded-xl overflow-hidden bg-[#F5F0E8] flex-shrink-0 border border-gray-100">
                                @if($p->image)
                                    <img src="{{ $p->image_url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-2xl">{{ $p->category->icon ?? '🧶' }}</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800 max-w-[200px] truncate">{{ $p->name }}</div>
                                @if($p->yarn_type)
                                <div class="text-xs text-gray-400">🪡 {{ $p->yarn_type }}</div>
                                @endif
                                @if($p->is_featured)
                                <span class="inline-block text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full mt-1">⭐ Unggulan</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 text-gray-600 text-sm">
                        {{ $p->category->icon }} {{ $p->category->name }}
                    </td>
                    <td class="px-5 py-4 font-bold text-[#C4704F]">{{ $p->formatted_price }}</td>
                    <td class="px-5 py-4">
                        <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $p->status === 'ready_stock' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $p->status_label }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-gray-600">
                        @if($p->status === 'ready_stock')
                            <span class="{{ $p->stock > 0 ? 'text-green-600 font-semibold' : 'text-red-500 font-semibold' }}">
                                {{ $p->stock }} pcs
                            </span>
                        @else
                            <span class="text-amber-600">⏳ {{ $p->estimated_days ?? '?' }} hari</span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-xs font-medium px-3 py-1 rounded-full {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $p->is_active ? 'Aktif' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('product.show', $p->slug) }}" target="_blank"
                               class="p-2 text-gray-400 hover:text-[#8A9E7A] rounded-lg hover:bg-gray-100 transition-colors" title="Lihat">
                                👁
                            </a>
                            <a href="{{ route('admin.products.edit', $p) }}"
                               class="p-2 text-gray-400 hover:text-[#C4704F] rounded-lg hover:bg-gray-100 transition-colors" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('admin.products.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Hapus produk {{ addslashes($p->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-12 text-center text-gray-400">
                    <div class="text-4xl mb-2">🧶</div>
                    Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-[#C4704F] hover:underline">Tambah sekarang</a>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $products->links() }}
    </div>
</div>
@endsection