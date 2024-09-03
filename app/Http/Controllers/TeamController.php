<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data["teams"] = Team::select("*");

        if($request->input('member'))
        {
          $member = $request->input('member');

          Session(['member' => $member]);

          $data["teams"] = $data["teams"]->where(function($v) use ($member)
          {
              $v->where("name_ar",'LIKE', '%'. $member .'%')
              ->orWhere("name_en",'LIKE', '%'. $member .'%')
              ->orWhere("address",'LIKE', '%'. $member .'%')
              ->orWhere("phone",'LIKE', '%'. $member .'%')
              ->orWhere("email",'LIKE', '%'. $member .'%');
          });
        }
        else
        {
          $membereSession = session('member');
          if( $membereSession != "")
          {
            $data["teams"] = $data["teams"]->where(function($v) use ($membereSession)
            {
                $v->where("name_ar",'LIKE', '%'. $membereSession .'%')
              ->orWhere("name_en",'LIKE', '%'. $membereSession .'%')
              ->orWhere("address",'LIKE', '%'. $membereSession .'%')
              ->orWhere("phone",'LIKE', '%'. $membereSession .'%')
              ->orWhere("email",'LIKE', '%'. $membereSession .'%');
            });
          }
        }

        $data["teams"] = $data["teams"]->paginate(15);

        return view("manage.teams",$data);
    }

    public function showAll()
    {
      Session(['member' => ""]);
      Session(['job' => ""]);

      return redirect("/team");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("manage.createTeam");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        $member = new Team();
        $member->name_en = $request->name_en;
        $member->name_ar = $request->name_ar;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->Job = $request->job;
        $member->job_en = $request->job_en;

        if($request->file("image_path"))
        {
            $path = public_path('teamImages');

            $file = $request->file("image_path");
            $fileName = "team".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $member->photo = $fileName;
        }
        $member->save();

        return redirect("/team")->with("note","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $member)
    {
        $data["member"] = Team::find($member);

        return view("manage.editTeam",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request,  $member_id)
    {
        $member = Team::find($member_id);
        $member->name_ar = $request->name_ar;
        $member->name_en = $request->name_en;
        $member->Job = $request->job;
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->job_en = $request->job_en;
        $member->address = $request->address;

        $path = public_path('teamImages');

        if($request->file("image_path"))
        {
            $file = $request->file("image_path");
            $fileName = "team".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $member->photo = $fileName;
        }

        $member->update();
        return redirect("/team")->with("note","تم التعديل");

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $member)
    {
        Team::where("id",$member)->delete();

        return redirect("/team")->with("note","تم الحذف");
    }
}
