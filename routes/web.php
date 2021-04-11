<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserMutationController;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get(
    '/dashboard',
    function () {
        return view('dashboard');
    }
)->middleware(['auth'])->name('dashboard');

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::post('/users/mute', [UserMutationController::class, 'mute']);
        Route::post('/users/unmute', [UserMutationController::class, 'unmute']);
    }
);


require __DIR__.'/auth.php';
