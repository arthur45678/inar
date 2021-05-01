<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

      //  return view('admin.home')
        //home
        return view('admin.home')

            ->with([ 'title' => 'Здравствуйте ' . Auth::user()->f_name . ' '.Auth::user()->l_name,
                'success' => 'AAAAA',
                ]);
    }




}
