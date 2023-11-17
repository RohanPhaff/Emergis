@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<!-- Table sorting -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery CDN MUST be loaded first -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/jquery.dataTables.js') }}"></script> <!-- DataTables CDN -->
<link href="{{ asset('vendor/DataTables-1.13.8/css/dataTables.bootstrap4.css') }}" rel="stylesheet"> <!-- DataTables bootstrap css -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/dataTables.bootstrap4.js') }}"></script> <!-- DataTables bootstrap js -->
<script src="{{ asset('js/dataTables.js') }}"></script> <!-- DataTables custom js -->

<!-- @if ($success = Session::get('success'))
<div class="alert alert-success">
    {{ $success }}
</div>
@endif -->

<div class="dashboard-content">
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
                            <option value="Admin" @if ($user->role == 'Admin') selected @endif>Admin</option>
                            <option value="Guest" @if ($user->role == 'Guest') selected @endif>Guest</option>
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
</div>

@endsection