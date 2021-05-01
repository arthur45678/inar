<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    protected $vars = [];
    protected $template;

    protected $keywords;
    protected $meta_desc;
    protected $title;
    public $user;


    public function __construct()
    {

        $this->middleware('InvestorUser');
        view()->share([
            'imagePath' => asset('storage/images'),
            'imagesServe' => asset('imagesServe'),
            'assetPath' => asset('account'),
        ]);
    }


    public function renderOutput()
    {
        $sidebar = $this->getSidebar();
        $this->vars = array_add($this->vars, 'sidebar', $sidebar);

        $this->vars = array_add($this->vars, 'title', $this->title);

        return view($this->template)->with($this->vars);
    }


    public function getSidebar()
    {
        return view('account.includes.sidebar');
    }
}
