<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Pages\Pagesimple;
use App\Models\Pages\Pagetalent;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PagesTalentsController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Pagetalent::orderBy('id', 'desc')
            ->paginate(20);
        return view('site.pages.talents.index')->with([
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

        $post = Pagetalent::findOrFail($id);
        if(!$post->hasTranslation('name',$lang)){
            abort(403);
        }

        return view('site.pages.talents.showById', compact('post'))->with([
            'title' => $post->name,
            'lang' => $lang,
            'searchedText' => $searchedText,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Pagetalent::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }
        return view('site.pages.talents.show', compact('post'))->with([
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
