<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar – Benang & Kasih</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Cormorant Garamond', serif; }
        .bg-linen {
            background-color: #F7F2E9;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%238A9E7A' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .input-field {
            width:100%; border:1.5px solid #E3D9C6; border-radius:12px;
            padding:12px 16px; font-size:.875rem; background:white;
            transition: border-color .2s, box-shadow .2s; outline:none;
        }
        .input-field:focus { border-color:#8A9E7A; box-shadow: 0 0 0 4px rgba(138,158,122,.12); }
        .btn-main {
            width:100%; background: linear-gradient(135deg, #8A9E7A, #6B7F5C);
            color:white; font-weight:600; padding:14px; border-radius:12px;
            border:none; cursor:pointer; font-size:.9rem;
            transition: all .2s; font-family:'DM Sans',sans-serif;
        }
        .btn-main:hover { transform:translateY(-1px); box-shadow:0 8px 24px rgba(138,158,122,.35); }
        .float-anim { animation: floatUp 4s ease-in-out infinite; }
        @keyframes floatUp { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        .step-item { transition: all .3s; }
    </style>
</head>
<body class="min-h-screen bg-linen flex">

    {{-- ── KIRI: Dekorasi Sage Green ── --}}
    <div class="hidden lg:flex lg:w-5/12 relative overflow-hidden items-center justify-center"
         style="background: linear-gradient(145deg, #4a5e3a 0%, #6B7F5C 50%, #4a5e3a 100%)">

        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%">
                <defs>
                    <pattern id="knit" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M20 5 Q25 10 20 15 Q15 20 20 25 Q25 30 20 35" stroke="white" stroke-width="1" fill="none"/>
                        <path d="M10 0 Q15 5 10 10 Q5 15 10 20 Q15 25 10 30 Q5 35 10 40" stroke="white" stroke-width="0.8" fill="none"/>
                        <path d="M30 0 Q35 5 30 10 Q25 15 30 20 Q35 25 30 30 Q25 35 30 40" stroke="white" stroke-width="0.8" fill="none"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#knit)"/>
            </svg>
        </div>

        <div class="relative z-10 px-10 text-center">
            <div class="float-anim w-24 h-24 mx-auto mb-6 bg-white/10 rounded-full flex items-center justify-center">
                <svg viewBox="0 0 80 80" fill="none" class="w-14 h-14">
                    <circle cx="40" cy="40" r="36" stroke="rgba(255,255,255,.3)" stroke-width="1.5"/>
                    <path d="M25 40c0-8.284 6.716-15 15-15s15 6.716 15 15" stroke="white" stroke-width="3" stroke-linecap="round"/>
                    <path d="M18 45c0-12.15 9.85-22 22-22s22 9.85 22 22" stroke="rgba(255,255,255,.4)" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="3 3"/>
                    <circle cx="40" cy="44" r="5" fill="white"/>
                </svg>
            </div>

            <h2 class="font-display text-3xl font-bold text-white mb-3">Bergabung Yuk!</h2>
            <p class="text-white/60 text-sm leading-relaxed mb-8">
                Buat akun gratis dan nikmati pengalaman belanja rajutan handmade yang menyenangkan
            </p>

            {{-- Benefits --}}
            <div class="space-y-3 text-left">
                @foreach([
                    ['✓', 'Akses profil & riwayat akun'],
                    ['✓', 'Notifikasi koleksi terbaru'],
                    ['✓', 'Pesan langsung via WhatsApp'],
                    ['✓', 'Gratis selamanya!'],
                ] as $b)
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-2.5">
                    <span class="text-green-300 font-bold text-sm">{{ $b[0] }}</span>
                    <span class="text-white/80 text-sm">{{ $b[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── KANAN: Form Register ── --}}
    <div class="w-full lg:w-7/12 flex items-center justify-center px-6 py-10 overflow-y-auto">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="flex items-center gap-3 mb-6 lg:hidden">
                <div class="w-9 h-9 rounded-full bg-[#8A9E7A] flex items-center justify-center">
                    <svg viewBox="0 0 36 36" fill="none" class="w-5 h-5">
                        <path d="M12 18c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="18" cy="21" r="2.5" fill="white"/>
                    </svg>
                </div>
                <span class="font-display text-lg font-bold text-gray-800">Benang & Kasih</span>
            </div>

            <div class="mb-7">
                <h1 class="font-display text-4xl font-bold text-gray-800 mb-1.5">Buat Akun</h1>
                <p class="text-gray-500 text-sm">Isi data di bawah untuk mendaftar — gratis!</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="input-field @error('name') !border-red-400 @enderror"
                           placeholder="Nama kamu">
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="input-field @error('email') !border-red-400 @enderror"
                           placeholder="nama@email.com">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input id="pass1" type="password" name="password" required
                               class="input-field pr-12 @error('password') !border-red-400 @enderror"
                               placeholder="Minimal 8 karakter"
                               oninput="checkStrength(this.value)">
                        <button type="button" onclick="togglePass('pass1','eye1a','eye1b')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg id="eye1a" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye1b" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    {{-- Password strength --}}
                    <div class="mt-2 flex gap-1" id="strengthBars">
                        <div class="strength-bar h-1 flex-1 rounded-full bg-gray-200 transition-colors" id="bar1"></div>
                        <div class="strength-bar h-1 flex-1 rounded-full bg-gray-200 transition-colors" id="bar2"></div>
                        <div class="strength-bar h-1 flex-1 rounded-full bg-gray-200 transition-colors" id="bar3"></div>
                        <div class="strength-bar h-1 flex-1 rounded-full bg-gray-200 transition-colors" id="bar4"></div>
                    </div>
                    <p id="strengthText" class="text-xs text-gray-400 mt-1"></p>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input id="pass2" type="password" name="password_confirmation" required
                               class="input-field pr-12"
                               placeholder="Ulangi password">
                        <button type="button" onclick="togglePass('pass2','eye2a','eye2b')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg id="eye2a" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye2b" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-main mt-2">
                    Buat Akun Sekarang 🎉
                </button>
            </form>

            <div class="flex items-center gap-4 my-5">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-xs text-gray-400">Sudah punya akun?</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <a href="{{ route('login') }}"
               class="flex items-center justify-center gap-2 w-full border-2 border-[#E3D9C6]
                      hover:border-[#C4704F] hover:bg-[#FDF8F5] text-gray-700 font-semibold
                      py-3.5 rounded-xl transition-all text-sm">
                <svg class="w-4 h-4 text-[#C4704F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk ke Akun
            </a>

            <div class="text-center mt-5">
                <a href="{{ route('home') }}"
                   class="text-xs text-gray-400 hover:text-[#8A9E7A] transition-colors inline-flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
<script>
function togglePass(id, eyeA, eyeB) {
    const input = document.getElementById(id);
    const isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    document.getElementById(eyeA).classList.toggle('hidden', isPass);
    document.getElementById(eyeB).classList.toggle('hidden', !isPass);
}

function checkStrength(val) {
    const bars   = [1,2,3,4].map(i => document.getElementById('bar'+i));
    const text   = document.getElementById('strengthText');
    const colors = ['bg-red-400','bg-orange-400','bg-yellow-400','bg-green-500'];
    const labels = ['','Lemah','Cukup','Kuat','Sangat Kuat'];
    let score = 0;
    if (val.length >= 8)              score++;
    if (/[A-Z]/.test(val))            score++;
    if (/[0-9]/.test(val))            score++;
    if (/[^A-Za-z0-9]/.test(val))     score++;
    bars.forEach((b, i) => {
        b.className = 'h-1 flex-1 rounded-full transition-colors ' +
            (i < score ? colors[score-1] : 'bg-gray-200');
    });
    text.textContent = val.length > 0 ? labels[score] || 'Lemah' : '';
    text.className   = 'text-xs mt-1 ' +
        (score <= 1 ? 'text-red-400' : score === 2 ? 'text-orange-400' : score === 3 ? 'text-yellow-500' : 'text-green-500');
}
</script>
</html>