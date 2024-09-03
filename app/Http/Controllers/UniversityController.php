<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversityRequest;
use App\Models\Advertisement;
use App\Models\DspaceLink;
use App\Models\Home;
use App\Models\Service;
use App\Models\Simulation;
use App\Models\State;
use App\Models\University;
use App\Models\UniversityService;
use App\Models\UniversityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["universities"] = University::select("universities.*","university_types.type_ar")
        ->join("university_types","university_types.id","universities.type_id")
        ->paginate(10);
        $data["types"] = UniversityType::all();
        return view("manage.universities",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversityRequest $request)
    {
        $university = new University();
        $university->ar_name = $request->ar_name;
        $university->en_name = $request->en_name;
        $university->type_id = $request->type_id;

        $university->address = $request->address;
        $university->datee = $request->datee;
        $university->phone = $request->phone;
        $university->email = $request->email;
        $university->town = $request->town;
        $university->website = $request->website;
        $university->others = $request->others;

        $university->password = bcrypt("123456");

        $university->manager_name = $request->manager_name;
        $university->manager_phone = $request->manager_phone;
        $university->manager_email = $request->manager_email;
        $university->manager_address = $request->manager_address;

        $university->sub_manager_name = $request->sub_manager_name;
        $university->sub_manager_phone = $request->sub_manager_phone;
        $university->sub_manager_email = $request->sub_manager_email;
        $university->sub_manager_address = $request->sub_manager_address;

        $university->execution_manager_name = $request->execution_manager_name;
        $university->execution_manager_phone = $request->execution_manager_phone;
        $university->execution_manager_email = $request->execution_manager_email;
        $university->execution_manager_address = $request->execution_manager_address;

        $path = public_path('logos');

        if($request->file("logo"))
        {
            $file = $request->file("logo");
            $fileName = "logo".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $university->logo = $fileName;
        }

        $university->save();

        return redirect("/members")->with("note","تم إرسال طلب الإشتراك");

    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $university_id)
    {
        $data["university"] = University::find($university_id);

        $data["types"] = UniversityType::all();

        return view("manage.editUniversity",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$university_id)
    {
        $university =  University::find($university_id);
        $university->ar_name = $request->ar_name;
        $university->en_name = $request->en_name;
        $university->type_id = $request->type_id;

        $university->address = $request->address;
        $university->datee = $request->datee;
        $university->phone = $request->phone;
        $university->email = $request->email;
        $university->town = $request->town;
        $university->website = $request->website;
        $university->others = $request->others;

        $university->password = bcrypt($request->password);

        $university->manager_name = $request->manager_name;
        $university->manager_phone = $request->manager_phone;
        $university->manager_email = $request->manager_email;
        $university->manager_address = $request->manager_address;

        $university->sub_manager_name = $request->sub_manager_name;
        $university->sub_manager_phone = $request->sub_manager_phone;
        $university->sub_manager_email = $request->sub_manager_email;
        $university->sub_manager_address = $request->sub_manager_address;

        $university->execution_manager_name = $request->execution_manager_name;
        $university->execution_manager_phone = $request->execution_manager_phone;
        $university->execution_manager_email = $request->execution_manager_email;
        $university->execution_manager_address = $request->execution_manager_address;

        $path = public_path('logos');

        if($request->file("logo"))
        {
            $file = $request->file("logo");
            $fileName = "logo".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $university->logo = $fileName;
        }

        $university->update();

        return redirect("/universities")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $university_id)
    {
        $university = University::find($university_id);
        File::delete(public_path("logos/$university->logo"));
        $university->delete();

        return redirect("/universities")->with("note","تم الحذف");
    }

    public function profile()
    {
        $data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Home::where("home_type","Goals")->get();

        $data["news"] = Advertisement::where("archieve",0)->get();

        $data["services"] = Service::where("stactus",1)->get();

        if (!Auth::guard('university')->check())
        {
            return redirect('/universityLogin');
        }
        $user = Auth::guard('university')->user();

        $data["university"] = University::select("universities.*","states.ar_state")
        ->leftJoin("states","states.id","universities.state_id")
        ->with(["universityService"=> function($sql){
            $sql->leftjoin("services","services.id","university_services.service_id")
            ->get();
        }])
        ->find($user->id);

        return view("website.universityProfile",$data);
    }

    public function university_change_password(Request $request)
    {
        University::where("id",Auth::guard('university')->user()->id)->update(['password' => bcrypt($request->new_password) ]);

        Session::flush();

        Auth::guard('university')->logout();

        return redirect('/universityLogin')->with("note","تم تغيير كلمة المرور");
    }

    public function serviceApply(Request $request)
    {
        if (!Auth::guard('university')->check())
        {
            return redirect('/universityProfile')->with("errorNote","الرجاء تسجيل الدخول أولاً");
        }

        if($request->service_id == 1000)
        {
            $universityService = new UniversityService();
            $universityService->university_id = Auth::guard('university')->user()->id;
            $universityService->else = $request->else;
            $universityService->save();
        }
        else
        {
            $data = ["service_id" => $request->service_id];

            $validator = Validator::make($data, [
                'service_id'      => "required|numeric|exists:services,id"
            ]);

            if ($validator->fails())
            {
                return redirect("/universityProfile")->with("errorNote","الخدمة المطلوبة غير صحيحة");
            }

            $service = Service::find($request->service_id);

            $universityService = new UniversityService();
            $universityService->university_id = Auth::guard('university')->user()->id;
            $universityService->service_id = $request->service_id;
            $universityService->price = $service->price;
            $universityService->save();
        }
        return redirect("/universityProfile")->with("note","تم إرسال طلب الخدمة");

    }

    public function showLoginForm()
    {
        $data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        $data["goals"] = Home::where("home_type","Goals")->get();

        $data["news"] = Advertisement::where("archieve",0)->get();

        return view("website.login",$data);
    }

    public function login(Request $request)
    {
        $fields = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );

        // Find subscriber by membership number
        $user = University::where('email', $fields['email'])->first();

        // Return error if subscriber not found
        if (!$user)
        {
            return redirect("universityLogin")->with("errorNote","الرجاء مراجعة الصلاحيات ثم المحاولة مرة أخرى");
        }

        // Check if password matches
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return redirect("universityLogin")->with("errorNote","الرجاء مراجعة الصلاحيات ثم المحاولة مرة أخرى");
        }

        if (Auth::guard('university')->attempt(['email' => $request->email, 'password' =>
        $request->password])) {
        return redirect("universityProfile");
        }

        // return redirect("universityProfile");

    }

    public function logout()
    {
        Session::flush();

        Auth::guard('university')->logout();

        return redirect('/universityLogin');
    }

    public function editMembership()
    {
        if (!Auth::guard('university')->check())
        {
            return redirect('/universityLogin');
        }

        $data["university"] = Auth::guard("university")->user();

        $data["types"] = UniversityType::all();

        $data["states"] = State::all();

        $data["news"] = Advertisement::all();

        $data["goals"] = Home::where("home_type","Goals")->get();

        $data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();

        return view("editMemebership",$data);
    }

    public function updateMembership(UniversityRequest $request)
    {
        if (!Auth::guard('university')->check())
        {
            return redirect('/universityLogin');
        }

        $university_id = Auth::guard("university")->user()->id;

        $university =  University::find($university_id);
        $university->ar_name = $request->ar_name;
        $university->en_name = $request->en_name;
        $university->type_id = $request->type_id;

        $university->address = $request->address;
        $university->datee = $request->datee;
        $university->phone = $request->phone;
        $university->email = $request->email;
        $university->town = $request->town;
        $university->website = $request->website;
        $university->others = $request->others;

        // $university->password = bcrypt($request->password);

        $university->manager_name = $request->manager_name;
        $university->manager_phone = $request->manager_phone;
        $university->manager_email = $request->manager_email;
        $university->manager_address = $request->manager_address;

        $university->sub_manager_name = $request->sub_manager_name;
        $university->sub_manager_phone = $request->sub_manager_phone;
        $university->sub_manager_email = $request->sub_manager_email;
        $university->sub_manager_address = $request->sub_manager_address;

        $university->execution_manager_name = $request->execution_manager_name;
        $university->execution_manager_phone = $request->execution_manager_phone;
        $university->execution_manager_email = $request->execution_manager_email;
        $university->execution_manager_address = $request->execution_manager_address;

        $path = public_path('logos');

        if($request->file("logo"))
        {
            $file = $request->file("logo");
            $fileName = "logo".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $university->logo = $fileName;
        }

        $university->update();

        return redirect("/universityProfile")->with("note","تم التعديل");
    }

    public function services_requests()
    {
        $data["requests"] = UniversityService::select("universities.ar_name","services.service_ar","university_services.*")
        ->join("universities","universities.id","university_services.university_id")
        ->leftjoin("services","services.id","university_services.service_id")
        ->paginate(15);

        return view("manage.services_requests",$data);
    }
}
