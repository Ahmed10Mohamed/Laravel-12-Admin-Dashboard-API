<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Admin\AboutSectionRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutSectionController extends Controller
{
    protected AboutSectionRepo $aboutSectionRepo;

    public function __construct(AboutSectionRepo $aboutSectionRepo)
    {
        $this->aboutSectionRepo = $aboutSectionRepo;
    }

    public function edit(string $position): View
    {
        return $this->aboutSectionRepo->edit($position);
    }

    public function update(Request $request): JsonResponse
    {
        return $this->aboutSectionRepo->update($request);
    }
}
