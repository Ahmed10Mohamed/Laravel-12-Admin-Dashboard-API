<?php

namespace App\Repository\Admin;
use App\Interfaces\ImageVideoUpload;
use App\Models\AboutSection;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Message;
use App\Models\PostImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
class aboutSectionRepo
{
    private ImageVideoUpload $ImageUpload;
    public function __construct(ImageVideoUpload $ImageUpload)
    {
        $this->ImageUpload = $ImageUpload;
    }

  

    public function show($position)
    {
        $class = $position;
        $data = AboutSection::firstOrCreate(['position' => $position]);
        return view('admin-panel.pages.aboutsection.index',compact('class', 'data'));
    }
  
  
    public function update($request)
    {

        $data_req = $request->except('_token','image');
        DB::beginTransaction();

       try {
           $section = AboutSection::firstOrCreate(['position' => $request->position]);
             if($request->hasFile('image')){

                 $data_req['image'] = $this->ImageUpload->UpdateImageSingleWithOutLogo($request->hasFile('image'),'AboutSection',image_data: $section->image);
                }
                $section->update($data_req);
            DB::commit();
                return redirect()->back()->with('success','تم التعديل بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail',$e->getMessage());

        }



    }



}