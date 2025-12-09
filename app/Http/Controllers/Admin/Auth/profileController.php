<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\passwordRequest;
use App\Http\Requests\Admin\Auth\profileRequest;
use App\Repository\Admin\profileRepo;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
class profileController extends Controller
{
    protected ProfileRepo $profileRepo;    
    function __construct(profileRepo $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }
    public function show(): View{
        return view('admin-panel.pages.auth.profile');
    }
    public function update(profileRequest $request): RedirectResponse
    {
        return $this->profileRepo->update($request);
    }
    public function password(): View{
        return view('admin-panel.pages.auth.password');
    }
    public function update_password(passwordRequest $request): RedirectResponse
    {
        return $this->profileRepo->changePassword($request);
    }
}
