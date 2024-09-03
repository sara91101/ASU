<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\University;
use App\Models\UniversityType;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function universitiesByService()
    {
        $services = Service::with("universityService")
        ->whereHas("universityService")->paginate(15);

        return view("manage.universitiesByService",compact("services"));
    }


    public function universitiesByTypes()
    {
        $universities = University::with("universityService")
        ->whereHas("universityService")->paginate(15);

        return view("manage.universitiesByTypes",compact("universities"));
    }


    public function contactsByCategory()
    {
        $types = UniversityType::with("university")
        ->whereHas("university")->paginate(15);

        return view("manage.contactsByCategory",compact("types"));
    }
}
