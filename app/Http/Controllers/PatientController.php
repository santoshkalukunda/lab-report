<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorepatientRequest;
use App\Http\Requests\UpdatepatientRequest;
use App\Models\Category;
use App\Models\Test;
use App\Models\Testreport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::latest()->simplePaginate(10);
        $users= User::get(['id','name']);
        return view('patient.index', compact('patients','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepatientRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $patient = $user->patient()->create($request->validated());
        return redirect()->route('patients.show', $patient)->with('success', 'Patient Registed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(patient $patient, Testreport $testreport = null)
    {
        if (!$testreport) {
            $testreport = new Testreport();
        }
        $testreports = $patient->testreport()->get();
        $tests = Test::get();
        $categories = Category::get();
        return view('patient.show', compact('patient', 'tests','testreports','categories','testreport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(patient $patient)
    {
        return view('patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepatientRequest  $request
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepatientRequest $request, patient $patient)
    {
        $patient->update($request->validated());
        return redirect()->back()->with('success', "Patient infomation update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(patient $patient)
    {
        $patient->delete();
        return redirect()->back()->with('success', 'Patient deleted');
    }
}
