<?php

namespace App\Http\Controllers;

use App\Models\TechnicalReport;
use App\Models\TechnicalReportDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TechnicalReportDetailsController extends Controller
{
    public function show(TechnicalReport $technicalReport)
    {
        //return dd($technicalReport->technical_report_details);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hour_id' => ['required','numeric'],
            'technical_report_id' => ['required','numeric'],
        ]);
        TechnicalReportDetails::create($validated);
    }

    public function update(Request $request, TechnicalReportDetails $technical_report_detail): RedirectResponse
    {
        $request->validate([
            'night_eu' => ['required','bool'],
            'night_xeu' => ['required','bool']
        ]);

        $technical_report_detail->update([
            'nightEU' => $request->get('night_eu'),
            'nightExtraEU' => $request->get('night_xeu')
        ]);
        return back();
    }
}
