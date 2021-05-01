<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chart;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Enums\PostsEnum;
use Illuminate\Support\Facades\App;

class PagepostsController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:posts-list');
        $this->middleware('permission:posts-create', ['only' => ['create','store']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        parent::__construct();

    }


    public function index(Request $request)
    {

        // $query = Post::where(['posts_type' => PostsEnum::article()])->orderByDesc('id');
        $query = Post::where(['posts_type' => PostsEnum::pagesPosts()] )->orderByDesc('id');

        if (!empty($value = $request->get('search-text'))) {
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $query->where("name->$localeCode", 'like', '%' . $value . '%');
            }

        }
        $posts = $query->orderBy('id','desc')
            ->paginate(20);
        return view('admin.pages.pages-posts.index')->with([
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

        $charts = Chart::all();
        return view('admin.pages.pages-posts.create')->with([
            'title' => 'Ավելացնել հոդված',
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

        $input = $request->except('_token');
        $item = new Post();
        $item->savePagePosts($request);
        $item->storeImage($request);
        $item->storeMiniImage($request);
        $item->storePageImage($request);

        return redirect()->route('admin.pages.pages-posts.index')
            ->with('success','Ավելացվեց');
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
        return view('admin.pages.pages-posts.show')->with([
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
        $charts = Chart::all();
        return view('admin.pages.pages-posts.edit')->with([
            'title' => 'Փոփոխել հոդվածը',
            'post' => $post,
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
        $item->storePageImage($request);
        $item->save();
        return redirect()->route('admin.pages.pages-posts.index')->with(['success' => 'Թարմացվեց']);
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
        return redirect()->route('admin.pages.pages-posts.index')
            ->with('success','Ջնջվեց');
    }
}
