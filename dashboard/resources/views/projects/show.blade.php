@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="content">
    <h1>Project {{ $project->name }}</h1>

    <div class="item">
        <span class="label">Project code:</span>
        <span class="value">{{ $project->code }}</span>
    </div>

    <div class="item">
        <span class="label">Man hours:</span>
        <span class="value">{{ $project->man_hours }}</span>
    </div>

    <div class="item">
        <span class="label">Budget:</span>
        <span class="value">{{ $project->budget }}</span>
    </div>

    <div class="item">
        <span class="label">Expected costs:</span>
        <span class="value">{{ $project->expected_costs }}</span>
    </div>

    <div class="item">
        <span class="label">Duration:</span>
        <span class="value">{{ $project->start_date }} to {{ $project->end_date }}</span>
    </div>

    <div class="item">
        <span class="label">Alternative project leader:</span>
        <span class="value">{{ $project->alt_projectleader }}</span>
    </div>

    <div class="item">
        <span class="label">Initiator:</span>
        <span class="value">{{ $project->initiator }}</span>
    </div>

    <div class="item">
        <span class="label">Actor:</span>
        <span class="value">{{ $project->actor }}</span>
    </div>

    <div class="item">
        <span class="label">Portfolio holder:</span>
        <span class="value">{{ $project->portfolio_holder }}</span>
    </div>

    <div class="item">
        <span class="label">Reasoning:</span>
        <span class="value">{{ $project->reasoning }}</span>
    </div>

    <div class="item">
        <span class="label">Documents:</span>
        <div class="value">Start: {{ $project->uploaded_document_start }}</div>
        <div class="value">Planning: {{ $project->uploaded_document_planning }}</div>
    </div>

    <div class="item">
        <span class="label">Program:</span>
        <span class="value">{{ $project->program }}</span>
    </div>

    <div class="item">
        <span class="label">Status:</span>
        <span class="value">{{ $project->project_status }}</span>
    </div>

    <div class="item">
        <span class="label">Check discussion RvB:</span>
        <span class="value">{{ $project->check_discussion_RvB }}</span>
    </div>

    <div class="item">
        <span class="label">Created at:</span>
        <span class="value">{{ $project->created_at }}</span>
    </div>

    <div class="item">
        <span class="label">Updated at:</span>
        <span class="value">{{ $project->updated_at }}</span>
    </div>
</div>
@endsection