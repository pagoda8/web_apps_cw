<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function licitations() {
        return $this->hasMany(Licitation::class);
    }

    public function bids() {
        return $this->hasMany(Bid::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
