<?php

namespace App\Auth\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Users\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\Factory;
use Illuminate\View\View;

class RegisterController extends Controller
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
        return $this->viewFactory->make('Auth::register');
    }

    public function store(Redirector $redirector): RedirectResponse
    {
        $this->request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed']
        ]);

        $user = (new User)->create([
            'name' => $this->request->get('name'),
            'email' => $this->request->get('email'),
            'password' => Hash::make($this->request->get('password')),
        ]);

        Auth::login($user);

        return $redirector->home();
    }
}
