<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category();
        $category->slug = 'news';
        $category->name =  ['en' => 'News', 'ru' => 'Новости', 'hy' => 'Նորություններ'];
        $category->save();

        $category = new \App\Models\Category();
        $category->slug = 'tourism';
        $category->name =  ['en' => 'Tourism', 'ru' => 'Туризм', 'hy' => 'Զբոսաշրջություն'];
        $category->save();

        $category = new \App\Models\Category();
        $category->slug = 'health';
        $category->name =  ['en' => 'Health', 'ru' => 'Здоровье', 'hy' => 'Առողջություն'];
        $category->save();


    }
}
