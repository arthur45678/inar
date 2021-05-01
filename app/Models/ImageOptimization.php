<?php

namespace App\Models;


use Intervention\Image\Facades\Image;
//use Intervention\Image\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImageOptimization extends Model
{

    public static function imageCropSave($imageRequestFile, $height, $width, $path = false, $setSaveName = false)
    {

        if($path == FALSE){
            $path = public_path().'/images/';
        }
        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if(isset($imageRequestFile) && $imageRequestFile->isValid()){
            $str = Str::random(20);
            $obj = new \stdClass;

            if($setSaveName){
                $obj->post_img = $setSaveName .'.'. $imageRequestFile->getClientOriginalExtension();
            }else{
                $obj->post_img = $str.'_' . $imageRequestFile->getClientOriginalName();
            }
            $img = Image::make($imageRequestFile);

            $img->fit( $width,$height)
                ->save($path. '/'. $obj->post_img);
            return $obj->post_img;
        }

    }

        /*
        * // $path - linklke this public_path().'/images/';
        */
    public static function imageCropAndResizeSave($imageRequestFile, $width = false, $height = false, $path, $setSaveName = false)
    {
        // Srancic meknumek@ FALSE piti lini ($width, $height)
        if($width && $height){
            return 'Set value only one (width or height)';
        }

        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if($imageRequestFile->isValid()){
            $str = Str::random(8);
            $obj = new \stdClass;

            if($setSaveName){
                $obj->post_img = $setSaveName;
            }else{
                $obj->post_img = $str.'_' . $imageRequestFile->getClientOriginalName();
            }
            $img = Image::make($imageRequestFile);

            if($width){
                $img->widen($width);
            }
            if($height){
                $img->heighten($height);
            }
            $img->save($path. '/'. $obj->post_img);

        }
        return $obj->post_img;
    }

    /*
    * // $path - linklke this public_path().'/images/';
    */
    public static function imageStoreNoOptimize($file, $path, $name = false)
    {

        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if($file->isValid()){
            $str = Str::random(8);

            if($name == false){
               $name = $str.'_' . $file->getClientOriginalName();
            }

            $file->move($path, $name);
            return $name;
        }
    }

    /*
     * // $path - linklke this public_path().'/images/';
     */
    public static function imageResizeOnlyTheWidth($imageRequestFile, $width, $path, $setSaveName = false)
    {
        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if($imageRequestFile->isValid()){
            $str = Str::random(8);
            $obj = new \stdClass;

            if($setSaveName){
                $obj->post_img = $setSaveName;
            }else{
                $obj->post_img = $str.'_' . $imageRequestFile->getClientOriginalName();
            }
            $img = Image::make($imageRequestFile);

            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            }
            )->save($path. '/'. $obj->post_img);
        }
        return $obj->post_img;
    }

    // $path - public_path().'/images/';
     public static function imageResizeOnlyTheHeight($imageRequestFile, $height, $path, $setSaveName = false)
     {
        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if($imageRequestFile->isValid()){
            $str = Str::random(8);
            $obj = new \stdClass;

            if($setSaveName){
                $obj->post_img = $setSaveName;
            }else{
                $obj->post_img = $str.'_' . $imageRequestFile->getClientOriginalName();
            }
            $img = Image::make($imageRequestFile);

            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            }
            )->save($path. '/'. $obj->post_img);
        }
        return $obj->post_img;
    }

    //$path - public_path().'/images/';
    public static function deleteImage($fileName, $path)
    {
        if($fileName && file_exists($path . '/' . $fileName)){
            unlink($path . '/' . $fileName);
        }
    }





}
