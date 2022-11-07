<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/infocookies', function () {
    return view('infocookies');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function() { #grupa zalogowanych użytkowników
    Route::middleware(['can:isAdmin'])->group(function() { #grupa Administrator
        Route::resource('users', UsersController::class)->only([
            'index', 'edit', 'update', 'destroy'
        ]);  # ->middleware('auth')  -wymagane jest wcześniejsze zalogowanie się 

    });

    // Route::middleware(['can:isModer'])->group(function() { #grupa Moderator
    // });

    // Route::middleware(['can:isClient'])->group(function() { #grupa Student
    // });
  
});

Auth::routes();  // Klasa Auth ma ukryty routing i endpointy które kierują do kontrolerów (wszystkie routes)
