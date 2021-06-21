<?php

use Illuminate\Support\Facades\Route;

Route::get('home', fn() => 'Home')->middleware('auth')->name('home');
