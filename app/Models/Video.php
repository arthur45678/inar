<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class Video extends BaseModel
{
    protected $table = 'videos';
    protected $fillable = ['name','file',];

    public static function storeSettingsPageImage($request)
    {
        $group = 'Video_Page_Image';
        $key = 'page_img';

        if($request->delete_page_img){

            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {

          //  $value = ImageOptimization::imageCropSave($request->page_img, config::get('settings.categories.page_img.height'), config::get('settings.categories.page_img.width'), storage_path('app/public/images'));
            $value = ImageOptimization::imageStoreNoOptimize($request->page_img,  storage_path('app/public/images'));

            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);

    }

    public function storeVideo($file)
    {

        $path = storage_path('app/public/files');
        if(!file_exists($path) ){
            mkdir($path, 0777, true);
        }

        if($file->isValid()){
            $str = Str::random(8);
            $name = $str.'_' . $file->getClientOriginalName();
            $file->move($path, $name);
            $this->file = $name;
        }
        $this->save();
    }


}
