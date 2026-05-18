@extends('layouts.app')

@section('title', $product->name . ' – Benang & Kasih')

@section('content')

{{-- Breadcrumb --}}
<div class="bg-[var(--cream)] border-b border-[var(--cream-dark)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex text-sm text-[var(--mocha)]">
            <a href="{{ route('home') }}" class="hover:text-[var(--terra)]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home') }}?category={{ $product->category->slug }}" class="hover:text-[var(--terra)]">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-[var(--charcoal)] font-medium line-clamp-1">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<section class="py-12 bg-[var(--warm-white)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">

            {{-- ─── LEFT: Images ─── --}}
            <div>
                {{-- Main Image --}}
                <div class="rounded-3xl overflow-hidden aspect-square bg-[var(--cream)] shadow-lg mb-4" id="mainImageWrap">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             id="mainImage" class="w-full h-full object-cover transition-opacity duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-9xl">
                            {{ $product->category->icon ?? '🧶' }}
                        </div>
                    @endif
                </div>

                {{-- Gallery thumbs --}}
                @if($product->gallery && count($product->gallery))
                <div class="flex gap-3 overflow-x-auto pb-1">
                    @if($product->image)
                    <button onclick="setMainImage('{{ $product->image_url }}')"
                            class="flex-shrink-0 w-20 h-20 rounded-2xl overflow-hidden border-2 border-[var(--terra)] shadow-sm">
                        <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                    </button>
                    @endif
                    @foreach($product->gallery as $img)
                    <button onclick="setMainImage('{{ asset('storage/' . $img) }}')"
                            class="flex-shrink-0 w-20 h-20 rounded-2xl overflow-hidden border-2 border-transparent hover:border-[var(--terra)] transition-colors shadow-sm">
                        <img src="{{ asset('storage/' . $img) }}" alt="" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- ─── RIGHT: Details ─── --}}
            <div class="flex flex-col">
                {{-- Category + Badges --}}
                <div class="flex items-center gap-2 mb-3 flex-wrap">
                    <span class="text-sm text-[var(--sage-dark)] font-medium">
                        {{ $product->category->icon }} {{ $product->category->name }}
                    </span>
                    <span class="badge-{{ $product->status === 'ready_stock' ? 'ready' : 'preorder' }} text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $product->status_label }}
                    </span>
                    @if($product->is_featured)
                    <span class="bg-[var(--terra)] text-white text-xs font-semibold px-3 py-1 rounded-full">⭐ Unggulan</span>
                    @endif
                </div>

                {{-- Name --}}
                <h1 class="font-serif text-3xl lg:text-4xl font-bold text-[var(--charcoal)] leading-tight mb-3">
                    {{ $product->name }}
                </h1>

                {{-- Price --}}
                <div class="flex items-baseline gap-3 mb-6">
                    <span class="font-serif text-4xl font-bold text-[var(--terra)]">{{ $product->formatted_price }}</span>
                    @if($product->status === 'pre_order')
                    <span class="text-sm text-[var(--mocha)] bg-amber-50 px-3 py-1 rounded-full border border-amber-200">Pre-Order</span>
                    @endif
                </div>

                {{-- Description --}}
                <p class="text-[var(--mocha)] leading-relaxed mb-6">{{ $product->description }}</p>

                {{-- Info Cards Grid --}}
                <div class="grid grid-cols-2 gap-3 mb-6">
                    @if($product->yarn_type)
                    <div class="bg-[var(--cream)] rounded-2xl p-4">
                        <div class="text-xs text-[var(--mocha)] mb-1 font-medium uppercase tracking-wide">Jenis Benang</div>
                        <div class="font-semibold text-[var(--charcoal)] text-sm">🪡 {{ $product->yarn_type }}</div>
                    </div>
                    @endif
                    @if($product->yarn_weight)
                    <div class="bg-[var(--cream)] rounded-2xl p-4">
                        <div class="text-xs text-[var(--mocha)] mb-1 font-medium uppercase tracking-wide">Ketebalan</div>
                        <div class="font-semibold text-[var(--charcoal)] text-sm">⚖️ {{ $product->yarn_weight }}</div>
                    </div>
                    @endif
                    @if($product->size)
                    <div class="bg-[var(--cream)] rounded-2xl p-4">
                        <div class="text-xs text-[var(--mocha)] mb-1 font-medium uppercase tracking-wide">Ukuran</div>
                        <div class="font-semibold text-[var(--charcoal)] text-sm">📏 {{ $product->size }}</div>
                    </div>
                    @endif
                    @if($product->status === 'pre_order' && $product->estimated_days)
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                        <div class="text-xs text-amber-600 mb-1 font-medium uppercase tracking-wide">Estimasi Pengerjaan</div>
                        <div class="font-semibold text-amber-700 text-sm">⏳ {{ $product->estimated_days }} hari kerja</div>
                    </div>
                    @elseif($product->status === 'ready_stock')
                    <div class="bg-green-50 border border-green-200 rounded-2xl p-4">
                        <div class="text-xs text-green-600 mb-1 font-medium uppercase tracking-wide">Stok</div>
                        <div class="font-semibold text-green-700 text-sm">✅ {{ $product->stock }} tersedia</div>
                    </div>
                    @endif
                </div>

                {{-- Material Detail --}}
                @if($product->material)
                <div class="bg-[var(--cream)] rounded-2xl p-5 mb-6 border border-[var(--cream-dark)]">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-lg">🧵</span>
                        <span class="font-semibold text-[var(--charcoal)] text-sm">Bahan & Material</span>
                    </div>
                    <p class="text-sm text-[var(--mocha)] leading-relaxed">{{ $product->material }}</p>
                </div>
                @endif

                {{-- Colors (Sudah Diubah Jadi Tombol Interaktif) --}}
                @if($product->colors && count($product->colors))
                <div class="mb-6 p-4 rounded-2xl border border-transparent transition-all duration-300" id="color-section">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-semibold text-[var(--charcoal)]">🎨 Pilihan Warna</div>
                        <span id="warning-text" class="text-xs text-red-500 font-medium hidden animate-pulse">⚠️ Silakan pilih warna dahulu!</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->colors as $color)
                        <button type="button" 
                                onclick="selectColor(this, '{{ trim($color) }}')"
                                class="color-btn bg-white text-[var(--mocha)] text-sm px-4 py-1.5 rounded-full border border-[var(--cream-dark)] font-medium transition-all duration-200 focus:outline-none active:scale-95">
                            {{ trim($color) }}
                        </button>
                        @endforeach
                    </div>
                    <p class="text-xs text-[var(--mocha)] mt-2">*Warna custom bisa request via WhatsApp</p>
                </div>
                @endif

                {{-- Shipping Section --}}
                <div class="mb-6 p-4 rounded-2xl border border-gray-200 bg-gray-50/70 transition-all duration-300" id="shipping-section">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-semibold text-[var(--charcoal)]">📋 Data Pengiriman Domestik:</span>
                        <span id="shipping-warning" class="text-xs text-red-500 font-medium hidden animate-pulse">⚠️ Mohon lengkapi alamat kirim!</span>
                    </div>
                    <div class="space-y-2.5">
                        <input type="text" id="buyer-name" placeholder="Nama Lengkap Penerima" 
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-[var(--terra)] bg-white">
                        <textarea id="buyer-address" rows="2" placeholder="Alamat Tujuan Lengkap (Kecamatan, Kota/Kabupaten, Kode Pos)" 
                                  class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-[var(--terra)] bg-white"></textarea>
                    </div>
                </div>

                {{-- Pre-order Info --}}
                @if($product->status === 'pre_order')
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 mb-6">
                    <h4 class="font-semibold text-amber-800 mb-2 flex items-center gap-2">
                        <span>ℹ️</span> Cara Pre-Order
                    </h4>
                    <ol class="text-sm text-amber-700 space-y-1 list-decimal list-inside">
                        <li>Klik tombol "Pesan via WhatsApp" di bawah</li>
                        <li>Konfirmasi warna, ukuran, dan detail pesanan</li>
                        <li>Lakukan pembayaran DP (biasanya 50%)</li>
                        <li>Tunggu pengerjaan ~{{ $product->estimated_days }} hari kerja</li>
                        <li>Pelunasan dan barang siap dikirim</li>
                    </ol>
                </div>
                @endif

                {{-- CTA Buttons (Ubah href ke href="#" dan pakai validateAndOrder) --}}
                <div class="flex flex-col sm:flex-row gap-3 mt-auto">
                    <a id="btn-wa"
                        href="#"
                        onclick="validateAndOrder(event)"
                        class="bg-gradient-to-r from-[#25D366] to-[#128C7E] hover:from-[#20ba5a] hover:to-[#0e6f63] text-white font-bold px-8 py-4 rounded-2xl flex items-center justify-center gap-3 text-base shadow-lg shadow-green-100 flex-1 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Pesan via WhatsApp
                    </a>
                    <a href="{{ route('home') }}" class="bg-[var(--cream)] hover:bg-[var(--cream-dark)] text-[var(--charcoal)] font-semibold px-6 py-4 rounded-2xl text-center transition-colors border border-[var(--cream-dark)]">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>

        {{-- ─── Related Products ─── --}}
        @if($related->count())
        <div class="mt-20">
            <h2 class="font-serif text-2xl font-bold text-[var(--charcoal)] mb-8">
                Produk Serupa ✨
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($related as $rel)
                <a href="{{ route('product.show', $rel->slug) }}" class="card-product bg-white rounded-3xl overflow-hidden shadow-sm border border-[var(--cream-dark)] block">
                    <div class="aspect-square bg-[var(--cream)] overflow-hidden">
                        @if($rel->image)
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-5xl">{{ $rel->category->icon ?? '🧶' }}</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="font-serif font-semibold text-sm text-[var(--charcoal)] line-clamp-2 mb-1">{{ $rel->name }}</div>
                        <div class="font-bold text-[var(--terra)] text-sm">{{ $rel->formatted_price }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- LOGIKA JAVASCRIPT VALIDASI & PARSING DATA KE WHATSAPP --}}
<script>
// Ambil data produk Laravel langsung ke dalam variabel JavaScript secara aman
const productName = {!! json_encode($product->name) !!};
const productPrice = {!! json_encode($product->formatted_price) !!};
const productUrl = {!! json_encode(url('/produk/' . $product->slug)) !!};
const whatsappNumber = "{{ config('app.whatsapp_number', '6285876177107') }}";

let selectedColorName = "";

// ✨ MEMUAT DATA OTOMATIS SAAT HALAMAN DIBUKA (Agar data pengirim tetap tercetak)
document.addEventListener("DOMContentLoaded", function() {
    const nameInput = document.getElementById('buyer-name');
    const addressInput = document.getElementById('buyer-address');

    // Cek apakah ada data nama & alamat yang tersimpan di memori browser
    const savedName = localStorage.getItem('saved_buyer_name');
    const savedAddress = localStorage.getItem('saved_buyer_address');

    if (savedName && nameInput) {
        nameInput.value = savedName;
    }
    if (savedAddress && addressInput) {
        addressInput.value = savedAddress;
    }
});

function setMainImage(url) {
    const img = document.getElementById('mainImage');
    if (img) { 
        img.style.opacity = '0'; 
        setTimeout(() => { 
            img.src = url; 
            img.style.opacity = '1'; 
        }, 200); 
    }
}

// Fungsi merubah state warna ketika diklik
function selectColor(element, colorName) {
    selectedColorName = colorName;

    const colorSection = document.getElementById('color-section');
    const warningText = document.getElementById('warning-text');
    if (colorSection) colorSection.classList.remove('bg-red-50', 'border-red-200');
    if (warningText) warningText.classList.add('hidden');

    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.classList.remove('border-[var(--terra)]', 'bg-[var(--terra)]/10', 'text-[var(--terra)]', 'scale-105');
        btn.classList.add('border-[var(--cream-dark)]', 'bg-white', 'text-[var(--mocha)]');
    });

    element.classList.remove('border-[var(--cream-dark)]', 'bg-white', 'text-[var(--mocha)]');
    element.classList.add('border-[var(--terra)]', 'bg-[var(--terra)]/10', 'text-[var(--terra)]', 'scale-105');
}

// Jalankan validasi nama + alamat lalu susun pesan WA otomatis dari Model
function validateAndOrder(event) {
    if (event) event.preventDefault();

    // 1. Ambil data pilihan warna
    const hasColorButtons = document.querySelectorAll('.color-btn').length > 0;
    if (hasColorButtons && !selectedColorName) {
        const colorSection = document.getElementById('color-section');
        const warningText = document.getElementById('warning-text');
        if (colorSection) colorSection.classList.add('bg-red-50', 'border-red-200', 'animate-bounce');
        if (warningText) warningText.classList.remove('hidden');
        return false;
    }

    // 2. Ambil data Nama dan Alamat dari form inputan
    const nameInput = document.getElementById('buyer-name');
    const addressInput = document.getElementById('buyer-address');
    const buyerName = nameInput ? nameInput.value.trim() : "";
    const buyerAddress = addressInput ? addressInput.value.trim() : "";

    if (!buyerName || !buyerAddress) {
        const shippingSection = document.getElementById('shipping-section');
        const shippingWarning = document.getElementById('shipping-warning');
        if (shippingSection) shippingSection.classList.add('bg-red-50', 'border-red-300', 'animate-bounce');
        if (shippingWarning) shippingWarning.classList.remove('hidden');
        return false;
    }

    // ✨ AMANKAN DATA KE MEMORI BROWSER SEBELUM DIKIRIM (Supaya form tidak kosong saat kembali)
    localStorage.setItem('saved_buyer_name', buyerName);
    localStorage.setItem('saved_buyer_address', buyerAddress);

    // 3. Ambil template dasar teks dari Model Laravel Product
    let baseMessage = {!! json_encode($product->generateWhatsappMessage()) !!};

    // 4. Manipulasi string bawaan Model menggunakan JavaScript (.replace) sesuai token baru
    let finalMessage = baseMessage
        .replace('🎨 Warna    : -', '🎨 Warna    : ' + selectedColorName)
        .replace('___NAMA_PEMBELI___', buyerName)
        .replace('___ALAMAT_PEMBELI___', buyerAddress);

    // 5. Eksekusi tembak ke link WhatsApp resmi Benang & Kasih
    const finalWaUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(finalMessage)}`;
    window.open(finalWaUrl, '_blank');
}
</script>
@endsection