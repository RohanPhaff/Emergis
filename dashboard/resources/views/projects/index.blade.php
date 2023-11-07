@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="content">
    <h1>List of Projects</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Program</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Progress</th>
                <th>Project Status</th>
                <th>Portfolio Holder</th>
                <th>Impact (per area)</th>
                <th>Phase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr data-href="{{ route('projects.show', $project) }}" onclick="window.location.href = this.getAttribute('data-href');">
                    <td>{{ $project->name }}</a></td>
                    <td>{{ $project->program }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>nan</td>
                    <td>{{ $project->project_status }}</td>
                    <td>{{ $project->portfolio_holder }}</td>
                    <td>nan</td>
                    <td>nan</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection