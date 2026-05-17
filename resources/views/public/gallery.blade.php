{{-- resources/views/public/gallery.blade.php --}}
@extends('layouts.app')
@section('title', 'Galeri Rajutan – Benang & Kasih')

@section('content')

{{-- ══ PAGE HEADER ══ --}}
<section class="py-16 bg-linen relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <svg class="absolute -top-8 -right-8 w-64 h-64 opacity-10" viewBox="0 0 200 200" fill="none">
            <circle cx="100" cy="100" r="90" stroke="var(--terra)" stroke-width="1" stroke-dasharray="5 4"/>
            <circle cx="100" cy="100" r="55" stroke="var(--sage)" stroke-width="1.5" stroke-dasharray="3 5"/>
        </svg>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-[var(--terra)]/10 border border-[var(--terra)]/20
                    text-[var(--terra)] text-xs font-semibold tracking-wider uppercase
                    px-4 py-2 rounded-full mb-5" data-aos="fade-down">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Galeri Karya
        </div>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-[var(--charcoal)] mb-4"
            data-aos="fade-up">
            Setiap <em class="text-[var(--terra)] not-italic">Helai</em> Punya Cerita
        </h1>
        <p class="text-[var(--mocha)] text-lg max-w-xl mx-auto"
           data-aos="fade-up" data-aos-delay="100">
            Kumpulan karya rajutan handmade. Klik foto untuk melihat detail atau memesan produknya.
        </p>
    </div>
</section>

{{-- ══ GALLERY GRID ══ --}}
<section class="py-12 bg-[var(--warm-white)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($galleries->count())

        {{-- ✅ SATU grid untuk SEMUA ukuran layar --}}
        <div class="gallery-masonry">
            @foreach($galleries as $i => $item)
            <div class="gallery-item relative rounded-2xl overflow-hidden cursor-pointer"
                 data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 60 }}"
                 onclick="openLightbox(
                     '{{ $item->image_url }}',
                     '{{ addslashes($item->caption ?? '') }}',
                     '{{ $item->product ? route('product.show', $item->product->slug) : '' }}'
                 )">

                {{-- Gambar --}}
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->alt ?? 'Foto rajutan handmade' }}"
                     class="w-full h-auto block"
                     loading="lazy"
                     onerror="this.closest('.gallery-item').style.display='none'">

                {{-- Overlay --}}
                <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex flex-col justify-end p-4">
                    @if($item->caption)
                    <p class="text-white font-semibold text-sm leading-snug mb-2">
                        {{ $item->caption }}
                    </p>
                    @endif
                    <div class="flex items-center gap-2 flex-wrap">
                        @if($item->product)
                        <a href="{{ route('product.show', $item->product->slug) }}"
                           onclick="event.stopPropagation()"
                           class="bg-[var(--terra)] text-white text-xs font-semibold
                                  px-3 py-1.5 rounded-full hover:bg-[var(--terra-dark)] transition-colors">
                            Lihat Produk →
                        </a>
                        @endif
                        <span class="bg-white/20 backdrop-blur text-white text-xs px-3 py-1.5 rounded-full">
                            🔍 Perbesar
                        </span>
                    </div>
                </div>

                {{-- Badge unggulan --}}
                @if($item->is_featured)
                <div class="absolute top-3 left-3">
                    <span class="bg-[var(--terra)] text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md">
                        ★ Pilihan
                    </span>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $galleries->links() }}
        </div>

        @else

        {{-- Empty State --}}
        <div class="text-center py-24" data-aos="fade-up">
            <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-[var(--cream)] flex items-center justify-center">
                <svg class="w-12 h-12 text-[var(--sand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-display text-2xl text-[var(--charcoal)] mb-2">Galeri masih kosong</h3>
            <p class="text-[var(--mocha)] mb-6">Admin belum mengunggah foto galeri.</p>
            <a href="{{ route('home') }}"
               class="bg-[var(--terra)] text-white px-8 py-3 rounded-full font-medium
                      hover:bg-[var(--terra-dark)] transition-colors">
                Lihat Katalog
            </a>
        </div>

        @endif
    </div>
</section>

{{-- ══ LIGHTBOX ══ --}}
<div id="lightbox"
     class="fixed inset-0 z-[100] hidden items-center justify-center p-4"
     style="background:rgba(20,15,10,.92); backdrop-filter:blur(8px);"
     onclick="closeLightbox(event)">
    <div class="relative max-w-5xl w-full max-h-[90vh] flex flex-col items-center"
         onclick="event.stopPropagation()">

        <button onclick="closeLightbox()"
                class="absolute -top-12 right-0 w-10 h-10 rounded-full bg-white/10
                       hover:bg-white/20 flex items-center justify-center text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <img id="lightboxImg" src="" alt=""
             class="max-h-[75vh] max-w-full object-contain rounded-2xl shadow-2xl">

        <div class="mt-4 text-center">
            <p id="lightboxCaption" class="text-white/80 text-sm mb-3"></p>
            <a id="lightboxLink" href="#" target="_blank"
               class="hidden bg-[var(--terra)] hover:bg-[var(--terra-dark)] text-white
                      text-sm font-semibold px-6 py-2.5 rounded-full transition-colors">
                Lihat & Pesan Produk →
            </a>
        </div>
    </div>
</div>

{{-- ══ CSS MASONRY ══ --}}
<style>
/* Masonry layout pakai CSS columns */
.gallery-masonry {
    column-count: 2;
    column-gap: 1rem;
}
@media (min-width: 640px) {
    .gallery-masonry { column-count: 3; }
}
@media (min-width: 1024px) {
    .gallery-masonry { column-count: 4; }
}

/* Setiap item tidak boleh terpotong antar kolom */
.gallery-masonry .gallery-item {
    break-inside: avoid;
    -webkit-column-break-inside: avoid;
    page-break-inside: avoid;
    margin-bottom: 1rem;
    display: block;
    width: 100%;
}

/* Overlay effect */
.gallery-overlay {
    opacity: 0;
    transition: opacity .3s ease;
}
.gallery-item:hover .gallery-overlay {
    opacity: 1;
}
.gallery-item {
    transition: transform .3s ease, box-shadow .3s ease;
}
.gallery-item:hover {
    transform: scale(1.02);
    box-shadow: 0 16px 40px rgba(46,40,34,.2);
    z-index: 10;
    position: relative;
}
</style>

@push('scripts')
<script>
function openLightbox(src, caption, link) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxCaption').textContent = caption;
    const lbLink = document.getElementById('lightboxLink');
    if (link) {
        lbLink.href = link;
        lbLink.classList.remove('hidden');
    } else {
        lbLink.classList.add('hidden');
    }
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e && e.target.id !== 'lightbox') return;
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
        document.body.style.overflow = '';
    }
});
</script>
@endpush

@endsection