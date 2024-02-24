<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Livewire\ProjectView;
use App\Livewire\ProjectCreate;
use App\Livewire\RabPage;
use Illuminate\Http\Request;
use App\Livewire\Auth\Register;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

use App\Livewire\AddRab;
use App\Livewire\Profile;
use App\Livewire\RabDetail;

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

Route::get('/profile', function () {
    return view('/profile');
});

Route::get('/otp-verification', function() {
    return view('livewire.otp-verification');
}) -> name('otp-verification');

Route::get('/project/{projectId}', AddRab::class);

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

Route::get('/userUpdate', Profile::class);
Route::post('/profpicUpdate', [ProfileController::class, 'updateProfilePicture']);
Route::post('/profileUpdate', [ProfileController::class, 'updateProfile']);

/**
 * Display all RAB for the project
 */
Route::get('/rab/{project_id}', RabPage::class);

/**
 * Display rab with the inputted id
 */
Route::get('/rabDetail/{rab_id}', RabDetail::class);

/**
 * Add A New RAB for the project
 */
Route::post('/rab/{project_id}', [RabController::class, 'create'] );

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



Route::post('/rab/{rab_id}/item/add', [RabItemController::class, 'addItem'])->name('rab.item.add');
Route::post('/rab/{rab_id}/discount', [RabController::class, 'applyDiscount'])->name('rab.applyDiscount');
