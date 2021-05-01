<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\ImageOptimization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use \Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class Broshyur extends BaseModel
{
    use HasTranslations;

    protected $table = 'broshyurs';
    protected $fillable = ['name','desc','img','file',];
    protected $translatable = ['name','desc',];

    public function storeImage($request)
    {
        if($request->delete_img){
            $this->img = null;
        }
        if ($request->hasFile('img')) {
            //$this->img = ImageOptimization::imageCropSave($request->img, 478, 357, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,storage_path('app/public/images'));
        }
        $this->save();
    }

    public static function storeSettingsPageImage($request)
    {
        $group = 'broshyur_Page_Image';
        $key = 'page_img';

        if($request->delete_page_img){
            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {
           // $value = ImageOptimization::imageCropSave($request->page_img, config::get('settings.categories.page_img.height'), config::get('settings.categories.page_img.width'), storage_path('app/public/images'));
            $value = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));
            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);
    }
}
