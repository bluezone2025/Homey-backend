<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\MyDataTable\MDT_UploadImag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    use MDT_UploadImag;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $regularPrice = $this->faker->numberBetween(400 , 1500);

        $salePrice = $regularPrice - random_int(70 , 150);

        $difference = $regularPrice - $salePrice;

        $path = 'assets/images/products/min/';
        $img = $this->faker->image(public_path($path), 1200  ,   800, 'products' , 'xxx');
        $imgName = explode('\\' ,$img);
        $imgName = end($imgName);

        \File::copy($img , public_path($path.'small_'.$imgName));
        \File::copy($img , public_path($path.'medium'.$imgName));

        return [

            'name_ar'        => 'ar_'.$this->faker->text(35),
            'name_en'        => 'en-'.$this->faker->text(35),
            'slug'           => 'en-'.$this->faker->text(35),
            'description_ar' => 'ar-'.$this->faker->text(255),
            'description_en' => 'en-'.$this->faker->text(255),
            'regular_price'  => $regularPrice,
            'sale_price'     => $salePrice,
            'discount_percentage'  => round(($difference / $regularPrice) * 100),
            'in_sale'        => random_int(0 ,1),
            'img'            => $imgName,
            'is_recommended' => random_int(0 ,1),
            'is_best'        => random_int(0 ,1),
            'has_options'    => random_int(0 ,1),
            'start_sale'     => Carbon::now(random_int(1 , 3))->format('Y-m-d'),
            'end_sale'       => Carbon::now(random_int(7 , 15))->format('Y-m-d'),
            'quantity'       => random_int(0 , 50)

        ];
    }
}
