<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\Test;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{

    protected $organization;
    protected $categories;
    protected $tests;

    public function __construct()
    {
        $this->organization = Organization::first();
        $this->categories = Category::get();
        $this->tests = Test::get();
    }

    public function testReport(Patient $patient)
    {
        $organization = $this->organization;
        $categories = $this->categories;
        $tests = $this->tests;
        $testreports = $patient->testreport()->get();

        return view('pdf.test-report-pdf', compact('testreports', 'organization', 'patient', 'categories', 'tests'));

        //pdf view
        $pdf = PDF::loadView('pdf.test-report-pdf', compact('testreports', 'organization', 'patient', 'categories', 'tests'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->setPaper('A4', 'portrait')->stream("report-".$patient->name."-". now() . ".pdf");
    }
    public function billView(Patient $patient)
    {
        
        $organization = $this->organization;
        $categories = $this->categories;
        $tests = $this->tests;
        $testreports = $patient->testreport()->get();
        return view('pdf.bill-pdf',compact('testreports', 'organization', 'patient', 'categories', 'tests'));

        $pdf = PDF::loadView('pdf.bill-pdf', compact('testreports', 'organization', 'patient', 'categories', 'tests'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->setPaper('A4', 'portrait')->stream("bill-".$patient->name ."-". now() . ".pdf");
    }
}
