<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Licitation;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function licitation_list() {
        $licitations = Licitation::all()->sortByDesc('end');
        $users = User::all();
        $bids = Bid::all();
        return view('pages.licitation_list', ['licitations' => $licitations, 'users' => $users, 'bids' => $bids]);
    }

    public function licitation_details($id) {
        $licitation = Licitation::findOrFail($id);
        $user = User::findOrFail($licitation->user_id);

        $bids = Bid::all();
        $current_bid = null;
        if($bids->where('licitation_id', '==', $licitation->id)->first()) {
            $current_bid = $bids->where('licitation_id', '==', $licitation->id)->sortByDesc('created_at')->first()->bid;
        }

        $users = User::all();
        $all_comments = Comment::all();
        $comments = $all_comments->where('licitation_id', '==', $licitation->id)->sortByDesc('created_at');

        return view('pages.licitation_details', ['licitation' => $licitation, 'user' => $user, 'current_bid' => $current_bid, 'comments' => $comments, 'all_users' => $users]);
    }

    public function create_licitation() {
        return view('pages.create_licitation');
    }

    public function user_profile($id) {
        $user = User::findOrFail($id);
        $is_signed_in_user = auth()->user()->id == $id;
        $bids = Bid::all();

        $all_licitations = Licitation::all();
        $licitations = null;
        if($all_licitations->where('user_id', '==', $user->id)->first()) {
            $licitations = $all_licitations->where('user_id', '==', $user->id)->sortByDesc('end');
        }

        return view('pages.user_profile', ['user' => $user, 'licitations' => $licitations, 'bids' => $bids, 'is_signed_in_user' => $is_signed_in_user]);
    }

    public function my_profile() {
        $id = auth()->user()->id;
        return self::user_profile($id);
    }
}
