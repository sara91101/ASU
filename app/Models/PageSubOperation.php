<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSubOperation extends Model
{
    use HasFactory;

    protected $fillable = ['operation_id','sub'];

    public function operation()
    {
        return $this->belongsTo(PageOperation::class,"operation_id");
    }
}
