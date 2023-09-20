<?php

namespace App\Http\Controllers;

use App\Models\Weaning;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WeaningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Weaning/index',[
            'weaning' => Weaning::with('breeding','labors', 'sow', 'boar')
            ->orderBy('id', 'asc')
            ->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($labor_id)
    {
        return inertia('Weaning/create', [
            'labor_id' => $labor_id,
            'weaning' => Weaning::with('labors', 'breeding')
                ->orderBy('id', 'asc')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'labor_id'  =>'required',
            'no_of_pigs_weaned' =>'required|numeric',
            'remarks'   =>'required'
        ]);

        Weaning::create($fields);
        return redirect('/weaning')->with('success', 'Labor Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Weaning $weaning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Weaning $weaning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Weaning $weaning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weaning $weaning)
    {
        //
    }
}
