<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class DspaceLinkContent extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = ["link_id","content_title","content_title_en","content_path"];

    public function dspaceLink()
    {
        return $this->belongsTo(DspaceLink::class,"link_id");
    }

    public function getSearchResult(): SearchResult
    {
        $lang = App::getLocale();
        if($lang == "ar")
        {
            $column = $this->content_title;
        }
        else
        {
            $column = $this->content_title_en;
        }

        $url = route('dspaceContent',$this->link_id);

        $engine = Engine::where("db_table","dspace_link_contents")->first();

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }
}
