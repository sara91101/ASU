<?php

namespace App\Http\Controllers;

use App\Http\Requests\DspaceLinkRequest;
use App\Models\DspaceLink;
use App\Models\DspaceLinkContent;
use Illuminate\Http\Request;

class DspaceLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["links"] = DspaceLink::with("dspaceLinkContent")->paginate(15);
        return view("manage.dspaceLinks",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("manage.createDspaceLink");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DspaceLinkRequest $request)
    {
        $link = new DspaceLink();
        $link->link_name = $request->name;
        $link->link_name_en = $request->name_en;
        $link->save();

        if($request->contents)
        {
            $contents = $request->contents;
            $contents_en = $request->contents_en;
            $paths = $request->file("content_paths");

            $dspace_path = public_path('dspace');

            for($c=0; $c <sizeof($contents); $c++)
            {
              	if($contents[$c] != "")
                {
                  $link_content = new DspaceLinkContent();
                  $link_content->link_id = $link->id;
                  $link_content->content_title = $contents[$c];
                  $link_content->content_title_en = $contents_en[$c];

                  $file = $paths[$c];
                  $fileName = "dspace$c".time(). '.' . $file->getClientOriginalExtension();
                  $file->move($dspace_path, $fileName);

                  $link_content->content_path = $fileName;

                  $link_content->save();
                }
            }
        }

        return redirect("/dspaceLinks")->with("note","تم الحفظ");
    }

    /**
     * Display the specified resource.
     */
    public function show(DspaceLink $dspaceLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $dspaceLink)
    {
        $dspace = DspaceLink::find($dspaceLink);
        return view("manage.editDspaceLink",compact('dspace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DspaceLinkRequest $request, $dspaceLink)
    {
        $link =  DspaceLink::find($dspaceLink);
        $link->link_name = $request->name;
        $link->link_name_en = $request->name_en;
        $link->update();

        DspaceLinkContent::where("link_id",$dspaceLink)->delete();

        if($request->contents)
        {
            $contents = $request->contents;
            $contents_en = $request->contents_en;
            $paths = $request->file("content_paths");
            $last_paths = $request->last_paths;

            $dspace_path = public_path('dspace');

            for($c=0; $c <sizeof($contents); $c++)
            {
              	if($contents[$c] != "")
                {
                    $link_content = new DspaceLinkContent();
                    $link_content->link_id = $link->id;
                    $link_content->content_title = $contents[$c];
                    $link_content->content_title_en = $contents_en[$c];

                    if (!empty($paths[$c]))
                    {
                        $file = $paths[$c];
                        $fileName = "dspace$c".time(). '.' . $file->getClientOriginalExtension();
                        $file->move($dspace_path, $fileName);

                        $link_content->content_path = $fileName;
                    }
                    else
                    {
                        $link_content->content_path = $last_paths[$c];
                    }
                    $link_content->save();
                }
            }
        }

        return redirect("/dspaceLinks")->with("note","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $dspaceLink)
    {
        DspaceLink::where("id",$dspaceLink)->delete();
        return redirect("/dspaceLinks")->with("note","تم الحذف");

    }
}
