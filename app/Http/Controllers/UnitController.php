<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["units"] = Unit::paginate(10);
        return view("manage.units",$data);
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
    public function store(UnitRequest $request)
    {
        $unit = new Unit();
        $unit->ar_unit = $request->ar_unit;
        $unit->en_unit = $request->en_unit;
        $unit->ar_details = $request->ar_details;
        $unit->en_details = $request->en_details;
        $unit->save();

        return redirect("/units")->with("note","تم الحفظ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $unit =  Unit::find($request->unit_id);
        $unit->ar_unit = $request->ar_unit;
        $unit->en_unit = $request->en_unit;
        $unit->ar_details = $request->ar_details;
        $unit->en_details = $request->en_details;
        $unit->update();

        return redirect("/units")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $unit)
    {
        $unit =  Unit::find($unit);
        $unit->delete();
        return redirect("/units")->with("note","تم الحذف");

    }
}
