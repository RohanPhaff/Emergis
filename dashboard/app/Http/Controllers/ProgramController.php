<?php

namespace App\Http\Controllers;

use App\Models\program;
use App\Models\Users;
use App\Http\Requests\StoreprogramsRequest;
use App\Http\Requests\UpdateprogramsRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return view('programs.index', [
            'programs' => $programs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Users::all();
        return view('programs.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprogramsRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'portfolio_holder' => 'required|string',
        ]);

        $program = new Program($validatedData);
    
        $program->save();
    
        return redirect()->route('programs.index')
            ->with('success', 'Program created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(program $program)
    {
        return view('programs.show', [
            'program' => $program
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(program $program)
    {
        $users = Users::all();
        return view('programs.edit', compact('program', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprogramsRequest $request, program $program)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'portfolio_holder' => 'required|string',
        ]);

        $program->update($validatedData);

        return redirect()->route('programs.show', ['program' => $program->id])
            ->with('success', 'Program updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully');
    }
}
