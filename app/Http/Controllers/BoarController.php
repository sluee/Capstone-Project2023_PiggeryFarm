<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Boar;
use App\Models\Breeding;
use App\Models\Labor;
use App\Models\Weaning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Boar/index',[
            'boars' => Boar::query()
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->where('boar_no', 'like', '%' . $search . '%')
                ->orWhere('breed','like','%' .$search . '%');
            })->paginate(8)
            ->withQueryString(),
            'filters' => HttpRequest::only(['search'])
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



       $boars =  Boar::create($fields);
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created  a Boar with the id# " . $boars->id;
        event(new UserLog($log_entry));


        return redirect()->route('boar.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Boar $boar)
    {
        $breedings = Breeding::with('sow')
        ->whereHas('boar', function ($query) use ($boar) {
            $query->where('boar_id', $boar->id);
        })->paginate(6);

        $labors = Labor::whereHas('breeding', function ($query) use ($boar) {
            $query->where('boar_id', $boar->id);
        })->paginate(6);

        $weanings = Weaning::with('labors')
        ->whereHas('labors.breeding', function ($query) use ($boar) {
            $query->where('boar_id', $boar->id);
        })
        ->paginate(6);


        return inertia('Boar/show', [
            'boar' => $boar,
            'breedings' => $breedings,
            'labors' => $labors,
            'weanings' => $weanings

        ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boar $boar)
    {
        return inertia('Boar/edit',[
            'boars' => $boar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boar $boar)
    {
        $fields=$request->validate([
            'boar_no' => 'required',
            'breed' => 'required',
            'location' => 'required',
            'date_arrived' => 'required|date',
        ]);

        $boar->update($fields);
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a Boar with the id# " . $boar->id;
        event(new UserLog($log_entry));

        return redirect('/boars')->with('success','Boar Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boar $boar)
    {
        //
    }

    public function deactivateBoar(Boar $boar){
        $boar->update(['status' => 0]);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a Boar status to deactivated  with the id# " . $boar->id;
        event(new UserLog($log_entry));

        return redirect('/boars/' . $boar->id)->with('success','Boar deactivated successfully');
    }

    public function activateBoar(Boar $boar){
        $boar->update(['status' => 1]);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a Boar status to activated  with the id# " . $boar->id;
        event(new UserLog($log_entry));

        return redirect('/boars/' . $boar->id)->with('success','Boar activated successfully');
    }
}
