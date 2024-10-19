<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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
    public function patient(Patient $patient, Report $report = null)
    {
        $testList = [];
        if (!$report) {
            $report = new Report();
        } else {
            $testList = $report->testreport()->get();
        }
        $reports = $patient->report()->latest()->paginate(5);
        return view('report.patient', compact('patient', 'reports', 'report', 'testList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient, Report $report = null)
    {
        if (!$report) {
            $report = new Report();
        }
        return view('report.create', compact('patient', 'report'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportRequest $request, Patient $patient)
    {
        try {
            DB::beginTransaction();
            $report = $patient->report()->create([
                'registed_date' => $request->registed_date,
                'refer_by' => $request->refer_by,
                'remarks' => $request->remarks,
                'user_id' => auth()->user()->id,
            ]);
            // dd($request);
            foreach ($request->test_id as $key => $test_id) {
                $report->testreport()->create([
                    'test_id' => $test_id,
                    'category_id' => $request->category_id[$key],
                    'sub_category_id' => $request->sub_category_id[$key],
                    'result' => $request->result[$key] ?? null,
                    'status' => $request->status[$key] ?? null,
                    'method' => $request->method[$key] ?? null,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back()->with('success', 'Report Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $patient = Patient::find($report->patient_id);
        return $this->create($patient, $report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        try {
            DB::beginTransaction();
             $report->update([
                'registed_date' => $request->registed_date,
                'refer_by' => $request->refer_by,
                'remarks' => $request->remarks,
            ]);
            $report->testreport()->delete();
            foreach ($request->test_id as $key => $test_id) {
                $report->testreport()->create([
                    'test_id' => $test_id,
                    'category_id' => $request->category_id[$key],
                    'sub_category_id' => $request->sub_category_id[$key],
                    'result' => $request->result[$key] ?? null,
                    'status' => $request->status[$key] ?? null,
                    'method' => $request->method[$key] ?? null,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back()->with('success', 'Report updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back()->with('success', 'Report deleted');
    }
}
