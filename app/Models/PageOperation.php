<?php

namespace App\Models;

use Database\Seeders\PageOperationSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageOperation extends Model
{
    use HasFactory;

    protected $fillable = ['page_id','operation'];

    public function page()
    {
        return $this->belongsTo(Page::class,"page_id");
    }

    public function sub()
    {
        return $this->hasMany(PageOperationSeeder::class,"operation_id");
    }
}
