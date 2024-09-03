<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Committee extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ['ar_name', 'en_name'];

    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->ar_name;
        }
        else
        {
            $column = $this->en_name;
        }

        $url = route('committee',$this->id);

        $engine = Engine::where("db_table","committees")->first();

        $this->ar_table = $engine->ar_table;

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }

    public function news()
    {
        return $this->hasMany(CommitteNew::class,"committe_id");
    }

    public function member()
    {
        return $this->hasMany(CommitteMember::class,"committe_id");
    }

    public function task()
    {
        return $this->hasMany(CommitteeTask::class,"committe_id");
    }

}
