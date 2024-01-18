<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class TimelineController extends Controller
{
    public function index()
    {
        $projects = Project::select('id', 'name', 'start_date', 'end_date', 'project_status')->get();
        $projects = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'name' => $project->name,
                'start_date' => $project->start_date,
                'end_date' => $project->end_date,
                'project_status' => $project->project_status,
            ];
        });

        return view('timeline', compact('projects'));
    }
}
