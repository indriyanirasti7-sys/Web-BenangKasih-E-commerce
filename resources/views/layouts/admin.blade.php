<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – Benang & Kasih</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --cream:#F5F0E8; --sage:#8A9E7A; --terra:#C4704F; --mocha:#8B6355; --charcoal:#3D3530; --sidebar:#2C2420; }
        body { font-family: 'DM Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', Georgia, serif; }
        .sidebar-link { transition: all .2s; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(196,112,79,.15); color: #C4704F; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- ─── SIDEBAR ─── --}}
    <aside class="w-64 flex-shrink-0 flex flex-col" style="background:var(--sidebar)">
        {{-- Logo --}}
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🧶</span>
                <div>
                    <div class="font-serif text-white font-bold">Benang & Kasih</div>
                    <div class="text-xs text-white/40 tracking-wider">Admin Panel</div>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="{{ route('admin.products') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <span>🧶</span> Produk
            </a>
            <a href="{{ route('admin.categories') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 text-sm font-medium {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <span>🏷️</span> Kategori
            </a>
            <div class="border-t border-white/10 my-2"></div>
            <a href="{{ route('home') }}" target="_blank"
               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 text-sm font-medium">
                <span>🌐</span> Lihat Website
            </a>
        </nav>

        {{-- User --}}
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[var(--terra)] flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <div class="text-white text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       class="text-white/40 text-xs hover:text-white transition-colors">Keluar</a>
                </div>
            </div>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
        </div>
    </aside>

    {{-- ─── MAIN ─── --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Top bar --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
            <h1 class="font-serif text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-3">
                @if(session('success'))
                <span class="bg-green-100 text-green-700 text-sm px-4 py-1.5 rounded-full">✅ {{ session('success') }}</span>
                @endif
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-8">
            @yield('admin-content')
        </main>
    </div>
</div>

</body>
</html>