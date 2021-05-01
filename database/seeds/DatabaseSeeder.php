<?php

use Illuminate\Database\Seeder;

use App\Models\Chart;
use App\Models\SubscribeText;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

         $this->call(ManagersSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
         $this->call(TagsSeeder::class);
         $this->call(CategoriesSeeder::class);
         $this->call(RegionsTableSeeder::class);
         $this->call(RegionsMainPartTableSeeder::class);
         $this->call(RegionsInformationTableSeeder::class);

    }
}
