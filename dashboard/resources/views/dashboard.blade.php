@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-content">
    <h2>Dashboard</h2>
    <p>Welkom {{ Auth::user()->name }}</p>
</div>
@endsection