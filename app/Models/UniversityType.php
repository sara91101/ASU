<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class UniversityType extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['type_ar', 'type_en'];

    public function university()
    {
        return $this->hasMany(University::class,"type_id");
    }
    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->type_ar;
        }
        else
        {
            $column = $this->type_en;
        }

        $url = route('members');

        return new SearchResult(
            $this,
            $column,
            $url
         );
    }

}
