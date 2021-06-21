<?php


namespace App\Auth\Providers;


use App\Auth\Http\Controllers\LoginController;
use App\Auth\Http\Controllers\RegisterController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthRoutesProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function() {
            Route::middleware('web')->group(function() {
                Route::middleware('guest')->group(function() {
                    Route::get('login', [LoginController::class, 'show'])->name('auth.login.show');
                    Route::post('login', [LoginController::class, 'store'])->name('auth.login.store');
                    Route::get('register', [RegisterController::class, 'show'])->name('auth.register.show');
                    Route::post('register', [RegisterController::class, 'store'])->name('auth.register.store');
                });

                Route::get('logout', [LoginController::class, 'destroy'])
                    ->middleware('auth')
                    ->name('auth.login.destroy');
            });
        });
    }
}
