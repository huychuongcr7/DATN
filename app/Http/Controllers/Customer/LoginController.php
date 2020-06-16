<?php
namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
    protected $redirectTo = '/customer/customers';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('customer');
    }

    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|min:6|string'
        ]);

        $input = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => Customer::STATUS_ACTIVE
        ];

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('customer')->attempt($input, $request->remember)) {
            return redirect()->intended(Route('customers.index'));
        }

        return redirect()->back()->withInput($request->only('email','remember'))
            ->withErrors(['email' => 'Thông tin tài khoản không tìm thấy trong hệ thống!']);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        return redirect()->route( 'welcome');
    }
}
