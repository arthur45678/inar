<?php

namespace App\Models\Home;

use App\Models\BaseModel;
use App\Models\ImageOptimization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use \Spatie\Translatable\HasTranslations;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Discoveryarmenia extends BaseModel implements Searchable
{
    use HasTranslations;

    protected $table = 'discoveryarmenias';
    protected $fillable = ['name','desc','img','file',];
    protected $translatable = ['name','desc',];

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.users.index', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function storeImage($request)
    {
        if($request->delete_img){
            $this->img = null;
        }
        if ($request->hasFile('img')) {
          //  $this->img = ImageOptimization::imageCropSave($request->img, 478, 357, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,storage_path('app/public/images'));
        }
        $this->save();
    }



}
