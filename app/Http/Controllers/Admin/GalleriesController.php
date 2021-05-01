<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Pages\Aboutus;
use Illuminate\Http\Request;

class GalleriesController extends AdminController
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
        Gallery::storeSettingsPageImage($request);
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $query = Gallery::orderByDesc('id');
        //$posts = $query->orderBy('id','desc');

        if (!empty($value = $request->get('search-text'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('text', 'like', '%' . $value . '%');
        }

        $posts = $query->paginate(20);

        return view('admin.galleries.index')->with([
            'title' => 'Բոլորը Տեսադարանները',
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
        return view('admin.galleries.create')->with([
            'title' => 'Ավելացնել Տեսադարան',
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
        // dd($request->name);
        $item = new Gallery();
        $item->name = $request->name;
        $item->meta_desc = $request->meta_desc;
        $item->keywords = $request->keywords;
        $item->save();


        $item->storeImage($request);
        $item->storePageImage($request);
        $item->storeImages($request, 463,548);

        return redirect()->route('admin.galleries.index')
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
        $item = Gallery::findOrFail($id);
        return view('admin.galleries.show')->with([
            'title' => 'Տեսադարան',
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
        $post = Gallery::findOrFail($id);
        return view('admin.galleries.edit')->with([
            'title' => 'Փոփոխել Տեսադարանը',
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
        $item = Gallery::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);
        $item->storePageImage($request);
        $item->storeImages($request, 463,548);
        $item->save();

        return redirect()->route('admin.galleries.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();
        return redirect()->route('admin.galleries.index')
            ->with('success','Ջնջվեց');
    }
}
