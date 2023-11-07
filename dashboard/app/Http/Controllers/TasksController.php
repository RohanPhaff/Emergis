<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use App\Http\Requests\StoretasksRequest;
use App\Http\Requests\UpdatetasksRequest;

class TasksController extends Controller
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
    public function store(StoretasksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetasksRequest $request, tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tasks $tasks)
    {
        //
    }
}
