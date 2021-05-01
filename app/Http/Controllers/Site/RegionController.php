<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Region\RegionModel;
use Illuminate\Http\Request;

class RegionController extends SiteController
{
    public function index($id=7)
    {

        if (app()->getLocale()=='hy'):
            $regionJsons=RegionModel::with(['MainPart','Informate'])->where('slug','am')->get();
        else:
            $regionJsons=RegionModel::with(['MainPart','Informate'])->where('slug',app()->getLocale())->get();
        endif;
//        $mainpart=Region

        return view('site.Region.Region',compact('regionJsons','id'));
    }
}
