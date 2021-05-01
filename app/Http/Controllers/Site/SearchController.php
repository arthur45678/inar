<?php

namespace App\Http\Controllers\Site;

use App\Enums\PostsEnum;
use App\Http\Controllers\Controller;
use App\Models\Home\Discoveryarmenia;
use App\Models\Home\OurMissionsMenu;
use App\Models\Manager;
use App\Models\Pages\Aboutus;
use App\Models\Pages\Boardoftrusteesteam;
use App\Models\Pages\Buisnessenvioirments;
use App\Models\Pages\Pageinnovation;
use App\Models\Pages\Pagequality;
use App\Models\Pages\Pagesimple;
use App\Models\Pages\Pagesimple2;
use App\Models\Pages\Pagetalent;
use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\DB;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;
use Symfony\Component\Console\Input\Input;


class SearchController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        if(empty($request->search_text)){
            return  redirect()->back();
        }

        $search_text = $request->search_text;
        $searchResults = \App\Models\Search::search($search_text);
        return view('site.searchResults', compact('searchResults','search_text'));

    }
}
