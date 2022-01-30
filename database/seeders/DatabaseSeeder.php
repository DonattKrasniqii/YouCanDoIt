<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use function Database\Seeders\each as eachAlias;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();



    }


}


