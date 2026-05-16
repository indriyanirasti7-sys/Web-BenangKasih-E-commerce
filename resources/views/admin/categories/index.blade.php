@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori 🏷️')

@section('admin-content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Form Tambah --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-fit">
        <h3 class="font-serif font-bold text-gray-700 text-lg mb-5">➕ Tambah Kategori</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori *</label>
                <input type="text" name="name" required placeholder="Contoh: Tas"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Icon Emoji</label>
                <input type="text" name="icon" maxlength="5" placeholder="👜"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="2" placeholder="Deskripsi singkat kategori..."
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C4704F]/30 resize-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-[#C4704F] hover:bg-[#A85A3A] text-white font-semibold py-2.5 rounded-xl transition-colors">
                Tambah Kategori
            </button>
        </form>
    </div>

    {{-- Daftar Kategori --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-serif font-bold text-gray-700 text-lg">Daftar Kategori</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($categories as $cat)
            <div class="px-6 py-4 flex items-center justify-between gap-4" x-data="{ editing: false }">
                <div class="flex items-center gap-3 flex-1">
                    <span class="text-3xl">{{ $cat->icon ?? '🏷' }}</span>
                    <div>
                        <div class="font-semibold text-gray-800">{{ $cat->name }}</div>
                        <div class="text-xs text-gray-400">{{ $cat->products_count }} produk · slug: {{ $cat->slug }}</div>
                        @if($cat->description)
                        <div class="text-xs text-gray-500 mt-0.5">{{ Str::limit($cat->description, 60) }}</div>
                        @endif
                    </div>
                </div>

                {{-- Edit inline --}}
                <div class="flex items-center gap-2">
                    <button onclick="toggleEditCat({{ $cat->id }})"
                            class="text-xs text-[#8A9E7A] hover:text-[#6B7F5C] font-medium px-3 py-1.5 rounded-lg hover:bg-green-50 transition-colors">
                        ✏️ Edit
                    </button>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                          onsubmit="return confirm('Hapus kategori {{ addslashes($cat->name) }}? Produk terkait akan terhapus!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">
                            🗑 Hapus
                        </button>
                    </form>
                </div>
            </div>

            {{-- Edit Form (hidden by default) --}}
            <div id="editCat{{ $cat->id }}" class="hidden px-6 py-4 bg-gray-50 border-t border-gray-100">
                <form action="{{ route('admin.categories.update', $cat) }}" method="POST" class="flex gap-3 items-end flex-wrap">
                    @csrf @method('PUT')
                    <div>
                        <label class="text-xs text-gray-500 block mb-1">Icon</label>
                        <input type="text" name="icon" value="{{ $cat->icon }}" maxlength="5"
                               class="border border-gray-200 rounded-lg px-3 py-2 text-sm w-20 focus:outline-none">
                    </div>
                    <div class="flex-1">
                        <label class="text-xs text-gray-500 block mb-1">Nama</label>
                        <input type="text" name="name" value="{{ $cat->name }}" required
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
                    </div>
                    <div class="flex-1">
                        <label class="text-xs text-gray-500 block mb-1">Deskripsi</label>
                        <input type="text" name="description" value="{{ $cat->description }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
                    </div>
                    <button type="submit" class="bg-[#C4704F] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#A85A3A] transition-colors">
                        Simpan
                    </button>
                    <button type="button" onclick="toggleEditCat({{ $cat->id }})"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition-colors">
                        Batal
                    </button>
                </form>
            </div>
            @empty
            <div class="px-6 py-12 text-center text-gray-400">Belum ada kategori.</div>
            @endforelse
        </div>
    </div>
</div>

<script>
function toggleEditCat(id) {
    const el = document.getElementById('editCat' + id);
    el?.classList.toggle('hidden');
}
</script>
@endsection