<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Pages\Employeedepartment;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\App;

class AboutUsDepartmentsController extends AdminController
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
    public function index(Request $request)
    {
        $query = Employeedepartment::orderByDesc('id');

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        $posts = $query->orderBy('id','desc')
            ->paginate(20);

        return view('admin.pages.aboutusDepartment.index')->with([
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

        return view('admin.pages.aboutusDepartment.create')->with([
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
        ]);

        $input = $request->except('_token');
        $item = Employeedepartment::create($input);

        return redirect()->route('admin.pages.aboutusDepartment.index')
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
        $item = Employeedepartment::findOrFail($id);
        return view('admin.pages.aboutusDepartment.show')->with([
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
        $post = Employeedepartment::findOrFail($id);
        return view('admin.pages.aboutusDepartment.edit')->with([
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
        ]);
        $input = $request->all();
        $item = Employeedepartment::findOrFail($id);
        $item->update($input);


        return redirect()->route('admin.pages.aboutusDepartment.index')->with(['success' => 'Փոփոխվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employeedepartment::findOrFail($id)->delete();
        return redirect()->route('admin.pages.aboutusDepartment.index')
            ->with('success','Ջնջվեց');
    }
}
