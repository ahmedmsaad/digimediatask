<?php

namespace App\Http\Controllers;
use App\clients;
use App\services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function getServicesByUserId($id)
    {
        $clientData=clients::find($id);
        $clientServices=clients::find($id) -> services;
        return view("/userServices",compact('clientData','clientServices'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client=clients::find($request->clientId);

        $service = new services;
        $service->Title = $request->Title;
        $service->Description = $request->Description;
        $service->Type= $request->Type;
        $service->Link= $request->Link;

        $client->services()->save($service);
        return redirect("/userservecies/{$request->clientId}");
    }
    public function delete(Request $request)
    {
        $service=services::findOrFail($request->id)->first();
        services::findOrFail($request->id)->delete();
        return redirect("/userservecies/{$service->clients_id}");
    }

    public function fetchService(Request $request)
    {
        //$client =DB::select('select * from clients where id = ?', array($id));
        $service = services::where('id','=',$request->id)->first();
        return response()->json(['service' => $service]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $service = services::where('id','=',$request->serviceId)->first();
        $service["Title"]=$request->Title;
        $service["Description"]=$request->Description;
        $service["Type"]=$request->Type;
        $service["Link"]=$request->Link;
        $service->save();
        return redirect("/userservecies/{$request->clientId}");    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(services $services)
    {
        //
    }
}
