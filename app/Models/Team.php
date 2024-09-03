<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Team extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_ar', 'email', 'phone', 'Job', 'photo', 'address'];


    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->name_ar;
        }
        else
        {
            $column = $this->name_en;
        }

        $url = route('websiteHome');

        $engine = Engine::where("db_table","teams")->first();

        $this->ar_table = $engine->ar_table;

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }
}
