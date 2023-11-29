<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Program;
use App\Models\Department;
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
        $departments = Department::all();
        return view('projects.create', compact('users', 'programs', 'departments'));
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
            'department' => 'string|nullable',
            'man_hours' => 'array|nullable',
            'departments' => 'array|nullable',
            'budget' => 'numeric|nullable',
            'spent_costs' => 'numeric|nullable',
            'start_date' => 'date|nullable',
            'end_date' => 'date|nullable',
            'projectleader' => 'required|string',
            'second_projectleader' => 'string|nullable',
            'initiator' => 'string|nullable',
            'actor' => 'string|nullable',
            'reasoning' => 'required|string',
            'uploaded_document_start' => 'file|mimes:pdf,doc,docx|nullable',
            'uploaded_document_planning' => 'file|mimes:pdf,doc,docx|nullable',
            'program' => 'required|string',
            'community_link' => 'url|nullable',
            'project_status' => 'filled|string|nullable',
            'progress' => 'filled|numeric|nullable',
            'check_discussion_RvB' => 'boolean',
        ]);

        $departments = $request->input('departments');
        $leftDepartment = "";
        $manHours = $request->input('man_hours');

        // Combine departments and man_hours into a string format
        $combinedData = [];
        foreach ($departments as $key => $department) {
            if ($department != "") {
                $combinedData[] = $department . ':' . $manHours[$key];
                $leftDepartment = $department;
            }
        }

        // Convert the array to a string separated by ';'
        $formattedString = implode(';', $combinedData);

        $validatedData['man_hours'] = $formattedString;
        $validatedData['department'] = $leftDepartment;
        unset($validatedData['departments']);

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
            ->with('newProject', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $program = Program::where('name', $project->program)->first();
        
        return view('projects.show', compact('project', 'program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {    
        $users = Users::all();
        $programs = Program::all();
        $projects = Project::all();
        $departments = Department::all();
        return view('projects.edit', compact('project', 'users', 'programs', 'projects', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects,name,' . $project->id . '|max:50',
            'code' => 'required|unique:projects,code,' . $project->id . '|max:50',
            'description' => 'required|max:255',
            'department' => 'string|nullable',
            'man_hours' => 'array|nullable',
            'departments' => 'array|nullable',
            'budget' => 'nullable|numeric',
            'spent_costs' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'projectleader' => 'required|string',
            'second_projectleader' => 'nullable|string',
            'initiator' => 'nullable|string',
            'actor' => 'nullable|string',
            'reasoning' => 'required|string',
            'uploaded_document_start' => 'nullable|file|mimes:pdf,doc,docx',
            'uploaded_document_planning' => 'nullable|file|mimes:pdf,doc,docx',
            'program' => 'required|string',
            'community_link' => 'nullable|url',
            'project_status' => 'nullable|string',
            'progress' => 'nullable|numeric',
            'check_discussion_RvB' => 'boolean',
        ]);

        $departments = $request->input('departments');
        $leftDepartment = "";
        $manHours = $request->input('man_hours');

        // Combine departments and man_hours into a string format
        $combinedData = [];
        foreach ($departments as $key => $department) {
            if ($department != "") {
                $combinedData[] = $department . ':' . $manHours[$key];
                $leftDepartment = $department;
            }
        }

        // Convert the array to a string separated by ';'
        $formattedString = implode(';', $combinedData);

        $validatedData['man_hours'] = $formattedString;
        $validatedData['department'] = $leftDepartment;
        unset($validatedData['departments']);

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
            ->with('updatedProject', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('deletedProject', $project);
    }
}
