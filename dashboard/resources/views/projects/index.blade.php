@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<!-- Table sorting -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> <!-- Select2 css -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> <!-- Select2 js -->
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

    <div class="filter-section">
    <label for="programFilter">Select Program:</label>
    <select id="programFilter" multiple>
        <option value="">All Programs</option>
        @foreach ($programOptions as $programOption)
            <option value="{{ $programOption }}">{{ $programOption }}</option>
        @endforeach
    </select>

    <label for="statusFilter">Select Status:</label>
    <select id="statusFilter" multiple>
        <option value="">All Status</option>
        @foreach ($statusOptions as $statusOption)
            <option value="{{ $statusOption }}">{{ $statusOption }}</option>
        @endforeach
    </select>
    
    <label for="departmentFilter">Select Afdeling:</label>
<select id="departmentFilter" multiple>
    <option value="">All Departments</option>
    @foreach ($departmentOptions as $departmentOption)
        <option value="{{ $departmentOption }}">{{ $departmentOption }}</option>
    @endforeach
</select>

<label for="manHoursFilter">Select Man Hours Category:</label>
<select id="manHoursFilter" multiple>
    <option value="">All Categories</option>
    @foreach ($manHoursCategories as $category)
        <option value="{{ $category }}">{{ $category }}</option>
    @endforeach
</select>

<label for="budgetFilter">Select Budget:</label>
<select id="budgetFilter" multiple>
    <option value="">All Budgets</option>
    @foreach ($budgetOptions as $budgetOption)
        <option value="{{ $budgetOption }}">{{ $budgetOption }}</option>
    @endforeach
</select>

<label for="rvbFilter">Select RvB:</label>
<select id="rvbFilter" multiple>
    <option value="">All RvB</option>
    @foreach ($rvbOptions as $rvbOption)
        <option value="{{ $rvbOption }}">{{ $rvbOption }}</option>
    @endforeach
</select>

    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Programma</th>
                <th>Verwachte Start Datum</th>
                <th>Verwachte Eind Datum</th>
                <th>Voortgang</th>
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
                <td>{{ $project->progress }}%</td>
                <td>{{ $project->project_status }}</td>
                <td>{{ $project->projectleader }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // Initialize Select2 for the new filters
        $('#programFilter, #statusFilter, #departmentFilter, #manHoursFilter, #budgetFilter, #rvbFilter').select2();

        // DataTables filtering logic
        var table = $('.table').DataTable();

        $('#programFilter, #statusFilter, #departmentFilter, #manHoursFilter, #budgetFilter, #rvbFilter').on('change', function () {
            var programFilter = $('#programFilter').val() || [];
            var statusFilter = $('#statusFilter').val() || [];
            var departmentFilter = $('#departmentFilter').val() || [];
            var manHoursFilter = $('#manHoursFilter').val() || [];
            var budgetFilter = $('#budgetFilter').val() || [];
            var rvbFilter = $('#rvbFilter').val() || [];

        table.columns(1).search(programFilter.join('|'), true, false)
            .columns(5).search(statusFilter.join('|'), true, false)
            .columns(2).search(departmentFilter.join('|'), true, false)
            .columns(4).search(manHoursFilter.join('|'), true, false)
            .columns(3).search(budgetFilter.join('|'), true, false)
            .columns(6).search(rvbFilter.join('|'), true, false)
            .draw();
        });
    });
</script>

@endsection