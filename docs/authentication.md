# Authentication - Projet LooterStrike

## ✅ Résumé des modifications

### Configuration actuelle
- **Projet**: LooterStrike - Application Laravel avec authentification par plateformes de jeu
- **URL Locale**: https://looter.local
- **Méthode HTTPS**: Configuré via WAMP avec certificat SSL auto-signé

---

## 🔐 Système d'authentification

### Utilisateurs autorisés
1. **SuperAdmin** - Connexion via email/mot de passe (Laravel Breeze)
2. **Joueurs** - Connexion via Steam, Epic Games ou PlayStation

### Inscription publique
- **INSCRIPION DÉSACTIVÉE** pour le grand public
- Les utilisateurs normaux s'inscrivent uniquement via Steam, Epic Games ou PlayStation
- Le superadmin peut créer des comptes internes manuellement via la base de données

### URLs d'authentification

| Méthode | URL | Statut |
|---------|-----|--------|
| Steam Login | `/auth/steam/login` | ✅ Actif (Popup) |
| Steam Register | `/auth/steam/register` | ✅ Actif (Popup) |
| Epic Login | `/auth/epic/login` | 🔶 Coming Soon |
| Epic Register | `/auth/epic/register` | 🔶 Coming Soon |
| PlayStation | - | 🔶 À implémenter |
| Admin Login | `/auth/admin` | ✅ Actif |
| Login (public) | `/login` | ❌ Redirige vers homepage |
| Register (public) | `/register` | ❌ Inaccessible |

---

## 🎮 Steam Authentication (Popup)

### Flux d'authentification
1. Utilisateur clique sur "Se connecter avec Steam" dans le popup
2. Popup Steam s'ouvre (600x700) avec la page d'authentification Steam
3. Utilisateur se connecte sur Steam
4. Steam redirige vers `/auth/steam/callback?popup=1`
5. Le service SteamOpenID traite la connexion
6. Si popup=1, affiche la page `steam-callback.blade.php`
7. Message "Connexion réussie" avec compteur (4, 3, 2, 1)
8. Popup se ferme automatiquement + page principale se recharge

### Fichiers clés Steam
- `app/Services/SteamOpenID.php` - Service d'authentification Steam avec support popup
- `app/Http/Controllers/Auth/SteamController.php` - Contrôleur Steam
- `resources/views/auth/steam-callback.blade.php` - Page de succès avec compteur

### Configuration Steam
```env
STEAM_API_KEY=VOTRE_CLE_STEAM_ICI
STEAM_REDIRECT_URI=https://looter.local/auth/steam/callback
```

### Note technique
- Le retour de `handleCallback()` ne doit PAS avoir de type de retour declare (ni `void` ni autre chose)
- Le callback détecte le paramètre `popup=1` pour retourner la vue de succès
- Sans le paramètre popup, redirige vers le dashboard

---

## 🎯 Epic Games Authentication

### Statut: Coming Soon
- Le bouton Epic Games est temporairement désactivé
- Le bouton affiche "Coming Soon" (clique non fonctionnel)

### Configuration requise (pour activation future)
Epic Games n'accepte PAS les URLs localhost/HTTPS locaux. Solution: ngrok.

1. **Installer ngrok** : https://ngrok.com/download
2. **Démarrer ngrok** (sur le port HTTPS de WAMP):
   ```bash
   ngrok http 443
   # ou
   ngrok http https://localhost:443
   ```
3. **Copier l'URL ngrok** (ex: https://abcd1234.ngrok.io)
4. **Configurer Epic Developer Portal** avec cette URL

#### Configuration .env
```env
EPIC_CLIENT_ID=votre_client_id
EPIC_CLIENT_SECRET=votre_client_secret
EPIC_REDIRECT_URI=https://VOTRE_NGROK_URL/auth/epic/callback
```

#### URLs à configurer dans Epic Developer Portal

**Redirect URIs:**
- `https://VOTRE_NGROK_URL/auth/epic/callback`
- `http://localhost/auth/epic/callback` (fallback)

**CORS Allowed Origins:**
- `https://VOTRE_NGROK_URL`
- `http://localhost`

---

## 🎮 PlayStation Network (PSN) - À implémenter

### Statut: Non commencé
- **Méthode**: OAuth 2.0 / API non officielle
- **Documentation**: https://psn.flipscreen.games/
- **Package suggéré**: paoPSN ou psn-php

### Note
PSN n'offre pas d'OAuth public officiel. Options:
- Utiliser l'API非officielle PSN (paoPSN ou psn-php)
- Intégration via réseau social où le joueur partage son ID PSN

---

## 📁 Fichiers modifiés

### Services
- `app/Services/SteamOpenID.php` - Auth Steam avec support popup + return type void retiré

### Contrôleurs
- `app/Http/Controllers/Auth/SteamController.php` - Contrôleur Steam

### Modèle
- `app/Models/User.php` - Champs steam_id, steam_avatar, epic_id, epic_display_name, epic_avatar

### Vues
- `resources/views/auth/login.blade.php` - Popup auth centré
- `resources/views/auth/register.blade.php` - Popup auth centré
- `resources/views/auth/steam-callback.blade.php` - Page succès avec compteur (NOUVEAU)
- `resources/views/snippets/navbar.blade.php` - Popup auth aveclogos officiels + window.open()

### Routes
- `routes/auth.php` - Register désactivé, route离散 login admin
- `routes/web.php` - Routes Steam/Epic

### Configuration
- `.env` - Configuration Steam (Epic désactivé)
- `bootstrap/app.php` - Support HTTPS forcé

---

## 🎨 Interface utilisateur

### Popup d'authentification
- **Centrage**: Utilise `position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)`
- **Logos**: Images officielles Steam et Epic (pas de filtres CSS)
- **Boutons**: Steam (actif), Epic (Coming Soon)
- **Style**: Design moderne avec bordures et effets hover

### Menu utilisateur connecté
- **Format**: "Bienvenue agent {nom}" avec avatar
- **Avatar**: Image Steam ou Epic de l'utilisateur
- **Dropdown au hover**: Options de déconnexion
- **Responsive**: Adaptation mobile

### Page de succès Steam (Popup)
- **Message**: "Connexion réussie ! Bienvenue agent {nom}"
- **Compteur**: Décompte 4, 3, 2, 1 avec fermeture automatique
- **Fermeture**: `window.opener.location.reload()` + `window.close()`

---

## 🚀 Commandes utiles

```bash
# Démarrer ngrok (pour Epic Games - requis car Epic n'accepte pas localhost)
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

---

## ⚠️ Notes importantes

1. **Backoffice réservé au SUPERADMIN uniquement**
   - Seul le superadmin peut se connecter via `/auth/admin`
   - Tous les autres utilisateurs utilisent Steam/Epic/PlayStation
   - **NE JAMAIS** modifier les blades du backoffice

2. **HTTPS obligatoire**
   - Laravel configuré pour forcer HTTPS
   - Steam OpenID nécessite HTTPS

3. **Popup Steam**
   - Utilise `window.open()` avec nom de fenêtre fixe (`steam_popup`)
   - Taille: 600x700 pixels
   - Fermeture automatique après authentification

4. **Inscription**
   - `/register` est totalement inaccessible
   - Les utilisateurs normaux s'inscrivent via leur plateforme de jeu
   - Le superadmin peut créer des comptes manuellement en base de données
