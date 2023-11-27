@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<div class="charts">
    <div class="charts-left">
        <div class="small-chart">
            <div class="chart-container">
                {!! $smallChart1->container() !!}
                {!! $smallChart1->script() !!}
                <div class="center-text">{{ $smallChart1->getPercentageCompleted() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Afgeronde projecten</h3>
                <p>{{ $smallChart1->getCompletedProjectsCount() }} van de {{ $smallChart1->getTotalProjectsCount() }} projecten</p>
            </div>
        </div>

        <div class="small-chart">
            <div class="chart-container">
                {!! $smallChart2->container() !!}
                {!! $smallChart2->script() !!}
                <div class="center-text">{{ $smallChart2->getPercentageExpectedCosts() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Budget verbruikt</h3>
                <p>€{{ $smallChart2->getTotalExpectedCosts() }} van de €{{ $smallChart2->getTotalBudget() }}</p>
            </div>
        </div>

        <div class="small-chart">
            <div class="chart-container">
                {!! $smallChart3->container() !!}
                {!! $smallChart3->script() !!}
                <div class="center-text">{{ $smallChart3->getPercentageDelayed() }}%</div>
            </div>
            <div class="chart-text-container">
                <h3>Uitgelopen projecten</h3>
                <p>{{ $smallChart3->getDelayedCount() }} van de {{ $smallChart3->getTotalProjects() }} projecten</p>
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
                @foreach($labels as $label)
                @php
                list($program, $percentage) = explode(' ', $label);
                @endphp
                <div class="legend-item">
                    <span class="label">{{ $program }}</span>
                    <span class="percentage">{{ $percentage }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div>
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