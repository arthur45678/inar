<?php

namespace App\Models\Pages;

use App\Models\BaseModel;
use App\Models\ImageOptimization;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\App;
class Aboutus extends BaseModel implements Searchable
{
    use HasSlug, HasTranslations;
    protected $table = 'aboutuses';
    protected $fillable = ['f_name','l_name','department_id','position','email','phone','img','short_desc',];
    protected $translatable = ['f_name','l_name','department','position','short_desc',];

    public function getSearchResult(): SearchResult
    {
        //$url = route('showTeamUser', ['id' => $this->id,'lang' => false]);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->f_name . ' ' .$this->l_name,
        //    $url
        );
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('f_name')
            ->saveSlugsTo('slug');
    }


    public function storeImage($request)
    {

        if($request->delete_img){
            $this->img = null;
        }
        if ($request->hasFile('img')) {
           // $this->img = ImageOptimization::imageCropSave($request->img, 283, 345, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,storage_path('app/public/images'));
        }
        $this->save();
    }


    public function department()
    {
        return $this->belongsTo(Employeedepartment::class,'department_id','id');
    }



    public static function storeSettingsPageImage($request)
    {

        $group = 'About_Us_Page_Image';
        $key = 'page_img';

        if($request->delete_page_img){

            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {

          //  $value = ImageOptimization::imageCropSave($request->page_img, config::get('settings.categories.page_img.height'), config::get('settings.categories.page_img.width'), storage_path('app/public/images'));
            $value = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));

            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);

    }

}
