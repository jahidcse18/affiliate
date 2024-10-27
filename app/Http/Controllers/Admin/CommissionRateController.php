<?php

// app/Http/Controllers/Admin/CommissionRateController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionRate;
use Illuminate\Http\Request;

class CommissionRateController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rate' => 'required|numeric|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        CommissionRate::create($request->all());

        return redirect()->back()->with('success', 'Commission rate added successfully!');
    }
}

