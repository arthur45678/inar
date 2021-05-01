<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['parent', 'lang', 'title', 'path', 'status'];

    public static function getMenus($lang)
    {
        return (array) DB::select("SELECT * FROM menus WHERE lang = '$lang'");
    }




    public static function buildTreeForSelectMultiLevel(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            $d = (array) $d;
            if ($d['parent'] == $parent) {
                $children = self::buildTreeForSelectMultiLevel($data, $d['id']);
                // set a trivial key
                if (!empty($children)) {
                    $d['_children'] = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }


    public static function storeMenu($request)
    {
        $input = $request->all();

        return self::create($input);
    }

    public static function updateMenu($request, $id)
    {
        $input = $request->all();
        $item = self::findOrFail($id);
        return $item->update($input);
    }

    public static function deleteMenuItem($id)
    {

        self::findOrFail($id)->delete();

        $childeItems = self::whereIn('parent', [$id])->update(['parent' => 0]);
        return true;
    }

    public static function getTranslateTitles($menu_id)
    {

        $sql = "SELECT * FROM menus WHERE parent = '$menu_id'";
        $result = DB::select($sql);

        $str = '';
        foreach ($result as $item) {
            $str .= ' ' . $item->locale . ' -> ' .$item->title . ' |';
        }

        $str = rtrim($str, '|');
        return $str;
    }


}
