@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="content">
    <h1>List of Programs</h1>

    <div>
        <a href="{{ route('programs.create') }}" class="light-blue-button">Nieuw programma</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Portfolio houder</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
                <tr data-href="{{ route('programs.show', $program) }}" onclick="window.location.href = this.getAttribute('data-href');">
                    <td>{{ $program->name }}</a></td>
                    <td>{{ $program->description }}</td>
                    <td>{{ $program->portfolio_holder }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection