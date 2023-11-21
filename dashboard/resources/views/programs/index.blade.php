@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Table sorting -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery CDN MUST be loaded first -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/jquery.dataTables.js') }}"></script> <!-- DataTables CDN -->
<link href="{{ asset('vendor/DataTables-1.13.8/css/dataTables.bootstrap4.css') }}" rel="stylesheet"> <!-- DataTables bootstrap css -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/dataTables.bootstrap4.js') }}"></script> <!-- DataTables bootstrap js -->
<script src="{{ asset('js/dataTables.js') }}"></script> <!-- DataTables custom js -->

<div class="content1">
    @if ($newProgram = Session::get('newProgram'))
    <div class="alert alert-success">
        <p class="successAdd">Program: "{{ $newProgram->name }}" has successfully been created!</p>
    </div>
    @endif

    <div class="header">
        <h1>Lijst van Programmas</h1>
        <a href="{{ route('programs.create') }}" class="light-blue-button">Nieuw programma</a>
    </div>

    <table class="table">
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