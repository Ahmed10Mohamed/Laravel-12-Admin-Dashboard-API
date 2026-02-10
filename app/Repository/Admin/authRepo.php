<?php

namespace App\Repository\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authRepo
{
    public function login($request)
    {
        $admin = Admin::where('email', '=', $request->email)->orWhere('userName', $request->email)->first();

        if ($admin === null) {
            return redirect()->back()->with('fail', translate('this user name or email not found'));
        } elseif (! Hash::check($request->password, $admin->password)) {
            return redirect()->back()->with('fail', translate('this passoword not correct'));
        } elseif (! $admin->isActive) {
            return redirect()->back()->with('fail', translate('this account not active'));
        }
        $rememberMe = $request->rememberMe ? true : false;
        Auth::guard('admin')->login($admin, $rememberMe);

        return redirect()->route('Admin-Dashboard')->with(translate('this account login success'));
    }

    public function logout($request)
    {
        $this->guard()->logout();

        // $request->session()->invalidate();
        return redirect()->route('login')->with(translate('logout success'));
    }

    private function guard()
    {
        return Auth::guard('admin');
    }
}
