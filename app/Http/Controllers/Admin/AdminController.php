<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $vars = [];
    protected $template;

    protected $keywords;
    protected $meta_desc;
    protected $title;
    public $user;


    public function __construct()
    {

        $this->middleware('permission:view-admin');
        view()->share([
            'imagePath' => asset('storage/images'),
            'imagesServe' => asset('imagesServe'),
            'assetPath' => asset('admin_1'),
        ]);
    }


    public function renderOutput()
    {
        //$sidebar = $this->getSidebar();
        $this->vars = array_add($this->vars, 'sidebar', $sidebar);

        $this->vars = array_add($this->vars, 'title', $this->title);

        return view($this->template)->with($this->vars);
    }


    public function getSidebar()
    {
        return view('admin.includes.sidebar');
    }
}
