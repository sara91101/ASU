<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable; //Add this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class University extends Authenticatable implements Searchable
{
    use HasFactory;

    protected $fillable = [ 'ar_name', 'en_name', 'logo', 'type_id', 'created_at', 'updated_at', 'state_id', 'address', 'datee', 'phone', 'email', 'town', 'website', 'others', 'password', 'manager_name', 'manager_phone', 'manager_email', 'manager_address', 'sub_manager_name', 'sub_manager_phone', 'sub_manager_email', 'sub_manager_address', 'execution_manager_name', 'execution_manager_phone', 'execution_manager_email', 'execution_manager_address'];


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

        $url = route('members');

        $engine = Engine::where("db_table","universities")->first();

        return new SearchResult(
            $this,
            $column,
            $url,
            $engine
         );
    }

    public function type()
    {
        return $this->belongsTo(UniversityType::class,"type_id");
    }

    public function state()
    {
        return $this->belongsTo(State::class,"state_id");
    }

    public function universityService()
    {
        return $this->hasMany(UniversityService::class,"university_id");
    }

}
