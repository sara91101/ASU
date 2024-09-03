<?php

namespace App\Http\Controllers;

use App\Http\Requests\FAQRequest;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["faqs"] = FAQ::paginate(10);
        return view("manage.faqs",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("manage.createFAQ");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request)
    {
        $faq = new FAQ();
        $faq->ar_question = $request->ar_question;
        $faq->ar_answer = $request->ar_answer;
        $faq->en_question = $request->en_question;
        $faq->en_answer = $request->en_answer;
        $faq->save();

        return redirect("/faqs")->with("note","تم الحفظ");

    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $fAQ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request)
    {
        $faq =  FAQ::find($request->faq_id);
        $faq->ar_question = $request->ar_question;
        $faq->ar_answer = $request->ar_answer;
        $faq->en_question = $request->en_question;
        $faq->en_answer = $request->en_answer;
        $faq->update();

        return redirect("/faqs")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $fAQ)
    {
        FAQ::where("id",$fAQ)->delete();
        return redirect("/faqs")->with("note","تم الحذف");

    }
}
