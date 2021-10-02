<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        for ($i=0; $i < 2; $i++) {
//            User::factory(2)->create();
//        }

        DB::table('users')->insert([
            'full_name' => "nguyen ngoc quang nhan",
            'username' => "ben123",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone_number' => "01216568789565",
            'email' => "quangnhan451@gmail.com",
            'address' => "HUE VN ASIAN",
//            'role_id' => Role::all()->random()->id,
            'created_at'=>"2021-07-22 10:24:42",
            'updated_at'=>"2021-07-22 10:24:42",
//            'is_deleted'=>$this->faker->boolean
        ]);


    }
}
