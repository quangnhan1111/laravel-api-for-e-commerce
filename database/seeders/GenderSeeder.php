<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            'name' => 'male'
        ]);
        DB::table('genders')->insert([
            'name' => 'female'
        ]);
        DB::table('genders')->insert([
            'name' => 'couple'
        ]);
    }
}
