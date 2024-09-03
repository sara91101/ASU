<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Advertisement extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['ar_advertisement', 'en_advertisement', 'ar_details', 'en_details',
     'archieve','image','end_time'];

    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->ar_advertisement;
        }
        else
        {
            $column = $this->en_advertisement;
        }

        $url = route('websiteHome');

        $engine = Engine::where("db_table","advertisements")->first();

        $this->ar_table = $engine->ar_table;

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }
}
