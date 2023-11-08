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
        <input type="text" class="form-control" id="name" name="name" placeholder="project naam" required>
        </div>

        <div class="item">
            <span class="label">Project code:</span>
            <input type="number" class="form-control" id="code" name="code" placeholder="12345" required>
        </div>

        <div class="item">
            <span class="label">Beschrijving:</span>
            <input type="text" class="form-control" id="description" name="description" placeholder="beschrijving"
                required>
        </div>

        <div class="item">
            <span class="label">Man uren:</span>
            <input type="number" class="form-control" id="man_hours" name="man_hours" placeholder="75" required>
        </div>

        <div class="item">
            <span class="label">Budget:</span>
            <input type="number" class="form-control" id="budget" name="budget" placeholder="12500" required>
        </div>

        <div class="item">
            <span class="label">Verwachte kosten:</span>
            <input type="number" class="form-control" id="expected_costs" name="expected_costs" placeholder="10000"
                required>
        </div>

        <div class="item">
            <span class="label">Duur:</span>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
            tot
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="item">
            <span class="label">Alternatieve project leider:</span>
            <input type="text" class="form-control" id="alt_projectleader" name="alt_projectleader"
                placeholder="projectleider" required>
        </div>

        <div class="item">
            <span class="label">Initiator:</span>
            <input type="text" class="form-control" id="initiator" name="initiator" placeholder="initiator" required>
        </div>

        <div class="item">
            <span class="label">Actor:</span>
            <input type="text" class="form-control" id="actor" name="actor" placeholder="actor" required>
        </div>

        <div class="item">
            <span class="label">Portfolio houder:</span>
            <input type="text" class="form-control" id="portfolio_holder" name="portfolio_holder"
                placeholder="portfolio houder" required>
        </div>

        <div class="item">
            <span class="label">Aanleiding project:</span>
            <input type="text" class="form-control" id="reasoning" name="reasoning" placeholder="aanleiding project"
                required>
        </div>

        <div class="item">
            <span class="label">Documenten:</span>
            <input type="file" class="form-control" id="uploaded_document_start" name="uploaded_document_start"
                required>
            <input type="file" class="form-control" id="uploaded_document_planning" name="uploaded_document_planning"
                required>
        </div>

        <div class="item">
            <span class="label">Programma:</span>
            <input type="text" class="form-control" id="program" name="program" placeholder="programma" required>
        </div>

        <div class="item">
            <span class="label">Community link:</span>
            <input type="url" class="form-control" id="community_link" name="community_link"
                placeholder="www.community.nl" required>
        </div>

        <div class="item">
            <span class="label">Status:</span>
            <input type="text" class="form-control" id="project_status" name="project_status" placeholder="op schema"
                required>
        </div>

        <div class="item">
            <span class="label">Progressie:</span>
            <input type="number" class="form-control" id="progress" name="progress" placeholder="0 > 100" required>
        </div>

        <div class="item">
            <span class="label">Check discussie RvB:</span>
            <input type="hidden" name="check_discussion_RvB" value="0">
            <input type="checkbox" class="form-control" id="check_discussion_RvB" name="check_discussion_RvB" value="1">
        </div>

        <div class="form-actions">
            <button type="submit" class="light-blue-button">Maak aan</button>
            <a href="{{ route('projects.index') }}" class="light-blue-button">Annuleer</a>
        </div>
        </form>

    </div>
    @endsection