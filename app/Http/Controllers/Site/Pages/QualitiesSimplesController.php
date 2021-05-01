<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Menu;
use App\Models\Pages\Pagequality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualitiesSimplesController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = Pagequality::orderBy('id', 'desc')
            ->paginate(20);

        return view('site.pages.qualities.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function showById(Request $request)
    {
        $id = $request->id;
        $lang = $request->lang;
        $searchedText = $request->searchedText;

        $post = Pagequality::findOrFail($id);
        if(!$post->hasTranslation('name',$lang)){
            abort(403);
        }
        return view('site.pages.qualities.showById', compact('post'))->with([
            'title' => $post->name,
            'searchedText' => $searchedText,
        ]);
    }

    public function show($slug)
    {
        $post = Pagequality::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }
        $postName = $post->name;

        $menus = DB::table('menus')->where('title',$postName)->first();
        $parent = DB::table('menus')->where('id',$menus->parent)->first();
        $parent_par = DB::table('menus')->where('id',$parent->parent)->first();
        return view('site.pages.qualities.show', compact('post','parent','parent_par'))->with([
            'title' => $post->name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
