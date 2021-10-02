<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Invoice;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'totalPrice' => $this->faker->numberBetween(0,0),
            'customer_id' => User::all()->random()->id,
            'employee_id' => User::all()->random()->id,
            'is_paid'=>$this->faker->boolean,
            'created_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
            'updated_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
//            'is_deleted'=>$this->faker->boolean
            'full_name' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'message' => $this->faker->text(100),
        ];
    }
}
