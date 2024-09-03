<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelOperation extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'operation_id'];

    public function level()
    {
        return $this->belongsTo(Level::class,"level_id");
    }

    public function operation()
    {
        return $this->belongsTo(LevelOperation::class,"operation_id");
    }
}
