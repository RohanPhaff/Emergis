@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="content"> <h1>Gebruiker uitnodigen</h1>

<form method="POST" action="{{ route('users.sendInvite') }}" enctype="multipart/form-data" id="sendInvite">
    @csrf

    <div class="item">
        <span class="required">*</span>
        <span class="label">Gebruikers naam:</span>
        <input type="text" class="form-control" id="name" name="name" placeholder="Gebruikers naam" value="{{ old('name') }}" required>
    </div>

    <div class="item">
        <span class="required">*</span>
        <span class="label">Gebruikers email:</span><br>
        <input type="text" class="form-control" id="email" name="email" placeholder="Gebruikers email" value="{{ old('email') }}" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="light-blue-button">Nodig uit</button>
        <button onclick="document.getElementById('sendInvite').reset(); return false;" class="light-blue-button">Leeghalen</button>
    </div>
</form>
@endsection