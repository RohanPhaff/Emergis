@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@if ($updatedProgram = Session::get('updatedProgram'))
    <div class="alert alert-success">
        <p class="successUpdate">Program: "{{ $updatedProgram->name }}" has successfully been updated!</p>
    </div>
@endif

<div class="project-container">
<div class="left-box">
        <h1 class="showName">{{ $program->name }}</h1>
        <p class="showDescription">{{ $program->description }}</p>
    </div>
    <div class="right-box">
        <p class="showRoles"><strong>Portefeuillehouder:</strong> {{ $program->portfolio_holder }}</p>
    </div>
</div>
    <div>
        <span class="label">Aangemaakt op:</span>
        <span class="value">{{ $program->created_at }}</span>
    </div>
    
    <div>
        <span class="label">Geüpdatet op:</span>
        <span class="value">{{ $program->updated_at }}</span>
    </div>
</div>
@endsection