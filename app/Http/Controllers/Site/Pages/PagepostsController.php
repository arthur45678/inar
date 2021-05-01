<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PagepostsController extends SiteController
{
    public function show($slug)
    {
        $post = Post::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }

        return view('site.pages.pages-posts.show')->with([
            'title' => $post->name,
            'post' => $post,
        ]);
    }
}
