<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Pages\Pageinnovation;
use Illuminate\Http\Request;

class GalleriesController extends SiteController
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
        $posts = Gallery::with('images')->orderBy('id', 'desc')
            ->paginate(20);

        // dd($posts[0]);

        return view('site.galleries.index')->with([
            'posts' => $posts,
        ]);
    }

    public function show($slug)
    {
        $post = Gallery::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }
        return view('site.galleries.show', compact('post'))->with([
            'title' => $post->name,
        ]);
    }

}
