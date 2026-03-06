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
                            <span class="text-white">Bienvenue agent</span>
                            <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
                            <img src="{{ Auth::user()->steam_avatar ?? 'https://placehold.co/40x40/1a1a2e/FF6A00?text=?' }}" 
                                 alt="Avatar" 
                                 class="rounded-circle user-avatar"
                                 style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--primary-color);">
                        </div>
                        <div class="user-dropdown">
                            <div class="user-dropdown-header">
                                <img src="{{ Auth::user()->steam_avatar ?? 'https://placehold.co/60x60/1a1a2e/FF6A00?text=?' }}" 
                                     alt="Avatar" 
                                     class="rounded-circle"
                                     style="width: 60px; height: 60px; object-fit: cover; border: 2px solid var(--primary-color);">
                                <div class="user-dropdown-info">
                                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">Agent Steam</small>
                                </div>
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
                    <!-- Boutons Login et Register separes -->
                    <a class="nav-link btn-login" href="{{ route('steam.login') }}">Login</a>
                    <a class="btn-dome" href="{{ route('steam.register') }}"><span>Register</span></a>
                @endauth
            </div>

        </div>
    </div>
</nav>
