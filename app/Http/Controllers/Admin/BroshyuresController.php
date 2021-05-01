<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broshyur;
use App\Models\Home\Discoveryarmenia;
use App\Models\Pages\Aboutus;
use App\Models\Settings;
use Illuminate\Http\Request;

class BroshyuresController extends AdminController
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
        $data = $request->all();
        Settings::storeMultilanguageSettings($data);

        Broshyur::storeSettingsPageImage($request);
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Broshyur::paginate(20);
        return view('admin.broshyures.index')->with([
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
        return view('admin.broshyures.create')->with([
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

        $item = Broshyur::create($input);
        $item->storeImage($request);
        $item->storeFile($request);

        return redirect()->route('admin.broshyures.index')
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
        $item = Broshyur::findOrFail($id);
        return view('admin.broshyures.show')->with([
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
        $post = Broshyur::findOrFail($id);
        return view('admin.broshyures.edit')->with([
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
        $item = Broshyur::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);
        $item->storeFile($request);

        return redirect()->route('admin.broshyures.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Broshyur::findOrFail($id)->delete();
        return redirect()->route('admin.broshyures.index')
            ->with('success','Ջնջվեց');
    }
}
