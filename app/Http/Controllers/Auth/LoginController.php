<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Home;
use App\Models\Service;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\DspaceLink;
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
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        $data["services"] = Service::all();
        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Home::where("home_type","Goals")->get();

        $data["news"] = Advertisement::where("archieve",0)->get();
        return view('auth.login',$data);
    }
}
