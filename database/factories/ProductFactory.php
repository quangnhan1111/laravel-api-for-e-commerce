<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;
    private $size = ["XL", "XXL", "L", "M"];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomDigit,
            'name_size' => $this->size[array_rand($this->size)],
            'number' => $this->faker->numberBetween(1,100),
            'des' => $this->faker->text,
            'cate_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'gender_id' => Gender::all()->random()->id,
            'image_id' => Image::all()->random()->id,
            'color_id' => Color::all()->random()->id,
            'created_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
            'updated_at'=>$this->faker->dateTimeBetween("-1 day" , now()),
//            'is_deleted'=>$this->faker->boolean
        ];
    }
}
