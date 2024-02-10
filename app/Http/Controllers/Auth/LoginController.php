<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
            $remember
        ]);

        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $credentials['password'] = $hashedPassword;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // dd('eror');
        return back()->with('loginError', 'Login failed!');
    }

    public function logout()
    {
        Auth::logout();

        request->session()->invalidate();

        request->session()->regenerateToken();

        return redirect('/');
    }
}