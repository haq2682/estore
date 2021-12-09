<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => rand(1, 13),
            'name' => $this->faker->name(),
            'stock_status' => 'instock',
            'description' => $this->faker->paragraph(),
            'product_image1' => $this->faker->imageUrl('480', '360'),
            'product_image2' => $this->faker->imageUrl('480', '360'),
            'product_image3' => $this->faker->imageUrl('480', '360'),
            'product_image4' => $this->faker->imageUrl('480', '360'),
            'product_image5' => $this->faker->imageUrl('480', '360'),
            'count' => rand(10, 50),
            'old_price' => rand(10, 400),
            'new_price' => rand(10, 400),
            'sold' => rand(10, 400),
        ];
    }
}
