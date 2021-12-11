<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function testReport(Patient $patient)
    {
        $organization = Organization::first();
        $testreports = $patient->testreport()->get();
        $pdf = PDF::loadView('pdf.test-report-pdf', compact('testreports', 'organization', 'patient'));
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );    
        return $pdf->setPaper('A4', 'portrait')->stream("report-" . now() . ".pdf");
    }
}
