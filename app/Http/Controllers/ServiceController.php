<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data["services"] = Service::select("services.*");

        if($request->input('service'))
        {
          $service = $request->input('service');

          Session(['service' => $service]);

          $data["services"] = $data["services"]->where(function($v) use ($service)
          {
              $v->where("service_ar",'LIKE', '%'. $service .'%')
              ->orWhere("service_en",'LIKE', '%'. $service .'%')
              ->orWhere("description_ar",'LIKE', '%'. $service .'%')
              ->orWhere("description_en",'LIKE', '%'. $service .'%');
          });
        }
        else
        {
          $serviceSession = session('service');
          if( $serviceSession != "")
          {
            $data["services"] = $data["services"]->where(function($v) use ($serviceSession)
            {
                $v->where("service_ar",'LIKE', '%'. $serviceSession .'%')
              ->orWhere("service_en",'LIKE', '%'. $serviceSession .'%')
              ->orWhere("description_ar",'LIKE', '%'. $serviceSession .'%')
              ->orWhere("description_en",'LIKE', '%'. $serviceSession .'%');
            });
          }
        }


        if($request->input('status') != 0)
        {
          $status = $request->input('status') - 1;

          Session(['sstatus' => $status]);

          $data["services"] = $data["services"]->where("services.status", $status);
        }
        else
        {
          $status_Session = session('sstatus');
          if( $status_Session != "")
          {
            $data["services"] = $data["services"]->where("services.status", $status_Session);
          }
        }

        $data["services"] = $data["services"]->orderBy('service_ar')->paginate(15);


        return view("manage.services",$data);
    }

    public function showAll()
    {
      Session(['service' => ""]);
      Session(['category' => ""]);
      Session(['sstatus' => ""]);

      return redirect("/services");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("manage.createService");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();

        $service->service_ar = $request->service_ar;
        $service->service_en = $request->service_en;
        $service->price = $request->price;
        $service->description_ar = $request->description_ar;
        $service->description_en = $request->description_en;

        $path = public_path('servicesImages');

        if($request->file("image"))
        {
            $file = $request->file("image");
            $fileName = "service".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $service->image = $fileName;
        }

        $service->save();

        return redirect("/services")->with("note","تمت الاضافة");

    }

    /**
     * Display the specified resource.
     */
    public function show( $service)
    {
        $data["service"] = Service::find($service);

        return view("manage.service",$data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $service)
    {
        $data["service"] = Service::find($service);

        return view("manage.editService",$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request,$service_id)
    {
        $service = Service::find($service_id);

        $service->service_ar = $request->service_ar;
        $service->service_en = $request->service_en;
        $service->price = $request->price;
        $service->description_ar = $request->description_ar;
        $service->description_en = $request->description_en;
        $service->stactus = $request->status;

        $path = public_path('servicesImages');

        if($request->file("image"))
        {
            $file = $request->file("image");
            $fileName = "service".time(). '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $service->image = $fileName;
        }

        $service->update();

        return redirect("/services")->with("note","تم التعديل");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $service)
    {
        Service::where("id",$service)->delete();
        return redirect("/services")->with("note","تم الحذف");
    }
}
