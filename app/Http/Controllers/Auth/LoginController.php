<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Http\Controllers\Controller;
use App\Member;
use App\User;
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

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login.verify');
    }


    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return $this->verify($request)->withErrors(['password' => [trans('auth.failed')]]);
    }

    public function verify(Request $request)
    {
       // dd($request->all);
        $client = Client::query()
            ->where('status', 'active')
            ->where('email', $request->email)
            ->first();
        $admin = User::query()
            ->where('status', 'active')
            ->where('email', $request->email)
            ->first();
        if ($client && $admin && $request->get('guard', null) == null) {
            $users = compact('client', 'admin');
            return view('auth.login.choose', compact('users'));
        } else {
            if ($admin && $client && $request->guard == 'admin') {
                $client = $admin;
            } else {
                $client = coalesce($client, $admin);
            }
            if ($client) {
                session(['email' => $client->email]);
                return view('auth.login.password', compact('client'));
            }
            return redirect(route('login'))->withInput()->withErrors(['email' => ['No account found matching the details above']]);
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(\request('guard'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('https://localhost/25-percent/');// 
    }
}
