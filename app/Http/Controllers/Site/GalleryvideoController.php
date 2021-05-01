<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Galleryvideo;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryvideoController extends SiteController
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
        $posts = Galleryvideo::orderBy('id', 'desc')
            ->paginate(20);

        return view('site.galleryvideos.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }

    public function show($id)
    {

        $post = Video::firstOrFail($id);
        dd($post);
        return view('site.galleryvideos.show', compact('post'))->with([
            'title' => $post->name,
        ]);
    }
}
