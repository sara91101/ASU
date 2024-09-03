<?php

namespace App\Http\Controllers;

use App\Models\UniversityType;
use Illuminate\Http\Request;

class UniversityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("manage.universityTypes");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UniversityType $universityType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityType $universityType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityType $universityType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityType $universityType)
    {
        //
    }
}
