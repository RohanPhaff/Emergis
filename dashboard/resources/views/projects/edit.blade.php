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
    <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $project->code) }}" required>
    </div>

    <div class="item">
    <span class="label">Beschrijving:</span>
    <textarea class="form-control auto-resize" id="description" name="description" style="height: 200px; width: 100%;" required>{{ old('description', $project->description) }}</textarea>
    </div>

    <div class="item">
        <span class="label">Mens uren:</span>
        <input type="number" class="form-control" id="man_hours" name="man_hours" value="{{ old('man_hours',
        $project->man_hours) }}" required>
    </div>

    <div class="item">
    <span class="label">Budget:</span>
    <input type="number" class="form-control" id="budget" name="budget" value="{{ old('budget', $project->budget) }}" required>
    </div>

    <div class="item">
    <span class="label">Gemaakte kosten:</span>
    <input type="number" class="form-control" id="expected_costs" name="expected_costs"
        value="{{ old('expected_costs', $project->expected_costs) }}" required>
    </div>

    <div class="item">
        <span class="label">Verwachtte duur:</span>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date',
        $project->start_date) }}" required>
        tot
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date',
        $project->end_date) }}" required>
        </div>

        <div class="item">
            <span class="label">2e projectleider:</span>
            <select class="form-control" id="alt_projectleader" name="alt_projectleader" value="{{ old('alt_projectleader') }}" required>
                <option value="">Kies een Alternatieve Projectleider</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('alt_projectleader', $project->alt_projectleader) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Initiator:</span>
            <select class="form-control" id="initiator" name="initiator" value="{{ old('initiator') }}" required>
                <option value="">Kies een Initiator</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('initiator', $project->initiator) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Actor:</span>
            <select class="form-control" id="actor" name="actor" value="{{ old('actor') }}" required>
                <option value="">Kies een Actor</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('actor', $project->actor) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Portfolio houder:</span>
            <select class="form-control" id="portfolio_holder" name="portfolio_holder" value="{{ old('portfolio_holder') }}" required>
            <option value="">Kies een Portfolio houder</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('portfolio_holder', $project->portfolio_holder) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Beredenering project:</span>
            <textarea class="form-control auto-resize" id="reasoning" name="reasoning" style="height: 200px; width: 100%;" required>{{ old('reasoning', $project->reasoning) }}</textarea>
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