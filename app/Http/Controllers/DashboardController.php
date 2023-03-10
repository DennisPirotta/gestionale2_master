<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Holiday;
use App\Models\Hour;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders_statuses = [];
        foreach (Order::all()->groupBy('status_id') as $status => $records){
            $orders_statuses[Status::find($status)->description] =  round($records->count() * 100 / Order::all()->count(),1);
        }
        $hours = [];
        $holidays = [];
        foreach (User::all() as $user){
            $hours_count = 0;
            $user->hours->whereBetween('date',[Carbon::now()->subWeek(),Carbon::now()])->each(function ($hour) use (&$hours_count) {
                $hours_count += $hour->count;
            });
            $hours[$user->name.' '.$user->surname] = $hours_count;

            if ($user->holidayList->where('approved',false)->count() > 0){
                $holidays[$user->id] = $user->holidayList->where('approved',false);
            }
        }

        return view('dashboard',[
            'exchanges' => Exchange::whereBetween('datetime',[Carbon::now()->subWeek(), Carbon::now()])->orderBy('datetime')->get(),
            'orders_statuses' => $orders_statuses,
            'employees_hours' => collect($hours),
            'holidays' => $holidays
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
