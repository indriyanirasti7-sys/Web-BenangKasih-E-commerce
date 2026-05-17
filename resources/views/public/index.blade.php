{{-- resources/views/public/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Benang & Kasih – Katalog Rajutan Handmade')

@section('content')

{{-- ══════════════════════════════════════════════════════
     HERO CAROUSEL
════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-[var(--cream)] -mt-px" style="min-height: 90vh;">

    {{-- Carousel Track --}}
    <div id="carouselTrack" class="carousel-track flex" style="min-height:90vh;">

        {{-- Slide 1 --}}
        <div class="carousel-slide flex-shrink-0 w-full relative bg-linen flex items-center" style="min-height:90vh;">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-[var(--cream-dark)] to-transparent"></div>
                <div class="absolute -top-24 -right-24 w-[500px] h-[500px] rounded-full opacity-30"
                     style="background: radial-gradient(circle, var(--terra-light) 0%, transparent 65%)"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full opacity-20"
                     style="background: radial-gradient(circle, var(--sage) 0%, transparent 70%)"></div>
                {{-- Decorative yarn SVG --}}
                <svg class="absolute top-10 right-8 opacity-10 w-64 h-64" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="90" stroke="var(--terra)" stroke-width="1.5" stroke-dasharray="6 4"/>
                    <circle cx="100" cy="100" r="65" stroke="var(--mocha)" stroke-width="1" stroke-dasharray="3 5"/>
                    <circle cx="100" cy="100" r="40" stroke="var(--sage)" stroke-width="1.5"/>
                    <circle cx="100" cy="100" r="12" fill="var(--terra)" opacity=".4"/>
                </svg>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-[var(--terra)]/10 border border-[var(--terra)]/20 text-[var(--terra)] text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 bg-[var(--terra)] rounded-full animate-pulse"></span>
                        New Collection 2025
                    </div>
                    <h1 class="font-display text-6xl lg:text-7xl font-bold text-[var(--charcoal)] leading-[1.05] mb-6">
                        Rajutan yang<br>
                        <em class="text-[var(--terra)] not-italic">Hangat</em> &<br>
                        <em class="text-[var(--sage-dark)] not-italic">Berkelas</em>
                    </h1>
                    <p class="text-[var(--mocha)] text-lg leading-relaxed mb-8 max-w-md">
                        Setiap produk dirajut satu per satu dengan benang pilihan. Temukan koleksi tas, pakaian, dan aksesoris eksklusif.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#katalog"
                           class="bg-[var(--terra)] hover:bg-[var(--terra-dark)] text-white font-semibold px-8 py-4 rounded-full transition-all hover:shadow-xl hover:-translate-y-1 text-sm">
                            Jelajahi Koleksi
                        </a>
                        <a href="{{ route('gallery') }}"
                           class="bg-white/80 backdrop-blur border border-[var(--cream-dark)] text-[var(--charcoal)] font-semibold px-8 py-4 rounded-full transition-all hover:bg-white hover:-translate-y-1 text-sm">
                            Lihat Galeri
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex justify-center">
                    <div class="relative w-[420px] h-[420px]">
                       <div class="relative w-[480px] h-[480px] flex items-center justify-center mb-8">
                        <div class="absolute inset-4 rounded-full bg-[var(--cream-dark)]/60 border-2 border-[var(--cream-dark)]"></div>
                            <div class="w-72 h-72 rounded-full overflow-hidden shadow-2xl border-4 border-white">
                                {{-- Placeholder image --}}
                                <div class="w-full h-full bg-gradient-to-br from-[var(--cream)] via-[var(--terra-light)]/30 to-[var(--sage-light)]/40 flex items-center justify-center">
                                    <img src="{{ asset('images/hero1.png') }}" 
                                        alt="Koleksi Benang Kasih" 
                                        class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                        {{-- Floating badges --}}
                        <div class="absolute top-4 right-0 bg-white rounded-2xl shadow-lg px-4 py-2.5 border border-[var(--cream-dark)]">
                            <div class="text-xs text-[var(--mocha)]">Ready Stock</div>
                            <div class="font-display font-bold text-[var(--terra)]">{{ \App\Models\Product::where('status','ready_stock')->where('is_active',true)->count() }} Produk</div>
                        </div>
                        <div class="absolute bottom-8 left-0 bg-[var(--sage)] text-white rounded-2xl shadow-lg px-4 py-2.5">
                            <div class="text-xs opacity-80">Handmade</div>
                            <div class="font-bold">100% Original</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        {{-- SESUDAH: tambahkan gambar background --}}
        <div class="carousel-slide flex-shrink-0 w-full relative flex items-center"
            style="min-height:90vh;">
            {{-- Background foto --}}
            <div class="absolute inset-0">
                <img src="{{ asset('images/hero2.png') }}"
                    alt="Background"
                    class="w-full h-full object-cover">
                {{-- Overlay hijau di atas foto --}}
                <div class="absolute inset-0"
                    style="background: linear-gradient(135deg, rgba(74,102,64,.85) 0%, rgba(74,102,64,.75) 100%)">
                </div>
            </div>
            <div class="absolute inset-0 overflow-hidden">
                <svg class="absolute -bottom-16 -left-16 opacity-10 w-96 h-96" viewBox="0 0 300 300">
                    <circle cx="150" cy="150" r="140" stroke="white" stroke-width="1" fill="none" stroke-dasharray="8 6"/>
                    <circle cx="150" cy="150" r="100" stroke="white" stroke-width="1.5" fill="none"/>
                    <circle cx="150" cy="150" r="60" stroke="white" stroke-width="2" fill="none" stroke-dasharray="4 4"/>
                </svg>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center text-white">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur border border-white/20 text-white text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-full mb-6">
                    ✨ Koleksi Eksklusif
                </div>
                <h2 class="font-display text-6xl lg:text-7xl font-bold leading-[1.05] mb-6">
                    Pre-Order<br><em class="not-italic opacity-80">Spesial</em> Untukmu
                </h2>
                <p class="text-white/80 text-lg mb-8 max-w-xl mx-auto">
                    Pesan sekarang, rajut khusus sesuai permintaanmu. Warna, ukuran, dan detail bisa disesuaikan.
                </p>
                <a href="{{ route('home') }}?status=pre_order"
                   class="inline-block bg-white text-[var(--sage-dark)] font-bold px-10 py-4 rounded-full hover:shadow-2xl hover:-translate-y-1 transition-all text-sm">
                    Lihat Pre-Order
                </a>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="carousel-slide flex-shrink-0 w-full relative flex items-center bg-linen" style="min-height:90vh; background-color: var(--cream-mid);">
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-1">
                    <div class="text-[var(--terra)] text-xs font-semibold tracking-widest uppercase mb-3">Produk Unggulan</div>
                    <h2 class="font-display text-5xl font-bold text-[var(--charcoal)] mb-4">Pilihan<br><em class="text-[var(--terra)] not-italic">Terbaik</em></h2>
                    <p class="text-[var(--mocha)] leading-relaxed mb-6">Rajutan premium yang paling banyak diminati. Dibuat dari bahan terpilih.</p>
                    <a href="#katalog" class="inline-block bg-[var(--charcoal)] text-[var(--cream)] font-semibold px-7 py-3.5 rounded-full hover:bg-[var(--terra)] transition-colors text-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="lg:col-span-2 grid grid-cols-2 gap-4">
                    @foreach(\App\Models\Product::with('category')->active()->featured()->take(4)->get() as $fp)
                    <a href="{{ route('product.show', $fp->slug) }}"
                       class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                        <div class="aspect-square overflow-hidden bg-[var(--cream)]">
                            @if($fp->image)
                                <img src="{{ $fp->image_url }}" alt="{{ $fp->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                 <div class="w-full h-full flex items-center justify-center text-4xl bg-gradient-to-br from-[var(--cream)] to-[var(--cream-dark)]">{{ $fp->category->icon }}</div>
                            @endif
                        </div>
                        <div class="p-3">
                            <div class="font-semibold text-xs text-[var(--charcoal)] line-clamp-1">{{ $fp->name }}</div>
                            <div class="text-[var(--terra)] font-bold text-sm mt-1">{{ $fp->formatted_price }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel Controls --}}
    <button id="prevBtn" onclick="carouselMove(-1)"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/80 backdrop-blur shadow-lg flex items-center justify-center hover:bg-white transition-colors">
        <svg class="w-5 h-5 text-[var(--charcoal)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button id="nextBtn" onclick="carouselMove(1)"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/80 backdrop-blur shadow-lg flex items-center justify-center hover:bg-white transition-colors">
        <svg class="w-5 h-5 text-[var(--charcoal)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Dots --}}
    <div id="carouselDots" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2.5">
        <button onclick="carouselGo(0)" class="carousel-dot w-8 h-2 rounded-full bg-[var(--terra)] transition-all"></button>
        <button onclick="carouselGo(1)" class="carousel-dot w-2 h-2 rounded-full bg-[var(--charcoal)]/30 transition-all"></button>
        <button onclick="carouselGo(2)" class="carousel-dot w-2 h-2 rounded-full bg-[var(--charcoal)]/30 transition-all"></button>
    </div>

    {{-- Wave --}}
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg viewBox="0 0 1440 56" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full">
            <path d="M0 56L1440 56L1440 28C1200 56 960 0 720 18C480 36 240 8 0 28Z" fill="var(--warm-white)"/>
        </svg>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     CATEGORY FILTER STRIP
════════════════════════════════════════════════════════ --}}
<section class="py-8 bg-[var(--warm-white)]" id="katalog">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide flex-wrap" data-aos="fade-up">
            <a href="{{ route('home') }}"
               class="flex-shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-medium transition-all border {{ !request('category') ? 'bg-[var(--terra)] text-white border-[var(--terra)] shadow-md' : 'bg-white text-[var(--charcoal)] border-[var(--cream-dark)] hover:border-[var(--terra)] hover:text-[var(--terra)]' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home') }}?category={{ $cat->slug }}"
               class="flex-shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-medium transition-all border {{ request('category') === $cat->slug ? 'bg-[var(--terra)] text-white border-[var(--terra)] shadow-md' : 'bg-white text-[var(--charcoal)] border-[var(--cream-dark)] hover:border-[var(--terra)] hover:text-[var(--terra)]' }}">
                {{ $cat->icon }} {{ $cat->name }}
                <span class="opacity-60 text-xs">({{ $cat->active_products_count }})</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     PRODUCT GRID
════════════════════════════════════════════════════════ --}}
<section class="py-8 pb-20 bg-[var(--warm-white)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header & Search --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10" data-aos="fade-up">
            <div>
                <h2 class="font-display text-3xl font-bold text-[var(--charcoal)]">
                    {{ request('category') ? ucfirst(request('category')) : 'Semua Koleksi' }}
                </h2>
                <p class="text-[var(--mocha)] text-sm mt-1">{{ $products->total() }} produk ditemukan</p>
            </div>
            <form method="GET" action="{{ route('home') }}" class="flex gap-2 w-full sm:w-auto flex-wrap sm:flex-nowrap">
                @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                <div class="relative flex-1 sm:w-56">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                           class="w-full pl-9 pr-4 py-2.5 rounded-full border border-[var(--cream-dark)] bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[var(--terra)]/25 focus:border-[var(--terra)]">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[var(--mocha)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select name="status" class="px-4 py-2.5 rounded-full border border-[var(--cream-dark)] bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[var(--terra)]/25">
                    <option value="">Semua Status</option>
                    <option value="ready_stock" {{ request('status') === 'ready_stock' ? 'selected' : '' }}>Ready Stock</option>
                    <option value="pre_order"   {{ request('status') === 'pre_order'   ? 'selected' : '' }}>Pre-Order</option>
                </select>
                <button type="submit" class="bg-[var(--terra)] text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-[var(--terra-dark)] transition-colors shadow-sm">Filter</button>
            </form>
        </div>

        {{-- Grid --}}
        @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $i => $product)
            <article class="card-product bg-white rounded-3xl overflow-hidden shadow-sm border border-[var(--cream-dark)]"
                     data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 80 }}">

                <a href="{{ route('product.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-[var(--cream)]">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="card-img w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[var(--cream)] to-[var(--cream-dark)]">
                            <svg viewBox="0 0 80 80" fill="none" class="w-20 h-20 opacity-30">
                                <circle cx="40" cy="40" r="35" stroke="var(--mocha)" stroke-width="2" stroke-dasharray="4 3"/>
                                <circle cx="40" cy="40" r="20" stroke="var(--terra)" stroke-width="2"/>
                                <circle cx="40" cy="40" r="6" fill="var(--terra)" opacity=".5"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3 flex flex-col gap-1">
                        <span class="badge-{{ $product->status === 'ready_stock' ? 'ready' : 'preorder' }} text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
                            {{ $product->status_label }}
                        </span>
                        @if($product->is_featured)
                        <span class="bg-[var(--terra)] text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">★ Unggulan</span>
                        @endif
                    </div>
                </a>

                <div class="p-4">
                    <div class="text-xs text-[var(--sage-dark)] font-medium mb-1.5">
                        {{ $product->category->icon }} {{ $product->category->name }}
                    </div>
                    <a href="{{ route('product.show', $product->slug) }}">
                        <h3 class="font-display font-semibold text-[var(--charcoal)] hover:text-[var(--terra)] transition-colors line-clamp-2 text-base leading-snug mb-2">
                            {{ $product->name }}
                        </h3>
                    </a>
                    @if($product->yarn_type)
                    <div class="text-xs text-[var(--mocha)] flex items-center gap-1 mb-3">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="1.5"/><path d="M8 12c0-2.21 1.79-4 4-4s4 1.79 4 4" stroke-width="1.5" stroke-linecap="round"/></svg>
                        {{ $product->yarn_type }}
                    </div>
                    @endif
                    @if($product->colors)
                    <div class="flex gap-1 mb-3 flex-wrap">
                        @foreach(array_slice($product->colors, 0, 3) as $color)
                        <span class="text-xs bg-[var(--cream)] text-[var(--mocha)] px-2 py-0.5 rounded-full border border-[var(--cream-dark)]">{{ $color }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-[var(--cream-dark)]">
                        <div>
                            <div class="font-display font-bold text-[var(--terra)] text-lg">{{ $product->formatted_price }}</div>
                            @if($product->status === 'pre_order' && $product->estimated_days)
                            <div class="text-xs text-[var(--mocha)]">~{{ $product->estimated_days }} hari kerja</div>
                            @endif
                        </div>
                        <a href="https://wa.me/{{ config('shop.whatsapp_number', '6281234567890') }}?text={{ $product->whatsapp_message }}"
                           target="_blank"
                           class="w-10 h-10 rounded-xl flex items-center justify-center shadow-md transition-all hover:scale-110 hover:shadow-lg"
                           style="background: linear-gradient(135deg, #25D366, #128C7E)">
                            <svg class="w-5 h-5" fill="white" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-12 flex justify-center">{{ $products->links() }}</div>
        @else
        <div class="text-center py-24" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-[var(--cream)] flex items-center justify-center">
                <svg class="w-10 h-10 text-[var(--sand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="font-display text-2xl text-[var(--charcoal)] mb-2">Produk tidak ditemukan</h3>
            <p class="text-[var(--mocha)] mb-6">Coba ubah filter atau kata kunci pencarian</p>
            <a href="{{ route('home') }}" class="bg-[var(--terra)] text-white px-8 py-3 rounded-full font-medium hover:bg-[var(--terra-dark)] transition-colors">Lihat Semua</a>
        </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     WHY US SECTION
════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-linen relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-14" data-aos="fade-up">
            <h2 class="font-display text-4xl font-bold text-[var(--charcoal)] mb-3">Kenapa Pilih Kami?</h2>
            <p class="text-[var(--mocha)] max-w-lg mx-auto">Kepuasanmu adalah prioritas kami. Setiap produk dibuat dengan standar kualitas tertinggi.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z','title'=>'Benang Premium','desc'=>'Menggunakan benang pilihan berkualitas tinggi, anti-bulu, dan tahan lama.'],
                ['icon'=>'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01','title'=>'Warna Custom','desc'=>'Tersedia pilihan warna sesuai keinginanmu. Tinggal request via WhatsApp!'],
                ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Pengerjaan Cepat','desc'=>'Ready stock siap kirim, pre-order dikerjakan sesuai estimasi waktu.'],
                ['icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z','title'=>'Packaging Cantik','desc'=>'Dikemas dengan cantik, siap jadi kado spesial untuk orang tersayang.'],
            ] as $idx => $feat)
            <div class="bg-white rounded-3xl p-7 shadow-sm border border-[var(--cream-dark)] text-center group hover:shadow-lg transition-shadow"
                 data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-[var(--cream)] flex items-center justify-center group-hover:bg-[var(--terra)] transition-colors">
                    <svg class="w-7 h-7 text-[var(--terra)] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feat['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-[var(--charcoal)] mb-2">{{ $feat['title'] }}</h3>
                <p class="text-sm text-[var(--mocha)] leading-relaxed">{{ $feat['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
// ── CAROUSEL LOGIC ─────────────────────────────────────────────────
let currentSlide = 0;
const totalSlides = 3;
let autoTimer;

function carouselMove(dir) {
    currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
    updateCarousel();
    resetTimer();
}
function carouselGo(idx) {
    currentSlide = idx;
    updateCarousel();
    resetTimer();
}
function updateCarousel() {
    document.getElementById('carouselTrack').style.transform = `translateX(-${currentSlide * 100}%)`;
    document.querySelectorAll('.carousel-dot').forEach((d, i) => {
        d.style.width      = i === currentSlide ? '2rem'  : '.5rem';
        d.style.background = i === currentSlide ? 'var(--terra)' : 'rgba(46,40,34,.25)';
    });
}
function resetTimer() {
    clearInterval(autoTimer);
    autoTimer = setInterval(() => carouselMove(1), 5000);
}
// Auto-scroll
autoTimer = setInterval(() => carouselMove(1), 5000);
// Pause on hover
document.querySelector('.carousel-track')?.addEventListener('mouseenter', () => clearInterval(autoTimer));
document.querySelector('.carousel-track')?.addEventListener('mouseleave', resetTimer);

// Swipe support
let touchStartX = 0;
document.getElementById('carouselTrack')?.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX, {passive:true});
document.getElementById('carouselTrack')?.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) carouselMove(diff > 0 ? 1 : -1);
});
</script>
@endpush
@endsection