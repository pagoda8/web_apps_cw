<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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

        $allLicitations = DB::table('licitations')->get();
        $randomLicitation = fake()->randomElement($allLicitations);

        $comments = [
            "I like this car.",
            "This car looks great.",
            "Does it have a V8 engine?",
            "Where was the car serviced?",
            "Did kids ride in the car?",
            "Are there any issues with the car?",
            "What size are the rims?",
        ];

        return [
            'authorID' => $randomUser->id,
            'licitationID' => $randomLicitation->id,
            'comment' => fake()->randomElement($comments),
        ];
    }
}
