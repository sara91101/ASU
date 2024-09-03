<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertismentRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["advertisements"] = Advertisement::paginate(15);
        return view("manage.advertisements",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertismentRequest $request)
    {
        $Advertisement = new Advertisement();
        $Advertisement->ar_advertisement = $request->ar_advertisement;
        $Advertisement->en_advertisement = $request->en_advertisement;
        $Advertisement->ar_details = $request->ar_details;
        $Advertisement->en_details = $request->en_details;
        $Advertisement->end_time = $request->end_time;

        if($request->file("image"))
        {
            $path = public_path('news');

            $file = $request->file("image");
            $fileName = "advertisement".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $Advertisement->image = $fileName;
        }

        $Advertisement->save();

        return redirect("/advertisements")->with("note","تم الحفظ");

    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertismentRequest $request)
    {
        $Advertisement =  Advertisement::find($request->advertisement_id);
        $Advertisement->ar_advertisement = $request->ar_advertisement;
        $Advertisement->en_advertisement = $request->en_advertisement;
        $Advertisement->ar_details = $request->ar_details;
        $Advertisement->en_details = $request->en_details;
        $Advertisement->end_time = $request->end_time;

        if($request->file("image"))
        {
            $path = public_path('news');

            $file = $request->file("image");
            $fileName = "advertisement".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $Advertisement->image = $fileName;
        }

        $Advertisement->update();

        return redirect("/advertisements")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $advertisement)
    {
        Advertisement::where("id",$advertisement)->delete();
        return redirect("/advertisements")->with("note","تم الحذف");
    }

    public function archieve( $advertisement)
    {
        Advertisement::where("id",$advertisement)->update(["archieve"=>1]);
        return redirect("/advertisements")->with("note","تم الأرشفة");
    }
}
