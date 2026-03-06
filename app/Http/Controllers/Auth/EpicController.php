<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\EpicOAuth;
use Illuminate\Support\Facades\Auth;

class EpicController extends Controller
{
    protected EpicOAuth $epicOAuth;

    public function __construct(EpicOAuth $epicOAuth)
    {
        $this->epicOAuth = $epicOAuth;
    }

    /**
     * Redirect to Epic Games for login (connect existing account).
     */
    public function redirectToEpicLogin()
    {
        return $this->epicOAuth->redirect('login');
    }

    /**
     * Redirect to Epic Games for registration (create new account).
     */
    public function redirectToEpicRegister()
    {
        return $this->epicOAuth->redirect('register');
    }

    /**
     * Handle callback after Epic Games authentication.
     */
    public function handleCallback()
    {
        return $this->epicOAuth->handleCallback();
    }
}
