<?php

use App\Admin\Users\Http\AdminUsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('users', AdminUsersController::class)->except(['show', 'destroy'])->parameter('user', 'id');
    Route::get('users/{id}/delete', [AdminUsersController::class, 'destroy'])->name('users.destroy');
});
