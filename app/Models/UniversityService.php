<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityService extends Model
{
    use HasFactory;

    protected $fillable = [ 'university_id', 'service_id', 'price'];

    public function university()
    {
        return $this->belongsTo(University::class,"university_id");
    }

    public function service()
    {
        return $this->belongsTo(Service::class,"service_id");
    }
}
