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
            'labors' => Labor::orderBy('id','desc')->get(),

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
    public function create()
    {
        return inertia('Labor/create', [
            'labors' => Labor::with('sow', 'boar','breeding') // Load related data
                ->orderBy('id', 'asc')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $breed_id = $request->input('breed_id');
        $breed = Breeding::findOrFail($breed_id);
        $fields = $request->validate([
            'breed_id'  =>'required',
            'parity_no' => 'required|numeric',
            'actual_date_farrowing' => 'required|date',
            'no_pigs_born' =>'required|numeric',
            'no_pigs_alive' =>'required|numeric',
            'date_of_weaning' => 'required|date|after:actual_date_farrowing',
        ]);

        // $actual_date_farrowing = Carbon::parse($fields['actual_date_farrowing']);
        // $fields['date_of_weaning'] = $actual_date_farrowing->addDays(30)->toDateString();
        $fields['breed_id']= $breed->id;
        Labor::create($fields);

        return redirect('/labors')->with('success', 'Labor Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Labor $labor)
    {
        //
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
