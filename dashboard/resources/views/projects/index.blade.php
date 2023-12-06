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

    <button id="toggleButton">
        <img src="{{ asset('images/switch.png') }}" alt="Switch View" title="Wissel tussen tabel en blokjes weergave" class="toggleIcon">
    </button>

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
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->start_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->end_date)->format('d-m-Y') }}</td>
                <td>{{ $project->progress }}%</td>
                <td>{{ $project->project_status }}</td>
                <td>{{ $project->projectleader }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="compareDiv">
        @foreach ($projects as $project)
        <div class="compare" data-href="{{ route('projects.show', $project) }}" onclick="window.location.href = this.getAttribute('data-href');">
            <p>{{ $project->name }}</a></p>
                <?php
                $manHours = $project->man_hours;
                $entries = explode(';', $manHours);
                $sum = 0;
            
                foreach ($entries as $entry) {
                    $parts = explode(':', $entry);
                    if (count($parts) === 2 && is_numeric($parts[1])) {
                        $sum += intval($parts[1]);
                    }
                }
                $category = ($sum >= 0 && $sum <= 1000) ? 'Laag' : (($sum > 1000 && $sum <= 3000) ? 'Middel' : 'Hoog');

                $spent = $project->spent_costs;
                $budget = $project->budget;
                $percentageBudget = ($spent / $budget) * 100;

                $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $project->start_date);
                $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $project->end_date);
                $currentDate = \Carbon\Carbon::now();

                $totalDuration = $startDate->diffInDays($endDate);
                $elapsedDays = $startDate->diffInDays($currentDate);
                $percentageTime = ($elapsedDays / $totalDuration) * 100;

                // Ensure the percentage is within the bounds (0 to 100)
                $percentageTime = max(0, min(100, $percentageTime));
                ?>

            <p>Mens uren: {{ $category }}</p>
            <p>€{{ $spent }} van de €{{ $budget }} besteed</p>
            <div class="progress-container-percentage">
                <div class="progress-bar-percentage" style="width: {{ $percentageBudget }}%; background-color: #c3d3b1;"></div>
            </div>

            <p>Van {{ $startDate->format('d-m-Y') }} tot {{ $endDate->format('d-m-Y') }}</p>
            <div class="progress-container-percentage">
                <div class="progress-bar-percentage" style="width: {{ $percentageTime }}%; background-color: #3498db;"></div>
            </div>
            <div class="statusBar" style="background-color: 
                @if($project->project_status === 'Op schema')
                    #acd084;
                @elseif($project->project_status === 'Vertraagd')
                    #f5a04c;
                @elseif($project->project_status === 'Afgewezen')
                    #e63a4e;
                @else
                    #000000;
                @endif">
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.compareDiv').hide();

        $('#toggleButton').click(function() {
            $('.compareDiv').toggle();
            $('.table').toggle();
        });
    });
</script>

@endsection