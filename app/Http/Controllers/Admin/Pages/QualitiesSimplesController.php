<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Chart;
use App\Models\Pages\Pagequality;
use App\Models\Pages\Pagesimple;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\ImageOptimization;
use Illuminate\Support\Facades\App;

class QualitiesSimplesController extends AdminController
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


        $query = Pagequality::orderByDesc('id');
        //$posts = $query->orderBy('id','desc');

        if (!empty($value = $request->get('search-text'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('text_top', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('search-text'))) {
            $query->orWhere('text_bottom', 'like', '%' . $value . '%');
        }

        $posts = $query->paginate(20);

        return view('admin.pages.qualities.index')->with([
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
        $charts = Chart::all();
        return view('admin.pages.qualities.create')->with([
            'title' => 'Ավելացնել Որակի էջ',
            'charts' => $charts->groupBy('lang'),
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
        //$input = $request->except('_token');
        $input = $request->except('_token');


        $item = Pagequality::create($input);
        $item->storePageImage($request);
        $item->storePageImageMini($request);
        $item->storePageImageBottom($request);
        $item->service_icon_symbol_1($request);
        $item->service_icon_symbol_2($request);
        $item->service_icon_symbol_3($request);
        $item->service_icon_symbol_4($request);
        $item->service_icon_symbol_5($request);
        $item->service_icon_symbol_6($request);


        return redirect()->route('admin.pages.qualities.index')
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
        $item = Pagequality::findOrFail($id);
        return view('admin.pages.qualities.show')->with([
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
        $post = Pagequality::findOrFail($id);
        $charts = Chart::all();
        return view('admin.pages.qualities.edit')->with([
            'title' => 'Փոփոխել էջը',
            'post' => $post,
            'charts' => $charts->groupBy('lang'),

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
        $item = Pagequality::findOrFail($id);
        $item->update($input);
        $item->storePageImage($request);
        $item->storePageImageMini($request);
        $item->storePageImageBottom($request);
        $item->service_icon_symbol_1($request);
        $item->service_icon_symbol_2($request);
        $item->service_icon_symbol_3($request);
        $item->service_icon_symbol_4($request);
        $item->service_icon_symbol_5($request);
        $item->service_icon_symbol_6($request);

        $item->save();

        return redirect()->route('admin.pages.qualities.index')->with(['success' => 'Թարմացվեց']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pagequality::findOrFail($id)->delete();
        return redirect()->route('admin.pages.qualities.index')
            ->with('success','Ջնջվեց');
    }
}
