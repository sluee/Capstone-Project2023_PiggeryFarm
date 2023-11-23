<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
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
        $labors = Labor::with('sow', 'boar','breeding')
        ->when(HttpRequest::input('search'), function ($query, $search) {
            $query->where('parity_no', 'like', '%' . $search . '%')
                ->orWhere('date_of_weaning', 'like', '%' . $search . '%')
                ->orWhere('remarks', 'like', '%' . $search . '%')
                ->orWhere('no_pigs_born', 'like', '%' . $search . '%')
                ->orWhere('actual_date_farrowing', 'like', '%' . $search . '%');
        })
        ->paginate(8)
        ->withQueryString();

        return inertia('Labor/index', [
            'labors' => $labors,
            'filters' => HttpRequest::only(['search']),
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
    public function create($breed_id , Breeding $breeding)
    {
        // $breedings = $breeding->where('id', $breed_id)->first();
        $breedings = $breeding->with('sow','boar')->where('id', $breed_id)->first();
        return inertia('Labor/create', [
            'breed_id' => $breed_id,
            'labors' => Labor::with('sow', 'boar', 'breeding')
                ->orderBy('id', 'asc')
                ->get(),
            'breedings' => $breedings
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
        $breeding = Breeding::findOrFail($request->input('breed_id'));

        // Update the remarks field to "Laboring"
        $breeding->update(['remarks' => 'Laboring']);

        // Breeding::update($breeding);
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
    $labor->load('breeding.sow', 'breeding.boar');

    return inertia('Labor/edit', [
        'labors' => $labor,
    ]);
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Labor $labor)
    {
        $fields = $request->validate([
            'breed_id'  =>'required',
            'parity_no' => 'required|numeric',
            'actual_date_farrowing' => 'required|date',
            'no_pigs_born' =>'required|numeric',
            'no_pigs_alive' => 'required|numeric|lte:no_pigs_born',
            'date_of_weaning' => 'required|date|after:actual_date_farrowing',
        ]);

        $labor->update($fields);

        // Breeding::update($breeding);
        return redirect('/labors')->with('success', 'Labor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Labor $labor)
    {
        //
    }
}
