<?php

use Illuminate\Database\Seeder;
use   \App\Models\Region\RegionModel;
use Illuminate\Support\Str;


class RegionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ["name" => "Արագածոտն",'slug'=>'am',"parent_id" => 1],
            ["name" => "Արարատ", 'slug' => 'am',"parent_id" => 2],
            ["name" => "Արմավիր", 'slug' => 'am',"parent_id" => 3],
            ["name" => "Գեղարքունիք", 'slug' => 'am',"parent_id" => 4],
            ["name" => "Լոռի", 'slug' => 'am',"parent_id" => 5],
            ["name" => "Կոտայք", 'slug' => 'am',"parent_id" => 6],
            ["name" => "Շիրակ", 'slug' => 'am',"parent_id" => 7],
            ["name" => "Սյունիք", 'slug' => 'am',"parent_id" => 8],
            ["name" => "Վայոց ձոր", 'slug' => 'am',"parent_id" => 9],
            ["name" => "Երևան", 'slug' => 'am',"parent_id" => 10],
            ["name" => "Տավուշ", 'slug' => 'am',"parent_id" => 11],

            ["name" => "Aragatsotn", 'slug' => 'en', "parent_id" => 1],
            ["name" => "Ararat", 'slug' => 'en', "parent_id" => 2],
            ["name" => "Armavir", 'slug' => 'en', "parent_id" => 3],
            ["name" => "Gegharkunik", 'slug' => 'en', "parent_id" => 4],
            ["name" => "Lori", 'slug' => 'en', "parent_id" => 5],
            ["name" => "Kotayk", 'slug' => 'en', "parent_id" => 6],
            ["name" => "Shirak", 'slug' => 'en', "parent_id" => 7],
            ["name" => "Syunik", 'slug' => 'en', "parent_id" => 8],
            ["name" => "Vayots Dzor", 'slug' => 'en', "parent_id" => 9],
            ["name" => "Yerevan", 'slug' => 'en', "parent_id" => 10],
            ["name" => "Tavush", 'slug' => 'en',"parent_id" => 11],

            ["name" => "Арагацотн", 'slug' => 'ru', "parent_id" => 1],
            ["name" => "Арарат", 'slug' => 'ru', "parent_id" => 2],
            ["name" => "Армавир", 'slug' => 'ru', "parent_id" => 3],
            ["name" => "Гегаркуник", 'slug' => 'ru', "parent_id" => 4],
            ["name" => "Лори", 'slug' => 'ru', "parent_id" => 5],
            ["name" => "Котайк", 'slug' => 'ru', "parent_id" => 6],
            ["name" => "Ширак", 'slug' => 'ru', "parent_id" => 7],
            ["name" => "Сюник", 'slug' => 'ru', "parent_id" => 8],
            ["name" => "Вайоц Дзор", 'slug' => 'ru', "parent_id" => 9],
            ["name" => "Ереван", 'slug' => 'ru', "parent_id" => 10],
            ["name" => "Тавуш", 'slug' => 'ru',"parent_id" => 11],
        ];
        foreach ($regions as $region) {


            RegionModel::create([
                "name" => $region['name'],
                "slug" => $region['slug'],
                "state_id" => $region['parent_id']??null,

            ]);

        }


    }
}
