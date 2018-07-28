<?php

namespace Cavidel\Http\Controllers\Auth;

use Cavidel\Http\Controllers\Controller;
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

    public function getValidateToken()
    {
        if (session('2fa:user:id')) {
            return view('2fa/validate');
        }

        return redirect('login');
    }

    public function postValidateToken(ValidateSecretRequest $request)
    {
        //get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId . ':' . $request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        //login and redirect user
        Auth::loginUsingId($userId);

        return redirect()->intended($this->redirectTo);
    }

    private function authenticated(Request $request)
    {
        $user = auth()->user();
        if ($user->google2fa_secret) {
            \Auth::logout();

            $request->session()->put('2fa:user:id', $user->id);

            return redirect('2fa/validate');
        }

        return redirect()->intended($this->redirectTo);
    }

}
