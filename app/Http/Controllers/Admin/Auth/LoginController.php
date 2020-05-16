<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    // protected function credentials(Request $request)
    // {
    //     $credentials =  $request->only($this->username(), 'password');
    //     return array_add($credentials , 'status',1);
    // }

    protected function validateLogin(Request $request)
{
    $this->validate($request, [
        $this->username() => 'exists:admins,' . $this->username() . ',status,1',
        'password' => 'required|string',
    ], [
        $this->username() . '.exists' => 'This account is Inactive , Contact Admin.'
    ]);
}

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
}
