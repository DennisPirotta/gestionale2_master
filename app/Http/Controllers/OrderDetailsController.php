<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderDetailsController extends Controller
{
    public function store(Request $request): Response
    {
        $validated = $request->validate([
            'signed' => ['nullable','boolean'],
            'order_id' => ['required','numeric'],
            'hour_id' => ['required','numeric'],
            'job_type_id' => ['nullable','numeric'],
        ]);
        OrderDetails::create($validated);
        return response(__('Order Details Created Successfully'));
    }

    public function update(Request $request, OrderDetails $order_detail): RedirectResponse
    {
        $request->validate([ 'job_type_id' => ['required','numeric'] ]);
        $order_detail->update([ 'job_type_id' => $request->get('job_type_id') ]);
        return back();
    }
}
