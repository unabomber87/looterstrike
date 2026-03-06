<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SteamOpenID;
use Illuminate\Support\Facades\Auth;

class SteamController extends Controller
{
    protected SteamOpenID $steamOpenID;

    public function __construct(SteamOpenID $steamOpenID)
    {
        $this->steamOpenID = $steamOpenID;
    }

    /**
     * Redirect to Steam for login (connect existing account).
     */
    public function redirectToSteamLogin()
    {
        return $this->steamOpenID->redirect('login');
    }

    /**
     * Redirect to Steam for registration (create new account).
     */
    public function redirectToSteamRegister()
    {
        return $this->steamOpenID->redirect('register');
    }

    /**
     * Handle callback after Steam authentication.
     */
    public function handleCallback()
    {
        return $this->steamOpenID->handleCallback();
    }
}
