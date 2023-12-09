<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::orderBy('id' ,'desc')
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->where('position', 'like', '%' . $search . '%');
            })
            ->paginate(8)
            ->withQueryString();


        return inertia('Position/index',[
            'positions' => $positions,
            'filters' => HttpRequest::only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'position' => [
            'required',
            Rule::unique('positions'),
        ],
        'rate' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/positions')  // Replace with the actual route of your form
            ->with('error', 'Position already exists.');
    }

    // If validation passes, create the position
    Position::create([
        'position' => $request->input('position'),
        'rate' => $request->input('rate'),
    ]);

    return redirect('/positions')->with('success', 'Position Added Successfully');
}




    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $fields=$request->validate([
            'position' => 'required',
            'rate' => 'required',

        ]);

       $position->update($fields);

        return redirect('/positions')->with('success','Position Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return redirect('/positions')->with('success', 'Position has been deleted successfully!');
    }
}
