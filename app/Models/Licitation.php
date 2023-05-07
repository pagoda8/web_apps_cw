<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitation extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bids() {
        return $this->hasMany(Bid::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function ai_response() {
        return $this->hasOne(AIResponse::class);
    }
}
