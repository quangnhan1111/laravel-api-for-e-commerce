<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'created_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
            'updated_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
//            'is_deleted'=>$this->faker->boolean
        ];
    }
}
