<?php

namespace App\Models;

use App\Enums\PostsEnum;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Config;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\App;

class Post extends BaseModel implements Searchable
{
    public function getSearchResult(): SearchResult
    {
        $url = 'site.articles.showById';

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
    /**
     * Ես մոդեում պահվում են տարբեր տիպի պոստեր, օրինակ - հոդվածներ, նորություններ, միջոցառումներ:
     * Իսկ իրարից տարբերիչը posts_type ֆիլդինա: Որը որոշումա տիպը:
     */
    protected $table = 'posts';

    protected $fillable = [
        'name', 'desc', 'text', 'chart_text_top_id', 'meta_desc', 'keywords', 'img',
        'img_mini', 'page_img', 'publish', 'user_id', 'meta_desc', 'keywords', 'posts_type',
        'event_started_date', 'event_finished_date'
    ];
    protected $translatable = ['name', 'desc', 'text', 'meta_desc', 'keywords', 'meta_desc', 'keywords','chart_text_top_id',];

    use HasSlug, HasTranslations;


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /* public function charts()
    {
        return $this->morphToMany(Chart::class,'chartable')->withPivot('id','post_position');
    }*/


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories', 'post_id', 'category_id');
    }

    public function addCategories($input)
    {
        if (empty($input['categories'])) return false;
        $ids = $input['categories'];
        if (isset($ids)) {
            $this->categories()->sync($ids);
            return $this;
        }
        return false;
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    public static function mosPopularPosts()
    {
        return self::where('posts_type', PostsEnum::article())->orderBy('view_count', 'desc')->take(5)->get();
    }

    public static function mosPopularPressReleases()
    {
        return self::where('posts_type', PostsEnum::press_releases())->orderBy('view_count', 'desc')->take(5)->get();
    }


    public function addTags($input)
    {
        if (empty($input['tags'])) return false;
        $ids = $input['tags'];
        if (isset($ids)) {
            $this->tags()->sync($ids);
            return $this;
        }
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getTagPosts($tag_id)
    {
        return self::whereHas('tags', function ($query) use ($tag_id) {
            $query->where(['tag_id' => $tag_id]);
        })->orderBy('id', 'desc')
            ->paginate('20');
    }

    public static function categoryPosts($cat_id)
    {
        return self::whereHas('categories', function ($query) use ($cat_id) {
            $query->where('category_id', '=', $cat_id);
        })->orderBy('id', 'desc')
            ->paginate(20);
    }



    public function savePagePosts(Request $request)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::pagesPosts();
        $item = $this->fill($data);
        return $item->save();
    }

    public function updatePagePosts(Request $request, $id)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::pagesPosts()->getValue();
        $item = $this->update($data);
        return $item;
    }

    public function savePost(Request $request)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::article();
        $item = $this->fill($data);
        return $item->save();
    }

    public function saveRelease(Request $request)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::press_releases();
        $item = $this->fill($data);
        return $item->save();
    }

    public function updatePost(Request $request, $id)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::article()->getValue();
        $item = $this->update($data);
        return $item;
    }

    public function updateRelease(Request $request, $id)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::press_releases()->getValue();
        $item = $this->update($data);
        return $item;
    }

    public function saveEvent(Request $request)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::events();
        $item = $this->fill($data);
        return $item->save();
    }

    public function updateEvent(Request $request, $id)
    {
        $data = $request->only($this->fillable);
        $data['posts_type'] = PostsEnum::events()->getValue();
        $item = $this->update($data);
        return $item;
    }

    public function storeImage($request)
    {
        if ($request->delete_img) {
            $this->img = null;
        }
        if ($request->hasFile('img')) {
           // $this->img = ImageOptimization::imageCropSave($request->img, 300, 800, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,storage_path('app/public/images'));
        }
        $this->save();
    }

    public function storeMiniImage($request)
    {
        if ($request->delete_img_mini) {
            $this->img_mini = null;
        }
        if ($request->hasFile('img_mini')) {
           // $this->img_mini = ImageOptimization::imageCropSave($request->img_mini, 299, 499, storage_path('app/public/images'));
            $this->img_mini = ImageOptimization::imageStoreNoOptimize($request->img_mini,storage_path('app/public/images'));
        }
        $this->save();
    }

    //chart_text_top_id
    public function chartTextTop()
    {
        return $this->belongsTo(Chart::class, 'chart_text_top_id', 'id')->where(['lang' => App::getLocale()]);
    }

    public function storePageImage($request)
    {
        if ($request->delete_page_img) {
            $this->page_img = null;
        }
        if ($request->hasFile('page_img')) {
          //  $this->page_img = ImageOptimization::imageCropSave($request->page_img, 270, 985, storage_path('app/public/images'));
            $this->page_img = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));
        }
        $this->save();
    }

    public static function storeSettingsPageImage($request)
    {

        $group = 'Articles_Page_Image';
        $key = 'page_img';

        if($request->delete_page_img){

            settings()->group($group)->set($key, null);
        }
        if ($request->hasFile('page_img')) {

              $value = ImageOptimization::imageCropSave($request->page_img, config::get('settings.categories.page_img.height'), config::get('settings.categories.page_img.width'), storage_path('app/public/images'));
            $value = ImageOptimization::imageStoreNoOptimize($request->page_img,storage_path('app/public/images'));

            settings()->group($group)->set($key, $value);
        }
        return settings()->group($group)->get($key);

    }

    public static function storePressReleasesPageSettings($request)
    {

        $group = 'Pres-Release_Page_Image';
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
