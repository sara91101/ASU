<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Home extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['home_ar', 'home_en', 'home_type', 'home_image'];

    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->home_ar;
        }
        else
        {
            $column = $this->home_en;
        }

        $url = route('about');

        $engine = Engine::where("db_table","homes")->first();

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }

}
