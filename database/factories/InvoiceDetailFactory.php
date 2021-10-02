<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1,100),
            'invoice_id' => Invoice::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ];
    }
}
