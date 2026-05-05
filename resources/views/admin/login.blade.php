<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Admin — KSPM SV IPB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Card Login -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-8 py-8 text-center">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <span class="text-blue-800 font-extrabold text-2xl">K</span>
                </div>
                <h1 class="text-white font-bold text-xl">KSPM SV IPB</h1>
                <p class="text-blue-200 text-sm mt-1">Admin Dashboard</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-8">
                <h2 class="text-gray-800 font-bold text-lg mb-1">Selamat Datang 👋</h2>
                <p class="text-gray-400 text-sm mb-6">Masuk untuk mengelola dashboard admin.</p>

                <!-- Alert Error -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-5 text-sm flex items-start gap-2">
                        <span class="mt-0.5">⚠️</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Alert Session -->
                @if (session('status'))
                    <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-5 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf

                    <!-- Username -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                            Username
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">👤</span>
                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username admin"
                                required
                                autofocus
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition @error('username') border-red-400 bg-red-50 @enderror"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">🔒</span>
                            <input
                                type="password"
                                name="password"
                                id="password-input"
                                placeholder="Masukkan password"
                                required
                                class="w-full pl-10 pr-12 py-3 border border-gray-200 rounded-xl bg-gray-50 text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition"
                            />
                            <!-- Toggle show/hide password -->
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-sm"
                                id="toggle-btn"
                            >👁️</button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2 mb-6">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-gray-300 text-blue-600 cursor-pointer">
                        <label for="remember" class="text-sm text-gray-500 cursor-pointer">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="w-full bg-blue-800 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 text-sm"
                    >
                        🔑 Masuk ke Dashboard
                    </button>
                </form>
            </div>

            <!-- Footer Card -->
            <div class="bg-gray-50 border-t border-gray-100 px-8 py-4 text-center">
                <p class="text-xs text-gray-400">
                    Hanya untuk administrator KSPM SV IPB. <br>
                    Hubungi IT jika lupa password.
                </p>
            </div>
        </div>

        <p class="text-center text-blue-300 text-xs mt-6">
            © {{ date('Y') }} KSPM SV IPB — All rights reserved
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password-input');
            const btn = document.getElementById('toggle-btn');
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁️';
            }
        }
    </script>

</body>
</html>