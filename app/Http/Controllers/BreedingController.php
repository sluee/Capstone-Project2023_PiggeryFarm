<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
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
        $breedings = Breeding::with('sow', 'boar')
        ->when(HttpRequest::input('search'), function ($query, $search) {
            $query->where('date_of_breed', 'like', '%' . $search . '%')
                ->orWhere('exp_date_of_farrowing', 'like', '%' . $search . '%')
                ->orWhere('remarks', 'like', '%' . $search . '%')
                ->orWhereHas('sow', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('sow_no', 'like', '%' . $search . '%');
                })
                ->orWhereHas('boar', function ($supplierQuery) use ($search) {
                    $supplierQuery->where('breed', 'like', '%' . $search . '%');
                });
        })
        ->paginate(8)
        ->withQueryString();

        return inertia('Breeding/index', [
            'breedings' => $breedings,
            'filters' => HttpRequest::only(['search']),
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

    public function reheatRemarks(Breeding $breeding) {
        $breeding->update(['remarks' => 'Reheat']);
        $breeding->save();

        return redirect('/breedings');
    }

    public function abortRemarks(Breeding $breeding) {
        $breeding->update(['remarks' => 'Abort']);
        $breeding->save();

        return redirect('/breedings');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Breeding $breeding)
    {
        // Load the specific $breeding record with its related sow and boar
        $breeding->load('sow', 'boar');
        $sows = Sow::orderBy('sow_no', 'asc')->get();
        $boars = Boar::orderBy('breed', 'asc')->get();
        return inertia('Breeding/edit', [
            'breeding' => $breeding, // Pass the specific $breeding record to the view
            'sows' => $sows,
            'boars' => $boars
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Breeding $breeding)
    {
        $fields = $request->validate([
            'sow_id'                => 'required|numeric',
            'boar_id'               => 'required|numeric',
            'date_of_breed'         => 'required|date',
            'possible_reheat'       => 'required|date|after:date_of_breed',
            'changeFeeds'           =>'required|date|after:date_of_breed',
            'exp_date_of_farrowing' => 'required|date|after:possible_reheat'
        ]);

        $breeding->update($fields);

        return redirect('/breedings')->with('success', 'Breeding Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Breeding $breeding)
    {
        //
    }
}
