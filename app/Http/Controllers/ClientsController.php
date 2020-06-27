<?php

namespace App\Http\Controllers;
use DB;
use App\clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
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
        $client = new clients;

        $client->title = $request->title;
        $client->description = $request->description;
        $client->status= $request->status;
        $client->Contact_Phone = $request->number;
        $client->Contract_Start_Date = $request->startdate;
        $client->Contract_End_Date = $request->enddate;

        $client->save();
      
        $clients = DB::table('clients')->get();
        return redirect("/clients");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        $clients = DB::table('clients')->get();
        return view("/clients",compact('clients'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function fetchClient($id)
    {
        //$client =DB::select('select * from clients where id = ?', array($id));
        $client = clients::where('id','=',$id)->first();
        return response()->json(['client' => $client]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(clients $clients)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $client = clients::where('id','=',$request->id)->first();
        $client["Title"]=$request->title;
        $client["Description"]=$request->description;
        $client["status"]=$request->status;
        $client["Contact_Phone"]=$request->number;
        $client["Contract_Start_Date"]=$request->startdate;
        $client["Contract_End_Date"]=$request->enddate;
        $client->save();
        /*$array= array(    
            "Title" -> {$request->data['title']},
            "Description" -> {$request->description},
            "status" -> {$request->status},
            "Contact_Phone" -> {$request->number},
            "Contract_Start_Date" -> {$request->startdate},
            "Contract_End_Date" -> {$request->enddate},
        );
        clients::where('id','=',$request->id).update( $array);*/
        return redirect("/clients");
    }

    public function delete(Request $request)
    {
        clients::findOrFail($request->id)->delete();
        return redirect("/clients");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(clients $clients)
    {
        //
    }
}
