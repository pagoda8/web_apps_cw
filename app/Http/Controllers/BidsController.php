<?php

namespace App\Http\Controllers;

use App\Events\BidEvent;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Licitation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BidsController extends Controller
{
    public function store(Request $request, string $licitation_id) {
        $illegal_bid = false;
        $licitation = Licitation::findOrFail($licitation_id);
        $bids = Bid::all()->where('licitation_id', '==', $licitation_id)->sortByDesc('created_at');
        $relative_bid = $licitation->min_bid;
        if($bids->first()) {
            $relative_bid = $bids->first()->bid;
        }

        $validator = Validator::make($request->all(), [
            'bid' => 'required|integer',
        ]);

        if($licitation->user_id == auth()->user()->id) {
            $illegal_bid = true;
            $validator->errors()->add('bid', 'You cannot place bids on your licitations.');
            throw new ValidationException($validator);
        }
        if(now()->gt($licitation->end)) {
            $illegal_bid = true;
            $validator->errors()->add('bid', 'This licitation has already ended.');
            throw new ValidationException($validator);
        }
        if($request->bid < $relative_bid + 10) {
            $illegal_bid = true;
            $validator->errors()->add('bid', 'A bid must be at least £10 higher than the starting/current bid.');
            throw new ValidationException($validator);
        }

        if($validator->fails() || $illegal_bid) {
            return redirect('/licitation_details/' . $licitation_id)->withErrors($validator)->withInput();
        }
        else {
            $bid = new Bid;
            $bid->user_id = auth()->user()->id;
            $bid->licitation_id = $licitation_id;
            $bid->bid = $request->bid;
            $bid->save();

            $receiver_id = $licitation->user_id;
            $name = $licitation->manufacturer . " " . $licitation->model . " (" . $licitation->year . ")";
            event(new BidEvent($receiver_id, $request->bid, $name));

            session()->flash('message', 'Bid was placed.');
            return redirect('/licitation_details/' . $licitation_id);
        }
    }
}
