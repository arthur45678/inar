<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class Category extends BaseModel
{
    protected $guarded = [];

    protected $table = 'categories';
    protected $fillable = ['name','parent_id','sort_order','live','meta_desc','keywords','img','page_img',];
    protected $translatable = ['name','meta_desc','keywords'];

    use HasSlug, HasTranslations;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function scopeIsLive($query)
    {
        return $query->where('live', true);
    }

    public function scopeOfSort($query, $sort)
    {
        foreach ($sort as $column => $direction) {
            $query->orderBy($column, $direction);
        }
        return $query;
    }


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_categories', 'category_id','post_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public static function deleteCategryItem($id)
    {

        // Childs, who have -parent this category, parent 0
        $item = new static();

        foreach ($item->where(['parent_id' => $id])->get() as $item) {
            $item->parent_id = 0;
            $item->save();
        }
        $item = $item->where(['id' => $id])->first();
        $item->delete();
        return $item;

    }

    public function storeImage($request)
    {
        if($request->delete_img){
            $this->img = null;
        }
        if ($request->hasFile('img')) {
           // $this->img = ImageOptimization::imageCropSave($request->img, 2000, 2000, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,storage_path('app/public/images'));
        }
        $this->save();
    }

    public function storePageImage($request)
    {
        if($request->delete_page_img){
            $this->page_img = null;
        }
        if ($request->hasFile('page_img')) {
        //    $this->page_img = ImageOptimization::imageCropSave($request->page_img, config::get('settings.categories.page_img.height'), config::get('settings.categories.page_img.width'), storage_path('app/public/images'));
            $this->page_img = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));
        }
        $this->save();
    }



}
