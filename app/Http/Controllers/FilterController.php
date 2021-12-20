<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Patient;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    
    public function filterPatient(Request $request)
    {
        $patients = new Patient;
        if ($request->has('date_from')) {
            if ($request->date_from != null && $request->date_to != null)
                $patients = $patients->whereBetween('date', [$request->date_from, $request->date_to]);
        }
        if ($request->has('name')) {
            if ($request->name != null)
                $patients = $patients->where('name', 'LIKE', ["$request->name%"]);
        }
        if ($request->has('email')) {
            if ($request->email != null)
                $patients = $patients->where('email', 'LIKE', ["$request->email%"]);
        }
        if ($request->has('phone')) {
            if ($request->phone != null)
                $patients = $patients->where('phone', ["$request->phone"]);
        }
        if ($request->has('address')) {
            if ($request->address != null)
                $patients = $patients->where('address', 'LIKE', ["$request->address%"]);
        }
        if ($request->has('age_from')) {
            if ($request->age_from != null && $request->age_to != null)
                $patients = $patients->whereBetween('age', [$request->age_from, $request->age_to]);
        }
        if ($request->has('in')) {
            if ($request->in != null)
                $patients = $patients->where('in', ["$request->in"]);
        }
        if ($request->has('gender')) {
            if ($request->gender != null)
                $patients = $patients->where('gender', ["$request->gender"]);
        }
        if ($request->has('referred')) {
            if ($request->referred != null)
                $patients = $patients->where('referred', 'LIKE', ["$request->referred%"]);
        }
        if ($request->has('user_id')) {
            if ($request->user_id != null)
                $patients = $patients->where('user_id', ["$request->user_id"]);
        }
        $patients = $patients->get();
        $users= User::get(['id','name']);
      
        return view('patient.search-result',compact('patients','users'));
    }
    public function PDFPatient(Request $request){
        $patients = new Patient;
        if ($request->has('date_from')) {
            if ($request->date_from != null && $request->date_to != null)
                $patients = $patients->whereBetween('date', [$request->date_from, $request->date_to]);
        }
        if ($request->has('name')) {
            if ($request->name != null)
                $patients = $patients->where('name', 'LIKE', ["$request->name%"]);
        }
        if ($request->has('email')) {
            if ($request->email != null)
                $patients = $patients->where('email', 'LIKE', ["$request->email%"]);
        }
        if ($request->has('phone')) {
            if ($request->phone != null)
                $patients = $patients->where('phone', ["$request->phone"]);
        }
        if ($request->has('address')) {
            if ($request->address != null)
                $patients = $patients->where('address', 'LIKE', ["$request->address%"]);
        }
        if ($request->has('age_from')) {
            if ($request->age_from != null && $request->age_to != null)
                $patients = $patients->whereBetween('age', [$request->age_from, $request->age_to]);
        }
        if ($request->has('in')) {
            if ($request->in != null)
                $patients = $patients->where('in', ["$request->in"]);
        }
        if ($request->has('gender')) {
            if ($request->gender != null)
                $patients = $patients->where('gender', ["$request->gender"]);
        }
        if ($request->has('referred')) {
            if ($request->referred != null)
                $patients = $patients->where('referred', 'LIKE', ["$request->referred%"]);
        }
        if ($request->has('user_id')) {
            if ($request->user_id != null)
                $patients = $patients->where('user_id', ["$request->user_id"]);
        }
        $patients = $patients->get();
        $organization = Organization::first();
        $pdf = PDF::loadView('patient.pdf', compact(['patients','organization']));   
        $customPaper = array(0,0,950,950);
        return $pdf->setPaper('A4', 'landscape')->stream("patient-list-" . now() . ".pdf");
    }
}
