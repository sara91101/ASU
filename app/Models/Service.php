<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Service extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['service_ar', 'service_en', 'description_ar', 'description_en', 'price', 'stactus'];

    public function universityService()
    {
        return $this->hasMany(UniversityService::class,"service_id");
    }


    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->service_ar;
        }
        else
        {
            $column = $this->service_en;
        }

        $url = route('websiteHome');

        $engine = Engine::where("db_table","services")->first();

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }
}
