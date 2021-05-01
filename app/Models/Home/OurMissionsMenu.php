<?php

namespace App\Models\Home;

use App\Models\ImageOptimization;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OurMissionsMenu extends Model
{
    protected $table = 'ourmissionsmenus';

    protected $fillable = ['parent', 'lang', 'title', 'path','img'];

    public static function getMenus($lang)
    {
        return (array) DB::select("SELECT * FROM ourmissionsmenus WHERE lang = '$lang'");
    }

    public static function storeTopMenu($request)
    {
        $input = $request->all();
        return self::create($input);
    }

    public static function storeBottomMenu($request)
    {
        $input = $request->all();
        return self::create($input);
    }

    public static function storeSocialLinksMenu($request)
    {
        $input = $request->all();
        return self::create($input);
    }

    public function storeImage($request)
    {
        if($request->delete_img){
            $this->img = null;
        }
        if ($request->hasFile('img')) {
            $this->img = ImageOptimization::imageStoreNoOptimize($request->img,  storage_path('app/public/images'));
        }
        $this->save();
    }
}
