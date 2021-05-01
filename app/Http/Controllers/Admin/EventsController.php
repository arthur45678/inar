<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostsEnum;
use App\Http\Controllers\Controller;
use App\Models\ImageOptimization;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EventsController extends AdminController
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
        $query = Post::where(['posts_type' => PostsEnum::events()])->orderByDesc('id');
        //$posts = $query->orderBy('id','desc');

        if (!empty($value = $request->get('search-text'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('text', 'like', '%' . $value . '%');
        }

        $posts = $query->paginate(20);

        return view('admin.events.index')->with([
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
        return view('admin.events.create')->with([
            'title' => 'Ավելացնել միջոցառում',
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
        $item->saveEvent($request);
        $item->storeImage($request);
        $item->storeMiniImage($request);

        return redirect()->route('admin.events.index')
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
        return view('admin.events.show')->with([
            'title' => 'Միևոցառում',
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
        return view('admin.events.edit')->with([
            'title' => 'Փոփոխել միջոցառումը',
            'post' => $post,
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

        $item->save();

        return redirect()->route('admin.events.index')->with(['success' => 'Թարմացվեց']);
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
        return redirect()->route('admin.events.index')
            ->with('success','Ջնջվեց');
    }
}
