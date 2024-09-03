<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use App\Models\Coalition;
use App\Models\Committee;
use App\Models\CommitteNew;
use App\Models\FAQ;
use App\Models\Home;
use App\Models\Service;
use App\Models\Simulation;
use App\Models\State;
use App\Models\Team;
use App\Models\Unit;
use App\Models\University;
use App\Models\UniversityType;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\DspaceLink;
use App\Models\DspaceLinkContent;
use App\Models\Engine;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
//

    public function generalSearch()
    {
      $data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

      $data["goals"] = Home::where("home_type","Goals")->get();

      $data["news"] = Advertisement::where("archieve",0)->get();

      return view("website.generalSearch",$data);
    }

    public function searchable(Request $request)
    {
      $field = $request->field;
        $data["searchResults"] = (new Search())
        ->registerModel(Advertisement::class, 'ar_advertisement','en_advertisement', 'ar_details', 'en_details')
        ->registerModel(Coalition::class, 'home_ar', 'home_en', 'home_type')
        ->registerModel(Committee::class, 'ar_name', 'en_name')
        ->registerModel(Simulation::class, 'home_ar', 'home_en', 'home_type')
        ->registerModel(DspaceLinkContent::class, 'content_title','content_title_en')
        ->registerModel(FAQ::class, 'ar_question','en_question', 'ar_answer', 'en_answer')
        ->registerModel(DspaceLink::class, 'link_name','link_name_en')
        ->registerModel(Service::class, 'service_ar', 'service_en', 'description_ar', 'description_en')
        ->registerModel(Team::class, 'name_en', 'name_ar', 'email', 'phone', 'Job')
        ->registerModel(University::class, 'ar_name', 'en_name')
        // ->registerModel(UniversityType::class, 'type_ar', 'type_en')
        ->registerModel(Home::class, 'home_ar', 'home_en', 'home_type')
        ->perform($field);

        $data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Home::where("home_type","Goals")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

      return view('website.search', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data["memebers"] = University::count();
        $data["services"] = Service::count();
        $data["types"] = UniversityType::with("university")->get();


        $data["universities"] = University::select("universities.*","university_types.type_ar")
        ->join("university_types","university_types.id","universities.type_id")
        ->orderBy("id","desc")
        ->limit(5)->get();

        return view('manage.home',$data);
    }


    public function websiteHome(Request $request)
    {
        // echo App::getLocale();exit;
        $data["visitors"] = Visitor::count();


        $data["sliders"] = Home::where("home_type","Slider")->get();
        $data["speech"] = Home::where("home_type","Secretary-General's speech")->first();
        $data["about"] = Home::where("home_type","About")->first();

        $data["vision"] = Home::where("home_type","Vision")->first();
        $data["mission"] = Home::where("home_type","Mission")->first();
        $data["goals"] = Home::where("home_type","Goals")->get();
        $data["values"] = Home::where("home_type","Values")->get();

        $data["phone"] = Home::where("home_type","Phone")->first();
        $data["email"] = Home::where("home_type","Email")->first();
        $data["address"] = Home::where("home_type","Address")->first();

        $data["types"] = UniversityType::with("university")->get();
        $data["committes"] = Committee::all();

        $data["services"] = Service::all();
        $data["news"] = Advertisement::where("archieve",0)->get();

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["faqs"] = FAQ::all();
        $data["teams"] = Team::all();

        $data["members"] = University::all();
        $data["faqs"] = FAQ::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["university_user"] = Auth::guard('university')->user();

        return view('website.home',$data);
    }

    public function websiteAbout(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["speech"] = Home::where("home_type","Secretary-General's speech")->first();
        $data["about"] = Home::where("home_type","About")->first();

        $data["vision"] = Home::where("home_type","Vision")->first();
        $data["mission"] = Home::where("home_type","Mission")->first();
        $data["goals"] = Home::where("home_type","Goals")->get();
        $data["values"] = Home::where("home_type","Values")->get();

        $data["vision"] = Home::where("home_type","Vision")->first();
        $data["structure"] = Home::where("home_type","structure")->first();
        $data["goals"] = Home::where("home_type","Goals")->get();
        $data["types"] = UniversityType::with("university")->get();
        $data["units"] = Unit::all();
        $data["services"] = Service::all();
        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();
        $data["committes"] = Committee::all();

        $data["teams"] = Team::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view('website.about',$data);
    }

    public function committee($committee_id,Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["committee"] = Committee::with("task")->with("news")->find($committee_id);

        $data["members"] = University::join("committe_members","committe_members.university_id","universities.id")
        ->where("committe_id",$committee_id)->paginate(15);

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();

        $data["goals"] = Home::where("home_type","Goals")->get();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.committee",$data);
    }

    public function news(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["vision"] = Home::where("home_type","Vision")->first();

        $data["committes"] = Committee::all();

        $data["news"] = CommitteNew::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        return view("website.news",$data);
    }

    public function contactUs(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();
        $data["types"] = UniversityType::all();
        $data["goals"] = Home::where("home_type","Goals")->get();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.contactUs",$data);
    }

    public function coalition(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["vision"] = Home::where("home_type","Vision")->first();
        $data["committes"] = Committee::all();

        $data["vision"] = Coalition::where("home_type","Vision")->first();
        $data["mission"] = Coalition::where("home_type","Mission")->first();

        $data["location"] = Coalition::where("home_type","المقر")->first();
        $data["mjal"] = Coalition::where("home_type","مجال ناطه وخدماته")->first();
        $data["member"] = Coalition::where("home_type","العضاء")->first();
        $data["geographical"] = Coalition::where("home_type","نطاق عله الجغرافي")->first();
        $data["owner"] = Coalition::where("home_type","الملكية والإطار القانوني")->first();
        $data["structure"] = Coalition::where("home_type","الهيكل اتنظيمي")->first();

        $data["goals"] = Coalition::where("home_type","الأهداف")->get();
        $data["ways"] = Coalition::where("home_type","الوسائل")->get();
        $data["tasks"] = Coalition::where("home_type","المهام والخدمات")->get();

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.coalition",$data);
    }



    public function simulation(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["vision"] = Simulation::where("home_type","Vision")->first();
        $data["mission"] = Simulation::where("home_type","Mission")->first();


        $data["goals"] = Simulation::where("home_type","Goals")->get();
        $data["values"] = Simulation::where("home_type","Values")->get();
        $data["about"] = Simulation::where("home_type","About")->first();

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.simulation",$data);
    }

    public function websiteMembers(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["members"] = University::select("universities.*","university_types.type_ar")->
        join("university_types","university_types.id","universities.type_id")
        ->orderby("type_id")->paginate(15);

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Simulation::where("home_type","Goals")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();


        return view("website.members",$data);
    }

    public function websiteMembersByType($type)
    {

        $data["visitors"] = Visitor::count();

        $data["members"] = University::select("universities.*","university_types.type_ar")->
        join("university_types","university_types.id","universities.type_id")
        ->where("type_id",$type)->paginate(15);

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Simulation::where("home_type","Goals")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();


        return view("website.members",$data);
    }

    public function membership(Request $request)
    {

        $data["visitors"] = Visitor::count();

        $data["types"] = UniversityType::all();
        $data["states"] = State::all();

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Home::where("home_type","Goals")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.membership",$data);
    }

    public function change_password(Request $request)
    {
        User::where("id",Auth::user()->id)->update(['password' => bcrypt($request->new_password) ]);

        Session::flush();

        return redirect("/login");


    }


    public function visitors(Request $request)
    {
         //echo $_SERVER['HTTP_REFERER']; exit;
        if(!str_contains(url()->previous(),"sarademos.online.sd"))
        {
            $route = Route::getFacadeRoot()->current()->uri();
            $visitor = new Visitor();

            $visitor->ip_address = $request->ip();
            $visitor->page = "$route";

            $visitor->save();
       }
    }

    public function dspace($dspace_id)
    {
      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["dsapceContent"] = DspaceLink::with("dspaceLinkContent")->find($dspace_id);

        $data["goals"] = Home::where("home_type","Goals")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.dspace",$data);
    }

    public function changeLanguage($language)
    {
        App::setLocale($language);
        session()->put('locale', $language);

        return redirect()->back();
    }
}
