<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class Youtube extends BaseModel
{
    protected $table = 'youtubes';
    protected $fillable = ['youtube_link'];

    public static function storeSettingsPageImage($request)
    {
        $group = 'Youtube_Page_Image';
        $key = 'page_img';

        if($request->delete_page_img){

            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {

          //  $value = ImageOptimization::imageCropSave($request->page_img, 500, 1837, storage_path('app/public/images'));
            $value =  ImageOptimization::imageStoreNoOptimize($request->page_img,  storage_path('app/public/images'));

            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);

    }

}
