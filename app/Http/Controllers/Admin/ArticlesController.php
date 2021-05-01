<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostsEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chart;
use App\Models\ImageOptimization;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ArticlesController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:posts-list');
        $this->middleware('permission:posts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        parent::__construct();
    }


    public function index(Request $request)
    {
        $query = Post::where(['posts_type' => PostsEnum::article()])->orderByDesc('id');
        // $query = Post::orderByDesc('id');
        if (!empty($value = $request->get('search-text'))) {
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $query->where("name->$localeCode", 'like', '%' . $value . '%');
            }
        }
        $posts = $query->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.articles.index')->with([
            'title' => 'Բոլոր Նորությունները',
            'posts' => $posts,
        ]);
    }

    public function pressReleases(Request $request)
    {
        $query = Post::where(['posts_type' => PostsEnum::press_releases()])->orderByDesc('id');
        // $query = Post::orderByDesc('id');
        if (!empty($value = $request->get('search-text'))) {
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $query->where("name->$localeCode", 'like', '%' . $value . '%');
            }
        }
        $posts = $query->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.articles.index')->with([
            'title' => 'Բոլոր Պրեսս-Ռելիզները',
            'posts' => $posts,
        ]);
    }


    public function storePageSettings(Request $request)
    {

        Post::storeSettingsPageImage($request);
        return redirect()->back();
    }

    public function storePressReleasesPageSettings(Request $request)
    {

        Post::storePressReleasesPageSettings($request);
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $charts = Chart::all();

        return view('admin.articles.create')->with([
            'title' => 'Ավելացնել հոդված',
            'tags' => $tags,
            'categories' => $categories,
            'charts' => $charts->groupBy('lang'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $post_type_value = $request->input('post_type_value', PostsEnum::article());

        $input = $request->except('_token');
        $item = new Post();
        $post_type_value === PostsEnum::press_releases()->getValue() ?
            $item->saveRelease($request) :
            $item->savePost($request);
        // $item->savePost($request);
        $item->storeImage($request);
        $item->storeMiniImage($request);
        $item->addTags($input);
        $item->addCategories($input);
        //   $item->addChart($input);

        $redirect_route = $post_type_value === PostsEnum::press_releases()->getValue() ?
        'admin.articles.pressReleases' : 'admin.articles.index';

        return redirect()->route($redirect_route)
            ->with('success', 'Ավելացվեց');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Post::findOrFail($id);
        return view('admin.articles.show')->with([
            'title' => 'Հոդված',
            'item' => $item,
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
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $charts = Chart::all();
        return view('admin.articles.edit')->with([
            'title' => 'Փոփոխել հոդվածը',
            'post' => $post,
            'tags' => $tags,
            'categories' => $categories,
            'charts' => $charts->groupBy('lang'),
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $item = Post::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);
        $item->storeMiniImage($request);
        $item->addTags($input);
        $item->addCategories($input);
        $item->addChart($input);
        $item->save();

        return redirect()->route('admin.articles.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Ջնջվեց');
    }
}
