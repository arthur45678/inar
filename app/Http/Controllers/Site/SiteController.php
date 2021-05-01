<?php

namespace App\Http\Controllers\Site;

use App\Enums\FooterMenusEnum;
use App\Models\Category;
use App\Models\Detailtype;
use App\Models\Footermenu;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class SiteController extends Controller
{
    protected $vars = [];
    protected $template;


    protected $keywords;
    protected $meta_desc;
    protected $title;
    protected $title_path;
    protected $title_desc;
    protected $title_desc_link;
    protected $page_image;
    protected $theme;


    public function __construct()
    {
        view()->share([
            'menu_tree' => $this->getTopMenu(),
            'imagePath' => asset('storage/images'),
            'assetPath' => asset('asset/site'),
            'imagesServe' => asset('imagesServe'),
            'page_image' => $this->page_image,
            'title' => $this->title,
            'footerMenusTop' => $this->footerMenuTop(),
            'footerMenusBottom' => $this->footerMenuBottom(),
            'footerMenusSocial' => $this->footerMenuSocial(),

                ]
            );
    }

    public function getTopMenu()
    {
        $rows = Menu::getMenus(App::getLocale());
        return Menu::buildTreeForSelectMultiLevel($rows);


        // $menuitems = Menu::isLive()
        //     ->ofSort(['parent_id' => 'asc', 'sort_order' => 'asc'])
        //     ->get();


       // return buildTree($menuitems);
    }

    public function getHeader()
    {

        $rows = Menu::getMenus(App::getLocale());
        $menu_tree = Menu::buildTreeForSelectMultiLevel($rows);

        return view('site.' .  '.includes.header')->with([
            'menu_tree' => $menu_tree,
        ]);
    }

    public function footerMenuTop()
    {
        return Footermenu::where(['type' => FooterMenusEnum::top(), 'lang' => App::getLocale()])->get();
    }

    public function footerMenuBottom()
    {
        return Footermenu::where(['type' => FooterMenusEnum::bottom(), 'lang' => App::getLocale()])->get();

    }

    public function footerMenuSocial()
    {
        return Footermenu::where(['type' => FooterMenusEnum::social(),  'lang' => App::getLocale()])->get();
    }


    public function getFooter()
    {

    }

    public function getSidebar($cargeneration)
    {

        $detailTypes = Detailtype::isLive()
            ->ofSort(['parent_id' => 'asc', 'sort_order' => 'asc'])
            ->get();
        $detailTypes = buildTree($detailTypes);
        $latestProducts = Product::orderBy('id','Desc')->limit(4)->get();

        return view('site.includes.sidebar', compact( 'detailTypes', 'latestProducts', 'cargeneration'));
    }

    public function renderOutput()
    {

        $header = $this->getHeader();
        $this->vars = array_add($this->vars, 'header', $header);

        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'title_path', $this->title_path);
        $this->vars = array_add($this->vars, 'title_desc', $this->title_desc);
        $this->vars = array_add($this->vars, 'title_desc_link', $this->title_desc_link);
        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);

      /*


        /*
        $footer = $this->getFooter();
        $this->vars = array_add($this->vars, 'footer', $footer);

        $sidebar = $this->getSidebar();
        $this->vars = array_add($this->vars, 'sidebar', $sidebar);*/

      /*Test*/
     // echo '<pre>';  print_r($this->theme . '.' . $this->template); echo '</pre>'; exit();
      /*Testend*/


       return view('site.' . $this->template)->with($this->vars);
    }


}
