<?php

namespace App\Http\Controllers;

use App\Models\programs;
use App\Http\Requests\StoreprogramsRequest;
use App\Http\Requests\UpdateprogramsRequest;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreprogramsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(programs $programs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(programs $programs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprogramsRequest $request, programs $programs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(programs $programs)
    {
        //
    }
}
