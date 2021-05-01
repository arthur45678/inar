<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class TagsController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:tags-list');
        $this->middleware('permission:tags-create', ['only' => ['create','store']]);
        $this->middleware('permission:tags-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tags-delete', ['only' => ['destroy']]);
        parent::__construct();
    }


    public function index(Request $request)
    {
        $query = Tag::orderByDesc('id');

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        $posts = $query->orderBy('id','desc')
            ->paginate(20);

        return view('admin.tags.index')->with([
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
        return view('admin.tags.create')->with([
            'title' => 'Ավելացնել թեգ',
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
        $item = Tag::create($input);
        $item->storeImage($request);
        $item->storePageImage($request);
        $item->storePageImageMini($request);

        return redirect()->route('admin.tags.index')
            ->with('success','Запись добавлен успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Tag::findOrFail($id);
        return view('admin.tags.show')->with([
            'title' => 'Тег',
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
        $post = Tag::findOrFail($id);
        return view('admin.tags.edit')->with([
            'title' => 'Редактировать Тег',
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
        $item = Tag::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);
        $item->storePageImage($request);
        $item->storePageImageMini($request);

        return redirect()->route('admin.tags.index')->with(['success' => 'Обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();
        return redirect()->route('admin.tags.index')
            ->with('success','Запись успешно удален');
    }
}
