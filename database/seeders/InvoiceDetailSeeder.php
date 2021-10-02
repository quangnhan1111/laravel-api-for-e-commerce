<?php

namespace Database\Seeders;

use App\Models\InvoiceDetail;
use Illuminate\Database\Seeder;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            InvoiceDetail::factory(2)->create();
        }
    }
}
