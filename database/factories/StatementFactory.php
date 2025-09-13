<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Statement;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();

        return [

            'name_ar'        => 'ar_'.$this->faker->text(15),
            'name_en'        => 'en-'.$this->faker->text(15),
            'value_ar'       => 'ar_'.$this->faker->text(20),
            'value_en'       => 'en-'.$this->faker->text(20),
            'product_id'     => $product->id
        ];
    }
}
