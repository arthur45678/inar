<?php

namespace App\Models\Pages;

use App\Models\BaseModel;
use App\Models\Chart;
use App\Models\ImageOptimization;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\App;

class Pagequality extends BaseModel implements Searchable
{

    use HasSlug, HasTranslations;
    protected $table = 'pagequalities';
    protected $fillable = ['name','slug','text_top','chart_text_top_id','text_bottom','chart_text_bottom_id','page_img','page_img_bottom','page_img_mini','meta_desc','keywords',
        'service_name_1','service_icon_symbol_1','service_price_1','service_name_2','service_icon_symbol_2','service_price_2','service_name_3','service_icon_symbol_3','service_price_3',
        'service_name_4','service_icon_symbol_4','service_price_4','service_name_5','service_icon_symbol_5','service_price_5','service_name_6','service_icon_symbol_6','service_price_6',
        ];
    protected $translatable = ['name','text_top','text_bottom','meta_desc','keywords',
        'service_name_1','service_name_2','service_name_3',
        'service_name_4','service_name_5','service_name_6',
        'chart_text_top_id','chart_text_bottom_id',
        ];
    public function getSearchResult(): SearchResult
    {
        $url = 'site.qualities.showById';
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function charts()
    {
        return $this->morphToMany(Chart::class,'chartable')->withPivot('id','post_position');
    }

    public function storePageImage($request)
    {
        if($request->delete_page_img){
            $this->page_img = null;
        }
        if ($request->hasFile('page_img')) {
          //  $this->page_img = ImageOptimization::imageCropSave($request->page_img, config::get('settings.talent.page_img.height'),config::get('settings.talent.page_img.width'), storage_path('app/public/images'));
            $this->page_img = ImageOptimization::imageStoreNoOptimize($request->page_img,  storage_path('app/public/images'));
        }
        $this->save();
    }

    public function storePageImageMini($request)
    {
        if($request->delete_page_img_mini){
            $this->page_img_mini = null;
        }
        if ($request->hasFile('page_img_mini')) {
          //  $this->page_img_mini = ImageOptimization::imageCropSave($request->page_img_mini, config::get('settings.talent.page_img_mini.height'),config::get('settings.talent.page_img_mini.width'), storage_path('app/public/images'));
            $this->page_img_mini =  ImageOptimization::imageStoreNoOptimize($request->page_img_mini,  storage_path('app/public/images'));
        }
        $this->save();
    }

    public function storePageImageBottom($request)
    {
        if($request->delete_page_img_bottom){
            $this->page_img_bottom = null;
        }
        if ($request->hasFile('page_img_bottom')) {
          //  $this->page_img_bottom = ImageOptimization::imageCropSave($request->page_img_bottom, 310, 1024, storage_path('app/public/images'));
            $this->page_img_bottom = ImageOptimization::imageStoreNoOptimize($request->page_img_bottom,  storage_path('app/public/images'));
        }
        $this->save();
    }


    public function service_icon_symbol_1($request)
    {
        if($request->service_icon_symbol_1){
            $this->service_icon_symbol_1 = null;
        }
        if ($request->hasFile('service_icon_symbol_1')) {
            $this->service_icon_symbol_1 = ImageOptimization::imageCropSave($request->service_icon_symbol_1, 100, 100, storage_path('app/public/images'));
        }
        $this->save();
    }

    public function service_icon_symbol_2($request)
    {
        if($request->service_icon_symbol_2){
            $this->service_icon_symbol_2 = null;
        }
        if ($request->hasFile('service_icon_symbol_2')) {
            $this->service_icon_symbol_2 = ImageOptimization::imageCropSave($request->service_icon_symbol_2, 100, 100, storage_path('app/public/images'));
        }
        $this->save();
    }
    public function service_icon_symbol_3($request)
    {
        if($request->service_icon_symbol_3){
            $this->service_icon_symbol_3 = null;
        }
        if ($request->hasFile('service_icon_symbol_3')) {
            $this->service_icon_symbol_3 = ImageOptimization::imageCropSave($request->service_icon_symbol_3, 100, 100, storage_path('app/public/images'));
        }
        $this->save();
    }

    public function service_icon_symbol_4($request)
    {
        if($request->service_icon_symbol_4){
            $this->service_icon_symbol_4 = null;
        }
        if ($request->hasFile('service_icon_symbol_4')) {
            $this->service_icon_symbol_4 = ImageOptimization::imageCropSave($request->service_icon_symbol_4, 100, 100, storage_path('app/public/images'));
        }
        $this->save();
    }

    public function service_icon_symbol_5($request)
    {
        if($request->service_icon_symbol_5){
            $this->service_icon_symbol_5 = null;
        }
        if ($request->hasFile('service_icon_symbol_5')) {
            $this->service_icon_symbol_5 = ImageOptimization::imageCropSave($request->service_icon_symbol_5, 100, 100, storage_path('app/public/images'));
        }
        $this->save();
    }

    public function service_icon_symbol_6($request)
    {
        if($request->service_icon_symbol_6){
            $this->service_icon_symbol_6 = null;
        }
        if ($request->hasFile('service_icon_symbol_6')) {
            $this->service_icon_symbol_6 = ImageOptimization::imageCropSave($request->service_icon_symbol_6, 100, 100, storage_path('app/public/images'));
        }
        $this->save();
    }

    public function chartTextTop()
    {
        return $this->belongsTo(Chart::class,'chart_text_top_id','id')->where(['lang' => App::getLocale()]);
    }


    public function chartTextBottom()
    {
        return $this->belongsTo(Chart::class,'chart_text_bottom_id','id')->where(['lang' => App::getLocale()]);
    }

}
