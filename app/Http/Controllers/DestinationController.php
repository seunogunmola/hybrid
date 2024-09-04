<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $resource;

    public function __construct()
    {
        $this->resource = "Destinations";
    }
    public function index()
    {
        $pageTitle = "All Destinations";
        $destinations = Destination::all();
        return view('admin.destinations.index',compact('destinations','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = $this->resource;
        $pageTitle = "Create Destination";
        return view('admin.destinations.create',compact('pageTitle','resource'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'destination_name'=>'string|required|unique:destinations',
            'status'=>'numeric|required'
        ];

        $request->validate($rules);

        $destination_data = [
            'destination_name'=>$request->destination_name,
            'status'=>$request->status,
            'uniqueid'=>str()->random('7'),
            'created_by'=>auth()->user()->id
        ];

        if (Destination::create($destination_data)){
            return redirect(route('admin.destinations.list'))->with(['message'=>'Destination Created Successfully','type'=>'success']);
        }
        else{
            return back()->with(['message'=>'An error occured, Please try again','type'=>'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit($uniqueid)
    {
        $destination = Destination::where('uniqueid',$uniqueid)->first();
        $resource = $this->resource;
        $pageTitle = "Edit Destination";
        return view('admin.destinations.edit',compact('pageTitle','resource','destination'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        $rules = [
            'destination_name'=>'string|required',
            'status'=>'numeric|required'
        ];

        $request->validate($rules);

        $destination_data = [
            'destination_name'=>$request->destination_name,
            'status'=>$request->status,
        ];

        if ($destination->update($destination_data)){
            return redirect(route('admin.destinations.list'))->with(['message'=>'Destination Updated Successfully','type'=>'success']);
        }
        else{
            return back()->with(['message'=>'An error occured, Please try again','type'=>'error']);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        //
    }
}
