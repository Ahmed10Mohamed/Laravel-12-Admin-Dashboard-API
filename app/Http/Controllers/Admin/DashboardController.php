<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Admin\dashboardRepo;
use Illuminate\Contracts\View\View;
class DashboardController extends Controller
{
    protected dashboardRepo $dashboardRepo;
    function __construct(dashboardRepo $dashboardRepo){
        $this->dashboardRepo = $dashboardRepo;
    }
    public function __invoke(): View{
        return $this->dashboardRepo->dashboard();

    }

}
