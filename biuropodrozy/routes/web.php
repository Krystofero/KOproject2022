<?php

use App\Http\Controllers\ModeratorOrderController;
use App\Http\Controllers\ModeratorOffertController;
use App\Http\Controllers\OffertController;
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

// Route::get('/offerts/index/{view}', [OffertController::class, 'index']);
// Route::get('/offerts/show/{view}', [OffertController::class, 'show']);


// Route::resource('offerts', OffertController::class)->only([
//     'index', 'show'
// ]); 
Route::get('/offerts', 'App\Http\Controllers\OffertController@index')->name('offerts.index');
Route::get('/offerts/{id}', 'App\Http\Controllers\OffertController@show')->name('offerts.show');


Route::middleware(['auth', 'verified'])->group(function() { #grupa zalogowanych użytkowników

    Route::get('/offerts/buy/{id}', 'App\Http\Controllers\OffertController@buy')->name('offerts.buy');

    Route::post('/offerts/store', 'App\Http\Controllers\OffertController@store')->name('offerts.store');

    Route::middleware(['can:isAdmin'])->group(function() { #grupa Administrator
        Route::resource('users', UsersController::class)->only([
            'index', 'edit', 'update', 'destroy'
        ]);  # ->middleware('auth')  -wymagane jest wcześniejsze zalogowanie się 

    });

    Route::middleware(['can:isModer'])->group(function() { #grupa Moderator
        Route::get('/offertsModerator/create', [ModeratorOffertController::class, 'create']);
        Route::get('/offertsModerator/{offert}', [ModeratorOffertController::class, 'show']);
        // Route::get('/offertsModerator/stats/{offert}', [ModeratorOffertController::class, 'stats']);
        Route::delete('/offertsModerator/{offert}', [ModeratorOffertController::class, 'destroy']);

        // Route::get('/offertsModerator/stats', 'App\Http\Controllers\ModeratorOffertController@stats')->name('offertsModerator.stats');

        Route::resource('offertsModerator', ModeratorOffertController::class)->only([ //oferty tworzone przez moderatora
            'index', 'store', 'edit', 'create', 'update', 'show', 'destroy'
        ]); 

        Route::resource('ordersModerator', ModeratorOrderController::class)->only([ //oferty tworzone przez moderatora
            'index'
        ]); 

    });


    
    // Route::middleware(['can:isClient'])->group(function() { #grupa Student
    // });
  
});

Auth::routes();  // Klasa Auth ma ukryty routing i endpointy które kierują do kontrolerów (wszystkie routes)
