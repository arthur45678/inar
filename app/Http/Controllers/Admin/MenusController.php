<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Facades\Config;
use App\Models\Menu;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class MenusController extends AdminController
{

    public function __construct()
    {

        $this->middleware('permission:menu-list');
        $this->middleware('permission:menu-create', ['only' => ['create','store']]);
        $this->middleware('permission:menu-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:menu-delete', ['only' => ['destroy']]);

        parent::__construct();
    }

    public function index()
    {
        $menusTree = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
            $rows = Menu::getMenus($localeCode);
            $tree = Menu::buildTreeForSelectMultiLevel($rows);
            $menusTree[$localeCode] = $tree;
        }

        //    $this->vars = array_add($this->vars, 'menusTree', $menusTree);

        //  $this->title = 'Menu';

        return view('admin.menus.index')
            ->with([
                'title' => 'Մենյու',
                'menusTree' => $menusTree,
            ]);

    }


    public function selectLanguage()
    {
        $title = 'Ընտրել լեզուն մենյուի համար';
        return view('admin.menus.selectLanguage', compact('title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $lang = $request->lang;
        //  $this->vars = array_add($this->vars, 'lang', $lang);

        if($lang == null){
            return redirect()->route('admin.menus.selectLanguage');
        }
        $data = [];

        $rows = Menu::getMenus($lang);
        $tree = Menu::buildTreeForSelectMultiLevel($rows);
        $data['parents'] = $tree;

        /*   $data['doctors_trans'] = DoctorsTranslation::where('locale', $lang)->orderBy('id', 'DESC')->take(15)->get();
           $data['clinics_trans'] = ClinicsTranslation::where('locale', $lang)->orderBy('id', 'DESC')->take(15)->get();
           $data['article_translations'] = ArticleTranlation::where('locale', $lang)->orderBy('id', 'DESC')->take(15)->get();
           $data['categoriesArticle_translations'] = CategoryTranslation::where('locale', $lang)->orderBy('id', 'DESC')->take(15)->get();*/


        //     $this->vars = array_add($this->vars, 'data', $data);

        $title = 'Ստեղծել մենյու';

        return  view('admin.menus.create', compact('title','lang','data'));

        //   return parent::renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'path' => 'required|url',
            'status' => 'required|max:11',
        ]);

        Menu::storeMenu($request);
        // return redirect()->route('admin.menus.index')->with(['success' => 'Добавлен']);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $post = Menu::findOrFail($id);
        $menu = $post;
        $lang = $post->lang;

        $rows = Menu::getMenus($lang);
        $tree = Menu::buildTreeForSelectMultiLevel($rows);
        $data['parents'] = $tree;


        $title = 'Ստեղծել մենյու';

        return  view('admin.menus.edit', compact('title','data','post','lang','tree','menu'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Menu::updateMenu($request, $id);
        return redirect()->route('admin.menus.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::deleteMenuItem($id);

        return redirect()->route('admin.menus.index')->with(['success' => 'Ջնջվեց']);
    }
}
