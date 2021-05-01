<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class Tag extends BaseModel
{
    protected $table = 'tags';
    protected $translatable = ['name','meta_desc','keywords','img','page_img','page_img_mini'];
    protected $fillable = ['name','meta_desc','keywords'];

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

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags', 'tag_id','post_id');
    }

    public static function getPostsTags($post_id)
    {
        return self::whereHas('posts', function ($query) use($post_id){
            $query->where(['post_id' => $post_id]);
        })->get();
    }

    public function storeImage($request)
    {
        if($request->delete_img){
            $this->img = null;
        }
        if ($request->hasFile('img')) {
          //  $this->img = ImageOptimization::imageCropSave($request->img, 2000, 2000, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,  storage_path('app/public/images'));
        }
        $this->save();
    }

    public function storePageImage($request)
    {
        if($request->delete_page_img){
            $this->page_img = null;
        }
        if ($request->hasFile('page_img')) {
        //    $this->page_img = ImageOptimization::imageCropSave($request->page_img, 300, 836, storage_path('app/public/images'));
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
         //   $this->page_img_mini = ImageOptimization::imageCropSave($request->page_img_mini, 473, 264, storage_path('app/public/images'));
            $this->page_img_mini = ImageOptimization::imageStoreNoOptimize($request->page_img_mini,  storage_path('app/public/images'));
        }
        $this->save();
    }
}
