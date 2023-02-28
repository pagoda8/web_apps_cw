<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomLicitation = DB::table('licitations')->inRandomOrder()->first();
        $randomUserID = DB::table('users')->where('id', '<>', $randomLicitation->user_id)->inRandomOrder()->first()->id;

        $minBid = $randomLicitation->min_bid;
        $buyPrice = $randomLicitation->buy_price;
        $latestBid = DB::table('bids')->where('licitation_id', $randomLicitation->id)->latest('created_at')->first();

        $newBid = null;
        if ($latestBid == null) {
            if ($buyPrice == null) {
                $newBid = $minBid + 100;
            }
            else {
                $newBid = ($minBid + 100 < $buyPrice) ? $minBid + 100 : $buyPrice;
            }
        }
        else {
            if ($buyPrice == null) {
                $newBid = $latestBid->bid + 100;
            }
            else {
                $newBid = ($latestBid->bid + 100 < $buyPrice) ? $latestBid->bid + 100 : $buyPrice;
            }
        }

        return [
            'user_id' => $randomUserID,
            'licitation_id' => $randomLicitation->id,
            'bid' => $newBid,
        ];
    }
}
