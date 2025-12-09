<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\auth_request;
use App\Http\Requests\Api\Auth\changePassword_request;
use App\Http\Requests\Api\Auth\login_request;
use App\Http\Requests\Api\Auth\update_fcm_request;
use App\Http\Requests\Api\Auth\updateProfile_request;
use App\Repository\Api\VI\Auth\UserAuthRepo;

class AuthController extends Controller
{
    protected UserAuthRepo $userAuthRepo;

    public function __construct(UserAuthRepo $userAuthRepo)
    {
        $this->userAuthRepo = $userAuthRepo;
    }

    public function register(auth_request $request)
    {
        return $this->userAuthRepo->register($request);
    }

    public function login(login_request $request)
    {
        return $this->userAuthRepo->login($request);
    }

    public function logout()
    {
        return $this->userAuthRepo->logout();
    }

    public function show_profile()
    {
        return $this->userAuthRepo->showProfile();
    }

    public function update_profile(updateProfile_request $request)
    {
        return $this->userAuthRepo->updateProfile($request);
    }

    public function changePassword(changePassword_request $request)
    {
        return $this->userAuthRepo->changePassword($request);
    }

    public function destroy()
    {
        return $this->userAuthRepo->destroy();
    }

    public function update_fcm(update_fcm_request $request)
    {
        return $this->userAuthRepo->update_fcm($request);
    }
  
}
