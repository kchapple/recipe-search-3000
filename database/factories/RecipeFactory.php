<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Recipe::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'author_email' => $this->faker->email,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recipe $recipe) {

            $ingredients = Ingredient::factory()->createMany($this->getIngredients());
            $ingredientsWithQuantity = [];
            foreach ($ingredients as $ingredient) {
                $ingredientsWithQuantity[$ingredient->id] = [
                    'quantity' => $this->faker->randomFloat(2, 1, 10), // Adjust as needed
                ];
            }

            $recipe->ingredients()->attach($ingredientsWithQuantity);

            $recipe->steps()->createMany($this->getSteps());
        });
    }

    private function getIngredients()
    {
        $numIngredients = $this->faker->numberBetween(1, 5);

        $ingredients = [];

        for ($i = 0; $i < $numIngredients; $i++) {
            $ingredients[] = [
                'name' => $this->faker->word,
            ];
        }

        return $ingredients;
    }

    private function getSteps()
    {
        $numSteps = $this->faker->numberBetween(3, 10);

        $steps = [];
        for ($i = 0; $i < $numSteps; $i++) {
            $steps[] = [
                'description' => $this->faker->sentence,
                'order' => $i + 1,
            ];
        }

        return $steps;
    }
}
