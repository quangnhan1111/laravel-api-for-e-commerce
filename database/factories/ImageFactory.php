<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName,
            'link' => $this->faker->imageUrl(),
            'created_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
            'updated_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
//            'is_deleted'=>$this->faker->boolean
        ];
    }
}
