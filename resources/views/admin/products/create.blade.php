@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('page-title', isset($product) ? 'Edit Produk ✏️' : 'Tambah Produk ➕')

@section('admin-content')

<div class="max-w-4xl">
    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4">
            <ul class="text-sm text-red-600 space-y-1 list-disc list-inside">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
        @endif

        {{-- ─── FOTO PRODUK ─────────────────────────────────── --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-6">
            <h3 class="font-serif font-bold text-gray-700 text-lg flex items-center gap-2">
                <span class="w-7 h-7 bg-[#C4704F]/10 rounded-lg flex items-center justify-center text-sm">📸</span>
                Foto Produk
            </h3>

            {{-- FOTO UTAMA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Foto Utama
                    @if(!isset($product))<span class="text-red-500">*</span>@endif
                    <span class="text-gray-400 font-normal ml-1">(tampil di kartu katalog, rasio 1:1)</span>
                </label>

                <div id="mainDropZone"
                     class="relative border-2 border-dashed border-gray-200 rounded-2xl transition-all cursor-pointer
                            hover:border-[#C4704F] hover:bg-[#FDF8F5]"
                     onclick="document.getElementById('mainImageInput').click()"
                     ondragover="event.preventDefault(); this.classList.add('!border-[#C4704F]','!bg-[#FDF8F5]')"
                     ondragleave="this.classList.remove('!border-[#C4704F]','!bg-[#FDF8F5]')"
                     ondrop="handleMainDrop(event)">

                    {{-- Jika edit: tampilkan foto lama dulu --}}
                    @if(isset($product) && $product->image)
                    <div id="currentMainWrap" class="p-4 text-center">
                        <p class="text-xs text-gray-400 mb-2 font-medium uppercase tracking-wide">Foto Saat Ini</p>
                        <img src="{{ $product->image_url }}" alt="Foto saat ini"
                             class="w-40 h-40 object-cover rounded-2xl shadow-md border border-gray-200 mx-auto">
                        <p class="text-xs text-gray-400 mt-2">Klik atau drag untuk mengganti foto ini</p>
                    </div>
                    @endif

                    {{-- Placeholder (tampil saat belum pilih foto baru) --}}
                    <div id="mainPlaceholder" class="p-8 text-center {{ isset($product) && $product->image ? 'hidden' : '' }}">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center">
                            <svg class="w-9 h-9 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Drag & drop foto ke sini</p>
                        <p class="text-xs text-gray-400 mb-3">atau klik untuk memilih dari komputer</p>
                        <span class="inline-block bg-[#C4704F]/10 text-[#C4704F] text-xs font-semibold px-4 py-2 rounded-full">
                            Pilih Foto Utama
                        </span>
                        <p class="text-xs text-gray-400 mt-3">JPG, PNG, WebP — Maksimal 2MB — Ideal: 800×800px</p>
                    </div>

                    {{-- Preview foto baru yang dipilih --}}
                    <div id="mainPreviewWrap" class="hidden p-4 text-center">
                        <p class="text-xs text-green-600 font-semibold mb-2 uppercase tracking-wide">✓ Foto Baru Dipilih</p>
                        <div class="relative inline-block">
                            <img id="mainPreviewImg" src="" alt="Preview baru"
                                 class="w-40 h-40 object-cover rounded-2xl shadow-md border-2 border-[#C4704F]/30 mx-auto">
                            <button type="button"
                                    onclick="event.stopPropagation(); clearMainImage()"
                                    class="absolute -top-2 -right-2 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-md transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <p id="mainFileName" class="text-xs text-gray-400 mt-2"></p>
                        <p class="text-xs text-[#C4704F] mt-1">Klik zona ini untuk mengganti</p>
                    </div>
                </div>
                <input type="file" id="mainImageInput" name="image" accept="image/jpeg,image/png,image/webp"
                       class="hidden" onchange="previewMainImage(this)">
            </div>

            {{-- FOTO GALERI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Foto Galeri
                    <span class="text-gray-400 font-normal ml-1">(opsional — foto tambahan detail produk)</span>
                </label>

                {{-- Tampilkan galeri lama jika edit --}}
                @if(isset($product) && $product->gallery && count($product->gallery))
                <div class="mb-4">
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-2">Galeri Saat Ini</p>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($product->gallery as $gi => $g)
                        <div class="relative group">
                            <img src="{{ asset('storage/'.$g) }}" alt="Galeri {{ $gi+1 }}"
                                 class="w-20 h-20 object-cover rounded-xl border border-gray-200 shadow-sm">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-amber-600 mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Upload foto baru di bawah akan menggantikan galeri lama
                    </p>
                </div>
                @endif

                <div id="galleryDropZone"
                     class="relative border-2 border-dashed border-gray-200 rounded-2xl transition-all cursor-pointer
                            hover:border-[#8A9E7A] hover:bg-[#F6FAF4]"
                     onclick="document.getElementById('galleryInput').click()"
                     ondragover="event.preventDefault(); this.classList.add('!border-[#8A9E7A]','!bg-[#F6FAF4]')"
                     ondragleave="this.classList.remove('!border-[#8A9E7A]','!bg-[#F6FAF4]')"
                     ondrop="handleGalleryDrop(event)">

                    <div id="galleryPlaceholder" class="p-8 text-center">
                        <div class="flex justify-center gap-2 mb-4">
                            @foreach(['rotate-[-8deg]','rotate-0','rotate-[8deg]'] as $rot)
                            <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center {{ $rot }}">
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                </svg>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Drag & drop beberapa foto sekaligus</p>
                        <p class="text-xs text-gray-400 mb-3">atau klik untuk pilih dari komputer</p>
                        <span class="inline-block bg-[#8A9E7A]/10 text-[#7A9268] text-xs font-semibold px-4 py-2 rounded-full">
                            Pilih Foto Galeri
                        </span>
                    </div>

                    <div id="galleryPreviewGrid" class="hidden p-4">
                        <div id="galleryGrid" class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-2 mb-3"></div>
                        <div class="flex items-center justify-between">
                            <span id="galleryCount" class="text-xs text-[#7A9268] font-semibold"></span>
                            <span class="text-xs text-gray-400">Klik zona ini untuk tambah lebih banyak</span>
                        </div>
                    </div>
                </div>
                <input type="file" id="galleryInput" name="gallery[]" accept="image/jpeg,image/png,image/webp"
                       multiple class="hidden" onchange="previewGallery(this)">
            </div>

            {{-- Tips Box --}}
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 flex gap-2.5">
                <svg class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-xs text-blue-600 space-y-0.5">
                    <p><strong>Tips foto produk rajutan:</strong></p>
                    <p>• Gunakan latar polos (putih/krem) agar produk lebih menonjol</p>
                    <p>• Foto dengan pencahayaan alami menghasilkan warna yang lebih akurat</p>
                    <p>• Ukuran ideal: <strong>800×800px</strong> untuk foto utama, bebas untuk galeri</p>
                </div>
            </div>
        </div>

        {{-- ─── INFORMASI DASAR ─────────────────────────────── --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
            <h3 class="font-serif font-bold text-gray-700 text-lg flex items-center gap-2">
                <span class="w-7 h-7 bg-[#C4704F]/10 rounded-lg flex items-center justify-center text-sm">📋</span>
                Informasi Dasar
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30 focus:border-[#C4704F]"
                           placeholder="Contoh: Tote Bag Rafi Sage">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori *</label>
                    <select name="category_id" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi *</label>
                <textarea name="description" rows="4" required
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30 resize-none"
                          placeholder="Deskripsikan produk secara detail...">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
        </div>

        {{-- ─── DETAIL BAHAN ────────────────────────────────── --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
            <h3 class="font-serif font-bold text-gray-700 text-lg flex items-center gap-2">
                <span class="w-7 h-7 bg-[#C4704F]/10 rounded-lg flex items-center justify-center text-sm">🧵</span>
                Detail Bahan
            </h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Material / Bahan Benang</label>
                <textarea name="material" rows="2"
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30 resize-none"
                          placeholder="Contoh: Benang katun premium 100% cotton, anti-stretch...">{{ old('material', $product->material ?? '') }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Benang</label>
                    <input type="text" name="yarn_type" value="{{ old('yarn_type', $product->yarn_type ?? '') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30"
                           placeholder="Cotton Premium">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ketebalan Benang</label>
                    <select name="yarn_weight"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
                        <option value="">-- Pilih --</option>
                        @foreach(['Lace Weight','Fingering Weight','Sport Weight','DK Weight','Worsted Weight','Bulky Weight','Super Bulky'] as $w)
                        <option value="{{ $w }}"
                            {{ old('yarn_weight', $product->yarn_weight ?? '') === $w ? 'selected' : '' }}>{{ $w }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ukuran</label>
                    <input type="text" name="size" value="{{ old('size', $product->size ?? '') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30"
                           placeholder="30cm x 35cm / S/M/L">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Pilihan Warna <span class="text-gray-400 text-xs">(pisahkan dengan koma)</span>
                </label>
                <input type="text" name="colors"
                       value="{{ old('colors', isset($product) && $product->colors ? implode(', ', $product->colors) : '') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30"
                       placeholder="Sage Green, Cream, Dusty Rose">
            </div>
        </div>

        {{-- ─── HARGA & STOK ────────────────────────────────── --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
            <h3 class="font-serif font-bold text-gray-700 text-lg flex items-center gap-2">
                <span class="w-7 h-7 bg-[#C4704F]/10 rounded-lg flex items-center justify-center text-sm">💰</span>
                Harga & Stok
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga (Rp) *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-400 font-medium">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required min="0"
                               class="w-full border border-gray-200 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30"
                               placeholder="150000">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status *</label>
                    <select name="status" id="statusSelect" onchange="toggleStock()"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
                        <option value="ready_stock" {{ old('status', $product->status ?? 'ready_stock') === 'ready_stock' ? 'selected' : '' }}>✅ Ready Stock</option>
                        <option value="pre_order"   {{ old('status', $product->status ?? '') === 'pre_order' ? 'selected' : '' }}>⏳ Pre-Order</option>
                    </select>
                </div>
                <div id="stockField">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
                </div>
                <div id="estimasiField" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Estimasi Hari Kerja</label>
                    <input type="number" name="estimated_days" value="{{ old('estimated_days', $product->estimated_days ?? '') }}" min="1"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30"
                           placeholder="7">
                </div>
            </div>
            <div class="flex flex-wrap gap-6 pt-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <div class="relative">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-[#C4704F] transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                    </div>
                    <span class="text-sm font-medium text-gray-700">⭐ Produk Unggulan</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-[#8A9E7A] transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                    </div>
                    <span class="text-sm font-medium text-gray-700">✅ Aktif (tampil di publik)</span>
                </label>
            </div>
        </div>

        {{-- ─── SUBMIT ──────────────────────────────────────── --}}
        <div class="flex gap-3 pb-8">
            <button type="submit"
                    class="bg-[#C4704F] hover:bg-[#A85A3A] text-white font-bold px-8 py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="{{ isset($product) ? 'M5 13l4 4L19 7' : 'M12 4v16m8-8H4' }}"/>
                </svg>
                {{ isset($product) ? 'Simpan Perubahan' : 'Tambah Produk' }}
            </button>
            <a href="{{ route('admin.products') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3.5 rounded-xl transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>

{{-- ──────────────────────────────────────────────────────────────── --}}
<script>
// ── STATUS TOGGLE ──────────────────────────────────────────────────
function toggleStock() {
    const s = document.getElementById('statusSelect').value;
    document.getElementById('stockField').classList.toggle('hidden', s === 'pre_order');
    document.getElementById('estimasiField').classList.toggle('hidden', s !== 'pre_order');
}
toggleStock();

// ── FOTO UTAMA: PREVIEW ────────────────────────────────────────────
function previewMainImage(input) {
    if (input.files && input.files[0]) showMainPreview(input.files[0]);
}

function handleMainDrop(e) {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('mainImageInput').files = dt.files;
    showMainPreview(file);
}

function showMainPreview(file) {
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('mainPreviewImg').src = ev.target.result;
        document.getElementById('mainFileName').textContent =
            file.name + '  (' + (file.size / 1024).toFixed(0) + ' KB)';
        // sembunyikan placeholder & foto lama, tampilkan preview baru
        document.getElementById('mainPlaceholder').classList.add('hidden');
        const cur = document.getElementById('currentMainWrap');
        if (cur) cur.classList.add('hidden');
        document.getElementById('mainPreviewWrap').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

function clearMainImage() {
    document.getElementById('mainImageInput').value = '';
    document.getElementById('mainPreviewWrap').classList.add('hidden');
    // tampilkan kembali foto lama jika edit, atau placeholder jika tambah
    const cur = document.getElementById('currentMainWrap');
    if (cur) cur.classList.remove('hidden');
    else document.getElementById('mainPlaceholder').classList.remove('hidden');
}

// ── FOTO GALERI: PREVIEW MULTI ─────────────────────────────────────
let galleryFiles = [];

function previewGallery(input) {
    Array.from(input.files).forEach(f => galleryFiles.push(f));
    renderGallery();
}

function handleGalleryDrop(e) {
    e.preventDefault();
    Array.from(e.dataTransfer.files)
         .filter(f => f.type.startsWith('image/'))
         .forEach(f => galleryFiles.push(f));
    renderGallery();
}

function renderGallery() {
    const grid  = document.getElementById('galleryGrid');
    const count = document.getElementById('galleryCount');
    grid.innerHTML = '';

    galleryFiles.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = ev => {
            const div = document.createElement('div');
            div.className = 'relative group aspect-square';
            div.innerHTML = `
                <img src="${ev.target.result}"
                     class="w-full h-full object-cover rounded-xl border border-gray-200 shadow-sm">
                <button type="button" onclick="removeGallery(${i})"
                        class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-red-500 hover:bg-red-600 text-white
                               rounded-full text-xs opacity-0 group-hover:opacity-100 transition-opacity
                               flex items-center justify-center shadow font-bold">×</button>
                <div class="absolute bottom-1 left-1 right-1 text-[9px] text-white bg-black/40 rounded px-1 truncate opacity-0 group-hover:opacity-100 transition-opacity">
                    ${file.name}
                </div>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });

    count.textContent = galleryFiles.length + ' foto dipilih';
    document.getElementById('galleryPlaceholder').classList.toggle('hidden', galleryFiles.length > 0);
    document.getElementById('galleryPreviewGrid').classList.toggle('hidden', galleryFiles.length === 0);
    syncGalleryInput();
}

function removeGallery(idx) {
    galleryFiles.splice(idx, 1);
    renderGallery();
}

function syncGalleryInput() {
    const dt = new DataTransfer();
    galleryFiles.forEach(f => dt.items.add(f));
    document.getElementById('galleryInput').files = dt.files;
}
</script>

@endsection