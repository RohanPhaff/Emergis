@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

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

    <div class="edit">
        <a href="{{ route('programs.edit', ['program' => $program->id]) }}" class="actions-container">
            <p class="edit-text">Program Wijzigen</p>
        </a>
    </div>

    <div class="delete">
        <a href="{{ route('programs.destroy', ['program' => $program->id]) }}" class="actions-container">
            <p class="delete-text">Program Verwijderen</p>
        </a>
    </div>
</div>
@endsection