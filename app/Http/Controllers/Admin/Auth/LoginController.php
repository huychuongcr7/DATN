<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    protected $redirectTo = '/admin/dashboard';

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
            'email' => 'required|email|string',
            'password' => 'required|min:6|string'
        ]);

        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        if (Auth::guard('web')->attempt($input, $request->remember)) {
            if (Auth::user()->role == User::ROLE_ADMIN) {
                return redirect()->intended(Route('admin.dashboard'));
            } elseif (Auth::user()->role == User::ROLE_STOCKER) {
                return redirect()->intended(Route('stocker.bills.index'));
            } else return redirect()->intended(Route('shipper.bills.index'));
        }

        return redirect()->back()->withInput($request->only('email','remember'))
            ->withErrors(['email' => 'Thông tin tài khoản không tìm thấy trong hệ thống!']);;
    }
}
