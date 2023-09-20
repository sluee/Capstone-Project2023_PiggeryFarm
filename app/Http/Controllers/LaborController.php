<?php

namespace App\Http\Controllers;

use App\Models\Breeding;
use App\Models\Labor;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Labor/index',[
            'labors' => Labor::with('sow', 'boar','breeding')
            ->orderBy('id', 'asc')
            ->get(),

        ]);
    }

    public function search($searchKey){
        return inertia('Labor/index', [
            'labors' => Labor::where('exp_date_farrowing', 'like' , "%$searchKey%")->orWhere('breed_id', 'like' , "%$searchKey%")->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($breed_id)
{
    return inertia('Labor/create', [
        'breed_id' => $breed_id,
        'labors' => Labor::with('sow', 'boar', 'breeding')
            ->orderBy('id', 'asc')
            ->get(),
    ]);
}

    /**
     * Store a newly created resource in storage.`
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'breed_id'  =>'required',
            'parity_no' => 'required|numeric',
            'actual_date_farrowing' => 'required|date',
            'no_pigs_born' =>'required|numeric',
            'no_pigs_alive' =>'required|numeric',
            'date_of_weaning' => 'required|date|after:actual_date_farrowing',
        ]);

        Labor::create($fields);
        return redirect('/labors')->with('success', 'Labor Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Labor $labor)
    {
        $labor->load('sow','boar','breeding');
        return inertia('Labor/show', [
            'labor' => $labor ,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Labor $labor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Labor $labor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Labor $labor)
    {
        //
    }
}
