<?php

namespace App\Http\Controllers;

use App\Models\Sow;
use Illuminate\Http\Request;

class SowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Sow/index',[
            'sows' => Sow::orderBy('sow_no')->get(),

        ]);
    }

    public function search($searchKey){
        return inertia('Sow/index', [
            'sows' => Sow::where('sow_no', 'like' , "%$searchKey%")->orWhere('location', 'like' , "%$searchKey%")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Sow/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'sow_no' => 'required',
            'location' => 'required',
            'date_arrived' => 'required|date',
        ]);

        $fileName = null;

        //process image
        // if($request->pic){
        //     $fileName = time().'.'.$request->pic->extension();
        //     $request->pic->move(public_path('images/supplier_pics'), $fileName);
        //     $fields['pic'] = $fileName;
        // }

        Sow::create($fields);

        return redirect('/sows')->with('message','Sow Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sow $sow)
    {
        return inertia('Sow/show', compact('sows'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sow $sow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sow $sow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sow $sow)
    {
        //
    }
}
