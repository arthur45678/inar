<?php

namespace App\Http\Controllers\Site;

use App\Enums\PostsEnum;
use App\Http\Controllers\Controller;
use Doctrine\DBAL\Driver\AbstractDB2Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class ArticlesController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->where('posts_type', PostsEnum::article())
            ->paginate(20);

        return view('site.articles.index')->with([
            'title' => 'Բոլոր նորությունները',
            'posts' => $posts,
        ]);

    }

    public function newsPage()
    {
        $last = Post::orderBy('id', 'desc')->where('posts_type', PostsEnum::article())->take(5)->first();
        $lastPost = Post::orderBy('id', 'desc')->where('posts_type', PostsEnum::article())->take(5)->get();

        return view('site.articles.newsPage')->with([
            'title' => 'Բոլոր նորությունները',
            'lastPost' => $lastPost,
            'last' => $last,
        ]);
    }

    public function pressReleases()
    {
        $lastPost = Post::orderBy('id', 'desc')->where('posts_type', PostsEnum::press_releases())->first();
        $mosPopularPosts = Post::mosPopularPressReleases();
        return view('site.press_releases.index')->with([
            'title' => 'Բոլոր նորությունները',
            'lastPost' => $lastPost,
            'mosPopularPosts' => $mosPopularPosts,
        ]);
    }

    public function categoryPosts($slug)
    {
        $category = Category::where(['slug' => $slug])->firstOrFail();

        $posts = Post::categoryPosts($category->id);
        return view('site.articles.categoryPosts')->with([
            'title' => $category->name,
            'posts' => $posts,
            'category' => $category,
        ]);
    }

    public function tagPosts($slug)
    {
        $tag = Tag::where(['slug' => $slug])->firstOrFail();
        $posts = Post::getTagPosts($tag->id);
        return view('site.articles.tagPosts')->with([
            'title' => $tag->name,
            'posts' => $posts,
            'tag' => $tag,
        ]);

    }


    public function showById(Request $request)
    {
        $id = $request->id;
        $lang = $request->lang;
        $searchedText = $request->searchedText;

        $post = Post::findOrFail($id);
        if(!$post->hasTranslation('name',$lang)){
            abort(403);
        }

        return view('site.articles.showById', compact('post'))->with([
            'title' => $post->name,
            'lang' => $lang,
            'searchedText' => $searchedText,
        ]);

    }


    public function show($slug)
    {

        $post = Post::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }

        $post->increment('view_count');
        $categories = $post->categories()->get();
        $tags = Tag::getPostsTags($post->id);

        return view('site.articles.show', compact('categories'))->with([
            'title' => $post->name,
            'post' => $post,
            'tags' => $tags,
        ]);
    }
}
