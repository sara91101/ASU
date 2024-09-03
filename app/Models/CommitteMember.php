<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteMember extends Model
{
    use HasFactory;

    protected $fillable = ['committe_id', 'university_id'];

    public function committe()
    {
        return $this->belongsTo(Committee::class,"committe_id");
    }

}
