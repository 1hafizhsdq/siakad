<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Mengubah nomor telepon yang dimulai dengan '0' atau '+62' menjadi '62'
        if (substr($credentials['email'], 0, 1) === '0') {
            $credentials['email'] = '62' . substr($credentials['email'], 1);
        } elseif (substr($credentials['email'], 0, 3) === '+62') {
            $credentials['email'] = '62' . substr($credentials['email'], 3);
        }
    
        if (filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (substr($credentials['email'], 0, 2) === '62') {
            $field = 'telp';
        } else {
            $field = 'no_induk';
        }

        return Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']]);
    }
}
