@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="content"> <h1>Nieuw project</h1>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="item">
        <span class="label">Project naam:</span>
        <input type="text" class="form-control" id="name" name="name" placeholder="project naam" value="{{ old('name') }}" required>
        </div>

        <div class="item">
            <span class="label">Project code:</span>
            <input type="number" class="form-control" id="code" name="code" placeholder="12345" value="{{ old('code') }}" required>
        </div>

        <div class="item">
            <span class="label">Beschrijving:</span>
            <input type="text" class="form-control" id="description" name="description" placeholder="beschrijving" value="{{ old('description') }}" required>
        </div>

        <div class="item">
            <span class="label">Man uren:</span>
            <input type="number" class="form-control" id="man_hours" name="man_hours" placeholder="75" value="{{ old('man_hours') }}" required>
        </div>

        <div class="item">
            <span class="label">Budget:</span>
            <input type="number" class="form-control" id="budget" name="budget" placeholder="12500" value="{{ old('budget') }}" required>
        </div>

        <div class="item">
            <span class="label">Verwachte kosten:</span>
            <input type="number" class="form-control" id="expected_costs" name="expected_costs" placeholder="10000" value="{{ old('expected_costs') }}" required>
        </div>

        <div class="item">
            <span class="label">Duur:</span>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
            tot
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
        </div>

        <div class="item">
            <span class="label">Alternatieve projectleider:</span>
            <select>
                <option value="">Kies een Alternatieve Projectleider</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select type="text" class="form-control" id="alt_projectleader" name="alt_projectleader" value="{{ old('alt_projectleader') }}" required>
        </div>

        <div class="item">
            <span class="label">Initiator:</span>
            <select>
                <option value="">Kies een Initiator</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select type="text" class="form-control" id="initiator" name="initiator" value="{{ old('initiator') }}" required>
        </div>

        <div class="item">
            <span class="label">Actor:</span>
            <select>
                <option value="">Kies een Actor</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select type="text" class="form-control" id="actor" name="actor" value="{{ old('actor') }}" required>
        </div>

        <div class="item">
            <span class="label">Portfolio houder:</span>
            <select>
                <option value="">Kies een Portfolio houder</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select type="text" class="form-control" id="portfolio_holder" name="portfolio_holder" value="{{ old('portfolio_holder') }}" required>
        </div>

        <div class="item">
            <span class="label">Aanleiding project:</span>
            <input type="text" class="form-control" id="reasoning" name="reasoning" placeholder="aanleiding project" value="{{ old('reasoning') }}" required>
        </div>

        <div class="item">
            <span class="label">Documenten:</span>
            <input type="file" class="form-control" id="uploaded_document_start" name="uploaded_document_start" value="{{ old('uploaded_document_start') }}" required>
            <input type="file" class="form-control" id="uploaded_document_planning" name="uploaded_document_planning" value="{{ old('uploaded_document_planning') }}" required>
        </div>

        <div class="item">
            <span class="label">Programma:</span>
            <input type="text" class="form-control" id="program" name="program" placeholder="programma" value="{{ old('program') }}" required>
        </div>

        <div class="item">
            <span class="label">Community link:</span>
            <input type="url" class="form-control" id="community_link" name="community_link" placeholder="https://www.community.nl" value="https://{{ old('community_link') }}" required>
        </div>

        <div class="item">
            <span class="label">Status:</span>
            <input type="text" class="form-control" id="project_status" name="project_status" placeholder="op schema" value="{{ old('project_status') }}" required>
        </div>

        <div class="item">
            <span class="label">Progressie:</span>
            <input type="number" class="form-control" id="progress" name="progress" placeholder="0 > 100" value="{{ old('progress') }}" required>
        </div>

        <div class="item">
            <span class="label">Check discussie RvB:</span>
            <input type="hidden" name="check_discussion_RvB" value="0">
            <input type="checkbox" class="form-control" id="check_discussion_RvB" name="check_discussion_RvB" value="1" {{ old('check_discussion_RvB') ? 'checked' : '' }}>
        </div>

        <div class="form-actions">
            <button type="submit" class="light-blue-button">Maak aan</button>
            <a href="{{ route('projects.index') }}" class="light-blue-button">Annuleer</a>
        </div>
        </form>

    </div>
    @endsection