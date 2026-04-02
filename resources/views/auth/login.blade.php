<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white">Selamat Datang Kembali!</h2>
        <p class="text-gray-400 text-sm mt-2">Silakan masuk untuk mulai memesan Rice Bowl favoritmu.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-semibold" />
            <x-text-input id="email" 
                class="block mt-1 w-full bg-[#2a2a2a] border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400 rounded-xl shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required autofocus 
                autocomplete="username" 
                placeholder="Masukkan email kamu" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300 font-semibold" />
            <x-text-input id="password" 
                class="block mt-1 w-full bg-[#2a2a2a] border-gray-700 text-white focus:border-yellow-400 focus:ring-yellow-400 rounded-xl shadow-sm"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-5">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-[#2a2a2a] border-gray-700 text-yellow-500 shadow-sm focus:ring-yellow-400" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-yellow-400 hover:text-yellow-300 font-medium transition" href="{{ route('password.request') }}">
                    {{ __('Lupa sandi?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-yellow-400 border border-transparent rounded-xl font-bold text-sm text-black uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200 shadow-lg shadow-yellow-400/20">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>

        <div class="mt-6 flex items-center" data-oauth-button style="display: {{ $isOnlineMode ? 'flex' : 'none' }}">
            <div class="flex-1 border-t border-gray-700"></div>
            <span class="px-4 text-sm text-gray-400">atau</span>
            <div class="flex-1 border-t border-gray-700"></div>
        </div>

        <div class="mt-6" data-oauth-button style="display: {{ $isOnlineMode ? 'block' : 'none' }}">
            <a href="{{ route('auth.google') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-white border border-gray-300 rounded-xl font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-md">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                {{ __('Masuk dengan Google') }}
            </a>
        </div>
        
        <div class="mt-6 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl" data-offline-notice style="display: {{ $isOfflineMode ? 'block' : 'none' }}">
            <div class="flex items-center gap-2 text-yellow-400 text-sm">
                <i class="fas fa-wifi-slash"></i>
                <span>Mode Offline - Google OAuth tidak tersedia</span>
            </div>
        </div>

        <div class="mt-6 text-center text-sm text-gray-400">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 font-bold underline transition">
                Daftar Gratis
            </a>
        </div>
    </form>
</x-guest-layout>