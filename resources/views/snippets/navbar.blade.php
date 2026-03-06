<!-- ============================================================
     NAVBAR
     - Logo Orbitron + liens de navigation + dropdown Tournois
     - Boutons Login (lien) et Register (btn dôme)
     - Affichage utilisateur connecté avec avatar Steam
     - Hamburger responsive Bootstrap
============================================================ -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">LooterStrike</a>

        <!-- Hamburger mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarMain">

            <!-- Liens principaux -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="#upcoming-matches">Matchs</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#">Tournois</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Tournoi A</a></li>
                        <li><a class="dropdown-item" href="#">Tournoi B</a></li>
                        <li><a class="dropdown-item" href="#">Tournoi C</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#watch-live">Live</a></li>
                <li class="nav-item"><a class="nav-link" href="#shop">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="#news">Actualités</a></li>
            </ul>

            <!-- Boutons Login / Register / User -->
            <div class="navbar-buttons">
                @auth
                    <!-- Utilisateur connecté - Avatar dropdown -->
                    <div class="user-menu">
                        <div class="user-trigger d-flex align-items-center gap-2">
                            @if(Auth::user()->epic_id)
                                <!-- Affichage Epic Games -->
                                <span class="text-white">Bienvenue agent</span>
                                <span class="text-white fw-bold">{{ Auth::user()->epic_display_name ?? Auth::user()->name }}</span>
                                <img src="{{ Auth::user()->epic_avatar ?? 'https://placehold.co/40x40/2f2d2e/da3333?text=Epic' }}" 
                                     alt="Avatar Epic" 
                                     class="rounded-circle user-avatar"
                                     style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #da3333;">
                            @else
                                <!-- Affichage Steam -->
                                <span class="text-white">Bienvenue agent</span>
                                <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
                                <img src="{{ Auth::user()->steam_avatar ?? 'https://placehold.co/40x40/1a1a2e/FF6A00?text=?' }}" 
                                     alt="Avatar Steam" 
                                     class="rounded-circle user-avatar"
                                     style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--primary-color);">
                            @endif
                        </div>
                        <div class="user-dropdown">
                            <div class="user-dropdown-header">
                                @if(Auth::user()->epic_id)
                                    <img src="{{ Auth::user()->epic_avatar ?? 'https://placehold.co/60x60/2f2d2e/da3333?text=Epic' }}" 
                                         alt="Avatar Epic" 
                                         class="rounded-circle"
                                         style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #da3333;">
                                    <div class="user-dropdown-info">
                                        <span class="fw-bold">{{ Auth::user()->epic_display_name ?? Auth::user()->name }}</span>
                                        <small class="text-muted">Agent Epic Games</small>
                                    </div>
                                @else
                                    <img src="{{ Auth::user()->steam_avatar ?? 'https://placehold.co/60x60/1a1a2e/FF6A00?text=?' }}" 
                                         alt="Avatar Steam" 
                                         class="rounded-circle"
                                         style="width: 60px; height: 60px; object-fit: cover; border: 2px solid var(--primary-color);">
                                    <div class="user-dropdown-info">
                                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                                        <small class="text-muted">Agent Steam</small>
                                    </div>
                                @endif
                            </div>
                            <div class="user-dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="user-dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Boutons Login et Register - Ouverture directe du popup -->
                    <button type="button" class="nav-link btn-login" onclick="openAuthPopup()">Login</button>
                    <button type="button" class="btn-dome" onclick="openAuthPopup()"><span>Register</span></button>
                @endauth
            </div>

        </div>
    </div>
</nav>

<!-- Popup d'authentification (disponible sur toutes les pages) -->
<div id="auth-popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
    <!-- Overlay -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85);" onclick="closeAuthPopup()"></div>

    <!-- Modal centré -->
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; max-width: 420px; padding: 2rem; box-sizing: border-box;">
        <div style="position: relative; background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-radius: 1rem; padding: 2.5rem; width: 100%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border: 1px solid #374151;">
            <!-- Close button -->
            <button type="button" onclick="closeAuthPopup()" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0.5rem;">
                <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Content -->
            <div style="text-align: center;">
                <!-- Logo -->
                <div style="margin-bottom: 1.5rem;">
                    <span style="font-family: 'Orbitron', sans-serif; font-weight: 700; font-size: 1.75rem; color: #F77F00; text-shadow: 0 0 20px #F77F00;">
                        LOOTER<span style="color: #E63946;">STRIKE</span>
                    </span>
                </div>

                <!-- Texte accrocheur -->
                <h3 style="font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 0.5rem;">
                    🔥 Rejoins l'élite !
                </h3>
                <p style="color: #d1d5db; margin-bottom: 2rem;">
                    Connecte-toi avec ta plateforme préférée et commence à looter !
                </p>

                <!-- Boutons -->
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Steam Login - Popup -->
                    <a href="#" onclick="window.open('{{ route('steam.login') }}', 'steam_popup', 'width=600,height=700,left=100,top=100'); return false;" style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 0.875rem 1rem; background: #1b2838; color: white; font-weight: 600; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s; border: 1px solid rgba(102, 192, 244, 0.3); cursor: pointer;" onmouseover="this.style.background='#2a3f54'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(102, 192, 244, 0.3)';" onmouseout="this.style.background='#1b2838'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" alt="Steam" style="width: 2rem; height: 2rem; margin-right: 0.75rem;">
                        <span>Se connecter avec Steam</span>
                    </a>

                    <!-- Epic Games Login (Coming Soon) -->
                    <div style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 0.875rem 1rem; background: #2f2d2e; color: #9ca3af; font-weight: 600; border-radius: 0.5rem; border: 1px solid rgba(218, 51, 51, 0.3); opacity: 0.6; cursor: not-allowed;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/Epic_Games_logo.svg" alt="Epic Games" style="width: 2rem; height: 2rem; margin-right: 0.75rem; opacity: 0.5;">
                        <span>Epic Games - Coming Soon</span>
                    </div>
                </div>

                <p style="margin-top: 2rem; font-size: 0.75rem; color: #6b7280;">
                    En te connectant, tu acceptes nos conditions d'utilisation
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function openAuthPopup() {
        document.getElementById('auth-popup').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeAuthPopup() {
        document.getElementById('auth-popup').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Fermer avec Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeAuthPopup();
    });
</script>
