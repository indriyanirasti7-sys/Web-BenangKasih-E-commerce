{{-- resources/views/customer/profile.blade.php --}}
@extends('layouts.app')
@section('title', 'Profil Saya – Benang & Kasih')

@section('content')
<section class="py-16 min-h-[70vh]">
    <div class="max-w-2xl mx-auto px-4">
        <div class="text-center mb-10" data-aos="fade-down">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-[var(--terra)] flex items-center justify-center text-white text-3xl font-display font-bold shadow-lg">
                {{ substr($user->name, 0, 1) }}
            </div>
            <h1 class="font-display text-3xl font-bold text-[var(--charcoal)]">{{ $user->name }}</h1>
            <p class="text-[var(--mocha)] text-sm mt-1">
                <span class="inline-flex items-center gap-1 bg-{{ $user->isAdmin() ? '[var(--terra)]' : '[var(--sage)]' }}/10 text-{{ $user->isAdmin() ? '[var(--terra)]' : '[var(--sage-dark)]' }} px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $user->isAdmin() ? '⚙️ Admin' : '👤 Customer' }}
                </span>
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-[var(--cream-dark)] p-8" data-aos="fade-up">
            <h2 class="font-display text-xl font-bold text-[var(--charcoal)] mb-6">Edit Profil</h2>

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-5">
                @foreach($errors->all() as $e)<p class="text-sm text-red-600">{{ $e }}</p>@endforeach
            </div>
            @endif

            <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-5">
                @csrf @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-[var(--charcoal)] mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full border border-[var(--cream-dark)] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--terra)]/25 focus:border-[var(--terra)]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[var(--charcoal)] mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full border border-[var(--cream-dark)] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--terra)]/25 focus:border-[var(--terra)]">
                </div>
                <div class="border-t border-[var(--cream-dark)] pt-5">
                    <p class="text-xs text-[var(--mocha)] mb-4">Kosongkan password jika tidak ingin mengubahnya.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[var(--charcoal)] mb-1.5">Password Baru</label>
                            <input type="password" name="password"
                                   class="w-full border border-[var(--cream-dark)] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--terra)]/25">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[var(--charcoal)] mb-1.5">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full border border-[var(--cream-dark)] rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--terra)]/25">
                        </div>
                    </div>
                </div>
                <button type="submit"
                        class="w-full bg-[var(--terra)] hover:bg-[var(--terra-dark)] text-white font-semibold py-3.5 rounded-xl transition-colors shadow-md">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        @if($user->isAdmin())
        <div class="mt-6 bg-[var(--terra)]/5 border border-[var(--terra)]/20 rounded-2xl p-5 flex items-center justify-between" data-aos="fade-up">
            <div>
                <div class="font-semibold text-[var(--terra)] text-sm">Panel Admin</div>
                <div class="text-xs text-[var(--mocha)]">Kelola produk dan katalog</div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-[var(--terra)] text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-[var(--terra-dark)] transition-colors">
                Buka Dashboard →
            </a>
        </div>
        @endif
    </div>
</section>
@endsection