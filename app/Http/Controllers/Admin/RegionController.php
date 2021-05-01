<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region\RegionInformateModel;
use App\Models\Region\RegionMainPartModel;
use App\Models\Region\RegionModel;
use Illuminate\Http\Request;

class RegionController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $region = RegionModel::with('MainPartAdmin')->where('slug', 'am')->get();

        return view('admin.region.index', compact('region'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regionAm = RegionModel::where('slug','am')->where('state_id',$id)->first();
        $regionRu = RegionModel::where('slug','ru')->where('state_id',$id)->first();
        $regionEn = RegionModel::where('slug','en')->where('state_id',$id)->first();

        $InformateAm=RegionInformateModel::where('parent_id',$id)->where('slug','am')->first();
        $InformateEn=RegionInformateModel::where('parent_id',$id)->where('slug','en')->first();
        $InformateRu=RegionInformateModel::where('parent_id',$id)->where('slug','ru')->first();


        $MainPartAm=RegionMainPartModel::where('parent_id',$id)->where('slug','am')->first();
        $MainPartRu=RegionMainPartModel::where('parent_id',$id)->where('slug','ru')->first();
        $MainPartEn=RegionMainPartModel::where('parent_id',$id)->where('slug','en')->first();
        if ($InformateAm==null or $MainPartAm==null){


            if($InformateAm==null){
                $lang=['am','ru','en'];

                foreach ($lang as $langs) {
                    RegionInformateModel::create([
                        'slug'=>$langs,
                        'parent_id' => $id
                    ]);
                }
            }
            if($MainPartAm==null){
                foreach ($lang as $langs) {
                    RegionMainPartModel::create([
                        'slug'=>$langs,
                        'parent_id'=>$id
                    ]);
                }
            }
            return redirect()->route('admin.region.edit',$id);
        }

        return view('admin.region.show', compact('regionAm','regionEn','regionRu',
            'MainPartAm','MainPartEn','MainPartRu','InformateAm','InformateEn','InformateRu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regionAm = RegionModel::where('slug','am')->where('state_id',$id)->first();
        $regionRu = RegionModel::where('slug','ru')->where('state_id',$id)->first();
        $regionEn = RegionModel::where('slug','en')->where('state_id',$id)->first();

        $InformateAm=RegionInformateModel::where('parent_id',$id)->where('slug','am')->first();
        $InformateEn=RegionInformateModel::where('parent_id',$id)->where('slug','en')->first();
        $InformateRu=RegionInformateModel::where('parent_id',$id)->where('slug','ru')->first();

        $MainPartAm=RegionMainPartModel::where('parent_id',$id)->where('slug','am')->first();
        $MainPartRu=RegionMainPartModel::where('parent_id',$id)->where('slug','ru')->first();
        $MainPartEn=RegionMainPartModel::where('parent_id',$id)->where('slug','en')->first();
        if ($InformateAm==null or $MainPartAm==null){


        if($InformateAm==null){
            $lang=['am','ru','en'];

            foreach ($lang as $langs) {
                RegionInformateModel::create([
                    'slug'=>$langs,
                    'parent_id' => $id
                ]);
            }
        }
        if($MainPartAm==null){
            foreach ($lang as $langs) {
            RegionMainPartModel::create([
                'slug'=>$langs,
                'parent_id'=>$id
            ]);
        }
        }
        return redirect()->route('admin.region.edit',$id);
        }

        return view('admin.region.edit', compact('regionAm','regionEn','regionRu',
            'MainPartAm','MainPartEn','MainPartRu','InformateAm','InformateEn','InformateRu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lang=['am','ru','en'];

        foreach ($lang as $langs){

           $mainpart= RegionMainPartModel::where('parent_id',$id)->where('slug',$langs)->first();
           $Informate=RegionInformateModel::where('parent_id',$id)->where('slug',$langs)->first();
           $region=RegionModel::where('state_id',$id)->where('slug',$langs)->first();

            $region->update([
                'name'=>$request->{'name_'.$langs},
                ]);
            $mainpart->update([
                'slug'=>$langs,
                'weather'=>$request->{'weather_'.$langs},
                'region_center_title'=>$request->{'region_center_title_'.$langs},
                'region_center_info'=>$request->{'region_center_info_'.$langs},
                'region_center_other'=>$request->{'region_center_other_'.$langs},
                'average_prices'=>$request->{'average_prices_'.$langs},
                'average_other'=>$request->{'average_other_'.$langs},
                'Georgia'=>$request->{'georgia_'.$langs},
                'Yerevan'=>$request->{'yerevan_'.$langs},
                'Iran'=>$request->{'iran_'.$langs},

            ]);

            $Informate->update([
                'slug'=>$langs,
                'territory'=>$request->{'territory_'.$langs},
                'agricultrual_land'=>$request->{'agricultrual_land_'.$langs},
                'total_population'=>$request->{'total_population_'.$langs},
                'urban'=>$request->{'urban_'.$langs},
                'rural'=>$request->{'rural_'.$langs},
                'total_workforce'=>$request->{'total_workforce_'.$langs},
                'employed'=>$request->{'employed_'.$langs},
                'average_salary'=>$request->{'average_salary_'.$langs},
                'specialization'=>$request->{'specialization_'.$langs},
                'success_case'=>$request->{'success_case_'.$langs},
                'agriculture'=>$request->{'agriculture_'.$langs},
                'agriculture_comments'=>$request->{'agriculture_comments_'.$langs},
                'retail_trade'=>$request->{'retail_trade_'.$langs},
                'retail_trade_comments'=>$request->{'retail_trade_comments_'.$langs},
                'construction'=>$request->{'construction_'.$langs},
                'construction_comments'=>$request->{'construction_comments_'.$langs},
                'industry'=>$request->{'industry_'.$langs},
                'industry_comments'=>$request->{'industry_comments_'.$langs},
                'tourism'=>$request->{'tourism_'.$langs},
                'cropproduction'=>$request->{'cropproduction_'.$langs},
                'portable_energy'=>$request->{'portable_energy_'.$langs},
                'food_processing'=>$request->{'food_processing_'.$langs},
                'beverage_production'=>$request->{'beverage_production_'.$langs},
                'textile'=>$request->{'textile_'.$langs},
                'field_1'=>$request->{'field_1_'.$langs},
                'field_2'=>$request->{'field_2_'.$langs},
                'field_3'=>$request->{'field_3_'.$langs},
                'field_4'=>$request->{'field_4_'.$langs},



            ]);


        }



     return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
