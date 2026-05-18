{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Benang & Kasih – Rajutan Handmade')</title>

    {{-- Fonts: Cormorant Garamond (display) + DM Sans (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">

    {{-- AOS Animation Library --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── CSS VARIABLES ─────────────────────────────────────── */
        :root {
            --cream:       #F7F2E9;
            --cream-mid:   #EFE8D8;
            --cream-dark:  #E3D9C6;
            --sage:        #7A9268;
            --sage-dark:   #5E7350;
            --sage-light:  #A8C096;
            --terra:       #BE6B4A;
            --terra-dark:  #9E5238;
            --terra-light: #D4896A;
            --mocha:       #7D5C4D;
            --charcoal:    #2E2822;
            --warm-white:  #FDFAF4;
            --sand:        #C9B99A;
        }

        /* ── BASE ──────────────────────────────────────────────── */
        * { box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--warm-white);
            color: var(--charcoal);
            -webkit-font-smoothing: antialiased;
        }
        .font-display { font-family: 'Cormorant Garamond', Georgia, serif; }

        /* ── NAVBAR ─────────────────────────────────────────────── */
        #main-navbar {
            transition: background .35s ease, box-shadow .35s ease, padding .3s ease;
        }
        #main-navbar.scrolled {
            background: rgba(247,242,233,.95) !important;
            backdrop-filter: blur(16px);
            box-shadow: 0 2px 24px rgba(46,40,34,.08);
            padding-top: .6rem;
            padding-bottom: .6rem;
        }
        .nav-link {
            position: relative;
            font-size: .875rem;
            font-weight: 500;
            color: var(--charcoal);
            transition: color .2s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0; bottom: -4px;
            width: 0; height: 2px;
            background: var(--terra);
            border-radius: 2px;
            transition: width .25s ease;
        }
        .nav-link:hover { color: var(--terra); }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link.active { color: var(--terra); }

        /* ── DROPDOWN ───────────────────────────────────────────── */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all .2s ease;
        }
        .dropdown:hover .dropdown-menu,
        .dropdown:focus-within .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* ── CARDS ──────────────────────────────────────────────── */
        .card-product {
            transition: transform .35s cubic-bezier(.34,1.56,.64,1),
                        box-shadow .3s ease;
        }
        .card-product:hover {
            transform: translateY(-8px) scale(1.015);
            box-shadow: 0 24px 48px rgba(46,40,34,.14);
        }
        .card-product:hover .card-img {
            transform: scale(1.08);
        }
        .card-img {
            transition: transform .5s cubic-bezier(.25,.46,.45,.94);
        }

        /* ── GALLERY MASONRY ────────────────────────────────────── */
        .gallery-item {
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .gallery-item:hover {
            transform: scale(1.03);
            box-shadow: 0 16px 40px rgba(46,40,34,.18);
            z-index: 10;
        }
        .gallery-overlay {
            opacity: 0;
            transition: opacity .3s ease;
        }
        .gallery-item:hover .gallery-overlay { opacity: 1; }

        /* ── CAROUSEL ───────────────────────────────────────────── */
        .carousel-track { transition: transform .6s cubic-bezier(.77,0,.175,1); }

        /* ── WHATSAPP FLOAT ─────────────────────────────────────── */
        .wa-float {
            animation: waPulse 2.5s ease infinite;
        }
        @keyframes waPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(37,211,102,.45); }
            50%       { box-shadow: 0 0 0 14px rgba(37,211,102,0); }
        }
        .wa-float:hover {
            transform: scale(1.12) rotate(-5deg);
            transition: transform .25s cubic-bezier(.34,1.56,.64,1);
        }

        /* ── BADGE ──────────────────────────────────────────────── */
        .badge-ready    { background: #d6edda; color: #2d6a4f; }
        .badge-preorder { background: #fef3cd; color: #856404; }

        /* ── TEXTURE ─────────────────────────────────────────────── */
        .bg-linen {
            background-color: var(--cream);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='80' height='80' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        }

        /* ── SCROLLBAR ──────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--cream); }
        ::-webkit-scrollbar-thumb { background: var(--sand); border-radius: 3px; }

        /* ── UTILITIES ──────────────────────────────────────────── */
        .line-clamp-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    </style>
</head>
<body class="antialiased">

{{-- ══════════════════════════════════════════════════════════════════════
     ADMIN PREVIEW BANNER
══════════════════════════════════════════════════════════════════════════ --}}
@if(session('admin_preview') && auth()->check() && auth()->user()->isAdmin())
<div class="bg-[var(--terra)] text-white text-center text-xs py-2 px-4 flex items-center justify-center gap-4 sticky top-0 z-[60]">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
    <span>Anda sedang melihat tampilan Customer sebagai Admin</span>
    <a href="{{ route('admin.dashboard') }}" class="bg-white text-[var(--terra)] text-xs font-bold px-3 py-1 rounded-full hover:bg-[var(--cream)] transition-colors">
        ← Kembali ke Admin
    </a>
</div>
@endif

{{-- ══════════════════════════════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════════════════════════════════ --}}
<header id="main-navbar" class="fixed top-0 left-0 right-0 z-50 bg-transparent px-0 py-4
    {{ session('admin_preview') && auth()->check() && auth()->user()->isAdmin() ? 'top-8' : 'top-0' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">

                    {{-- Jika logo berbentuk lingkaran/icon --}}
                <img src="{{ asset('images/logo.png') }}"
                        alt="Logo Benang & Kasih"
                        class="h-10 w-10 object-contain rounded-full
                                group-hover:scale-105 transition-transform shadow-md">
                <div class="leading-none">
                    <span class="font-display text-xl font-bold text-[var(--charcoal)] block">Benang & Kasih</span>
                    <span class="text-[10px] tracking-[.15em] text-[var(--mocha)] uppercase">Handmade Crochet</span>
                </div>
            </a>

            {{-- DESKTOP NAV --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Galeri</a>
                <a href="#main-footer" class="nav-link hover:text-[var(--terra-light)] transition-colors">Kontak</a>

                {{-- Kategori Dropdown --}}
                <div class="dropdown relative">
                    <button class="nav-link flex items-center gap-1">
                        Kategori
                        <svg class="w-3.5 h-3.5 mt-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-[var(--cream-dark)] py-2 overflow-hidden">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-[var(--cream)] transition-colors text-sm">
                            <span class="text-lg">🧶</span> Semua Koleksi
                        </a>
                        @php $navCats = \App\Models\Category::orderBy('sort_order')->get(); @endphp
                        @foreach($navCats as $nc)
                        <a href="{{ route('home') }}?category={{ $nc->slug }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-[var(--cream)] transition-colors text-sm">
                            <span class="text-lg">{{ $nc->icon }}</span> {{ $nc->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Auth Dropdown --}}
                @auth
                <div class="dropdown relative">
                    <button class="flex items-center gap-2 bg-[var(--cream)] hover:bg-[var(--cream-mid)] px-4 py-2 rounded-full transition-colors">
                        <div class="w-7 h-7 rounded-full bg-[var(--terra)] flex items-center justify-center text-white text-xs font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-[var(--charcoal)] max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu absolute top-full right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-[var(--cream-dark)] py-2">
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-[var(--cream)] text-sm font-medium text-[var(--terra)]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            Dashboard Admin
                        </a>
                        <a href="{{ route('admin.customer.view') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-[var(--cream)] text-sm">
                            <svg class="w-4 h-4 text-[var(--sage)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Lihat Tampilan Customer
                        </a>
                        <div class="border-t border-[var(--cream-dark)] my-1"></div>
                        @endif
                        <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-[var(--cream)] text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 hover:bg-red-50 text-sm text-red-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                    <a href="{{ route('register') }}"
                       class="bg-[var(--terra)] hover:bg-[var(--terra-dark)] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all hover:shadow-md hover:-translate-y-0.5">
                        Daftar
                    </a>
                </div>
                @endauth
            </div>

            {{-- MOBILE MENU BUTTON --}}
            <button id="mobileMenuBtn" class="lg:hidden p-2.5 rounded-xl hover:bg-[var(--cream)] transition-colors" aria-label="Menu">
                <svg id="menuIconOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menuIconClose" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </nav>

        {{-- MOBILE MENU --}}
        <div id="mobileMenu" class="lg:hidden hidden mt-4 bg-white rounded-2xl shadow-xl border border-[var(--cream-dark)] p-4 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[var(--cream)] text-sm font-medium">🏠 Beranda</a>
            <a href="{{ route('gallery') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[var(--cream)] text-sm font-medium">🖼️ Galeri</a>
            <a href="#main-footer" onclick="toggleMenu()" class="block px-3 py-2 rounded-md hover:text-[var(--terra-light)]">☎️ Kontak</a>
            @foreach($navCats as $nc)
            <a href="{{ route('home') }}?category={{ $nc->slug }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[var(--cream)] text-sm">
                {{ $nc->icon }} {{ $nc->name }}
            </a>
            @endforeach
            <div class="border-t border-[var(--cream-dark)] my-2"></div>
            @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[var(--cream)] text-sm font-semibold text-[var(--terra)]">⚙️ Dashboard Admin</a>
                @endif
                <a href="{{ route('customer.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[var(--cream)] text-sm">👤 Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 text-sm text-red-500">🚪 Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-center bg-[var(--cream)] py-3 rounded-xl text-sm font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="block text-center bg-[var(--terra)] text-white py-3 rounded-xl text-sm font-semibold">Daftar Gratis</a>
            @endauth
        </div>
    </div>
</header>

{{-- Spacer for fixed navbar --}}
<div class="h-20 {{ session('admin_preview') && auth()->check() && auth()->user()->isAdmin() ? 'mt-8' : '' }}"></div>

{{-- ══════════════════════════════════════════════════════════════════════
     MAIN CONTENT
══════════════════════════════════════════════════════════════════════════ --}}
<main>
    @if(session('success'))
    <div id="toast-success"
         class="fixed top-24 right-4 z-50 bg-[var(--sage)] text-white px-5 py-3 rounded-2xl shadow-lg flex items-center gap-2 text-sm font-medium"
         style="animation: slideInRight .4s ease">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    <script>setTimeout(()=>{ const t=document.getElementById('toast-success'); if(t){ t.style.animation='slideOutRight .4s ease forwards'; setTimeout(()=>t.remove(),400); }}, 3500);</script>
    @endif

    @yield('content')
</main>

{{-- ══════════════════════════════════════════════════════════════════════
     FLOATING WHATSAPP BUTTON
══════════════════════════════════════════════════════════════════════════ --}}
<a href="https://wa.me/{{ config('shop.whatsapp_number', '6285876177101') }}"
   target="_blank" rel="noopener noreferrer"
   class="wa-float fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full flex items-center justify-center shadow-2xl cursor-pointer"
   style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%)"
   title="Chat via WhatsApp">
    <svg viewBox="0 0 24 24" class="w-8 h-8" fill="white" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
    </svg>
</a>

{{-- ══════════════════════════════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════════════════════════════════ --}}
<footer id="main-footer" class="bg-[var(--charcoal)] text-[var(--cream)] mt-24 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
            {{-- Brand Col --}}
            <div class="md:col-span-4">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-full bg-[var(--terra)] flex items-center justify-center">
                        <div class="w-10 h-10 rounded-full overflow-hidden shadow-md border-2 border-[#D4E2D5]">
                            <img src="{{ asset('images/logo.png') }}"
                                alt="Logo Benang Kasih"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div>
                        <div class="font-display text-xl font-bold text-[var(--terra-light)]">Benang & Kasih</div>
                        <div class="text-[10px] tracking-widest text-[var(--cream-dark)]/60 uppercase">Handmade Crochet</div>
                    </div>
                </div>
                <p class="text-sm text-[var(--cream-dark)]/70 leading-relaxed mb-6">
                    Setiap helai benang dirajut dengan penuh cinta. Produk handmade berkualitas premium, dibuat khusus untukmu.
                </p>
                <a href="https://wa.me/{{ config('shop.whatsapp_number', '6281234567890') }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-colors shadow-md">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Chat WhatsApp
                </a>
            </div>
            {{-- Koleksi --}}
            <div class="md:col-span-3">
                <h4 class="font-display font-semibold text-base mb-4 text-[var(--cream-mid)]">Koleksi</h4>
                <ul class="space-y-2.5 text-sm text-[var(--cream-dark)]/65">
                    @foreach(\App\Models\Category::take(5)->get() as $fc)
                    <li><a href="{{ route('home') }}?category={{ $fc->slug }}" class="hover:text-[var(--terra-light)] transition-colors">{{ $fc->icon }} {{ $fc->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            {{-- Tautan --}}
            <div class="md:col-span-2">
                <h4 class="font-display font-semibold text-base mb-4 text-[var(--cream-mid)]">Tautan</h4>
                <ul class="space-y-2.5 text-sm text-[var(--cream-dark)]/65">
                    <li><a href="{{ route('home') }}" class="hover:text-[var(--terra-light)] transition-colors">Beranda</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-[var(--terra-light)] transition-colors">Galeri</a></li>
                    @auth<li><a href="{{ route('customer.profile') }}" class="hover:text-[var(--terra-light)] transition-colors">Profil</a></li>@endauth
                </ul>
            </div>
            {{-- Info --}}
            <div class="md:col-span-3">
                <h4 class="font-display font-semibold text-base mb-4 text-[var(--cream-mid)]">Info Pemesanan</h4>
                <ul class="space-y-3 text-sm text-[var(--cream-dark)]/65">
                    <li class="flex gap-2"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[var(--sage-light)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Ready Stock kirim 1-2 hari kerja</li>
                    <li class="flex gap-2"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[var(--sage-light)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Pre-Order sesuai estimasi waktu</li>
                    <li class="flex gap-2"><svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[var(--sage-light)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>Custom warna & ukuran tersedia</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-[var(--cream-dark)]/40">
            <span>© {{ date('Y') }} Benang & Kasih — Handmade with ❤️</span>
            @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="hover:text-[var(--terra-light)] transition-colors flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Panel Admin
            </a>
            @endif
        </div>
    </div>
</footer>

{{-- AOS Init + Navbar Scroll + Mobile Menu --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    // AOS
    AOS.init({ duration: 700, easing: 'ease-out-cubic', once: true, offset: 60 });

    // Navbar scroll effect
    const navbar = document.getElementById('main-navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 40);
    });

    // Mobile menu
    const btn   = document.getElementById('mobileMenuBtn');
    const menu  = document.getElementById('mobileMenu');
    const iconO = document.getElementById('menuIconOpen');
    const iconC = document.getElementById('menuIconClose');
    btn?.addEventListener('click', () => {
        const open = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden', open);
        iconO.classList.toggle('hidden', !open);
        iconC.classList.toggle('hidden', open);
    });

    // Toast animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight { from { opacity:0; transform:translateX(30px); } to { opacity:1; transform:translateX(0); } }
        @keyframes slideOutRight { from { opacity:1; transform:translateX(0); } to { opacity:0; transform:translateX(30px); } }
    `;
    document.head.appendChild(style);
</script>

@stack('scripts')
</body>
</html>