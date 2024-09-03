<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ["ar_state","en_state"];

    public function university()
    {
        return $this->hasMany(University::class,"state_id");
    }
}
