<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user    = User::where('is_admin' , 0)->inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();

        return [

            'rating'  => random_int(1, 5),
            'comment' => $this->faker->text(random_int(50 , 100)),
            'status'=> random_int(0 , 1),
            'user_id' => $user->id,
            'product_id' => $product->id,
        ];
    }
}
