<?php

namespace App\Http\Controllers;

use App\Models\Sow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as HttpRequest;

class SowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Sow/index',[
            'sows' => Sow::query()
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->where('sow_no', 'like', '%' . $search . '%')
                ->orWhere('location','like','%' .$search . '%');
            })->paginate(8)
            ->withQueryString(),
            'filters' => HttpRequest::only(['search'])
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

        Sow::create($fields);

        return redirect('/sows')->with('message','Sow Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sow $sow)
    {
        $sow->load('breedings.labors', 'breedings.weanings' , 'breedings.boar');
        return inertia('Sow/show',[
            'sows' => $sow
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sow $sow)
    {
        return inertia('Sow/edit',[
            'sows' => $sow
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sow $sow)
    {
        $fields=$request->validate([
            'sow_no' => 'required',
            'location' => 'required',
            'date_arrived' => 'required|date',
        ]);

        $sow->update($fields);

        return redirect('/sows')->with('message','Sow Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sow $sow)
    {
        //
    }
}
