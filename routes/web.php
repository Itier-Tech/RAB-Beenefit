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



Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');

    // Forgot password route
    Route::get('/forgot-password', function () {
        return view('auth.passwords.email');
    })->name('password.request');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->name('password.email');
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.passwords.reset', ['token' => $token]);
    })->name('password.reset');
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
    })->name('password.update');

    Route::get('/otp-verification', OtpVerification::class)->name('otp-verification');
});

Route::middleware('auth')->group(function () {
    Route::get('/', ProjectView::class);
    Route::get('/project-create', ProjectCreate::class);
    Route::get('/add-rab/{project_id}', AddRab::class);
    Route::get('/user-update', Profile::class);
    Route::post('/profpic-update', [ProfileController::class, 'updateProfilePicture']);
    Route::post('/profile-update', [ProfileController::class, 'updateProfile']);
    Route::get('/rab/{project_id}', RabPage::class);
    Route::post('/rab/{project_id}', [RabController::class, 'create']);
    Route::post('/rab_item', function (Request $request) {});
    Route::get('/rabDownload', RabFinal::class); // delete soon
    Route::get('rab/{rab_id}/final', [PDFController::class, 'index']);
    Route::post('/rab/{rab_id}/item/add', [RabItemController::class, 'addItem'])->name('rab.item.add');
    Route::post('/rab/{rab_id}/discount', [RabController::class, 'applyDiscount'])->name('rab.applyDiscount');

    Route::get('/generate-pdf/{rab_id}', [PDFController::class, 'generatePDF']);
});

Auth::routes(['login' => false, 'register' => false]);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

<<<<<<< HEAD
// Route::delete('/project/{project_id}', function ($project_id) {})->middleware('auth');
Route::get('/generatepdf', [PDFController::class, 'index']); // delete soon
=======
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

Route::get('/rabDownload', RabFinal::class);
Route::get('rab/{rab_id}/final', [PDFController::class, 'index']);
Route::get('/generate-pdf/{rab_id}', [PDFController::class, 'generatePDF']);

Route::post('/rab/{rab_id}/item/add', [RabItemController::class, 'addItem'])->name('rab.item.add');
Route::post('/rab/{rab_id}/discount', [RabController::class, 'applyDiscount'])->name('rab.applyDiscount');

Route::get('/generatepdf', [PDFController::class, 'index']);
>>>>>>> 4c9209c5cf68ee692139f03844ba0498e2400d80
