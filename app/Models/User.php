<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

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
