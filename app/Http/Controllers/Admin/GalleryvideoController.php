<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galleryvideo;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryvideoController extends AdminController
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
        Galleryvideo::storeSettingsPageImage($request);
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $query = Galleryvideo::orderByDesc('id');
        //$posts = $query->orderBy('id','desc');

        if (!empty($value = $request->get('search-text'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('text', 'like', '%' . $value . '%');
        }

        $posts = $query->paginate(20);

        return view('admin.galleryvideos.index')->with([
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
        return view('admin.galleryvideos.create')->with([
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

        $input = $request->except('_token');
        $item = new Galleryvideo();

        $item->storePageImage($request);
        $item->addVYoutubeLinks($input);

        return redirect()->route('admin.galleryvideos.index')
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
        $item = Galleryvideo::findOrFail($id);
        return view('admin.galleryvideos.show')->with([
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

        $post = Galleryvideo::findOrFail($id);

        return view('admin.galleryvideos.edit')->with([
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
        $item = Galleryvideo::findOrFail($id);
        $item->update($input);
        $item->storePageImage($request);
        $item->addVideoLinks($request);
        $item->save();

        return redirect()->route('admin.galleryvideos.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Galleryvideo::findOrFail($id)->delete();
        return redirect()->route('admin.galleryvideos.index')
            ->with('success','Ջնջվեց');
    }
}
