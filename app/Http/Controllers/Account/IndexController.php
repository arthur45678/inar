<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Account\AccountController;
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

class IndexController extends AccountController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('account.home')
            ->with([
                'title' => 'Здравствуйте ' . Auth::user()->f_name . ' ' . Auth::user()->l_name,
            ]);
    }
}
