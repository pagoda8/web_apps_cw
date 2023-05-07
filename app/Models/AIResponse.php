<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIResponse extends Model
{
    use HasFactory;

    public function licitation() {
        return $this->belongsTo(Licitation::class);
    }
}
