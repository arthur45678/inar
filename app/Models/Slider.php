<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\ImageOptimization;
use Illuminate\Database\Eloquent\Model;
use \Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;

class Slider extends BaseModel
{
    use HasTranslations;
    protected $table = 'sliders';
    protected $fillable = ['name', 'desc', 'link', 'img', 'link_name'];
    protected $translatable = ['name', 'desc','link_name'];

    public function storeImage($request)
    {
        if ($request->delete_img) {
            $this->img = null;
        }
        if ($request->hasFile('img')) {
           // $this->img = ImageOptimization::imageCropSave($request->img, 2122, 4238,  storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,  storage_path('app/public/images'));
        }
        $this->save();
    }
}
