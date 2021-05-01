<?php

use Illuminate\Database\Seeder;
use  \App\Models\Region\RegionMainPartModel;
use Illuminate\Support\Str;


class RegionsMainPartTableSeeder extends Seeder
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
                'parent_id' => 1,
                'slug' => 'am',
                "weather" => 'Բարեխառն, համեմատաբար տաք ամառով և չափավոր ցուրտ ձմեռով կլիմայի տիպը բնորոշ է Արագածոտն մարզի հարավարևմտյան հատվածին:',
                'region_center_title' => 'Աշտարակ - մարզկենտրոն',
                'region_center_info' => '1.10.33 բաժինները ներկայացված են',
                'region_center_other' => 'համար ոտորև ներկայացված',
                'average_prices' => 'Մարզի տարածքով անցնում են համապետական նշանակություն 3 ավտոխճուղիներ',
                'average_other' => 'Հնում Աշտարակը մտնում էր Մեծ Հայքի Այրարատյան աշխարհի Արագածոտն գավառի մեջ',
                'Georgia' => '19 կմ',
                'Yerevan' => '120 կմ',
                'Iran' => '200 կմ',

            ],
            [
                'parent_id' => 1,
                'slug' => 'en',
                "weather" => 'Mild, relatively hot summers with moderately cold winters are typical of the southwestern part of Aragatsotn region.',
                'region_center_title' => 'Ashtarak - regional center',
                'region_center_info' => 'Sections 1.10.33 are presented ',
                'region_center_other' => 'submitted for',
                'agricultrual_land' => 'In ancient times, Ashtarak was part of the Aragatsotn province of the Ayraratian world of Greater Armenia',
                'average_prices' => '3 highways of national importance pass through the territory of the region',
                'average_other' => '198,55$ ',
                'Georgia' => '19 km:',
                'Yerevan' => '120 km:',
                'Iran' => '200 km:',

            ],
            [
                'parent_id' => 1,
                'slug' => 'ru',
                "weather" => 'Мягкое, относительно жаркое лето с умеренно холодной зимой типично для юго-западной части Арагацотнского района.',
                'region_center_title' => 'Аштарак - районный центр',
                'region_center_info' => 'Разделы 1.10.33 представлены',
                'region_center_other' => 'отправлен для',
                'agricultrual_land' => 'В древние времена Аштарак был частью провинции Арагацотн айраратского мира Великой Армении',
                'average_prices' => 'По территории области проходят 3 автомобильные дороги государственного значения.',
                'average_other' => '198,55 $',
                'Georgia' => '19 км:',
                'Yerevan' => '120 км:',
                'Iran' => '200 км:',

            ],

        ];
        foreach ($regions as $region) {


            RegionMainPartModel::create([
                "parent_id" => $region['parent_id'],
                "slug" => $region['slug'],
                "weather" => $region['weather'],
                "region_center_title" => $region['region_center_title'],
                "region_center_info" => $region['region_center_info'],
                "region_center_other" => $region['region_center_other'],
                "average_prices" => $region['average_prices'],
                "average_other" => $region['average_other'],
                "Georgia" => $region['Georgia'],
                "Yerevan" => $region['Yerevan'],
                "Iran" => $region['Iran'],


            ]);

        }


    }
}
