@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="content">
    <h1>Nieuw project</h1>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

    <div class="item">
        <span class="label">Project code:</span>
        <input type="text" class="form-control" id="code" name="code" value="project code" required>
    </div>

    <div class="item">
        <span class="label">Man hours:</span>
        <input type="text" class="form-control" id="man_hours" name="man_hours" value="man hours" required>
    </div>

    <div class="item">
        <span class="label">Budget:</span>
        <input type="text" class="form-control" id="budget" name="budget" value="budget" required>
    </div>

    <div class="item">
        <span class="label">Expected costs:</span>
        <input type="text" class="form-control" id="expected_costs" name="expected_costs" value="expected costs" required>
    </div>

    <div class="item">
        <span class="label">Duration:</span>
        <input type="text" class="form-control" id="start_date" name="start_date" value="start date" required>
        to
        <input type="text" class="form-control" id="end_date" name="end_date" value="end date" required>
    </div>

    <div class="item">
        <span class="label">Alternative project leader:</span>
        <input type="text" class="form-control" id="alt_projectleader" name="alt_projectleader" value="projectleader" required>
    </div>

    <div class="item">
        <span class="label">Initiator:</span>
        <input type="text" class="form-control" id="initiator" name="initiator" value="initiator" required>
    </div>

    <div class="item">
        <span class="label">Actor:</span>
        <input type="text" class="form-control" id="actor" name="actor" value="actor" required>
    </div>

    <div class="item">
        <span class="label">Portfolio holder:</span>
        <input type="text" class="form-control" id="portfolio_holder" name="portfolio_holder" value="portfolio houder" required>
    </div>

    <div class="item">
        <span class="label">Reasoning:</span>
        <input type="text" class="form-control" id="reasoning" name="reasoning" value="reasoning" required>
    </div>

    <div class="item">
        <span class="label">Documents:</span>
        <input type="text" class="form-control" id="uploaded_document_start" name="uploaded_document_start" value="start document" required>
        <input type="text" class="form-control" id="uploaded_document_planning" name="uploaded_document_planning" value="planning" required>
    </div>

    <div class="item">
        <span class="label">Program:</span>
        <input type="text" class="form-control" id="program" name="program" value="program" required>
    </div>

    <div class="item">
        <span class="label">Status:</span>
        <input type="text" class="form-control" id="project_status" name="project_status" value="status" required>
    </div>

    <div class="item">
        <span class="label">Check discussion RvB:</span>
        <input type="text" class="form-control" id="check_discussion_RvB" name="check_discussion_RvB" value="check discussion RvB" required>
    </div>

    <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

</div>
@endsection
