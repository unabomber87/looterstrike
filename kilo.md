# Instructions pour Kilo Code

## ⚠️ RÈGLES TRÈS IMPORTANTES - À LIRE AU DÉBUT DE CHAQUE SESSION

1. **Backoffice Laravel réservé au SUPERADMIN uniquement**
   - Seul le superadmin peut se connecter au backoffice (`/auth/admin`)
   - Tous les autres utilisateurs utilisent **uniquement** Steam/Epic/PlayStation
   - **NE JAMAIS** modifier les blades du backoffice (dossier `resources/views/auth/`)

2. **Inscription publique désactivée**
   - Register Laravel **désactivé** pour le public
   - Les utilisateurs s'inscrivent via Steam, Epic Games ou PlayStation uniquement

3. **Modal d'authentification**
   - Doit être **centré** dans la page
   - Utiliser les logos officiels des plateformes
   - Steam utilise un **popup** avec compteur de fermeture automatique

4. **Epic Games temporairement désactivé**
   - Bouton affiche "Coming Soon"
   - Reviendra plus tard

## 📁 Structure du projet

```
looterStrike/
├── app/
│   ├── Http/Controllers/Auth/
│   │   ├── SteamController.php      # Contrôleur Steam
│   │   └── EpicController.php       # Contrôleur Epic (désactivé)
│   ├── Services/
│   │   ├── SteamOpenID.php          # Service auth Steam avec popup
│   │   └── EpicOAuth.php            # Service auth Epic (non activé)
│   └── Models/
│       └── User.php                 # Modèle User avec champs Steam/Epic
├── resources/views/
│   ├── snippets/
│   │   └── navbar.blade.php         # Popup auth avec Steam
│   ├── auth/
│   │   ├── login.blade.php          # Page login
│   │   ├── register.blade.php       # Page register
│   │   └── steam-callback.blade.php # Page succès popup
│   └── home.blade.php              # Page d'accueil
├── routes/
│   ├── web.php                     # Routes Steam/Epic
│   └── auth.php                    # Routes login/register discrètes
└── docs/
    └── authentication.md            # Documentation complète
```

## 🔐 URLs d'authentification

| Méthode | URL | Description |
|---------|-----|-------------|
| Steam Login | `/auth/steam/login` | Connexion Steam (popup) |
| Steam Register | `/auth/steam/register` | Inscription Steam (popup) |
| Epic Login | `/auth/epic/login` | Désactivé (Coming Soon) |
| Admin Login | `/auth/admin` | Login email pour superadmin |
| Login public | `/login` | Redirige vers homepage |
| Register | `/register` | Désactivé |

## 🎮 Flux d'authentification Steam (Popup)

1. Utilisateur clique sur "Se connecter avec Steam"
2. Popup s'ouvre (600x700) avec la page Steam
3. Utilisateur se connecte sur Steam
4. Steam redirige vers `/auth/steam/callback?popup=1`
5. Le callback affiche la page `steam-callback.blade.php`
6. Message "Connexion réussie" + compteur (4, 3, 2, 1)
7. Popup se ferme automatiquement + page principale se recharge

## 🔧 Commandes utiles

```bash
# Démarrer ngrok (pour Epic Games OAuth - requis car Epic n'accepte pas localhost)
ngrok http 443

# Démarrer le serveur Laravel
php artisan serve

# Vider les caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Migrer la base de données
php artisan migrate
```

## 🌐 URLs du projet

- **Local**: https://looter.local (HTTPS)
- **ngrok**: https://VOTRE_NGROK_URL (pour Epic Games)

## 📝 Notes importantes

- Toujours utiliser **https://** pour les URLs (Laravel configuré pour HTTPS)
- Steam OpenID nécessite une configuration spécifique dans le service
- Le popup Steam utilise `window.open()` avec un nom de fenêtre fixe (`steam_popup`)
- Le callback détecte le paramètre `popup=1` pour afficher la page de succès

## 📄 Fichiers clés modifiés récemment

- `app/Services/SteamOpenID.php` - Auth Steam avec support popup
- `resources/views/auth/steam-callback.blade.php` - Page de succès avec compteur
- `resources/views/snippets/navbar.blade.php` - Popup auth
- `routes/auth.php` - Routes login/register discrètes
