<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class DspaceLink extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ["link_name","link_name_en"];

    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->link_name;
        }
        else
        {
            $column = $this->link_name_en;
        }

        $url = route('dspaceContent',$this->id);

        $engine = Engine::where("db_table","dspace_links")->first();

        $this->ar_table = $engine->ar_table;

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }

    public function dspaceLinkContent()
    {
        return $this->hasMany(DspaceLinkContent::class,"link_id");
    }
}

