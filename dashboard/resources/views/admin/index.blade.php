@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<!-- @if ($success = Session::get('success'))
<div class="alert alert-success">
    {{ $success }}
</div>
@endif -->

<div class="dashboard-content">
    @foreach ($users as $user)
    <form method="POST" action="{{ route('admin.update', ['users' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="item">
            <p>{{$user->name}}</p>

            <p>{{$user->email}}</p>

            <span class="label">Rol:</span>
            <select name="role" id="role">
                <option value="Admin" @if ($user->role == 'Admin') selected @endif>Admin</option>
                <option value="Guest" @if ($user->role == 'Guest') selected @endif>Guest</option>
            </select>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    @endforeach
</div>
@endsection