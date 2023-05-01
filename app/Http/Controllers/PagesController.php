<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Licitation;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function licitation_list() {
        $licitations = Licitation::all();
        $users = User::all();
        $bids = Bid::all();
        return view('pages.licitation_list', ['licitations' => $licitations, 'users' => $users, 'bids' => $bids]);
    }

    public function licitation_details(string $id) {
        return view('pages.licitation_details')->with('id', $id);
    }

    public function create_licitation() {
        return view('pages.create_licitation');
    }

    public function user_profile(string $id) {
        return view('pages.user_profile')->with('id', $id);
    }
}
