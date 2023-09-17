<?php

namespace App\Http\Controllers;

use App\Models\Weaning;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WeaningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia('Weaning/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Weaning $weaning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Weaning $weaning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Weaning $weaning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Weaning $weaning)
    {
        //
    }
}
