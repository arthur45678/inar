<?php

namespace App\Http\Controllers\Admin\Home;

use App\Enums\FooterMenusEnum;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Footermenu;
use App\Models\Home\OurMissionsMenu;
use App\Models\Settings;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class OurMissionsMenusController extends AdminController
{
    public function __construct()
    {

        $this->middleware('permission:menu-list');
        $this->middleware('permission:menu-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menu-delete', ['only' => ['destroy']]);

        parent::__construct();
    }

    public function index()
    {

        $menus = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rows = OurMissionsMenu::getMenus($localeCode);
            $menus[$localeCode] = $rows;
        }

        return view('admin.home.ourMissionsMenus.index')
            ->with([
                'title' => 'Մեր առաքելությունը',
                'menus' => $menus,
            ]);
    }


    public function selectLanguage()
    {
        $title = 'Ընտրել լեզուն մենյուի համար';
        return view('admin.home.ourMissionsMenus.selectLanguage', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $lang = $request->lang;

        if ($lang == null) {
            return redirect()->route('admin.home.ourMissionsMenus.selectLanguage');
        }
        $data = [];

        $rows = OurMissionsMenu::getMenus($lang);

        $title = 'Ավելացնե';

        return  view('admin.home.ourMissionsMenus.create', compact('title', 'lang', 'data'));
    }

    public function storeOurMissionsMenusPageSettings(Request $request)
    {
        $data = $request->all();
        Settings::storeMultilanguageSettings($data);
        return redirect()->back();
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
        ]);

        $item = OurMissionsMenu::storeBottomMenu($request);
        $item->storeImage($request);
        return back()->with(['success' => 'Ավելացվեց']);
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
        $post = OurMissionsMenu::findOrFail($id);
        $lang = $post->lang;
        return view('admin.home.ourMissionsMenus.edit')->with([
            'title' => 'Փոփոխել',
            'post' => $post,
            'lang' => $lang,
        ]);
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
        $request->validate([
            'img' => 'nullable|file',
            'lang' => 'required|string',
            'title' => 'required|max:255',
            'path' => 'required|url'
        ]);

        $item = OurMissionsMenu::findOrFail($id);
        $item->update($request->all());
        $item->storeImage($request);
        return redirect()->back()->with(['success' => 'Обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = OurMissionsMenu::find($id);
        $item->delete();

        return redirect()->route('admin.home.ourMissionsMenus.index')->with(['success' => 'Ջնջվեց']);
    }
}
