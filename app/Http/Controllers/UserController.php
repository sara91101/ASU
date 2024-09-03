<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["users"] = User::select("users.*","levels.level")
        ->join("levels","levels.id","users.level_id")
        ->orderby("level_id")->orderby("name")->whereNot("level_id",1)->paginate(15);

        $data["levels"] = Level::whereNot("id",1)->get();
        return view("manage.users",$data);
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
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level_id = $request->level_id;
        $user->save();

        return redirect("/users")->with("note","تمت الاضافة");

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        $user =  User::find($request->User_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){$user->password = bcrypt($request->password);}
        $user->level_id = $request->level_id;
        $user->update();

        return redirect("/users")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $user)
    {
        User::where("id",$user)->delete();
        return redirect("/users")->with("note","تم الحذف");
    }
}
