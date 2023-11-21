@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="content"> <h1>{{ $program->name }}</h1>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

        <form method="POST" action="{{ route('programs.update', ['program' => $program->id]) }}">
        @csrf
        @method('PUT')

        <div class="item">
            <span class="required">*</span>
            <span class="label">Programma naam:</span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Programma naam" value="{{ old('name', $program->name) }}" required>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Beschrijving:</span><br>
            <textarea class="form-control auto-resize" id="description" name="description" placeholder="Beschrijving" style="height: 200px; width: 100%;" value="{{ old('description', $program->description) }}" required></textarea>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Portfolio houder:</span>
            <select class="form-control" id="portfolio_holder" name="portfolio_holder" required>
            <option value="">Kies een Portfolio houder</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('portfolio_holder', $program->portfolio_holder) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="light-blue-button">Aanpassen</button>
            <a href="{{ route('programs.index') }}" class="light-blue-button">Annuleer</a>
        </div>
        </form>

    </div>
    @endsection