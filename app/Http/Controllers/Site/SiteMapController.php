<?php

namespace App\Http\Controllers\Site;

use App\Enums\FooterMenusEnum;
use App\Models\Category;
use App\Models\Detailtype;
use App\Models\Footermenu;
use App\Models\Home\OurMissionsMenu;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SiteMapController extends Controller
{
    public function index()
    {
        $rows = Menu::getMenus(App::getLocale());
        $menu_tree = Menu::buildTreeForSelectMultiLevel($rows);
        $our_mission = OurMissionsMenu::where('lang', app()->getLocale())->get();
        $footer = Footermenu::where('lang', app()->getLocale())->orderBy('type', 'desc')->get();

        $assetPath = "true";
        return view('site.siteMap.index')->with([
            'rows' => $rows,
            'our_mission' => $our_mission,
            'menu_tree' => $menu_tree,
            'assetPath' => $assetPath,
            'footer' => $footer,
        ]);
        //return view('site.siteMap.index', compact('','menu_tree','assetPath'  ));
    }
}
