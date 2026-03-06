<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SteamOpenID
{
    const SESSION_KEY = 'steam_auth_action';

    /**
     * Redirect the user to Steam's OpenID login page.
     */
    public function redirect(string $action = 'login'): \Illuminate\Http\RedirectResponse
    {
        // Store the action (login or register) in session
        Session::put(self::SESSION_KEY, $action);
        
        $redirectUrl = config('app.url') . '/auth/steam/callback';
        
        $params = [
            'openid.ns'         => 'http://specs.openid.net/auth/2.0',
            'openid.mode'       => 'checkid_setup',
            'openid.return_to'  => $redirectUrl,
            'openid.realm'      => config('app.url'),
            'openid.identity'   => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        ];

        return redirect(env('STEAM_OPENID_URL', 'https://steamcommunity.com/openid/login') . '?' . http_build_query($params, '', '&'));
    }

    /**
     * Handle the callback from Steam and authenticate the user.
     */
    public function handleCallback(): \Illuminate\Http\RedirectResponse
    {
        try {
            $request = request();
            
            Log::info('Steam Callback params', $request->all());

            // Check for claimed_id (Laravel converts dots to underscores)
            $claimedId = $request->get('openid.claimed_id') 
                ?? $request->get('claimed_id') 
                ?? $request->get('openid_claimed_id');
            
            if (!$claimedId) {
                Log::error('Steam OpenID: No claimed_id found', $request->all());
                return redirect('/')->with('error', 'Paramètre claimed_id manquant.');
            }

            // Get Steam ID from the claimed_id
            $steamId = $this->getSteamIdFromClaimedId($claimedId);
            
            if (!$steamId) {
                Log::error('Steam OpenID: Could not extract Steam ID from claimed_id', ['claimed_id' => $claimedId]);
                return redirect('/')->with('error', 'Impossible de récupérer l\'ID Steam.');
            }

            Log::info('Steam ID found', ['steam_id' => $steamId]);

            // Get Steam user info
            $steamUser = $this->getSteamUserInfo($steamId);

            // Find or create user (always create if not exists)
            $user = $this->findOrCreateUser($steamId, $steamUser, true);

            // Login the user
            Auth::login($user);
            
            // Clear the session key
            Session::forget(self::SESSION_KEY);

            Log::info('User logged in', ['user_id' => $user->id, 'steam_id' => $steamId]);

            return redirect()->intended('/')->with('success', 'Bienvenue, ' . $user->name . ' !');
            
        } catch (\Exception $e) {
            Log::error('Steam OpenID Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return redirect('/')->with('error', 'Erreur lors de la connexion Steam: ' . $e->getMessage());
        }
    }

    /**
     * Extract Steam ID from the claimed_id URL.
     */
    private function getSteamIdFromClaimedId(string $claimedId): ?string
    {
        preg_match('#https?://steamcommunity.com/openid/id/([0-9]{17,25})#', $claimedId, $matches);
        
        if (isset($matches[1]) && is_numeric($matches[1])) {
            return $matches[1];
        }
        
        return null;
    }

    /**
     * Get Steam user information from the Steam API.
     */
    private function getSteamUserInfo(string $steamId): array
    {
        $apiKey = env('STEAM_API_KEY');
        
        if (!$apiKey) {
            Log::warning('Steam API key not configured');
            return [
                'steamid' => $steamId,
                'personaname' => 'Steam User',
                'avatarmedium' => null,
                'avatarfull' => null,
            ];
        }

        try {
            $response = Http::get('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/', [
                'key'       => $apiKey,
                'steamids'  => $steamId,
            ]);

            $data = json_decode($response->body(), true);
            
            if (isset($data['response']['players'][0])) {
                return $data['response']['players'][0];
            }
        } catch (\Exception $e) {
            Log::error('Steam API Error: ' . $e->getMessage());
        }

        return [
            'steamid' => $steamId,
            'personaname' => 'Steam User',
            'avatarmedium' => null,
            'avatarfull' => null,
        ];
    }

    /**
     * Find or create a user based on Steam ID.
     * 
     * @param bool $createUserIfNotExists If false, only log in existing users
     */
    private function findOrCreateUser(string $steamId, array $steamUser, bool $createUserIfNotExists = true): User
    {
        $user = User::where('steam_id', $steamId)->first();

        if ($user) {
            // Update info for existing user
            Log::info('User already exists, updating', ['user_id' => $user->id, 'steam_id' => $steamId]);
            
            if (isset($steamUser['avatarmedium']) || isset($steamUser['avatarfull'])) {
                $user->update([
                    'steam_avatar' => $steamUser['avatarmedium'] ?? $steamUser['avatarfull'] ?? null,
                    'name' => $steamUser['personaname'] ?? $user->name,
                ]);
            }
            
            return $user;
        }

        if (!$createUserIfNotExists) {
            throw new \Exception('Aucun compte Steam lié trouvé. Veuillez vous inscrire d\'abord.');
        }

        // Create new user
        Log::info('Creating new user', ['steam_id' => $steamId, 'name' => $steamUser['personaname'] ?? 'Steam User']);
        
        return User::create([
            'name' => $steamUser['personaname'] ?? 'Steam User',
            'email' => $steamId . '@steam.local',
            'password' => bcrypt(Str::random(16)),
            'steam_id' => $steamId,
            'steam_avatar' => $steamUser['avatarmedium'] ?? $steamUser['avatarfull'] ?? null,
        ]);
    }
}
