<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class ManagersController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:managers-list');
        $this->middleware('permission:managers-create', ['only' => ['create','store']]);
        $this->middleware('permission:managers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:managers-delete', ['only' => ['destroy']]);

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $query = Manager::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('f_name'))) {
            $query->where('f_name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('l_name'))) {
            $query->where('l_name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        $items = $query->paginate(20);

        return view('admin.managers.index')
            ->with([
                'title' => 'Բոլոր մենեջերները',
                'i' => ($request->input('page', 1) - 1) * 5,
                'users' => $items,
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = Manager::all();
        return view('admin.managers.create')
            ->with([
                'title' => 'Նոր մենեջեր',
                'managers' => $managers
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
            'email' => 'required|email|unique:users,email',
        ]);
        $item = Manager::create($request->all());
        $item->storePhoto($request);
        return redirect()->route('admin.managers.index')
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
        $item = Manager::find($id);
        return view('admin.managers.show')->with([
            'title' => 'Մենեւեր',
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
        $title = 'Խմբագրել մենեջերին';
        $item = Manager::find($id);

        return view('admin.managers.edit',compact('title','item'));
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
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $input = $request->all();
        $item = Manager::findOrFail($id);
        $item->update($input);
        $item->storePhoto($request);

        return redirect()->route('admin.managers.index')
            ->with('success','Թարմացվեց');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manager::find($id)->delete();
        return redirect()->route('admin.managers.index')
            ->with('success','Ջնջվեց');
    }
}
