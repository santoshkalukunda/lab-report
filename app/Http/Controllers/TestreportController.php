<?php

namespace App\Http\Controllers;

use App\Models\Testreport;
use App\Http\Requests\StoreTestreportRequest;
use App\Http\Requests\UpdateTestreportRequest;
use App\Models\Patient;
use App\Models\Test;

class TestreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testreports = Testreport::latest()->simplePaginate(15);
        $tests = Test::get();
        $patients = Patient::get();
        return view('testreport.index',compact('testreports','tests','patients'));
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
     * @param  \App\Http\Requests\StoreTestreportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestreportRequest $request, Patient $patient)
    {
        $patient->testreport()->create($request->validated());
        return redirect()->back()->with('success','Test Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testreport  $testreport
     * @return \Illuminate\Http\Response
     */
    public function show(Testreport $testreport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testreport  $testreport
     * @return \Illuminate\Http\Response
     */
    public function edit(Testreport $testreport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestreportRequest  $request
     * @param  \App\Models\Testreport  $testreport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestreportRequest $request, Testreport $testreport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testreport  $testreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testreport $testreport)
    {
        $testreport->delete();
        return redirect()->back()->with('success',"Test Deleted");
    }
}
