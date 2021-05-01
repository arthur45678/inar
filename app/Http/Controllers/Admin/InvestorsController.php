<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestorCompany;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class InvestorsController extends AdminController
{
    function __construct()
    {
        $this->middleware('permission:investors-list');
        $this->middleware('permission:investors-create', ['only' => ['create','store']]);
        $this->middleware('permission:investors-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:investors-delete', ['only' => ['destroy']]);

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $query = User::orderByDesc('id');

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
        $query->where('type', User::TYPE_INVESTOR);
        $users = $query->paginate(20);

        return view('admin.investors.index')
            ->with([
                'title' => 'Բոլոր Ներդրողները',
                'i' => ($request->input('page', 1) - 1) * 5,
                'users' => $users,
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
        return view('admin.investors.create')
            ->with([
                'title' => 'Նոր ներդրող',
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
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',

        ]);

        $inputCompany = $request->company;
        $investor = new User();
        $investor->storeInvestor($request);
        $investor->investor_company()->create($inputCompany);

        $investor->storeImage($request);
        return redirect()->route('admin.investors.index')
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
        $user = User::find($id);
        return view('admin.investors.show')->with([
            'title' => 'Նորդնող',
            'user' => $user,
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
        $title = 'Խմբագրել ներդնողին';
        $user = User::find($id);
        $managers = Manager::all();
        $company = $user->investor_company;
        return view('admin.investors.edit',compact('title','user','managers','company'));
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
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $input = $request->all();

        $investor = new User();
        $investor = $investor->updateInvestor($request, $id);
        $inputCompany = $request->get('company');
        $investor->investor_company()->update($inputCompany);
        $investor->storeImage($request);

        return redirect()->route('admin.investors.index')
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
        User::find($id)->delete();
        return redirect()->route('admin.investors.index')
            ->with('success','Ջնջվեց');
    }
}
