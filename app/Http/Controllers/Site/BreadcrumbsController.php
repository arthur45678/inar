<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;

class BreadcrumbsController extends Controller
{
    public function breadcrumbs(Request $request){
        $menu = $request->menu;
    /*use Illuminate\Support\Facades\DB;
        $menus = DB::table('menus')->where('title',$post->name)->first();
        $parent = DB::table('menus')->where('id',$menus->parent)->first();
        $parent_par = DB::table('menus')->where('title',$menus->parent)->first();*/
        session()->put('menu', $request->menu);
    }
}
