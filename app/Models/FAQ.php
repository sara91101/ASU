<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class FAQ extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['ar_question', 'en_question', 'ar_answer', 'en_answer'];

    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->ar_question;
        }
        else
        {
            $column = $this->en_question;
        }

        $url = route('websiteHome');

        $engine = Engine::where("db_table","f_a_q_s")->first();

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }
}
