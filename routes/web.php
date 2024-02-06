<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homepage');
});

Auth::routes(['login' => false, 'register' => false]);

route::middleware('guest')->group(function() {
    Route::get('/register', Register::class) -> name('register');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
