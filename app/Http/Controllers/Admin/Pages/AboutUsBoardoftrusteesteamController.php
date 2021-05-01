<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Pages\Aboutus;
use App\Models\Pages\Boardoftrusteesteam;
use App\Models\Pages\Employeedepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AboutUsBoardoftrusteesteamController extends AdminController
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

        Boardoftrusteesteam::storeSettingsPageImage($request);
        return redirect()->back();
    }

    public function index(Request $request)
    {

        $query = Boardoftrusteesteam::orderByDesc('id');
        //$posts = $query->orderBy('id','desc');

        if (!empty($value = $request->get('search-text'))) {
            $query->where('f_name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('l_name', 'like', '%' . $value . '%');
        }
        $posts = $query->paginate(20);

        return view('admin.pages.boardOfTrusteesTeam.index')->with([
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

        $departments = Employeedepartment::all();
        return view('admin.pages.boardOfTrusteesTeam.create')->with([
            'title' => 'Ավելացնել թիմի անդամ',
            'departments' => $departments,
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
            'f_name' => 'required',
            'l_name' => 'required',
        ]);
        $input = $request->except('_token');
        $item = Boardoftrusteesteam::create($input);
        $item->storeImage($request);

        return redirect()->route('admin.pages.boardOfTrusteesTeam.index')
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
        $item = Boardoftrusteesteam::findOrFail($id);
        return view('admin.pages.boardOfTrusteesTeam.show')->with([
            'title' => 'էջ',
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
        $post = Boardoftrusteesteam::findOrFail($id);
        $departments = Employeedepartment::all();
        return view('admin.pages.boardOfTrusteesTeam.edit')->with([
            'title' => 'Փոփոխել էջը',
            'post' => $post,
            'departments' => $departments,
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
            'f_name' => 'required',
            'l_name' => 'required',
        ]);

        $input = $request->all();
        $item = Boardoftrusteesteam::findOrFail($id);
        $item->update($input);
        $item->storeImage($request);

        return redirect()->route('admin.pages.boardOfTrusteesTeam.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Boardoftrusteesteam::findOrFail($id)->delete();
        return redirect()->route('admin.pages.boardOfTrusteesTeam.index')
            ->with('success','Ջնջվեց');
    }

}
