<?php

namespace App\Http\Controllers;

use App\Models\Boar;
use Illuminate\Http\Request;

class BoarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Boar/index',[
            'boars' => Boar::orderBy('boar_no')->get(),

        ]);
    }

    public function search($searchKey){
        return inertia('Boar/index', [
            'boars' => Boar::where('boar_no', 'like' , "%$searchKey%")->orWhere('breed', 'like' , "%$searchKey%")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Boar/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'boar_no' => 'required',
            'breed' => 'required',
            'location' => 'required',
            'date_arrived' => 'required|date',
        ]);



        Boar::create($fields);

        return redirect('/boars')->with('message','Sow Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Boar $boar)
    {
        return inertia('Sow/show', compact('sows'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boar $boar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boar $boar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boar $boar)
    {
        //
    }
}
