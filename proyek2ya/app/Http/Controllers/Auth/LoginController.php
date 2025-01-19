<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function logout(Request $request)
    {
        auth()->logout(); // Logout user
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login')->with('status', 'You have been logged out.');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
    if (auth()->user()->role === 'admin') {
        return '/admin/page/market';
    }

if (auth()->user()->role === 'dosen') {
    return '/dosen/page/market'; // Redirect for dosen role
}
return '/user/page/market';

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
