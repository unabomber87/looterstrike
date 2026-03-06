<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EpicOAuth
{
    const SESSION_KEY = 'epic_auth_action';
    
    const AUTHORIZE_URL = 'https://www.epicgames.com/id/authorize';
    const TOKEN_URL = 'https://api.epicgames.dev/epic/oauth/v1/token';
    const USERINFO_URL = 'https://api.epicgames.dev/epic/oauth/v1/userInfo';

    /**
     * Redirect the user to Epic Games OAuth authorization page.
     */
    public function redirect(string $action = 'login'): \Illuminate\Http\RedirectResponse
    {
        // Store the action (login or register) in session
        Session::put(self::SESSION_KEY, $action);
        
        $clientId = env('EPIC_CLIENT_ID');
        $redirectUri = env('EPIC_REDIRECT_URI', config('app.url') . '/auth/epic/callback');
        $state = Str::random(32);
        
        // Store state for CSRF protection
        Session::put('epic_oauth_state', $state);

        $params = [
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'scope'         => 'basic profile friends',
            'state'         => $state,
        ];

        $authorizeUrl = self::AUTHORIZE_URL . '?' . http_build_query($params);
        
        Log::info('Epic OAuth redirect', [
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'action' => $action
        ]);

        return redirect($authorizeUrl);
    }

    /**
     * Handle the callback from Epic Games OAuth.
     */
    public function handleCallback(): \Illuminate\Http\RedirectResponse
    {
        try {
            $request = request();
            
            // Check for errors from Epic
            if ($request->has('error')) {
                $error = $request->get('error_description') ?? $request->get('error');
                Log::error('Epic OAuth error', ['error' => $error]);
                return redirect('/')->with('error', 'Erreur Epic Games: ' . $error);
            }

            // Verify state (CSRF protection)
            $state = $request->get('state');
            $sessionState = Session::get('epic_oauth_state');
            
            if (!$state || $state !== $sessionState) {
                Log::error('Epic OAuth state mismatch', [
                    'received_state' => $state,
                    'session_state' => $sessionState
                ]);
                return redirect('/')->with('error', 'Erreur de sécurité: état invalide.');
            }

            $code = $request->get('code');
            
            if (!$code) {
                Log::error('Epic OAuth: No authorization code received');
                return redirect('/')->with('error', 'Code d\'autorisation manquant.');
            }

            Log::info('Epic OAuth callback received', ['code' => substr($code, 0, 10) . '...']);

            // Exchange code for access token
            $tokenData = $this->exchangeCodeForToken($code);
            
            if (!$tokenData || !isset($tokenData['access_token'])) {
                Log::error('Epic OAuth: Failed to get access token', ['token_data' => $tokenData]);
                return redirect('/')->with('error', 'Impossible d\'obtenir le token d\'accès.');
            }

            $accessToken = $tokenData['access_token'];
            $tokenType = $tokenData['token_type'] ?? 'Bearer';

            // Get user info from Epic
            $epicUser = $this->getUserInfo($accessToken);
            
            if (!$epicUser) {
                Log::error('Epic OAuth: Failed to get user info');
                return redirect('/')->with('error', 'Impossible de récupérer les informations utilisateur.');
            }

            Log::info('Epic user info received', [
                'epic_id' => $epicUser['account_id'] ?? 'unknown',
                'display_name' => $epicUser['displayName'] ?? 'unknown'
            ]);

            // Find or create user
            $user = $this->findOrCreateUser($epicUser, true);

            // Login the user
            Auth::login($user);
            
            // Clear session keys
            Session::forget(self::SESSION_KEY);
            Session::forget('epic_oauth_state');

            Log::info('User logged in via Epic', ['user_id' => $user->id, 'epic_id' => $user->epic_id]);

            return redirect()->intended('/')->with('success', 'Bienvenue agent ' . $user->epic_display_name . ' !');
            
        } catch (\Exception $e) {
            Log::error('Epic OAuth Error: ' . $e->getMessage(), ['trace' => $e->getTrace()]);
            return redirect('/')->with('error', 'Erreur lors de la connexion Epic Games: ' . $e->getMessage());
        }
    }

    /**
     * Exchange authorization code for access token.
     */
    private function exchangeCodeForToken(string $code): ?array
    {
        $clientId = env('EPIC_CLIENT_ID');
        $clientSecret = env('EPIC_CLIENT_SECRET');
        $redirectUri = env('EPIC_REDIRECT_URI', config('app.url') . '/auth/epic/callback');

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post(self::TOKEN_URL, [
                'grant_type'    => 'authorization_code',
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'code'          => $code,
                'redirect_uri'  => $redirectUri,
            ]);

            $data = json_decode($response->body(), true);
            
            if ($response->failed()) {
                Log::error('Epic token exchange failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }

            return $data;
            
        } catch (\Exception $e) {
            Log::error('Epic token exchange error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get user information from Epic Games API.
     */
    private function getUserInfo(string $accessToken): ?array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get(self::USERINFO_URL);

            $data = json_decode($response->body(), true);
            
            if ($response->failed() || isset($data['error'])) {
                Log::error('Epic userinfo failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }

            return $data;
            
        } catch (\Exception $e) {
            Log::error('Epic userinfo error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Find or create a user based on Epic account ID.
     * 
     * @param bool $createUserIfNotExists If false, only log in existing users
     */
    private function findOrCreateUser(array $epicUser, bool $createUserIfNotExists = true): User
    {
        $epicId = $epicUser['account_id'] ?? null;
        
        if (!$epicId) {
            throw new \Exception('ID Epic Games non trouvé dans la réponse.');
        }

        $user = User::where('epic_id', $epicId)->first();

        if ($user) {
            // Update info for existing user
            Log::info('User already exists, updating Epic info', [
                'user_id' => $user->id, 
                'epic_id' => $epicId
            ]);
            
            $user->update([
                'epic_display_name' => $epicUser['displayName'] ?? $user->epic_display_name,
                'epic_name' => $epicUser['name'] ?? $user->epic_name,
                'epic_avatar' => $epicUser['avatar'] ?? $user->epic_avatar,
            ]);
            
            return $user;
        }

        if (!$createUserIfNotExists) {
            throw new \Exception('Aucun compte Epic Games lié trouvé. Veuillez vous inscrire d\'abord.');
        }

        // Create new user
        $displayName = $epicUser['displayName'] ?? $epicUser['name'] ?? 'Epic User';
        
        Log::info('Creating new user with Epic', [
            'epic_id' => $epicId, 
            'display_name' => $displayName
        ]);
        
        return User::create([
            'name' => $displayName,
            'email' => $epicId . '@epic.local',
            'password' => bcrypt(Str::random(16)),
            'epic_id' => $epicId,
            'epic_display_name' => $displayName,
            'epic_name' => $epicUser['name'] ?? null,
            'epic_avatar' => $epicUser['avatar'] ?? null,
        ]);
    }
}
