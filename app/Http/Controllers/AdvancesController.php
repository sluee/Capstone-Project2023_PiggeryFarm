<?php

namespace App\Http\Controllers;

use App\Models\advances;
use App\Models\Advances as ModelsAdvances;
use App\Models\CashAdvance;
use Illuminate\Http\Request;

class AdvancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashAdvances = CashAdvance::orderBy('id')->get();
        $advance   = advances::orderBy('id')->with('cashAdvances')->get();
        return inertia('Advance/index',[
            'cashAdvances' => $cashAdvances,
            'advance'    =>$advance
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
    public function show(advances $advances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(advances $advances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, advances $advances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(advances $advances)
    {
        //
    }
}
