{{-- resources/views/public/gallery.blade.php --}}
@extends('layouts.app')
@section('title', 'Galeri Rajutan – Benang & Kasih')

@section('content')

{{-- Page Header --}}
<section class="py-16 bg-linen relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <svg class="absolute -top-8 -right-8 opacity-8 w-64 h-64" viewBox="0 0 200 200" fill="none">
            <circle cx="100" cy="100" r="90" stroke="var(--terra)" stroke-width="1" stroke-dasharray="5 4"/>
            <circle cx="100" cy="100" r="55" stroke="var(--sage)" stroke-width="1.5" stroke-dasharray="3 5"/>
        </svg>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-[var(--terra)]/10 border border-[var(--terra)]/20 text-[var(--terra)] text-xs font-semibold tracking-wider uppercase px-4 py-2 rounded-full mb-5" data-aos="fade-down">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Galeri Karya
        </div>
        <h1 class="font-display text-5xl lg:text-6xl font-bold text-[var(--charcoal)] mb-4" data-aos="fade-up">
            Setiap <em class="text-[var(--terra)] not-italic">Helai</em> Punya Cerita
        </h1>
        <p class="text-[var(--mocha)] text-lg max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Kumpulan karya rajutan handmade. Klik foto untuk melihat detail atau memesan produknya.
        </p>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     MASONRY / PINTEREST GRID
════════════════════════════════════════════════════════ --}}
<section class="py-12 bg-[var(--warm-white)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($galleries->count())
        {{-- Pinterest-style CSS columns --}}
        <div style="columns: 2; column-gap: 1rem;"
             class="sm:[&>*]:!hidden md:block hidden"
             id="masonryGrid">
            @foreach($galleries as $i => $item)
            <div class="gallery-item relative rounded-2xl overflow-hidden cursor-pointer break-inside-avoid mb-4"
                 style="display: inline-block; width: 100%;"
                 data-aos="zoom-in" data-aos-delay="{{ ($i % 4) * 60 }}"
                 onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->caption ?? '') }}', '{{ $item->product ? route('product.show', $item->product->slug) : '' }}')">
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->alt ?? 'Foto rajutan' }}"
                     class="w-full h-auto block rounded-2xl"
                     loading="lazy">

                {{-- Overlay --}}
                <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent rounded-2xl flex flex-col justify-end p-4">
                    @if($item->caption)
                    <p class="text-white font-semibold text-sm leading-snug mb-2">{{ $item->caption }}</p>
                    @endif
                    <div class="flex items-center gap-2">
                        @if($item->product)
                        <a href="{{ route('product.show', $item->product->slug) }}"
                           onclick="event.stopPropagation()"
                           class="bg-[var(--terra)] text-white text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-[var(--terra-dark)] transition-colors">
                            Lihat Produk
                        </a>
                        @endif
                        <button class="bg-white/20 backdrop-blur text-white text-xs px-3 py-1.5 rounded-full hover:bg-white/30 transition-colors">
                            <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Perbesar
                        </button>
                    </div>
                </div>

                @if($item->is_featured)
                <div class="absolute top-3 left-3">
                    <span class="bg-[var(--terra)] text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-md">★ Pilihan</span>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Mobile / Tablet Grid (standard) --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 md:hidden">
            @foreach($galleries as $i => $item)
            <div class="gallery-item relative rounded-2xl overflow-hidden cursor-pointer"
                 data-aos="zoom-in" data-aos-delay="{{ ($i % 3) * 60 }}"
                 onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->caption ?? '') }}', '{{ $item->product ? route('product.show', $item->product->slug) : '' }}')">
                <div class="aspect-square">
                    <img src="{{ $item->image_url }}" alt="{{ $item->alt ?? '' }}" class="w-full h-full object-cover" loading="lazy">
                </div>
                <div class="gallery-overlay absolute inset-0 bg-black/40 flex items-center justify-center rounded-2xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">{{ $galleries->links() }}</div>

        @else
        <div class="text-center py-24" data-aos="fade-up">
            <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-[var(--cream)] flex items-center justify-center">
                <svg class="w-12 h-12 text-[var(--sand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-display text-2xl text-[var(--charcoal)] mb-2">Galeri masih kosong</h3>
            <p class="text-[var(--mocha)] mb-6">Admin belum mengunggah foto galeri.</p>
            <a href="{{ route('home') }}" class="bg-[var(--terra)] text-white px-8 py-3 rounded-full font-medium hover:bg-[var(--terra-dark)] transition-colors">Lihat Katalog</a>
        </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     LIGHTBOX MODAL
════════════════════════════════════════════════════════ --}}
<div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center p-4"
     style="background: rgba(20,15,10,.92); backdrop-filter: blur(8px);"
     onclick="closeLightbox(event)">
    <div class="relative max-w-5xl w-full max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
        {{-- Close --}}
        <button onclick="closeLightbox()"
                class="absolute -top-12 right-0 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors z-10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Image --}}
        <img id="lightboxImg" src="" alt=""
             class="max-h-[75vh] max-w-full object-contain rounded-2xl shadow-2xl">

        {{-- Caption + CTA --}}
        <div class="mt-4 text-center">
            <p id="lightboxCaption" class="text-white/80 text-sm mb-3"></p>
            <a id="lightboxLink" href="#" target="_blank"
               class="hidden bg-[var(--terra)] hover:bg-[var(--terra-dark)] text-white text-sm font-semibold px-6 py-2.5 rounded-full transition-colors">
                Lihat & Pesan Produk →
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openLightbox(src, caption, link) {
    const lb = document.getElementById('lightbox');
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxCaption').textContent = caption;
    const lbLink = document.getElementById('lightboxLink');
    if (link) { lbLink.href = link; lbLink.classList.remove('hidden'); }
    else       { lbLink.classList.add('hidden'); }
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeLightbox(e) {
    if (e && e.target !== e.currentTarget && e.target.id !== 'lightbox') return;
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush
@endsection