@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="content"> <h1>Project {{ $project->name }}</h1>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('projects.update', ['project' => $project->id]) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="item">
        <span class="label">Project naam:</span>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}"
        required>
    </div>

    <div class="item">
    <span class="label">Project code:</span>
    <input type="number" class="form-control" id="code" name="code" value="{{ old('code', $project->code) }}" required>
    </div>

    <div class="item">
    <span class="label">Beschrijving:</span>
    <input type="text" class="form-control" id="description" name="description"
        value="{{ old('description', $project->description) }}" required>
    </div>

    <div class="item">
        <span class="label">Man uren:</span>
        <input type="number" class="form-control" id="man_hours" name="man_hours" value="{{ old('man_hours',
        $project->man_hours) }}" required>
    </div>

    <div class="item">
    <span class="label">Budget:</span>
    <input type="number" class="form-control" id="budget" name="budget" value="{{ old('budget', $project->budget) }}" required>
    </div>

    <div class="item">
    <span class="label">Verwachte kosten:</span>
    <input type="number" class="form-control" id="expected_costs" name="expected_costs"
        value="{{ old('expected_costs', $project->expected_costs) }}" required>
    </div>

    <div class="item">
        <span class="label">Duur:</span>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date',
        $project->start_date) }}" required>
        tot
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date',
        $project->end_date) }}" required>
        </div>

        <div class="item">
        <span class="label">Alternatieve project leider:</span>
        <input type="text" class="form-control" id="alt_projectleader" name="alt_projectleader"
            value="{{ old('alt_projectleader', $project->alt_projectleader) }}" required>
        </div>

        <div class="item">
            <span class="label">Initiator:</span>
            <input type="text" class="form-control" id="initiator" name="initiator" value="{{ old('initiator',
            $project->initiator) }}" required>
        </div>

        <div class="item">
        <span class="label">Actor:</span>
        <input type="text" class="form-control" id="actor" name="actor" value="{{ old('actor', $project->actor) }}"
        required>
        </div>

        <div class="item">
        <span class="label">Portfolio houder:</span>
        <input type="text" class="form-control" id="portfolio_holder" name="portfolio_holder"
            value="{{ old('portfolio_holder', $project->portfolio_holder) }}" required>
        </div>

        <div class="item">
            <span class="label">Beredenering project:</span>
            <input type="text" class="form-control" id="reasoning" name="reasoning" value="{{ old('reasoning',
            $project->reasoning) }}" required>
        </div>

        <div class="item">
        <span class="label">Documenten:</span>
        <input type="file" class="form-control" id="uploaded_document_start" name="uploaded_document_start">
        <input type="file" class="form-control" id="uploaded_document_planning" name="uploaded_document_planning">
    </div>

    <div class="item">
        <span class="label">Programma:</span>
        <input type="text" class="form-control" id="program" name="program"
            value="{{ old('program', $project->program) }}" required>
    </div>

    <div class="item">
        <span class="label">Community link:</span>
        <input type="url" class="form-control" id="community_link" name="community_link"
            value="{{ old('community_link', $project->community_link) }}" required>
    </div>

    <div class="item">
        <span class="label">Status:</span>
        <input type="text" class="form-control" id="project_status" name="project_status"
            value="{{ old('project_status', $project->project_status) }}" required>
    </div>

    <div class="item">
        <span class="label">Progressie:</span>
        <input type="number" class="form-control" id="progress" name="progress"
            value="{{ old('progress', $project->progress) }}" required>
    </div>

    <div class="item">
        <span class="label">Check discussie RvB:</span>
        <input type="hidden" name="check_discussion_RvB" value="0">
        <input type="checkbox" class="form-control" id="check_discussion_RvB" name="check_discussion_RvB" value="1" {{ old('check_discussion_RvB', $project->check_discussion_RvB) ? 'checked' : '' }}>
    </div>

    <div class="form-actions">
        <button type="submit" class="light-blue-button">Aanpassen</button>
        <a href="{{ route('projects.index') }}" class="light-blue-button">Annuleren</a>
    </div>
    </form>
</div>

@endsection