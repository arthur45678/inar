<?php

namespace App\Http\Controllers\Site;

use App\Models\Carbrand;
use App\Models\Home\Discoveryarmenia;
use App\Models\Home\OurMissionsMenu;
use App\Models\Post;
use App\Models\Region\RegionModel;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Subscribe;
use App\Models\Tweet;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class IndexController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $tweets = Tweet::where('status', 1)->latest()->get();
        $sliders = Slider::get();

        $ourMissions = OurMissionsMenu::where('lang', app()->getLocale())->get();
        $events = Post::where('posts_type', 'events')->where('event_started_date', '!=', null)
            ->select('id', 'event_started_date', 'desc', 'name', 'img_mini')
            ->where('event_started_date', '>', Carbon::now())->get()->take(2);

        $discoveryArmenia = Discoveryarmenia::orderBy('id', 'ASC')->get();

        return view('site.home', compact('sliders', 'events', 'ourMissions', 'discoveryArmenia', 'tweets'));
    }

    public function showPdf($pdfFileName)
    {
        return view('site.showPdf', compact('pdfFileName'));
    }

    public function talent()
    {
        return view('site.Page.talent');
    }
    public function buisness()
    {

        return view('site.Page.buisness_enviroment');
    }
    public function infrastructure()
    {

        return view('site.Page.infrastructure');
    }
    public function quality()
    {

        return view('site.Page.quality');
    }
    public function innovation()
    {

        return view('site.Page.innovation');
    }
    public function lifestyle()
    {

        return view('site.Page.lifestyle');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function subscribe(Request $request)
    {

        $request->validate([
            'email' => 'required|unique:subscribes|email',
        ]);


        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $message = "email invalid";
        }else{
            $data = $request->all();

            $check = Subscribe::insert($data);
            if($check){
                $message = "success";
            }else{
                $message = 'error';
            }
        }
        return $message;

    }

}
