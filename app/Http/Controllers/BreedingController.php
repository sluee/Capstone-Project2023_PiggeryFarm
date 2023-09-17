<?php

namespace App\Http\Controllers;

use App\Models\Boar;
use App\Models\Breeding;
use App\Models\Sow;
use Illuminate\Http\Request;

class BreedingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Breeding/index', [
            'breedings' => Breeding::with('sow', 'boar') // Load related data
                ->orderBy('id', 'asc')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sows = Sow::orderBy('sow_no', 'asc')->get();
        $boars = Boar::orderBy('breed', 'asc')->get();
        return inertia('Breeding/create',[
            'breedings' =>Breeding::orderBy('date_of_breed','asc'),
            'sows'      =>$sows,
            'boars'     => $boars
        ]);
    }

    public function search($searchKey){
        return inertia('Labor/index', [
            'labors' => Breeding::where('date_of_breed', 'like' , "%$searchKey%")->orWhere('possible_reheat', 'like' , "%$searchKey%")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'sow_id'                => 'required|numeric',
            'boar_id'               => 'required|numeric',
            'date_of_breed'         => 'required|date',
            'possible_reheat'       => 'required|date|after:date_of_breed',
            'changeFeeds'           =>'required|date|after:date_of_breed',
            'exp_date_of_farrowing' => 'required|date|after:possible_reheat'
        ]);

        Breeding::create($fields);

        return redirect('/breedings')->with('success', 'Breeding Added Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Breeding $breeding)
    {
        $breeding->load('sow','boar');
        return inertia('Breeding/show', [
            'breeding' => $breeding ,
        ]);
    }

    public function reheatRemarks($id) {
        // Find the record in the database by its ID
        $breeding = Breeding::findOrFail($id);

    // Update the "remarks" field to "Reheat"
    $breeding->update(['remarks' => 'Reheat']);

    return redirect('breedings');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Breeding $breeding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Breeding $breeding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Breeding $breeding)
    {
        //
    }
}
