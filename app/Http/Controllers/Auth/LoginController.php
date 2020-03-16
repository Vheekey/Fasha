<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
    }

    public function index(){
        return view('login');
    }

    
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'adminEmail'   => 'required|email',
            'adminPassword' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->adminEmail, 'password' => $request->adminPassword], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('adminEmail', 'remember'))->with('error', 'Login Failed, kindly confirm credentials');
    }

    public function vendorLogin(Request $request)
    {
        $this->validate($request, [
            'vendorEmail'   => 'required|email',
            'vendorPassword' => 'required|min:6'
        ]);

        if (Auth::guard('vendor')->attempt(['email' => $request->vendorEmail, 'password' => $request->vendorPassword], $request->get('remember'))) {

            return redirect()->intended('/vendor');
        }
        return back()->withInput($request->only('vendorEmail', 'remember'))->with('error', 'Login Failed, kindly confirm credentials');
    }
}
