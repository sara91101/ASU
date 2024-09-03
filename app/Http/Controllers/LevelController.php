<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\LevelOperation;
use App\Models\Page;
use App\Models\SubPageOperation;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["levels"] = Level::with("operation" )->whereNot("id",1)->paginate(15);
        return view("manage.levels",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["pages"] = Page::with("operation")->get();
        return view("manage.createLevel",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $level = new Level();
        $level->level = $request->level;
        $level->save();

        $operations = $request->operations;
        foreach($operations as $operation)
        {
        $level_operation = new LevelOperation();
            $level_operation->level_id = $level->id;
            $level_operation->operation_id = $operation;
            $level_operation->save();
        }
        return redirect("/levels")->with("note","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $level)
    {
        $data["level"] = Level::with(["operation"=> function($query)
        {
            $query->join('page_sub_operations', "page_sub_operations.id","level_operations.operation_id");
        }])->where("id",$level)->first();
        $data["pages"] = Page::with("operation")->get();
        return view("manage.editLevel",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $level_id)
    {
        $level = Level::find($level_id);
        $level->level = $request->level;
        $level->update();

        LevelOperation::where("level_id",$level_id)->delete();

        $operations = $request->operations;
        foreach($operations as $operation)
        {
            $level_operation = new LevelOperation();
            $level_operation->level_id = $level_id;
            $level_operation->operation_id = $operation;
            $level_operation->save();
        }
        return redirect("/levels")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $level)
    {
        Level::where("id",$level)->delete();
        return redirect("/levels")->with("note","تم الحذف");
    }
}
