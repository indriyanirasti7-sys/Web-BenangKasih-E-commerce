{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page-title', 'Galeri Foto 🖼')

@section('admin-content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Upload Form --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-fit">
        <h3 class="font-serif font-bold text-gray-700 text-lg mb-5">Upload Foto</h3>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto <span class="text-gray-400">(bisa multiple)</span></label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-[#C4704F] transition-colors cursor-pointer" onclick="document.getElementById('galleryInput').click()">
                    <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-sm text-gray-400">Klik atau drag foto di sini</p>
                    <p class="text-xs text-gray-300 mt-1">JPG, PNG, WebP max 3MB</p>
                </div>
                <input type="file" id="galleryInput" name="images[]" multiple accept="image/*" required class="hidden"
                       onchange="previewGallery(this)">
                <div id="galleryPreviewWrap" class="flex gap-2 flex-wrap mt-2 hidden"></div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Produk Terkait <span class="text-gray-400">(opsional)</span></label>
                <select name="product_id" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none">
                    <option value="">-- Tidak terkait produk --</option>
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Caption</label>
                <input type="text" name="caption" placeholder="Deskripsi singkat foto..."
                       class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none">
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 rounded accent-[#C4704F]">
                <span class="text-sm text-gray-700">Tampilkan sebagai foto unggulan</span>
            </label>
            <button class="w-full bg-[#C4704F] hover:bg-[#A85A3A] text-white font-semibold py-2.5 rounded-xl transition-colors">
                Upload Foto
            </button>
        </form>
    </div>

    {{-- Gallery Grid --}}
    <div class="lg:col-span-2">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @forelse($galleries as $g)
            <div class="relative group rounded-2xl overflow-hidden bg-gray-100 aspect-square">
                <img src="{{ $g->image_url }}" alt="{{ $g->alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between p-3">
                    <div class="flex justify-end">
                        <form action="{{ route('admin.gallery.destroy', $g) }}" method="POST"
                              onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center text-white hover:bg-red-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div>
                        @if($g->caption)<p class="text-white text-xs font-medium line-clamp-2">{{ $g->caption }}</p>@endif
                        @if($g->product)<p class="text-white/70 text-xs">{{ $g->product->name }}</p>@endif
                    </div>
                </div>
                @if($g->is_featured)
                <div class="absolute top-2 left-2 bg-[#C4704F] text-white text-xs px-2 py-0.5 rounded-full">★</div>
                @endif
            </div>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Belum ada foto di galeri
            </div>
            @endforelse
        </div>
        <div class="mt-6">{{ $galleries->links() }}</div>
    </div>
</div>

<script>
function previewGallery(input) {
    const wrap = document.getElementById('galleryPreviewWrap');
    wrap.innerHTML = '';
    wrap.classList.remove('hidden');
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-16 h-16 object-cover rounded-xl border border-gray-200';
            wrap.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endsection