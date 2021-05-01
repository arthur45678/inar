<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Menu;
use App\Models\Pages\Buisnessenvioirments;
use App\Models\Pages\Pagesimple;
use App\Models\Pages\Pagesimple2;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
class BuisnessenvioirmentsController extends SiteController
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
        $posts = Buisnessenvioirments::orderBy('id', 'desc')
            ->paginate(20);



        return view('site.pages.buisnessEnvioirments.index')->with([
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

        $post = Buisnessenvioirments::findOrFail($id);
        if(!$post->hasTranslation('name',$lang)){
            abort(403);
        }

        return view('site.pages.buisnessEnvioirments.showById', compact('post'))->with([
            'title' => $post->name,
            'lang' => $lang,
            'searchedText' => $searchedText,
        ]);
    }


    public function show($slug)
    {

        $post = Buisnessenvioirments::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }

       /*if($post->name == 'Buissness Environment'){
            $postName = "Business Environment";
        }*/
        if($post->name=='Textile and Garment'){
            $postName ='Textile & Garment';
        }
        elseif($post->name=='Information and Communication Technology'){
            $postName ='ICT';
        }
        elseif ($post->name=='Տեղեկատվական տեխնոլոգիակներ և հեռահաղորդակցություն'){
            $postName ='ՏՀՏ';
        }
        else{
            $postName = $post->name;
        }

        $menus = DB::table('menus')->where('title',$postName)->first();
        $parent = DB::table('menus')->where('id',$menus->parent)->first();
        $parent_par = DB::table('menus')->where('id',$parent->parent)->first();


        return view('site.pages.buisnessEnvioirments.show', compact('post','parent','parent_par'))->with([
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
