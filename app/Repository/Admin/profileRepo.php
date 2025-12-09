<?php

namespace App\Repository\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\ImageVideoUpload;

class profileRepo
{
    private ImageVideoUpload $ImageUpload;
    public function __construct(ImageVideoUpload $ImageUpload)
    {
        $this->ImageUpload = $ImageUpload;
    }

   public function update($request){
        $data_req  = $request->except('_token');
        $data = User::findOrfail(admin()->id);
        DB::beginTransaction();
        try {
            if($request->hasFile('image')){
                $data_req['image'] = $this->ImageUpload->UpdateImageSingleWithOutLogo   ($request->file  ('image'),'Admin',$data->image);
               }
            $data->update($data_req);
            DB::commit();
            return redirect()->back()->with('success','تم تعديل البيانات بنجاح');

        } catch (\Exception $e) {
            DB::rollback();
         //    dd($e->getMessage());
             return redirect()->back()->with('fail',$e->getMessage());
         }
   }
   public function changePassword($request){
        $data = User::findOrfail(admin()->id);
        if(!Hash::check($request->current_password, $data->password))
        {
            return redirect()->back()->with('fail','كلمة المرور الحالية غير صحيحة');
        }
        $password = bcrypt($request->password);

        DB::beginTransaction();
        try {
            $data->update(['password'=>$password]);
            DB::commit();
            return redirect()->back()->with('success','تم تحديث البيانات بنجاح');

        } catch (\Exception $e) {
            DB::rollback();
             return redirect()->back()->with('fail',$e->getMessage());
         }

   }

}
