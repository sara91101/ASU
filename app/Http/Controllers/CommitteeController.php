<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommitteeRequest;
use App\Models\Advertisement;
use App\Models\Committee;
use App\Models\CommitteeTask;
use App\Models\CommitteMember;
use App\Models\CommitteNew;
use App\Models\Home;
use App\Models\Service;
use App\Models\University;
use App\Models\UniversityType;
use App\Models\DspaceLink;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["committees"] = Committee::paginate(10);
        return view("manage.committees",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["types"] = UniversityType::with("university")->get();

        return view("manage.createCommittee",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommitteeRequest $request)
    {
        //save committe names
        $committee = new Committee();
        $committee->ar_name = $request->ar_name;
        $committee->en_name = $request->en_name;
        $committee->save();

        //save committee tasks
        $ar_tasks = $request->ar_task;
        $en_tasks = $request->en_task;

        for($t=0; $t <sizeof($ar_tasks); $t++)
        {
            $task = new CommitteeTask();
            $task->committe_id = $committee->id;
            $task->ar_task = $ar_tasks[$t];
            if($en_tasks[$t] != "")
            {
                $task->en_task = $en_tasks[$t];
            }
            $task->save();
        }

        //save committee news
        $ar_news = $request->ar_news;
        $en_news = $request->en_news;

        for($t=0; $t <sizeof($ar_news); $t++)
        {
            if($ar_news[$t] != "")
            {
                $news = new CommitteNew();
                $news->committe_id = $committee->id;
                $news->ar_news = $ar_news[$t];
                $news->ar_description = $en_news[$t];
                // if($en_news[$t] != "")
                // {
                //     $news->en_news = $en_news[$t];
                // }
                $news->save();
            }
        }

        //save committee members
        $members = $request->members;
        foreach($members as $member)
        {
            $memberr = new CommitteMember();
            $memberr->committe_id = $committee->id;
            $memberr->university_id = $member;
            $memberr->save();
        }

        return redirect("/committees")->with("note","تم الحفظ");

    }

    /**
     * Display the specified resource.
     */
    public function show( $committee)
    {
        $data["committee"] = Committee::with("task")->with("news")->find($committee);
        $data["members"] = University::join("committe_members","committe_members.university_id","universities.id")
        ->where("committe_id",$committee)->get();

        return view("manage.showCommittee",$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($committee)
    {
        $data["committee"] = Committee::with("task")->with("news")->find($committee);
        $data["types"] = UniversityType::with("university")->get();
        foreach($data["types"] as $type)
        {
            foreach($type["university"] as $university)
            {
                $check = CommitteMember::where("committe_id",$committee)->where("university_id",$university->id)->exists();
                if($check){$university->checked = "checked";}
                else{$university->checked = "";}
            }
        }
        return view("manage.editCommittee",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommitteeRequest $request, $committee)
    {
        //save committe names
        $committee =  Committee::find($committee);
        $committee->ar_name = $request->ar_name;
        $committee->en_name = $request->en_name;
        $committee->update();

        //save committee tasks
        $committee->task()->delete();
        $ar_tasks = $request->ar_task;
        $en_tasks = $request->en_task;

        for($t=0; $t <sizeof($ar_tasks); $t++)
        {
            $task = new CommitteeTask();
            $task->committe_id = $committee->id;
            $task->ar_task = $ar_tasks[$t];
            if($en_tasks[$t] != "")
            {
                $task->en_task = $en_tasks[$t];
            }
            $task->save();
        }

        //save committee news
        $committee->news()->delete();
        $ar_news = $request->ar_news;
        $ar_details = $request->ar_details;
        // $en_news = $request->en_news;

        for($t=0; $t <sizeof($ar_news); $t++)
        {
            if($ar_news[$t] != "")
            {
                $news = new CommitteNew();
                $news->committe_id = $committee->id;
                $news->ar_news = $ar_news[$t];
                $news->ar_description = $ar_details[$t];
                // if($en_news[$t] != "")
                // {
                //     $news->en_news = $en_news[$t];
                // }
                $news->save();
            }
        }

        //save committee members
        $committee->member()->delete();
        $members = $request->members;
        foreach($members as $member)
        {
            $memberr = new CommitteMember();
            $memberr->committe_id = $committee->id;
            $memberr->university_id = $member;
            $memberr->save();
        }

        return redirect("/committees")->with("note","تم التعديل");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $committee)
    {
        Committee::where("id",$committee)->delete();

        return redirect("/committees")->with("note","تم الحذف");

    }

    public function committes()
    {
        $data["committes"] = Committee::all();

        $data["phones"] = Home::where("home_type","Phone")->get();
        $data["email"] = Home::where("home_type","Email")->first();

        $data["services"] = Service::all();
        $data["goals"] = Home::where("home_type","Goals")->get();

      	$data["dspace"] = DspaceLink::with("dspaceLinkContent")->get();
        $data["news"] = Advertisement::where("archieve",0)->get();
        return view("website.committes",$data);
    }
}
