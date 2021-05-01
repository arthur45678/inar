<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Youtube;
use Illuminate\Http\Request;

class VideoController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:posts-list');
        $this->middleware('permission:posts-create', ['only' => ['create','store']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        parent::__construct();

    }
    public function storePageSettings(Request $request)
    {
        Video::storeSettingsPageImage($request);
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $query = Video::orderByDesc('id');
        //$posts = $query->orderBy('id','desc');

        if (!empty($value = $request->get('search-text'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('text', 'like', '%' . $value . '%');
        }

        $posts = $query->paginate(20);

        return view('admin.videos.index')->with([
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
        return view('admin.videos.create')->with([
            'title' => 'Ավելացնել',
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
           // 'file' => 'mimetypes:video/avi,video/mpeg,video/quicktime'
        ]);


        $item = Video::create(['name' => $request->name]);
        $item->storeFile($request);

        return redirect()->route('admin.videos.index')
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
        $item = Video::findOrFail($id);
        return view('admin.videos.show')->with([
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

        $post = Video::findOrFail($id);

        return view('admin.videos.edit')->with([
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
            'file' => 'required'
        ]);

        $item = Video::findOrFail($id);
        $item->update(['name' => $request->name]);

        $item->storeFile($request);


        return redirect()->route('admin.videos.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect()->route('admin.videos.index')
            ->with('success','Ջնջվեց');
    }
}
