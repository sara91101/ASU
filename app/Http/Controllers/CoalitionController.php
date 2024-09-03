<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoalitionRequest;
use App\Models\Coalition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoalitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data["homes"] = Coalition::select("*");

        if($request->home)
        {
            Session(['home' => $request->home]);
            $data["homes"] = $data["homes"]->where("home_type",$request->home);
        }

        $data["homes"] = $data["homes"]->orderBy('home_Type')->paginate(15);
        $data["types"] = Coalition::select("home_type")->distinct()->get();
        return view("manage.coalitions",$data);
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
    public function store(CoalitionRequest $request)
    {

        $home = new Coalition();
        $home->home_ar = $request->home_ar;
        $home->home_en = $request->home_en;
        $home->home_type = $request->home_type;

        $path = public_path('sliders');

        if($request->file("home_image"))
        {
            $file = $request->file("home_image");
            $fileName = "slider".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $home->home_image = "/sliders/".$fileName;
        }

        $home->save();
        return redirect("/coalitions")->with("note","تمت الإضافة");

    }

    /**
     * Display the specified resource.
     */
    public function show(Coalition $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coalition $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoalitionRequest $request)
    {
        $home = Coalition::find($request->home_id);
        $home->home_ar = $request->home_ar;
        $home->home_en = $request->home_en;
        // $home->home_type = $request->home_type;

        $path = public_path('sliders');

        if($request->file("home_image"))
        {
            File::delete(public_path("sliders/$home->home_image"));
            $file = $request->file("home_image");
            $fileName = "slider".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $home->home_image = $fileName;
        }

        $home->update();

        return redirect("/coalitions")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $home)
    {
        $home = Coalition::find($home);
        File::delete(public_path("sliders/$home->home_image"));
        $home->delete();

        return redirect("/coalitions")->with("note","تم الحذف");
    }
}
