<?php

namespace App\Auth\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;

class LoginController extends Controller
{
    private Request $request;
    private Factory $viewFactory;

    public function __construct(Request $request, Factory $viewFactory)
    {
        $this->request = $request;
        $this->viewFactory = $viewFactory;
    }

    public function show(): View
    {
        return $this->viewFactory->make('Auth::login');
    }

    public function store(Redirector $redirector): RedirectResponse
    {
        $credentials = $this->request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $this->request->has('remember'))) {
            $this->request->session()->regenerate();

            return $redirector->home();
        }

        return $redirector->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Redirector $redirector): RedirectResponse
    {
        Auth::logout();

        $this->request->session()->invalidate();
        $this->request->session()->regenerateToken();

        return $redirector->route('auth.login.show');
    }
}
