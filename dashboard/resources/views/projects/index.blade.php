@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<!-- Table sorting -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery CDN MUST be loaded first -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/jquery.dataTables.js') }}"></script> <!-- DataTables js -->
<link href="{{ asset('vendor/DataTables-1.13.8/css/dataTables.bootstrap4.css') }}" rel="stylesheet"> <!-- DataTables bootstrap css -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/dataTables.bootstrap4.js') }}"></script> <!-- DataTables bootstrap js -->
<script src="{{ asset('js/dataTables.js') }}"></script> <!-- DataTables custom js -->

<div class="content1">
    @if ($newProject = Session::get('newProject'))
    <div class="alert alert-success">
        <p class="successAdd">Project: "{{ $newProject->name }}" has successfully been created!</p>
    </div>
    @endif

    <div class="header">
        <h1>Lijst van Projecten</h1>
        <a href="{{ route('projects.create') }}" class="light-blue-button">Nieuw project</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Programma</th>
                <th>Start Datum</th>
                <th>Eind Datum</th>
                <th>Progressie</th>
                <th>Project Status</th>
                <th>Projectleider</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr data-href="{{ route('projects.show', $project) }}" onclick="window.location.href = this.getAttribute('data-href');">
                <td>{{ $project->name }}</a></td>
                <td>{{ $project->program }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>{{ $project->progress }}</td>
                <td>{{ $project->project_status }}</td>
                <td>{{ $project->projectleader }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection