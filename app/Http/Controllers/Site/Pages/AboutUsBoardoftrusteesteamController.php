<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Pages\Aboutus;
use App\Models\Pages\Boardoftrusteesteam;
use App\Models\Pages\Employeedepartment;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;


class AboutUsBoardoftrusteesteamController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Boardoftrusteesteam::all()//orderBy('id', 'desc')
            ->paginate(20);


        return view('site.pages.aboutus.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }


    public function aboutUsOurTeam()
    {
        /*$departments = Employeedepartment::with('teams')->get();
        return view('site.pages.boardOfTrusteesTeam.aboutUsOurTeam', compact('departments'))->with([
            'title' => Lang::get('aboutUs.title'),
        ]);*/
        //$departments = Employeedepartment::with('teams')->get(); /es em are

        $post = Boardoftrusteesteam::all();//orderBy('id', 'desc')


        return view('site.pages.boardOfTrusteesTeam.aboutUsOurTeam', compact('post'))->with([
            'title' => Lang::get('aboutUs.title'),
        ]);
    }

    public function AboutUs()
    {
        //$departments = Employeedepartment::with('teams')->get();
        $post = Boardoftrusteesteam::all();
        return view('site.pages.boardOfTrusteesTeam.AboutUs', compact('post'))->with([
            'title' => Lang::get('aboutUs.title'),
        ]);
    }
}
