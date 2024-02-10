<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/login', function () {return view('login');})->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);

Auth::routes(['login' => false, 'register' => false]);

Route::middleware('guest')->group(function() {
    Route::get('/register', Register::class) -> name('register');
});
