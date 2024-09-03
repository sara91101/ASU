<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteNew extends Model
{
    use HasFactory;

    protected $fillable = ['committe_id', 'ar_news', 'en_news'];

    public function committe()
    {
        return $this->belongsTo(Committee::class,"committe_id");
    }

}
