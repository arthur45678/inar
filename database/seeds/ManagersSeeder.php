<?php

use Illuminate\Database\Seeder;

class ManagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Manager::create([
            'f_name' => 'Առաքել Շմայս',
            'l_name' => 'Մովսիսյան',
            'img' => Null,
            'email' => 'araqel@gmail.com',
            'phone_1' => '456451212',
            'phone_2' => '7878796121',
            'viber' => '',
            'whatsapp' => '',
        ]);
        \App\Models\Manager::create([
            'f_name' => 'Գալուստ',
            'l_name' => 'Սահակյան',
            'img' => Null,
            'email' => 'galust@gmail.com',
            'phone_1' => '94564712',
            'phone_2' => '7878796121',
            'viber' => '',
            'whatsapp' => '',
        ]);
    }
}
