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

        //Generate a starting bid amount between 100 and 50 000,
        //that is divisable by 100 (looks better)
        $base = fake()->numberBetween(1, 50);
        $multiplier = fake()->randomElement([100, 1000]);
        $minBid = $base * $multiplier;
        //Select either the generated amount or 1 (no minimum bid)
        $minBid = fake()->randomElement([1, $minBid]);
        
        //Generate a buy now price bigger than minBid and 1000 and less than 100 000
        $buyPrice = fake()->numberBetween(max($minBid, 1000), 100000);
        //Remove last two digits and make sure it's bigger than minBid
        $buyPrice = intdiv($buyPrice, 100) * 100 + 100;
        //Select either the generated amount or null (no buy price)
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

        //Create path to random existing appropriate car model photo,
        //(just for seeding purposes)
        $randomPhotoNum = fake()->randomElement(['1', '2', '3']);
        $subPath = $manufacturer . '/' . $model . '/' . $randomPhotoNum . '.jpg';
        $subPath = strtolower(str_replace(' ', '_', $subPath));
        $photoPath = '/images/example/' . $subPath;

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
