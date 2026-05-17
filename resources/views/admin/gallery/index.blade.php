@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page-title', 'Galeri Foto 🖼️')

@section('admin-content')

@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 rounded-2xl px-5 py-3 mb-6 text-sm flex items-center gap-2">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ─── FORM UPLOAD ─────────────────────────────────── --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-6">
            <h3 class="font-serif font-bold text-gray-700 text-lg mb-5 flex items-center gap-2">
                <span class="w-7 h-7 bg-[#C4704F]/10 rounded-lg flex items-center justify-center">📤</span>
                Upload Foto
            </h3>

            <form action="{{ route('admin.gallery.store') }}" method="POST"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-3">
                    @foreach($errors->all() as $e)
                    <p class="text-xs text-red-600">• {{ $e }}</p>
                    @endforeach
                </div>
                @endif

                {{-- Drop Zone --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Foto
                        <span class="text-red-500">*</span>
                        <span class="text-gray-400 font-normal">(bisa banyak)</span>
                    </label>

                    <div id="dropZone"
                         class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center
                                cursor-pointer hover:border-[#C4704F] hover:bg-[#FDF8F5] transition-all"
                         onclick="document.getElementById('galleryFileInput').click()"
                         ondragover="event.preventDefault(); this.classList.add('!border-[#C4704F]','!bg-[#FDF8F5]')"
                         ondragleave="this.classList.remove('!border-[#C4704F]','!bg-[#FDF8F5]')"
                         ondrop="handleDrop(event)">

                        <div id="dropPlaceholder">
                            <div class="w-14 h-14 mx-auto mb-3 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-500">Drag & drop foto di sini</p>
                            <p class="text-xs text-gray-400 mt-1">atau klik untuk pilih file</p>
                            <span class="inline-block mt-3 bg-[#C4704F]/10 text-[#C4704F] text-xs font-semibold px-4 py-1.5 rounded-full">
                                Pilih Foto
                            </span>
                            <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP — Maks 3MB</p>
                        </div>

                        {{-- Preview setelah pilih --}}
                        <div id="dropPreview" class="hidden">
                            <div id="previewGrid" class="grid grid-cols-3 gap-2 mb-2"></div>
                            <p id="previewCount" class="text-xs text-[#C4704F] font-semibold"></p>
                            <p class="text-xs text-gray-400 mt-1">Klik untuk ganti/tambah</p>
                        </div>
                    </div>

                    <input type="file" id="galleryFileInput" name="images[]"
                           multiple accept="image/jpeg,image/png,image/webp"
                           class="hidden" onchange="previewFiles(this)">
                </div>

                {{-- Produk Terkait --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Produk Terkait
                        <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <select name="product_id"
                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/25 focus:border-[#C4704F]">
                        <option value="">-- Tidak terkait produk --</option>
                        @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->category->icon ?? '' }} {{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Caption --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Caption</label>
                    <input type="text" name="caption"
                           placeholder="Deskripsi singkat foto..."
                           class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/25 focus:border-[#C4704F]">
                </div>

                {{-- Featured Toggle --}}
                <label class="flex items-center gap-3 cursor-pointer p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="relative">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                        <div class="w-10 h-5 bg-gray-300 rounded-full peer peer-checked:bg-[#C4704F] transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-700">⭐ Foto Unggulan</span>
                        <p class="text-xs text-gray-400">Tampil di bagian utama galeri</p>
                    </div>
                </label>

                <button type="submit"
                        class="w-full bg-[#C4704F] hover:bg-[#A85A3A] text-white font-semibold
                               py-3 rounded-xl transition-all shadow-md hover:shadow-lg
                               hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Upload Foto
                </button>
            </form>
        </div>
    </div>

    {{-- ─── GRID FOTO ────────────────────────────────────── --}}
    <div class="lg:col-span-2">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-serif font-bold text-gray-700 text-lg">Foto di Galeri</h3>
                <p class="text-xs text-gray-400">{{ $galleries->total() }} foto tersimpan</p>
            </div>
        </div>

        @if($galleries->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($galleries as $g)
            <div class="relative group rounded-2xl overflow-hidden bg-gray-100 shadow-sm border border-gray-100">

                {{-- Gambar --}}
                <div class="aspect-square overflow-hidden">
                    <img src="{{ $g->image_url }}"
                         alt="{{ $g->alt ?? 'Foto galeri' }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/400x400/F5F0E8/8B6355?text=Foto'">
                </div>

                {{-- Overlay saat hover --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent
                            opacity-0 group-hover:opacity-100 transition-opacity duration-300
                            flex flex-col justify-between p-3">

                    {{-- Tombol hapus --}}
                    <div class="flex justify-end">
                        <form action="{{ route('admin.gallery.destroy', $g) }}" method="POST"
                              onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-xl
                                           flex items-center justify-center transition-colors shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    {{-- Info --}}
                    <div>
                        @if($g->caption)
                        <p class="text-white text-xs font-semibold line-clamp-2 mb-1">{{ $g->caption }}</p>
                        @endif
                        @if($g->product)
                        <span class="bg-white/20 text-white text-xs px-2 py-0.5 rounded-full">
                            {{ $g->product->name }}
                        </span>
                        @endif
                    </div>
                </div>

                {{-- Badge unggulan --}}
                @if($g->is_featured)
                <div class="absolute top-2 left-2">
                    <span class="bg-[#C4704F] text-white text-xs font-bold px-2 py-0.5 rounded-full shadow">
                        ⭐ Unggulan
                    </span>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">{{ $galleries->links() }}</div>

        @else
        {{-- Empty State --}}
        <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-50 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h4 class="font-serif font-bold text-gray-500 text-lg mb-1">Belum ada foto</h4>
            <p class="text-gray-400 text-sm">Upload foto pertama kamu menggunakan form di sebelah kiri</p>
        </div>
        @endif
    </div>
</div>

<script>
let selectedFiles = [];

function previewFiles(input) {
    Array.from(input.files).forEach(f => selectedFiles.push(f));
    renderPreview();
}

function handleDrop(e) {
    e.preventDefault();
    Array.from(e.dataTransfer.files)
         .filter(f => f.type.startsWith('image/'))
         .forEach(f => selectedFiles.push(f));
    renderPreview();
}

function renderPreview() {
    const grid  = document.getElementById('previewGrid');
    const count = document.getElementById('previewCount');
    grid.innerHTML = '';

    selectedFiles.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = ev => {
            const div = document.createElement('div');
            div.className = 'relative aspect-square group';
            div.innerHTML = `
                <img src="${ev.target.result}"
                     class="w-full h-full object-cover rounded-xl border border-gray-200">
                <button type="button" onclick="removeFile(${i})"
                        class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white rounded-full
                               text-xs flex items-center justify-center shadow opacity-0
                               group-hover:opacity-100 transition-opacity font-bold">×</button>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });

    count.textContent = selectedFiles.length + ' foto dipilih';
    document.getElementById('dropPlaceholder').classList.toggle('hidden', selectedFiles.length > 0);
    document.getElementById('dropPreview').classList.toggle('hidden', selectedFiles.length === 0);
    syncInput();
}

function removeFile(idx) {
    selectedFiles.splice(idx, 1);
    renderPreview();
}

function syncInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    document.getElementById('galleryFileInput').files = dt.files;
}
</script>

@endsection