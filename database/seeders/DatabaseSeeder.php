<?php

namespace Database\Seeders;

use App\Models\InvoiceDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(BrandSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(ColorSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(RoleSeeder::class);
//        $this->call(ImageSeeder::class);
//        $this->call(PostSeeder::class);
//        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(InvoiceSeeder::class);
//        $this->call(InvoiceDetailSeeder::class);
//        $this->call(ReviewSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
