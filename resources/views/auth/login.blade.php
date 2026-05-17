<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#FDFBF7] py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-2xl border border-[#EFEAE2] shadow-[0_8px_30px_rgb(229,220,205,0.4)] relative overflow-hidden">
            
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#E8EFE9] rounded-full blur-xl opacity-70"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#F5EFE6] rounded-full blur-xl opacity-70"></div>

            <div class="relative text-center">
                {{-- GANTI bagian div icon tersebut dengan ini --}}
                <div class="mx-auto h-16 w-16 rounded-full overflow-hidden shadow-md">
                    <img src="{{ asset('images/logo.png') }}"
                        alt="Logo Benang Kasih"
                        class="w-full h-full object-cover">
                </div>
                <h2 class="mt-4 text-center text-2xl sm:text-3xl font-bold text-[#5C4033] tracking-tight">
                    Selamat Datang Kembali
                </h2>
                <p class="mt-1.5 text-center text-sm text-[#8C7A6B]">
                    Silakan masuk ke akun <span class="font-semibold text-[#4A6B51]">Benang Kasih</span> Anda
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="mt-8 space-y-5 relative" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-[#5C4033]">
                        Alamat Email
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               class="block w-full px-4 py-3 bg-[#FAFAF8] border border-[#E1DCD6] text-[#5C4033] placeholder-[#A3978E] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4A6B51] focus:border-[#4A6B51] transition-all sm:text-sm"
                               placeholder="nama@email.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-[#5C4033]">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               class="block w-full px-4 py-3 bg-[#FAFAF8] border border-[#E1DCD6] text-[#5C4033] placeholder-[#A3978E] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4A6B51] focus:border-[#4A6B51] transition-all sm:text-sm"
                               placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               class="h-4 w-4 text-[#4A6B51] focus:ring-[#4A6B51] border-[#E1DCD6] rounded-md bg-[#FAFAF8] cursor-pointer">
                        <label for="remember_me" class="ms-2 block text-sm text-[#8C7A6B] cursor-pointer select-none">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-[#4A6B51] hover:text-[#3B5440] hover:underline transition-all">
                                Lupa kata sandi?
                            </a>
                        </div>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-[#4A6B51] hover:bg-[#3B5440] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4A6B51] shadow-md shadow-[#4A6B51]/20 transform active:scale-[0.98] transition-all duration-150">
                        Masuk Masuk ✨
                    </button>
                </div>
            </form>
            
            <div class="text-center text-xs text-[#BCB2A6] pt-2">
                &copy; {{ date('Y') }} Benang Kasih - Handmade Crochet.
            </div>
        </div>
    </div>
</x-guest-layout>