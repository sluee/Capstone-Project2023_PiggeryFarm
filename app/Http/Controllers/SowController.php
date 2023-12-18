<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Breeding;
use App\Models\Labor;
use App\Models\Sow;
use App\Models\Weaning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $sow = Sow::create($fields);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created a with the id# " . $sow->id;
        event(new UserLog($log_entry));

        // return redirect('/sows')->with('success','Sow Added Successfully');
        return redirect()->route('sow.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sow $sow)
    {
        $breedings = Breeding::with('boar')
        ->whereHas('sow', function ($query) use ($sow) {
            $query->where('sow_id', $sow->id);
        })->paginate(6);

        $labors = Labor::whereHas('breeding', function ($query) use ($sow) {
            $query->where('sow_id', $sow->id);
        })->paginate(6);

        $weanings = Weaning::with('labors')
        ->whereHas('labors.breeding', function ($query) use ($sow) {
            $query->where('sow_id', $sow->id);
        })
        ->paginate(6);

        return inertia('Sow/show', [
            'sows' => $sow,
            'breedings' => $breedings,
            'labors' => $labors,
            'weanings' => $weanings
            // 'weanings' => $weanings
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

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a sow  with the id# " . $sow->id;
        event(new UserLog($log_entry));
        return redirect('/sows')->with('success','Sow Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sow $sow)
    {
        $sow->delete();
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " deleted a sow  with the id# " . $sow->id;
        event(new UserLog($log_entry));
        return redirect('/sows')->with('success', 'Sows has been deleted successfully!');
    }

    public function deactivateSow(Sow $sow){
        $sow->update(['status' => 0]);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a sow status to deactivated  with the id# " . $sow->id;
        event(new UserLog($log_entry));

        return redirect('/sows/' . $sow->id);
    }

    public function activateSow(Sow $sow){
        $sow->update(['status' => 1]);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a sow status to activated  with the id# " . $sow->id;
        event(new UserLog($log_entry));

        return redirect('/sows/' . $sow->id);

    }

}
