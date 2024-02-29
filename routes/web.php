<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\User;

use App\Livewire\ProjectView;
use App\Livewire\ProjectCreate;
use App\Livewire\RabPage;
use App\Livewire\Auth\Register;
use App\Livewire\AddRab;
use App\Livewire\Profile;
use App\Livewire\RabFinal;
use App\Livewire\OtpVerification;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PDFController;


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
    return view('homepage'); // delete soon
});

Route::get('/profile', function () {
    return view('/profile'); // delete soon
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
});

Auth::routes(['login' => false, 'register' => false]);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/otp-verification', OtpVerification::class)->name('otp-verification');

Route::get('/project', ProjectView::class);
Route::get('/projectCreate', ProjectCreate::class);
Route::get('/add-rab/{project_id}', AddRab::class);
Route::delete('/project/{project_id}', function ($project_id) {});

Route::get('/user', function () {
    return User::all();
});

Route::get('/user-update', Profile::class);
Route::post('/profpic-update', [ProfileController::class, 'updateProfilePicture']);
Route::post('/profile-update', [ProfileController::class, 'updateProfile']);

Route::get('/rab/{project_id}', RabPage::class);
Route::get('/rab/{rab_id}', function ($rab_id) {});
Route::post('/rab/{project_id}', [RabController::class, 'create']);
Route::post('/rab_item', function (Request $request) {});
Route::get('/rabDownload', RabFinal::class); // delete soon
Route::get('rab/{rab_id}/final', [PDFController::class, 'index']);
Route::post('/rab/{rab_id}/item/add', [RabItemController::class, 'addItem'])->name('rab.item.add');
Route::post('/rab/{rab_id}/discount', [RabController::class, 'applyDiscount'])->name('rab.applyDiscount');

Route::get('/generate-pdf/{rab_id}', [PDFController::class, 'generatePDF']);
Route::get('/generatepdf', [PDFController::class, 'index']); // delete soon
