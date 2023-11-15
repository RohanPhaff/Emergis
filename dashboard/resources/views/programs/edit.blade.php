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
        <span class="label">Program naam:</span>
        <input type="text" class="form-control" id="name" name="name" placeholder="program naam" value="{{ old('name', $program->name) }}" required>
        </div>

        <div class="item">
            <span class="label">Beschrijving:</span>
            <input type="text" class="form-control" id="description" name="description" placeholder="beschrijving" value="{{ old('description', $program->description) }}" required>
        </div>

        <div class="item">
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