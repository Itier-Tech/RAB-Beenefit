<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/userUpdate';

    use Illuminate\Support\Facades\Password;

    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'passwordLama' => 'required',
            'passwordBaru' => 'required|min:8',
            'retypePasswordBaru' => 'required|same:passwordBaru',
        ]);

        $user = Auth::user();

        // Periksa apakah password lama cocok
        if (!Hash::check($request->passwordLama, $user->password)) {
            return back()->with('error', 'Password lama tidak cocok.');
        }

        // Update password baru
        $user->password = Hash::make($request->passwordBaru);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
