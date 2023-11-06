@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="content">
    <h1>Project {{$project->name}}</h1>
    
    <div>{{$project->name}}</div>
    <div>{{$project->code}}</div>
    <div>{{$project->description}}</div>
    <div>{{$project->man_hours}}</div>
    <div>{{$project->budget}}</div>
    <div>{{$project->expected_costs}}</div>
    <div>{{$project->start_date}}</div>
    <div>{{$project->end_date}}</div>
    <div>{{$project->alt_projectleader}}</div>
    <div>{{$project->initiator}}</div>
    <div>{{$project->actor}}</div>
    <div>{{$project->portfolio_holder}}</div>
    <div>{{$project->reasoning}}</div>
    <div>{{$project->uploaded_document_start}}</div>
    <div>{{$project->uploaded_document_planning}}</div>
    <div>{{$project->program}}</div>
    <div>{{$project->project_status}}</div>
    <div>{{$project->check_discussion_RvB}}</div>
    <div>{{$project->created_at}}</div>
    <div>{{$project->updated_at}}</div>
</div>
@endsection