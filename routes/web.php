<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Livewire\ProjectView;
use App\Livewire\ProjectCreate;
use App\Livewire\RabPage;
use Illuminate\Http\Request;
use App\Livewire\Auth\Register;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RabController;

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

Route::get('/project/{projectId}', function ($projectId) {
    return view('addrab');
});

Route::get('/login', function () {return view('login');})->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Auth::routes(['login' => false, 'register' => false]);

Route::middleware('guest')->group(function() {
    Route::get('/register', Register::class) -> name('register');
});

Route::get('/project', ProjectView::class);
Route::get('/projectCreate', ProjectCreate::class);

Route::get('/user', function() {
    $user = User::all();
    return $user;
});

/**
 * Display all RAB for the project
 */
Route::get('/rab/{project_id}/{project_name}', RabPage::class);

/**
 * Display rab with the inputted id
 */
Route::get('/rab/{rab_id}', function ($rab_id) {
    //
});

/**
 * Add A New RAB for the project
 */
Route::post('/rab/{project_id}', function (Request $request, $project_id) {
    //
});

/**
 * Add A New item for the RAB for the project
 */
Route::post('/rab_item', function (Request $request) {
    //
});
 
/**
 * Delete An Existing Project
 */
Route::delete('/project/{project_id}', function ($project_id) {
    //
});
