<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Support\Str;

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

Route::get('/', ProjectView::class)->middleware('auth');

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

// Forgot password route
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/project-create', ProjectCreate::class)->middleware('auth');
Route::get('/add-rab/{project_id}', AddRab::class)->middleware('auth');
// Route::delete('/project/{project_id}', function ($project_id) {})->middleware('auth');

Route::get('/user-update', Profile::class)->middleware('auth');
Route::post('/profpic-update', [ProfileController::class, 'updateProfilePicture'])->middleware('auth');
Route::post('/profile-update', [ProfileController::class, 'updateProfile'])->middleware('auth');

Route::get('/rab/{project_id}', RabPage::class)->middleware('auth');
Route::post('/rab/{project_id}', [RabController::class, 'create'])->middleware('auth');
Route::post('/rab_item', function (Request $request) {})->middleware('auth');
Route::get('/rabDownload', RabFinal::class)->middleware('auth'); // delete soon
Route::get('rab/{rab_id}/final', [PDFController::class, 'index'])->middleware('auth');
Route::post('/rab/{rab_id}/item/add', [RabItemController::class, 'addItem'])->name('rab.item.add')->middleware('auth');
Route::post('/rab/{rab_id}/discount', [RabController::class, 'applyDiscount'])->name('rab.applyDiscount')->middleware('auth');

Route::get('/generate-pdf/{rab_id}', [PDFController::class, 'generatePDF'])->middleware('auth');
Route::get('/generatepdf', [PDFController::class, 'index']); // delete soon
