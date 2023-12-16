<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Boar;
use App\Models\Breeding;
use App\Models\Sow;
use App\Models\Weaning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
        ->orderBy('id', 'desc')
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
        $sows = Sow::where('status', 1)
        ->orderBy('sow_no', 'asc')
        ->get();

        $boars = Boar::where('status', 1)
        ->orderBy('breed', 'asc')
        ->get();


        return inertia('Breeding/create',[
            'breedings' =>Breeding::orderBy('date_of_breed','asc'),
            'sows'      =>$sows,
            'boars'     => $boars
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

        $breed = Breeding::create($fields);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created a Breeding  with the id# " . $breed->id;
        event(new UserLog($log_entry));

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

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated the remarks of breeding with reheat with the id# " . $breeding->id;
        event(new UserLog($log_entry));

        return redirect('/breedings')->with('error' ,'The sow reheats');
    }

    public function abortRemarks(Breeding $breeding) {
        $breeding->update(['remarks' => 'Abort']);
        $breeding->save();

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated the status of breeding with abort with the id# " . $breeding->id;
        event(new UserLog($log_entry));

        return redirect('/breedings')->with('error', 'The sow underwent a miscarriage.');
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
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a breeding with the id# " . $breeding->id;
        event(new UserLog($log_entry));

        return redirect('/breedings')->with('success', 'Breeding Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Breeding $breeding)
    {
        // Delete the instance
        $breeding->delete();

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " deleted  a breeding with the id# " . $breeding->id;
        event(new UserLog($log_entry));
        // Optionally, you can redirect to a specific route or perform other actions after deletion
        return redirect()->route('breeding.index')->with('success', 'Breeding record deleted successfully');
    }


    public function breedingReports(){
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $weaning = Weaning::with('labors.breeding.boar', 'labors.breeding.sow')
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->paginate(5);

                
        $countAbort = Breeding::where('remarks', 'Abort')
        ->where(DB::raw('MONTH(created_at)'), $currentMonth)
        ->where(DB::raw('YEAR(created_at)'), $currentYear)
        ->count();

        $countReheat = Breeding::where('remarks', 'Reheat')
        ->where(DB::raw('MONTH(created_at)'), $currentMonth)
        ->where(DB::raw('YEAR(created_at)'), $currentYear)
        ->count();
        $totalPigsWeaned = $weaning->sum('no_of_pigs_weaned');
        $currentMonthAndYear = now()->format('F Y');

       return inertia('Breeding/reports', [
            'weaning' => $weaning,
            'totalPigsWeaned' => $totalPigsWeaned,
            'currentMonthAndYear' => $currentMonthAndYear,
            'countAbort' => $countAbort,
            'countReheat' => $countReheat
        ]);
    }



}
