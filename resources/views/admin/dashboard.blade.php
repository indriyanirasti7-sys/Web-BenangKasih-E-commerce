@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('admin-content')

{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5 mb-8">
    @foreach([
        ['label'=>'Total Produk',  'value'=>$stats['total_products'],   'icon'=>'🧶', 'color'=>'bg-amber-50 border-amber-200',   'text'=>'text-amber-700'],
        ['label'=>'Ready Stock',   'value'=>$stats['ready_stock'],      'icon'=>'✅', 'color'=>'bg-green-50 border-green-200',    'text'=>'text-green-700'],
        ['label'=>'Pre-Order',     'value'=>$stats['pre_order'],        'icon'=>'⏳', 'color'=>'bg-blue-50 border-blue-200',      'text'=>'text-blue-700'],
        ['label'=>'Kategori',      'value'=>$stats['total_categories'], 'icon'=>'🏷️', 'color'=>'bg-purple-50 border-purple-200',  'text'=>'text-purple-700'],
        ['label'=>'Unggulan',      'value'=>$stats['featured'],         'icon'=>'⭐', 'color'=>'bg-yellow-50 border-yellow-200',  'text'=>'text-yellow-700'],
        ['label'=>'Tidak Aktif',   'value'=>$stats['inactive'],         'icon'=>'🚫', 'color'=>'bg-red-50 border-red-200',        'text'=>'text-red-700'],
    ] as $s)
    <div class="bg-white rounded-2xl p-5 shadow-sm border {{ $s['color'] }}">
        <div class="text-2xl mb-2">{{ $s['icon'] }}</div>
        <div class="font-bold text-2xl {{ $s['text'] }}">{{ $s['value'] }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ $s['label'] }}</div>
    </div>
    @endforeach
</div>

{{-- Quick Actions --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('admin.products.create') }}"
       class="bg-gradient-to-br from-[#C4704F] to-[#A85A3A] text-white rounded-2xl p-6 flex items-center gap-4 shadow-lg hover:shadow-xl transition-shadow">
        <span class="text-4xl">➕</span>
        <div>
            <div class="font-bold text-lg">Tambah Produk</div>
            <div class="text-sm opacity-80">Upload foto & detail rajutan baru</div>
        </div>
    </a>
    <a href="{{ route('admin.products') }}"
       class="bg-gradient-to-br from-[#8A9E7A] to-[#6B7F5C] text-white rounded-2xl p-6 flex items-center gap-4 shadow-lg hover:shadow-xl transition-shadow">
        <span class="text-4xl">📋</span>
        <div>
            <div class="font-bold text-lg">Kelola Produk</div>
            <div class="text-sm opacity-80">Edit, hapus, atau update stok</div>
        </div>
    </a>
    <a href="{{ route('admin.categories') }}"
       class="bg-gradient-to-br from-[#8B6355] to-[#6B4A3E] text-white rounded-2xl p-6 flex items-center gap-4 shadow-lg hover:shadow-xl transition-shadow">
        <span class="text-4xl">🏷️</span>
        <div>
            <div class="font-bold text-lg">Kelola Kategori</div>
            <div class="text-sm opacity-80">Tambah atau ubah kategori produk</div>
        </div>
    </a>
</div>

{{-- Recent Products --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-serif font-bold text-gray-800">Produk Terbaru</h2>
        <a href="{{ route('admin.products') }}" class="text-sm text-[#C4704F] hover:underline">Lihat semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Harga</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Stok</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($recent as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-[#F5F0E8] flex-shrink-0">
                                @if($p->image)
                                    <img src="{{ $p->image_url }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xl">{{ $p->category->icon ?? '🧶' }}</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-gray-800">{{ $p->name }}</div>
                                @if($p->is_featured)<span class="text-xs text-amber-600">⭐ Unggulan</span>@endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $p->category->icon }} {{ $p->category->name }}</td>
                    <td class="px-6 py-4 font-semibold text-[#C4704F]">{{ $p->formatted_price }}</td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $p->status === 'ready_stock' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $p->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($p->status === 'ready_stock')
                            <span class="{{ $p->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">
                                {{ $p->stock }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">–</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.products.edit', $p) }}" class="text-[#8A9E7A] hover:text-[#6B7F5C] font-medium">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection