<?php

use Illuminate\Database\Seeder;
use App\Models\SubscribeText;

class SubscribeTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscribeText::create([
            'id' => 1,
            'text' => ['en' => ' ', 'ru' => ' ', 'hy' => ' '],
        ]);
    }
}
