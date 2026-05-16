@extends('layouts.app')
@section('title', 'Profil Saya – Benang & Kasih')

@section('content')
<section class="py-16 min-h-[70vh]">
    <div class="max-w-2xl mx-auto px-4">

        {{-- Header Profil --}}
        <div class="text-center mb-10">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-[#C4704F] flex items-center justify-center
                        text-white text-3xl font-bold shadow-lg">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h1 class="text-3xl font-bold text-gray-800" style="font-family:'Playfair Display',serif">
                {{ $user->name }}
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                    {{ $user->isAdmin() ? 'bg-[#C4704F]/10 text-[#C4704F]' : 'bg-green-100 text-green-700' }}">
                    {{ $user->isAdmin() ? '⚙️ Admin' : '👤 Customer' }}
                </span>
            </p>
        </div>

        {{-- Alert Sukses --}}
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-2xl px-5 py-3 mb-6 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Form Edit Profil --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <h2 class="font-bold text-gray-700 text-lg mb-6" style="font-family:'Playfair Display',serif">
                Edit Profil
            </h2>

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-5">
                @foreach($errors->all() as $e)
                <p class="text-sm text-red-600">• {{ $e }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-[#C4704F]/25 focus:border-[#C4704F]
                                  transition-colors">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-[#C4704F]/25 focus:border-[#C4704F]
                                  transition-colors">
                </div>

                {{-- Ganti Password --}}
                <div class="border-t border-gray-100 pt-5">
                    <p class="text-xs text-gray-400 mb-4">
                        Kosongkan kolom password jika tidak ingin mengubahnya.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Password Baru
                            </label>
                            <input type="password" name="password"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                          focus:outline-none focus:ring-2 focus:ring-[#C4704F]/25 focus:border-[#C4704F]"
                                   placeholder="Minimal 8 karakter">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm
                                          focus:outline-none focus:ring-2 focus:ring-[#C4704F]/25 focus:border-[#C4704F]"
                                   placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full bg-[#C4704F] hover:bg-[#A85A3A] text-white font-semibold
                               py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Tombol Admin (khusus role admin) --}}
        @if($user->isAdmin())
        <div class="mt-5 bg-[#C4704F]/5 border border-[#C4704F]/20 rounded-2xl p-5
                    flex items-center justify-between gap-4">
            <div>
                <p class="font-semibold text-[#C4704F] text-sm">Panel Admin</p>
                <p class="text-xs text-gray-500 mt-0.5">Kelola produk, kategori, dan galeri</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="bg-[#C4704F] hover:bg-[#A85A3A] text-white text-sm font-semibold
                      px-5 py-2.5 rounded-xl transition-colors flex-shrink-0">
                Buka Dashboard →
            </a>
        </div>
        @endif

        {{-- Tombol Kembali --}}
        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-[#C4704F] transition-colors">
                ← Kembali ke Beranda
            </a>
        </div>

    </div>
</section>
@endsection