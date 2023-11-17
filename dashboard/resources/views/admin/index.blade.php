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
            <p><strong>{{$user->name}}</strong></p>

            <p>{{$user->email}}</p>

            <span class="label">Rol:</span>
            <select name="role" id="role">
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" title="{{ $role->description }}" @if ($user->role == $role->name) selected @endif>{{ $role->name }}</option>
            @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    @endforeach
</div>
@endsection