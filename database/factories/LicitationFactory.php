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

        $active = fake()->boolean();
        $end = null;
        if ($active == true) {
            $end = fake()->dateTimeBetween('now', '+30 days');
        }
        else {
            $end = fake()->dateTimeBetween('-30 days', 'now');
        }

        $base = fake()->numberBetween(1, 50);
        $multiplier = fake()->randomElement([100, 1000]);
        $minBid = $base * $multiplier;
        $minBid = fake()->randomElement([1, $minBid]);

        $currentBid = fake()->numberBetween($minBid, 75000);
        $currentBid = fake()->randomElement([null, $currentBid]);
        
        $min = null;
        if ($currentBid != null) {
            $min = max($minBid, $currentBid);
        }
        else {
            $min = $minBid;
        }
        $buyPrice = fake()->numberBetween(max($min, 1000), 100000);
        $buyPrice = intdiv($buyPrice, 100) * 100 + 100;
        $buyPrice = fake()->randomElement([null, $buyPrice]);

        $winningBidderID = null;
        if ($currentBid != null) {
            $winningBidderID = DB::table('users')->where('id', '<>', $randomUser->id)->inRandomOrder()->first()->id;
        }

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
            'creatorID' => $randomUser->id,
            'end' => $end,
            'active' => $active,
            'minBid' => $minBid,
            'currentBid' => $currentBid,
            'buyPrice' => $buyPrice,
            'winningBidderID' => $winningBidderID,
            'views' => fake()->numberBetween(10, 1000),
            'manufacturer' => $manufacturer,
            'model' => $model,
            'photoPath' => $photoPath,
            'year' => strval(fake()->numberBetween(2005, 2022)),
            'mileage' => fake()->numberBetween(0, 300000),
            'fuel' => fake()->randomElement(['Petrol', 'Diesel']),
            'engineSize' => fake()->randomFloat(1, 1, 4),
            'horsePower' => fake()->numberBetween(70, 500),
            'transmission' => fake()->randomElement(['Manual', 'Automatic']),
            'description' => fake()->randomElement($descriptions),
        ];
    }
}
