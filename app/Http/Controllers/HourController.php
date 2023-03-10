<?php

namespace App\Http\Controllers;

use App\Models\Hour;
use App\Models\OrderDetails;
use App\Models\TechnicalReportDetails;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = Hour::with('hour_type')->filter(request(['month', 'user']))->get();
        $user = User::find(request('user', auth()->id()));

        $technical_report_hours = TechnicalReportDetails::with(['technical_report','technical_report.customer','hour'])
                                                        ->whereIn('hour_id', $data->where('hour_type_id', 2)->map(function ($item) { return $item->id; }))
                                                        ->get();
        $order_hours = OrderDetails::with(['order','order.customer','hour'])
                                   ->whereIn('hour_id', $data->where('hour_type_id', 1)->map(function ($item) { return $item->id; }))
                                   ->get();

        return response()->view('hours.index', [
            'user' => $user,
            'technical_report_hours' => $technical_report_hours->groupBy('technical_report_id'),
            'order_hours' => $order_hours->groupBy('order_id'),
            'other_hours' => $data->whereNotIn('hour_type_id', [1,2])->groupBy('hour_type_id'),
            'period' => CarbonPeriod::create(Carbon::parse(request('month'))->firstOfMonth(), Carbon::parse(request('month'))->lastOfMonth()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Hour
    {
        $data = $request->validate([
            'hour_type_id' => ['nullable','numeric'],
            'date' => ['required','date_format:Y-m-d'],
            'count' => ['required','numeric'],
            'user_id' => ['required','numeric']
        ]);
        return Hour::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hour $hour)
    {
        $count = $request->validate([ 'count' => ['required','numeric'] ]);
        $hour->update($count);
        return response(__('Hour Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hour $hour)
    {
        $hour->delete();
        return response(__('Hour Deleted Successfully'));
    }
}
