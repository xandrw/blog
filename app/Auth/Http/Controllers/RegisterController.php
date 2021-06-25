<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Http\Requests\RegisterRequest;
use App\Core\Http\Controllers\Controller;
use App\Users\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;

class RegisterController extends Controller
{
    private Factory $viewFactory;

    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function show(): View
    {
        return $this->viewFactory->make('Auth::register');
    }

    public function store(RegisterRequest $request, Redirector $redirector): RedirectResponse
    {
        $user = (new User)->create($request->validated());

        Auth::login($user);

        return $redirector->home();
    }
}
