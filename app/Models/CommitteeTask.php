<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeTask extends Model
{
    use HasFactory;

    protected $fillable = ['committe_id', 'ar_task', 'en_task'];

    public function committe()
    {
        return $this->belongsTo(Committee::class,"committe_id");
    }
}
