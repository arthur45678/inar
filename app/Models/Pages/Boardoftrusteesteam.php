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

class Boardoftrusteesteam extends BaseModel  implements Searchable
{
    use HasSlug, HasTranslations;
    protected $table = 'boardoftrusteesteams';
    protected $fillable = ['f_name','l_name','department_id','position','position_1','position_2','email','phone','img','short_desc',];
    protected $translatable = ['f_name','l_name','department','position','position_1','position_2','short_desc',];

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.users.index', ['id' => $this->id, 'lang' => false]);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
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

        $group = 'Our_Board_of_Trustees';
        $key = 'page_img';

        if($request->delete_page_img){

            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {

           // $value = ImageOptimization::imageCropSave($request->page_img, 500, 1837, storage_path('app/public/images'));
            $value = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));

            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);

    }
}
