<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //database
        $projects = project::all();
        return view('projects/index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Users::all();
    
        return view('projects.create', [
            'projects' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprojectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        return view('projects/show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprojectRequest $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        //
    }
}
