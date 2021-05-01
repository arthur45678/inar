<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Pages\Aboutus;
use App\Models\Pages\Employeedepartment;
use App\Models\Pages\Pagesimple;
use App\Models\Pages\Pagesimple2;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;


class AboutusController extends SiteController
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

        $posts = Aboutus::orderBy('id', 'desc')->orderBy('id','asc')
            ->paginate(20);

        return view('site.pages.aboutus.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }


    public function aboutUsOurTeam()
    {
        $departments = Employeedepartment::with('teams')->orderBy('id','asc')->get();
        return view('site.pages.aboutus.aboutUsOurTeam', compact('departments'))->with([
            'title' => Lang::get('aboutUs.our_team'),
        ]);
    }

    public function showTeamUser($id,$lang)
    {
        if (isset($lang)) {

            $user = Aboutus::findOrFail($id);
            if($user->hasTranslation('f_name',$lang)){

            }
            dd($user->getTranslation('f_name',$lang));
        }


        if(isset($id) && empty($lang)){
            $user = Aboutus::findOrFail($id);
            if(!$user->hasTranslation(\App::getLocale())){
                abort(403);
            }
        }

        return view('site.pages.aboutus.showTeamUser',compact('user'));
    }

    public function OurPartners()
    {

        $departments = Employeedepartment::with('teams')->get();
        return view('site.pages.aboutus.OurPartners', compact('departments'))->with([
            'title' => Lang::get('aboutUs.title'),
        ]);
    }
    public function BoardofTrustees()
    {
        $departments = Employeedepartment::with('teams')->get();
        return view('site.pages.aboutus.BoardofTrustees', compact('departments'))->with([
            'title' => Lang::get('aboutUs.title'),
        ]);
    }

    public function AboutUs()
    {
        $departments = Employeedepartment::with('teams')->get();
        return view('site.pages.aboutus.AboutUs', compact('departments'))->with([
            'title' => Lang::get('aboutUs.title'),
        ]);
    }
}
