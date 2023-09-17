<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Termwind\Components\Dd;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->user()) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->back()->withInput();
            }
        } else {
            session()->put('faild', trans('auth.failed'));
            return redirect()->back()->withInput();
        }
    }
    public function showLoginForm()
    {
        $title = trans('common.Sign in');
        return view('AdminPanel.auth.login', [
            'active' => '',
        ], compact('title'));
    }
    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}
