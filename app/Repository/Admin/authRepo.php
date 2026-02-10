<?php

namespace App\Repository\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class authRepo
{
    public function login($request){
        $admin = Admin::where('email', '=', $request->email)->orWhere('userName',$request->email)->first();
     
        if($admin === NULL)
        {
            return redirect()->back()->with('fail',"اسم المستخدم او البريد الالكترونى غير صحيح");
        }
        else if(!Hash::check($request->password, $admin->password))
        {
            return redirect()->back()->with('fail',"كلمة المرور غير صحيحة");
        }elseif(!$admin->isActive){
            return redirect()->back()->with('fail',"هذا الحساب معطل");
        }
        $rememberMe = $request->rememberMe?true:false;
        Auth::guard('admin')->login($admin, $rememberMe);
        return redirect()->route('Admin-Dashboard')->with('تم تسجيل الدخول بنجاح');
    }

    public function logout($request)
    {
        $this->guard()->logout();
        // $request->session()->invalidate();
        return redirect()->route('login')->with('تم تسجيل الخرور بنجاح');
    }
    private function guard()
    {
        return Auth::guard('admin');
    }


}