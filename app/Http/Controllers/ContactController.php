<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["contacts"] = Contact::paginate(10);
        return view("manage.contacts",$data);
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
    public function store(ContactRequest $request)
    {
        $today = date("Y-m-d");

        $ip_today = Contact::where("ip_address",$request->ip())->whereDate('created_at',$today)->exists();

        if($ip_today)
        {
            return redirect("/contact")->with("errorNote","لا يمكنك إرسال أكثر من رسالة في نفس اليوم ");
        }
        $contact = new Contact();
        $contact->visitor_type = $request->visitor_type;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->msg = $request->msg;
        $contact->ip_address = $request->ip();
        $contact->save();

        return redirect("/contact")->with("note","تم الإرسال");
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
