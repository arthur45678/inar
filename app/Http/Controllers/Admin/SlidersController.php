<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class SlidersController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:sliders-list');
        $this->middleware('permission:sliders-create', ['only' => ['create','store']]);
        $this->middleware('permission:sliders-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sliders-delete', ['only' => ['destroy']]);
        parent::__construct();
    }


    public function index(Request $request)
    {

        $query = Slider::orderByDesc('id');

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        $posts = $query->orderBy('id','desc')
            ->paginate(20);

        return view('admin.sliders.index')->with([
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
        return view('admin.sliders.create')->with([
            'title' => 'Նոր սլայդ',
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
           // 'name' => 'required',
        ]);

        $input = $request->except('_token');

        $item = Slider::create($input);
        $item->storeImage($request);

        return redirect()->route('admin.sliders.index')
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
        $item = Slider::findOrFail($id);
        return view('admin.sliders.show')->with([
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
        $post = Slider::findOrFail($id);
        return view('admin.sliders.edit')->with([
            'title' => 'Խմբագրել սլայդը',
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
        ]);
        $input = $request->all();
        $item = Slider::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);

        return redirect()->route('admin.sliders.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slider::findOrFail($id)->delete();
        return redirect()->route('admin.sliders.index')
            ->with('success','Ջնջվեց');
    }
}
