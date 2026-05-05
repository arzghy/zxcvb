<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — KSPM SV IPB</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: "JetBrains Mono", monospace; }

        /* Background foto IPB dipanggil dari folder public/images */
        .bg-photo {
            position: fixed; inset: 0; z-index: 0;
            background: url("{{ asset('images/bg-ipb.jpg') }}") center/cover no-repeat;
        }

        /* Overlay transparan agar form tetap terbaca jelas */
        .bg-overlay {
            position: fixed; inset: 0; z-index: 1;
            background: linear-gradient(135deg, rgba(10,15,46,0.88) 0%, rgba(13,26,110,0.80) 40%, rgba(26,47,181,0.70) 70%, rgba(37,99,235,0.65) 100%);
        }

        .bg-grid {
            position: fixed; inset: 0; z-index: 2;
            background-image: radial-gradient(rgba(255,255,255,0.07) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Animasi */
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(40px) scale(.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes logoPop {
            from { opacity: 0; transform: scale(0.55) rotate(-8deg); }
            to { opacity: 1; transform: scale(1) rotate(0deg); }
        }
        @keyframes ringPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.6; }
        }

        .animate-card-in { animation: cardIn .65s cubic-bezier(.4,0,.2,1) both; }
        .animate-logo-pop { animation: logoPop .6s .25s cubic-bezier(.4,0,.2,1) both; }
        .animate-ring-pulse { animation: ringPulse 6s ease-in-out infinite; }

        .ring3 {
            position: fixed; z-index: 3; width: 160px; height: 160px; top: 50%; left: 50%;
            transform: translate(-50%, -50%); border-radius: 50%;
            border: 1px solid rgba(96,165,250,0.1); pointer-events: none;
        }

        .btn-gradient { background: linear-gradient(135deg, #0d1a6e 0%, #1a2fb5 50%, #2563eb 100%); }
        .btn-gradient:hover { background: linear-gradient(135deg, #1a2fb5 0%, #2563eb 50%, #3b82f6 100%); }
        .card-shadow { box-shadow: 0 40px 100px rgba(0,0,0,0.45), 0 0 0 1px rgba(255,255,255,0.15); }
        .inp:focus { border-color: #1a2fb5; box-shadow: 0 0 0 4px rgba(26,47,181,0.09); outline: none; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center overflow-hidden relative bg-[#0d0f1a]">

    <!-- Backgrounds (Ini yang tadi tertinggal) -->
    <div class="bg-photo"></div>
    <div class="bg-overlay"></div>
    <div class="bg-grid"></div>

    <!-- Dekoratif rings -->
    <div class="fixed z-[3] w-[400px] h-[400px] -top-[150px] -right-[120px] rounded-full border border-white/[0.08] pointer-events-none animate-ring-pulse"></div>
    <div class="fixed z-[3] w-[280px] h-[280px] -bottom-[80px] -left-[80px] rounded-full border border-white/[0.08] pointer-events-none animate-ring-pulse" style="animation-delay: 3s"></div>
    <div class="ring3" style="animation-delay: 4s"></div>

    <!-- Main content -->
    <div class="relative z-10 flex flex-col items-center gap-4 px-4 py-5 w-full">
        
        <div class="w-full max-w-[460px] animate-card-in">
            <div class="bg-white/[0.97] backdrop-blur-2xl rounded-[28px] p-10 card-shadow" id="login-card">

                <!-- Logo -->
                <div class="text-center mb-7">
                    <div class="w-[100px] h-[100px] bg-white rounded-[22px] flex items-center justify-center mx-auto mb-4 shadow-lg p-2 animate-logo-pop border-2 border-blue-800/10">
                        <span class="text-3xl font-bold text-blue-800">KSPM</span>
                    </div>
                    <div class="text-[1.5rem] font-extrabold text-gray-900 tracking-tight">KSPM SV IPB</div>
                    <div class="text-[.78rem] text-gray-500 mt-1 font-medium">Klub Studi Pasar Modal — Sekolah Vokasi IPB University</div>
                    <div class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-800 text-[.68rem] font-bold px-3 py-1 rounded-full mt-2 border border-blue-800/15 tracking-wide">
                        🔐 Admin Panel
                    </div>
                </div>

                <!-- Divider -->
                <div class="flex items-center gap-2.5 mb-5">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-[.7rem] font-bold text-gray-400 uppercase tracking-[.08em] whitespace-nowrap">Masuk ke Dashboard</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Form Laravel -->
                <form action="{{ url('/admin/login') }}" method="POST">
                    @csrf
                    
                    <!-- Alert jika login gagal / Error Validasi -->
                    @if ($errors->any())
                        <div class="flex items-center gap-2 bg-red-100 text-red-800 border border-red-300 rounded-[10px] px-4 py-3 text-[.82rem] font-semibold mb-3.5">
                            <span>⛔</span>
                            <span>Username atau password salah!</span>
                        </div>
                    @endif

                    <!-- Username -->
                    <div class="mb-4">
                        <label class="flex items-center gap-1.5 text-[.75rem] font-bold text-gray-500 uppercase tracking-[.06em] mb-1.5">
                            <span>👤</span> Username
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[.9rem] text-gray-400 pointer-events-none">@</span>
                            <input type="text" name="username" value="{{ old('username') }}" required
                                placeholder="Masukkan username admin"
                                class="inp w-full pl-11 pr-3.5 py-3 border-[1.5px] border-gray-200 rounded-xl text-[.9rem] bg-gray-50 transition-all text-gray-900"/>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="flex items-center gap-1.5 text-[.75rem] font-bold text-gray-500 uppercase tracking-[.06em] mb-1.5">
                            <span>🔒</span> Password
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[.9rem] text-gray-400 pointer-events-none">🔑</span>
                            <input type="password" name="password" id="inp-password" required
                                placeholder="Masukkan password"
                                class="inp w-full pl-11 pr-12 py-3 border-[1.5px] border-gray-200 rounded-xl text-[.9rem] bg-gray-50 transition-all text-gray-900"/>
                            <button type="button" onclick="const pw=document.getElementById('inp-password'); pw.type=pw.type==='password'?'text':'password';"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[.9rem] text-gray-400 hover:text-blue-800 transition-colors bg-transparent border-none cursor-pointer p-0.5">👁</button>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit"
                        class="btn-gradient relative w-full py-3.5 rounded-[14px] border-none cursor-pointer text-white font-bold text-[.95rem] transition-all flex items-center justify-center shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                        🔓 Masuk ke Dashboard
                    </button>
                </form>

                <!-- Footer -->
                <div class="text-center mt-5 text-[.73rem] text-gray-500 leading-relaxed">
                    Akses hanya untuk <strong class="text-gray-900">Admin KSPM SV IPB</strong><br/>
                    Kendala login? Hubungi <strong class="text-gray-900">Divisi IT KSPM</strong>
                </div>

            </div>
        </div>
    </div>
</body>
</html>