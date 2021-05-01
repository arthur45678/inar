<?php

namespace App\Http\Controllers\Site\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\SiteController;
use App\Models\Post;
use Illuminate\Http\Request;

class HowToReachUsPage extends SiteController
{
    public function index()
    {
        return view('site.pages.howTwoReachUs.index');
    }
}
