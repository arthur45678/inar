<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use QCod\Settings\Setting\Setting;

class SettingsController extends AdminController
{


    function __construct()
    {
        $this->middleware('permission:settings-view');
        $this->middleware('permission:settings-create', ['only' => ['create','store','edit','update','destroy']]);
        parent::__construct();

    }



    // you can override following methods from trait

    // to display the settings view
    public function generalSettings()
    {

       return view('admin.settings.generalSettings')->with([
           'title' => 'Գլխավոր կարգավորումները',
       ]);
    }

    // to store settings changes
    public function storeGeneralSettings(Request $request)
    {
        $data = $request->all();
        Settings::storeMultilanguageSettings($data);
        return redirect()->back();
    }
}
