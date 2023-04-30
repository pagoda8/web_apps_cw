<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function licitation_list() {
        return view('pages.licitation_list');
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
