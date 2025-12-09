<?php

namespace App\Repository\Admin;

use App\Models\Academy;
use App\Models\subscribePackage;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class dashboardRepo
{
  public function dashboard()
    {

        return view('admin-panel.pages.dashboard');
    }


}