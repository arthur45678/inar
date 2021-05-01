<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Youtube;
use Illuminate\Http\Request;

class YoutubeController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = Youtube::orderBy('id', 'desc')
            ->paginate(20);

        return view('site.youtubes.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }
}
