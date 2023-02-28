<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Licitation>
 */
class LicitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $allUsers = DB::table('users')->get();
        $randomUser = fake()->randomElement($allUsers);

        $base = fake()->numberBetween(1, 50);
        $multiplier = fake()->randomElement([100, 1000]);
        $minBid = $base * $multiplier;
        $minBid = fake()->randomElement([1, $minBid]);
        
        $buyPrice = fake()->numberBetween(max($minBid, 1000), 100000);
        $buyPrice = intdiv($buyPrice, 100) * 100 + 100;
        $buyPrice = fake()->randomElement([null, $buyPrice]);

        $manufacturers = ['BMW', 'Mercedes-Benz', 'Porsche', 'Volkswagen'];
        $models = [
            "BMW" => ['3 Series', '5 Series', '7 Series'],
            "Mercedes-Benz" => ['E Class', 'S Class', 'G Class'],
            "Porsche" => ['911', 'Cayman', 'Panamera'],
            "Volkswagen" => ['Golf', 'Passat', 'Arteon'],
        ];

        $manufacturer = fake()->randomElement($manufacturers);
        $model = fake()->randomElement($models[$manufacturer]);

        $randomPhotoNum = fake()->randomElement(['1', '2', '3']);
        $subPath = $manufacturer . '/' . $model . '/' . $randomPhotoNum . '.jpg';
        $subPath = strtolower(str_replace(' ', '_', $subPath));
        $photoPath = '../public/images/example/' . $subPath;

        $descriptions = [
            "Car is in very good shape.",
            "Car is equipped with a lot of features.",
            "Car is accident-free.",
            "Car had 2 previous owners.",
            "Car had only 1 owner.",
            "Car was always parked in garage.",
        ];

        return [
            'user_id' => $randomUser->id,
            'end' => fake()->dateTimeBetween('-30 days', '+30 days'),
            'min_bid' => $minBid,
            'buy_price' => $buyPrice,
            'views' => fake()->numberBetween(10, 1000),
            'manufacturer' => $manufacturer,
            'model' => $model,
            'photo_path' => $photoPath,
            'year' => strval(fake()->numberBetween(2005, 2022)),
            'mileage' => fake()->numberBetween(0, 300000),
            'fuel' => fake()->randomElement(['Petrol', 'Diesel']),
            'engine_size' => fake()->randomFloat(1, 1, 4),
            'horse_power' => fake()->numberBetween(70, 500),
            'transmission' => fake()->randomElement(['Manual', 'Automatic']),
            'description' => fake()->randomElement($descriptions),
        ];
    }
}
