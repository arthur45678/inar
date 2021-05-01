<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\App;

class Manager extends BaseModel implements Searchable
{
    protected $table = 'managers';
    protected $fillable = ['f_name','l_name','img','email','phone_1','phone_2','viber','whatsapp',];


    public function getSearchResult(): SearchResult
    {
        $url = route('admin.users.index', $this->slug);
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->f_name,
            $url
        );
    }

    public function users()
    {
        return $this->hasMany(User::class,'manager_id','id');
    }

    public function storePhoto(Request $request)
    {
        if ($request->hasFile('img')) {
        //    $this->img = ImageOptimization::imageCropSave($request->img, 400, 300, storage_path('app/public/images'));
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,storage_path('app/public/images'));
            $this->save();
        }
    }
}

