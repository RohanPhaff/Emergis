@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('vendor/DataTables-1.13.8/js/jquery.dataTables.js') }}"></script>
<link href="{{ asset('vendor/DataTables-1.13.8/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/DataTables-1.13.8/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/dataTables.js') }}"></script>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <form method="POST" action="{{ route('admin.update', ['users' => $user->id]) }}">
                @csrf
                @method('PUT')
                <td><strong>{{$user->name}}</strong></td>
                <td>{{$user->email}}</td>
                <td>
                    <select name="role" id="role">
                        @foreach ($roles as $role)
                        <option value="{{ $role->name }}" title="{{ $role->description }}" @if ($user->role == $role->name) selected @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection