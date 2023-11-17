<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Program;
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
        $projects = Project::all();
        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Users::all();
        $programs = Program::all();
        return view('projects.create', compact('users', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'code' => 'required|unique:projects|max:50',
            'description' => 'required|max:255',
            'man_hours' => 'numeric|nullable',
            'budget' => 'numeric|nullable',
            'expected_costs' => 'numeric|nullable',
            'start_date' => 'date|nullable',
            'end_date' => 'date|nullable',
            'projectleader' => 'required|string',
            'alt_projectleader' => 'string|nullable',
            'initiator' => 'string|nullable',
            'actor' => 'string|nullable',
            'portfolio_holder' => 'string|nullable',
            'reasoning' => 'required|string',
            'uploaded_document_start' => 'file|mimes:pdf,doc,docx|nullable',
            'uploaded_document_planning' => 'file|mimes:pdf,doc,docx|nullable',
            'program' => 'required|string',
            'community_link' => 'url|nullable',
            'project_status' => 'filled|string|nullable',
            'progress' => 'filled|numeric|nullable',
            'check_discussion_RvB' => 'boolean',
        ]);

        if (empty($validatedData['project_status'])) {
            $validatedData['project_status'] = 'Op schema';
        }
        if (empty($validatedData['progress'])) {
            $validatedData['progress'] = '0';
        }

        $project = new Project($validatedData);
        
        // upload documents as blobs
        if ($request->hasFile('uploaded_document_start')) {
            $pdfDataStart = $request->file('uploaded_document_start')->get();
            $project->uploaded_document_start = $pdfDataStart;
        }
        
        if($request->hasFile('uploaded_document_planning')) {
            $pdfDataPlanning = $request->file('uploaded_document_planning')->get();
            $project->uploaded_document_planning = $pdfDataPlanning;
        }
    
        $project->save();
    
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $users = Users::all();
        return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:50',
            'code' => 'required|unique:projects|max:50',
            'description' => 'required|max:255',
            'man_hours' => 'required|numeric',
            'budget' => 'required|numeric',
            'expected_costs' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'alt_projectleader' => 'required|string',
            'initiator' => 'required|string',
            'actor' => 'required|string',
            'portfolio_holder' => 'required|string',
            'reasoning' => 'required|string',
            'uploaded_document_start' => 'required|file|mimes:pdf,doc,docx',
            'uploaded_document_planning' => 'required|file|mimes:pdf,doc,docx',
            'program' => 'required|string',
            'community_link' => 'required|url',
            'project_status' => 'required|string',
            'progress' => 'required|numeric',
            'check_discussion_RvB' => 'required|boolean',
        ]);

    // Check if 'uploaded_document_start' file was uploaded
    if ($request->hasFile('uploaded_document_start')) {
        $pdfDataStart = $request->file('uploaded_document_start')->get();
        $project->uploaded_document_start = $pdfDataStart;
    }

    // Check if 'uploaded_document_planning' file was uploaded
    if ($request->hasFile('uploaded_document_planning')) {
        $pdfDataPlanning = $request->file('uploaded_document_planning')->get();
        $project->uploaded_document_planning = $pdfDataPlanning;
    }

    $project->update($validatedData);

        return redirect()->route('projects.show', ['project' => $project->id])
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
