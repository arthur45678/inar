<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagPolitical = new \App\Models\Tag();
        $tagPolitical->slug = 'political';
        $tagPolitical->name = ['en' => 'Politics', 'ru' => 'Политика', 'hy' => 'Քաղաքականություն'];
        $tagPolitical->save();

        $tag = new \App\Models\Tag();
        $tag->slug = 'psychology';
        $tag->name = ['en' => 'Psychology', 'ru' => 'Псмхология', 'hy' => 'Հոգեբանություն'];
        $tag->save();


        $tag = new \App\Models\Tag();
        $tag->slug = 'psychology';
        $tag->name = ['en' => 'Criminal', 'ru' => 'Криминал', 'hy' => 'Կրիմինալ'];
        $tag->save();
    }
}
