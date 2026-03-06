<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

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
                            ⚡ Crée ton compte !
                        </h3>
                        <p class="text-gray-300 mb-8">
                            Rejoins la communauté et commence ton aventure !
                        </p>

                        <!-- Boutons -->
                        <div class="space-y-4">
                            <!-- Steam -->
                            <a href="#" onclick="window.open('{{ route('steam.register') }}', 'steam_popup', 'width=600,height=700,left=100,top=100'); return false;" class="flex items-center justify-center w-full px-4 py-3 bg-[#1b2838] hover:bg-[#2a475e] text-white font-semibold rounded-lg transition-all duration-200 border border-[#66c0f4]/30 hover:border-[#66c0f4]/60 hover:shadow-lg hover:shadow-[#66c0f4]/20 hover:-translate-y-0.5 cursor-pointer">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Steam" class="w-8 h-8 mr-3">
                                <span>S'inscrire avec Steam</span>
                            </a>

                            <!-- Epic Games (Coming Soon) -->
                            <div class="flex items-center justify-center w-full px-4 py-3 bg-[#2f2d2e] text-gray-400 font-semibold rounded-lg border border-[#da3333]/30 opacity-60 cursor-not-allowed">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/Epic_Games_logo.svg" alt="Epic Games" class="w-8 h-8 mr-3 opacity-50">
                                <span>Epic Games - Coming Soon</span>
                            </div>
                        </div>

                        <p class="mt-8 text-xs text-gray-500">
                            En t'inscrivant, tu acceptes nos conditions d'utilisation
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
