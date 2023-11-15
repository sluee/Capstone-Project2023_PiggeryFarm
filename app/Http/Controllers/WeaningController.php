<?php

namespace App\Http\Controllers;

use App\Models\Breeding;
use App\Models\Labor;
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
        return inertia('Weaning/index', [
            'weanings' => Weaning::with(['labors.breeding.sow', 'labors.breeding.boar'])
                ->orderBy('id', 'asc')
                ->get(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create($labor_id , Labor $labor)
    {
        // $breedings = $breeding->where('id', $breed_id)->first();
        $labors = $labor->with('breeding','sow','boar')->where('id', $labor_id)->first();
        return inertia('Weaning/create', [
            'labor_id' => $labor_id,
            'weaning' => Weaning::with('labors')
                ->orderBy('id', 'asc')
                ->get(),
            'labor' => $labors
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

        $labor = Labor::findOrFail($request->input('labor_id'));

        // Update the remarks field to "Laboring"
        $labor->update(['remarks' => 'Weaned']);
        return redirect('/weaning')->with('success', 'Weaning Added Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Weaning $weaning)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Weaning $weaning)
    {
        $weaning->load('labors.breeding.sow', 'labors.breeding.boar');

        return inertia('Weaning/edit', [
            'weaning' => $weaning,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Weaning $weaning)
    {
        $fields = $request->validate([
            'labor_id'  =>'required',
            'no_of_pigs_weaned' =>'required|numeric',
            'remarks'   =>'required'
        ]);

        $weaning->update($fields);


        return redirect('/weaning')->with('success', 'Weaning Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weaning $weaning)
    {
        //
    }
}
