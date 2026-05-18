<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – Benang & Kasih</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --sidebar:#2C2420; --terra:#C4704F; --sage:#8A9E7A; --cream:#F5F0E8; --charcoal:#3D3530; }
        body { font-family:'DM Sans',sans-serif; }
        .font-serif { font-family:'Cormorant Garamond',Georgia,serif; }
        .sidebar-link { transition:all .2s; border-radius:.75rem; }
        .sidebar-link:hover, .sidebar-link.active { background:rgba(196,112,79,.15); color:#C4704F; }

        /* ── MOBILE SIDEBAR OVERLAY ── */
        #sidebarOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 40;
            backdrop-filter: blur(2px);
        }
        #sidebarOverlay.active { display: block; }

        /* Mobile sidebar slide in */
        @media (max-width: 1023px) {
            #adminSidebar {
                position: fixed;
                top: 0; left: 0; bottom: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform .3s cubic-bezier(.4,0,.2,1);
                width: 16rem !important;
            }
            #adminSidebar.open { transform: translateX(0); }
            #adminMain { margin-left: 0 !important; }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

{{-- Overlay mobile --}}
<div id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="flex min-h-screen">

    {{-- ── SIDEBAR ── --}}
    <aside id="adminSidebar"
           class="w-64 flex-shrink-0 flex flex-col shadow-2xl"
           style="background:var(--sidebar)">

        {{-- Logo --}}
        <div class="p-5 border-b border-white/10 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full bg-[var(--terra)] flex items-center justify-center flex-shrink-0">
                     <img src="{{ asset('images/logo.png') }}" 
                        alt="Logo Benang Kasih" 
                        class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="font-serif text-white font-bold text-sm">Benang & Kasih</div>
                    <div class="text-[10px] text-white/40 tracking-wider">Admin Panel</div>
                </div>
            </a>
            {{-- Close button mobile --}}
            <button onclick="closeSidebar()" class="lg:hidden text-white/60 hover:text-white p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-3 space-y-0.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-white/70 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.products') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-white/70 text-sm font-medium {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg>
                Produk
            </a>
            <a href="{{ route('admin.categories') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-white/70 text-sm font-medium {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                Kategori
            </a>
            <a href="{{ route('admin.gallery') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-white/70 text-sm font-medium {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Galeri Foto
            </a>

            <div class="border-t border-white/10 my-2"></div>
            
            <a href="{{ route('home') }}" target="_blank"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-white/70 text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Website
            </a>
            <a href="{{ route('admin.customer.view') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 text-white/70 text-sm font-medium">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Tampilan Customer
            </a>
        </nav>

        {{-- User --}}
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[var(--terra)] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/40 text-xs hover:text-white transition-colors">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ── --}}
    <div id="adminMain" class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-gray-200 px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3 min-w-0">
                {{-- Hamburger mobile --}}
                <button onclick="openSidebar()"
                        class="lg:hidden p-2 rounded-xl hover:bg-gray-100 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="font-serif text-lg sm:text-xl font-bold text-gray-800 truncate">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            {{-- Right side: actions --}}
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                @if(session('success'))
                <span class="hidden sm:flex items-center gap-1.5 bg-green-100 text-green-700 text-xs px-3 py-1.5 rounded-full font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </span>
                @endif

                {{-- Quick actions --}}
                <a href="{{ route('admin.products.create') }}"
                   class="hidden sm:flex items-center gap-1.5 bg-[var(--terra)] hover:bg-[#A85A3A] text-white text-xs font-semibold px-3 py-2 rounded-xl transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Produk
                </a>

                {{-- Avatar --}}
                <div class="w-8 h-8 rounded-full bg-[var(--terra)] flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Toast mobile --}}
        @if(session('success'))
        <div class="sm:hidden bg-green-50 border-b border-green-200 px-4 py-2 flex items-center gap-2 text-green-700 text-xs">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            @yield('admin-content')
        </main>
    </div>
</div>

<script>
function openSidebar() {
    document.getElementById('adminSidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('adminSidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('active');
    document.body.style.overflow = '';
}
// Close on ESC
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSidebar(); });
</script>

</body>
</html>