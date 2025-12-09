<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\loginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Repository\Admin\authRepo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;   
class authController extends Controller
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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    protected authRepo $authRepo;
    function __construct(authRepo $authRepo){
        $this->authRepo = $authRepo;
    }
    public function showLoginForm(): View
    {
        return view('admin-panel.auth.login');
    }

    public function login(loginRequest $request): RedirectResponse
    {
        return $this->authRepo->login($request);

    }
    public function logout(Request $request): RedirectResponse
    {
       return $this->authRepo->logout($request);

    }

}
