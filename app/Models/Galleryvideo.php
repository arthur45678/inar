<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;
class Galleryvideo extends BaseModel
{
    use HasSlug, HasTranslations;

    protected $table = 'galleryvideos';
    protected $translatable = ['name','meta_desc','keywords'];
    protected $fillable = ['name','slug','page_img','meta_desc','keywords',];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function videos()
    {
        return $this->morphMany(Video::class,'videoable');
    }

    public function storePageImage($request)
    {
        if($request->delete_page_img){
            $this->page_img = null;
        }
        if ($request->hasFile('page_img')) {
           // $this->page_img = ImageOptimization::imageCropSave($request->page_img, config::get('settings.categories.page_img.height'), config::get('settings.categories.page_img.width'), storage_path('app/public/images'));
            $this->page_img = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));
        }
        $this->save();
    }


    public static function storeSettingsPageImage($request)
    {
        $group = 'Galeryvideos_Page_Image';
        $key = 'page_img';

        if($request->delete_page_img){
            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {
       //     $value = ImageOptimization::imageCropSave($request->page_img, 500, 1837, storage_path('app/public/images'));
            $value = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));
            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);
    }

}

