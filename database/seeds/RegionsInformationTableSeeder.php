<?php

use Illuminate\Database\Seeder;
use    \App\Models\Region\RegionInformateModel;
use Illuminate\Support\Str;


class RegionsInformationTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'slug'=>'am',
                "parent_id" => 1,
                'territory'=>'2600 քառակուսի կ/մ',
                'agricultrual_land'=>'2100 հեկտար',
                'total_population'=>'315.742',
                'urban'=>'235,55 (39%)',
                'rural'=>'158,55 (30%)',
                'total_workforce'=>'198,55 (20%)',
                'employed'=>'19,55 (50%)',
                'average_salary'=>'1 Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ',
                'specialization'=>'2 Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ',
                'success_case'=>'3 Հայտնի է, որ ընթերցողը, կարդալով հասկանալի տեքստ, չի կարողանա կենտրոնանալ',

            ],
            [
                'slug'=>'ru',
                "parent_id" => 1,
                'territory' => '2600 квадратных метров',
                'agricultrual_land' => '2100 га',
                'total_population' => '315.742',
                'urban' => '235,55 (39%)',
                'rural' => '158,55 (30%)',
                'total_workforce' => '198,55 (20%)',
                'employed' => '19, 55 (50%) ',
                'average_salary' => '1 Известно, что читатель, читая понятный текст, не сможет сконцентрироваться',
                'specialization' => '2 Известно, что читатель не сможет сконцентрироваться, читая понятный текст',
                'success_case' => '3 Известно, что читатель, читая понятный текст, не сможет сконцентрироваться',

            ],

            [
                'slug'=>'en',
                "parent_id" => 1,
                'territory' => '2600 square meters',
                'agricultrual_land' => '2100 hectares',
                'total_population' => '315.742',
                'urban' => '235.55 (39%)',
                'rural' => '158.55 (30%)',
                'total_workforce' => '198,55 (20%)',
                'employed' => '19,55 (50%)',
                'average_salary' => '1 It is known that the reader, reading a comprehensible text, will not be able to concentrate',
                'specialization' => '2 It is known that the reader, reading a comprehensible text, will not be able to concentrate',
                'success_case' => '3 It is known that the reader, reading a comprehensible text, will not be able to concentrate',
            ],

 ];
        foreach ($regions as $region) {


            RegionInformateModel::create([
                "slug" => $region['slug'],
                "parent_id" => $region['parent_id'],
                "territory" => $region['territory'],
                "agricultrual_land" => $region['agricultrual_land'],
                "total_population" => $region['total_population'],
                "urban" => $region['urban'],
                "rural" => $region['rural'],
                "total_workforce" => $region['total_workforce'],
                "employed" => $region['employed'],
                "average_salary" => $region['average_salary'],
                "specialization" => $region['specialization'],
                "success_case" => $region['success_case'],


            ]);

        }


    }
}
