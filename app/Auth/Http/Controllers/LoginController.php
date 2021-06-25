<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Http\Requests\LoginRequest;
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
    private Redirector $redirector;

    public function __construct(Request $request, Factory $viewFactory, Redirector $redirector)
    {
        $this->request = $request;
        $this->viewFactory = $viewFactory;
        $this->redirector = $redirector;
    }

    public function show(): View
    {
        return $this->viewFactory->make('Auth::login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $input = $request->validated();

        if (Auth::attempt($input, $this->request->has('remember'))) {
            $this->request->session()->regenerate();

            return $this->redirector->route('admin.users.index');
        }

        return $this->redirector->back()->withInput($input)->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();

        $this->request->session()->invalidate();
        $this->request->session()->regenerateToken();

        return $this->redirector->route('auth.login.show');
    }
}
