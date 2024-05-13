<?php



namespace Database\Factories;

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

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 0.99, 100.00),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
            'image' => $this->faker->imageUrl(),
        ];
    }
}

