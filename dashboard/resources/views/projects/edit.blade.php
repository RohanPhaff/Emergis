@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="content">
    <h1>Project {{ $project->name }}</h1>


    <form method="POST" action="{{ route('projects.update', ['project' => $project->id]) }}">
        @csrf
        @method('PUT')

    <div class="item">
        <span class="label">Project code:</span>
        <input type="text" class="form-control" id="code" name="code" value="{{ $project->code }}" required>
    </div>

    <div class="item">
        <span class="label">Man hours:</span>
        <input type="text" class="form-control" id="man_hours" name="man_hours" value="{{ $project->man_hours }}" required>
    </div>

    <div class="item">
        <span class="label">Budget:</span>
        <input type="text" class="form-control" id="budget" name="budget" value="{{ $project->budget }}" required>
    </div>

    <div class="item">
        <span class="label">Expected costs:</span>
        <input type="text" class="form-control" id="expected_costs" name="expected_costs" value="{{ $project->expected_costs }}" required>
    </div>

    <div class="item">
        <span class="label">Duration:</span>
        <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
        to
        <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}" required>
    </div>

    <div class="item">
        <span class="label">Alternative project leader:</span>
        <input type="text" class="form-control" id="alt_projectleader" name="alt_projectleader" value="{{ $project->alt_projectleader }}" required>
    </div>

    <div class="item">
        <span class="label">Initiator:</span>
        <input type="text" class="form-control" id="initiator" name="initiator" value="{{ $project->initiator }}" required>
    </div>

    <div class="item">
        <span class="label">Actor:</span>
        <input type="text" class="form-control" id="actor" name="actor" value="{{ $project->actor }}" required>
    </div>

    <div class="item">
        <span class="label">Portfolio holder:</span>
        <input type="text" class="form-control" id="portfolio_holder" name="portfolio_holder" value="{{ $project->portfolio_holder }}" required>
    </div>

    <div class="item">
        <span class="label">Reasoning:</span>
        <input type="text" class="form-control" id="reasoning" name="reasoning" value="{{ $project->reasoning }}" required>
    </div>

    <div class="item">
        <span class="label">Documents:</span>
        <input type="text" class="form-control" id="uploaded_document_start" name="uploaded_document_start" value="{{ $project->uploaded_document_start }}" required>
        <input type="text" class="form-control" id="uploaded_document_planning" name="uploaded_document_planning" value="{{ $project->uploaded_document_planning }}" required>
    </div>

    <div class="item">
        <span class="label">Program:</span>
        <input type="text" class="form-control" id="program" name="program" value="{{ $project->program }}" required>
    </div>

    <div class="item">
        <span class="label">Status:</span>
        <input type="text" class="form-control" id="project_status" name="project_status" value="{{ $project->project_status }}" required>
    </div>

    <div class="item">
        <span class="label">Check discussion RvB:</span>
        <input type="text" class="form-control" id="check_discussion_RvB" name="check_discussion_RvB" value="{{ $project->check_discussion_RvB }}" required>
    </div>

    <div class="item">
        <span class="label">Created at:</span>
        <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $project->created_at }}" required>
    </div>

    <div class="item">
        <span class="label">Updated at:</span>
        <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $project->updated_at }}" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
    </form>

</div>
@endsection
