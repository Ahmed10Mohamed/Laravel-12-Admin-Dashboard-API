<?php

namespace App\Interfaces;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

// use Intervention\Image\Facades\Image;
class ImageVideoUpload
{
  

    public function StoreImageSingleWithOutLogo($upload, $model)
    {

        $image = $upload;
        $imageName = uniqid().'.webp';

        $destinationPath = public_path('/uploads/image/'.$model);
        $image->move($destinationPath, $imageName);
        $name = '/uploads/image/'.$model.'/'.$imageName;

        return $name;
    }

    public function DeleteImageSingle($image_data)
    {
        if (File::exists(public_path().$image_data)) {
            File::delete(public_path().$image_data);
        }

    }

    public function UpdateImageSingleWithOutLogo($upload, $model, $image_data)
    {
        if (File::exists(public_path().$image_data)) {
            File::delete(public_path().$image_data);
        }

        $image = $upload;
        $imageName = uniqid().'.webp';

        $destinationPath = public_path('/uploads/image/'.$model);
        $image->move($destinationPath, $imageName);
        $name = '/uploads/image/'.$model.'/'.$imageName;

        return $name;
    }

   

    public function StoreFileSingle($upload, $model)
    {

        $image = $upload;

        $imageName = uniqid().'.'.$image->getClientOriginalExtension(); // Ensures a unique name
        $destinationPath = public_path('/uploads/file/'.$model);
        $image->move($destinationPath, $imageName);
        $name = '/uploads/file/'.$model.'/'.$imageName;

        return $name;
    }

    public function UpdateFileSingle($upload, $model, $image_data)
    {
        if (File::exists(public_path().$image_data)) {
            File::delete(public_path().$image_data);
        }

        $image = $upload;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/file/'.$model);
        $image->move($destinationPath, $imageName);
        $name = '/uploads/file/'.$model.'/'.$imageName;

        return $name;
    }
}
