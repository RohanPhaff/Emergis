@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> 

<div class="content"> <h1>Nieuw programma</h1>

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

        <form method="POST" action="{{ route('programs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="item">
            <span class="required">*</span>
            <span class="label">Programma naam:</span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Programma naam" value="{{ old('name') }}" required>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Beschrijving:</span><br>
            <textarea class="form-control auto-resize" id="description" name="description" placeholder="Beschrijving" style="height: 200px; width: 100%;" value="{{ old('description') }}" required></textarea>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Portefeuillehouder:</span>
            <select class="form-control" id="portfolio_holder" name="portfolio_holder" value="{{ old('portfolio_holder') }}" required>
            <option value="">Kies een Portefeuillehouder</option>
                @foreach ($users as $user)
                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="light-blue-button">Maak aan</button>
            <a href="{{ route('programs.index') }}" class="light-blue-button">Annuleer</a>
        </div>
        </form>

    </div>
    @endsection