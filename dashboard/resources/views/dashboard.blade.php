@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<script>
    function showGraphs(category) {
        document.querySelectorAll('.small-chart').forEach(chart => {
            chart.style.display = 'none';
        });

        document.querySelectorAll('.small-chart.${category}').forEach(chart => {
            chart.style.display = 'flex';
        });
    }

    console.log("test");

    window.onload = function() {
        showGraphs('projecten');
    };
</script>

<div class="charts">
    <div class="charts-left">
        <div class="charts-filter">
            <button class="grey-button" onclick="showGraphs('projecten')">Projecten</button>
            <button class="grey-button" onclick="showGraphs('kosten')">Kosten</button>
        </div>

        <div class="small-chart projecten">
            <div class="chart-container">
                {!! $onScheduleChart->container() !!}
                {!! $onScheduleChart->script() !!}
                <div class="center-text">{{ $onScheduleChart->getPercentageOnSchedule() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Op schema projecten</h3>
                <p>{{ $onScheduleChart->getOnScheduleCount() }} van de {{ $onScheduleChart->getTotalProjects() }} projecten</p>
            </div>
        </div>

        <div class="small-chart projecten">
            <div class="chart-container">
                {!! $delayedProjectsChart->container() !!}
                {!! $delayedProjectsChart->script() !!}
                <div class="center-text">{{ $delayedProjectsChart->getPercentageDelayed() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Vertraagde projecten</h3>
                <p>{{ $delayedProjectsChart->getDelayedCount() }} van de {{ $delayedProjectsChart->getTotalProjects() }} projecten</p>
            </div>
        </div>

        <div class="small-chart projecten">
            <div class="chart-container">
                {!! $completedProjectsChart->container() !!}
                {!! $completedProjectsChart->script() !!}
                <div class="center-text">{{ $completedProjectsChart->getPercentageCompleted() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Afgeronde projecten</h3>
                <p>{{ $completedProjectsChart->getCompletedProjectsCount() }} van de {{ $completedProjectsChart->getTotalProjectsCount() }} projecten</p>
            </div>
        </div>

        <div class="small-chart kosten">
            <div class="chart-container">
                {!! $budgetChart->container() !!}
                {!! $budgetChart->script() !!}
                <div class="center-text">{{ $budgetChart->getPercentageExpectedCosts() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Budget verbruikt</h3>
                <p>€{{ $budgetChart->getTotalExpectedCosts() }} van de €{{ $budgetChart->getTotalBudget() }}</p>
            </div>
        </div>
    </div>

    <div class="charts-right">
        <div class="big-chart">
            <div class="big-chart-container">
                {!! $bigChart->container() !!}
                {!! $bigChart->script() !!}
                <div class="center-text big-chart-text">Verdeling<br>projecten</div>
            </div>
            <div class="big-chart-text-container">
                @foreach($labels as $index => $label)
                @php
                list($program, $percentage) = explode(' ', $label);
                @endphp
                <a @if($index < count($labels) - 1) href="/projects?{{ $program }}" @endif class="legend-item">
                    <span class="label">{{ $program }}</span>
                    <span class="percentage">{{ $percentage }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <div>
            <h3>Opkomende projecten</h3>

            <table>
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Start Datum</th>
                        <th>Projectleider</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentProjects as $project)
                    <tr data-href="{{ route('projects.show', $project) }}" onclick="window.location.href = this.getAttribute('data-href');">
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->projectleader }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection