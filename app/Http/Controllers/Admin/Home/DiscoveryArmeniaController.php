<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Home\Discoveryarmenia;
use App\Models\Slider;
use Illuminate\Http\Request;

class DiscoveryArmeniaController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:posts-list');
        $this->middleware('permission:posts-create', ['only' => ['create','store']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        parent::__construct();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Discoveryarmenia::paginate(20);
        return view('admin.home.discovery-armenia.index')->with([
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
        return view('admin.home.discovery-armenia.create')->with([
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
            'img' => 'image',
            'file' => 'mimes:pdf',
        ]);

        $input = $request->except('_token');

        $item = Discoveryarmenia::create($input);
        $item->storeImage($request);
        $item->storeFile($request);

        return redirect()->route('admin.home.discovery-armenia.index')
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
        $item = Discoveryarmenia::findOrFail($id);
        return view('admin.home.discovery-armenia.show')->with([
            'title' => 'Սլայդ',
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
        $post = Discoveryarmenia::findOrFail($id);
        return view('admin.home.discovery-armenia.edit')->with([
            'title' => 'Փոփոխել',
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
            'img' => 'image',
            'file' => 'mimes:pdf',
        ]);
        $input = $request->all();
        $item = Discoveryarmenia::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);
        $item->storeFile($request);

        return redirect()->route('admin.home.discovery-armenia.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discoveryarmenia::findOrFail($id)->delete();
        return redirect()->route('admin.home.discovery-armenia.index')
            ->with('success','Ջնջվեց');
    }
}
