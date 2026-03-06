<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Bouton ouvrir popup auth -->
    <div class="mt-6 text-center">
        <button type="button" onclick="openAuthPopup()" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Connexion rapide
        </button>
    </div>

    <!-- Popup d'authentification -->
    <div id="auth-popup" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeAuthPopup()"></div>

        <!-- Modal centré -->
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative w-full max-w-md transform overflow-hidden rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 text-left shadow-2xl transition-all border border-gray-700 p-8">
                    <!-- Close button -->
                    <button type="button" onclick="closeAuthPopup()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Content -->
                    <div class="text-center">
                        <!-- Logo -->
                        <div class="mb-6">
                            <span style="font-family: 'Orbitron', sans-serif; font-weight: 700; font-size: 2rem; color: #F77F00; text-shadow: 0 0 20px #F77F00;">
                                LOOTER<span style="color: #E63946;">STRIKE</span>
                            </span>
                        </div>

                        <!-- Texte accrocheur -->
                        <h3 class="text-2xl font-bold text-white mb-2">
                            🔥 Rejoins l'élite !
                        </h3>
                        <p class="text-gray-300 mb-8">
                            Connecte-toi avec ta plateforme préférée et commence à looter !
                        </p>

                        <!-- Boutons -->
                        <div class="space-y-4">
                            <!-- Steam -->
                            <a href="#" onclick="window.open('{{ route('steam.login') }}', 'steam_popup', 'width=600,height=700,left=100,top=100'); return false;" class="flex items-center justify-center w-full px-4 py-3 bg-[#1b2838] hover:bg-[#2a475e] text-white font-semibold rounded-lg transition-all duration-200 border border-[#66c0f4]/30 hover:border-[#66c0f4]/60 hover:shadow-lg hover:shadow-[#66c0f4]/20 hover:-translate-y-0.5 cursor-pointer">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Steam" class="w-8 h-8 mr-3">
                                <span>Se connecter avec Steam</span>
                            </a>

                            <!-- Epic Games (Coming Soon) -->
                            <div class="flex items-center justify-center w-full px-4 py-3 bg-[#2f2d2e] text-gray-400 font-semibold rounded-lg border border-[#da3333]/30 opacity-60 cursor-not-allowed">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/Epic_Games_logo.svg" alt="Epic Games" class="w-8 h-8 mr-3 opacity-50">
                                <span>Epic Games - Coming Soon</span>
                            </div>
                        </div>

                        <p class="mt-8 text-xs text-gray-500">
                            En te connectant, tu acceptes nos conditions d'utilisation
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAuthPopup() {
            document.getElementById('auth-popup').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeAuthPopup() {
            document.getElementById('auth-popup').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Fermer avec Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAuthPopup();
        });
    </script>
</x-guest-layout>
