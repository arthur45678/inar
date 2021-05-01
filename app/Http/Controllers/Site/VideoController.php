<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = Video::orderBy('id', 'desc')
            ->paginate(20);

        return view('site.videos.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }
}
