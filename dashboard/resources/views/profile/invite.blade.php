@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> 

<div class="content"> <h1>Nieuwe gebruiker</h1>

<form method="PUT" action="{{ route('sendInvite') }}" enctype="multipart/form-data">
        @csrf

        <div class="item">
            <span class="required">*</span>
            <span class="label">Gebruiker naam:</span>
            <input type="text" class="form-control" id="name" name="name" placeholder="Gebruikers naam" value="{{ old('name') }}" required>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Email:</span><br>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="light-blue-button">Stuur uitnodiging</button>
        </div>
        </form>

@endsection