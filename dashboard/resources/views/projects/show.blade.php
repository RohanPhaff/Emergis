@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="project-container">
  <div class="left-box">
    <h1 class="showName">{{ $project->name }}</h1>
    <p class="showLeader"><strong>Projectleider:</strong> {{ $project->projectleader }}</p>
    <p class="showProgram"><strong>Programma:</strong> {{ $project->program }}</p>
    <p class="showDescription">{{ $project->description }}</p>
    <p class="showDescription">{{ $project->reasoning }}</p>
    <p class="showCode"><strong>Projectcode:</strong> {{ $project->code }}</p>
    <p class="showLink"><strong>Community Link:</strong> {{ $project->community_link }}</p>
  </div>
  <div class="right-box">
    <p class="showRoles"><strong>Projectleider:</strong> {{ $project->projectleader }}</p>
    <p class="showRoles"><strong>2e projectleider:</strong> {{ $project->alt_projectleader }}</p>
    <p class="showRoles"><strong>Initiator:</strong> {{ $project->initiator }}</p>
    <p class="showRoles"><strong>Actor:</strong> {{ $project->actor }}</p>
    <p class="showRoles"><strong>Portefeuillehouder:</strong> {{ $project->portfolio_holder }}</p>
  </div>
</div>

<div class="showDetails">
  <div class="showManHours">
    <h1>Mens uren</h1>
    <p>{{ $project->man_hours }}</p>
  </div>
  <div class="showBudget">
    <h1>Budget</h1>
    <p>{{ $project->budget }}</p>
  </div>
  <div class="showExpectedCosts">
    <h1>Verwachte kosten</h1>
    <p>{{ $project->spent_costs }}</p>
  </div>
  <div class="showDuration">
    <h1>Duratie</h1>
    <p>{{ $project->start_date }} tot {{ $project->end_date }}</p>
  </div>
</div>
<h1>Voortgang</h1>
<h1 id="progressValue">{{ $project->progress }}</h1>
<div class="container">
  <div class="progress-container">
    <div class="progress" id="progress"> </div>
    <div class="circle">1</div>
    <div class="circle">2</div>
    <div class="circle">3</div>
    <div class="circle">4</div>
    <div class="circle">5</div>
  </div>
</div>
<p id="projectStatus">{{ $project->project_status }}</p>

<h1 id="RvBValue">{{ $project->check_discussion_RvB }}</h1>
<p id="rvb">Discussie Raad van Bestuur is nodig!</p>

<div>
  <span class="label">Documenten:</span>
  <div class="value">Start: {{ $project->uploaded_document_start }}</div>
  <div class="value">Planning: {{ $project->uploaded_document_planning }}</div>
</div>

<div>
  <span class="label">Aangemaakt op:</span>
  <span class="value">{{ $project->created_at }}</span>
</div>

<div>
  <span class="label">GeÃ¼pdatet op:</span>
  <span class="value">{{ $project->updated_at }}</span>
</div>

<div class="edit">
  <a href="{{ route('projects.edit', ['project' => $project->id]) }}" class="actions-container">
    <p class="edit-text">Project Wijzigen</p>
  </a>
</div>

<div class="delete">
  <a href="{{ route('projects.destroy', ['project' => $project->id]) }}" class="actions-container">
    <p class="delete-text">Project Verwijderen</p>
  </a>
</div>

<script>
  const progress = document.getElementById("progress");
  const stepCircles = document.querySelectorAll(".circle");

  const progressValue = document.getElementById('progressValue').innerHTML;
  const projectStatus = document.getElementById('projectStatus').innerHTML;
  const rvb = document.getElementById('RvBValue').innerHTML;

  let currentActive = 1;

  const updateValue = Math.floor(progressValue / 20);

  update(updateValue);

  function update(currentActive) {
    stepCircles.forEach((circle, i) => {
      if (i < currentActive && projectStatus == "Op schema") {
        circle.classList.add("active_on_track");
        progress.style.background = "var(--line-border-on-track-lighter)";
      } else if (i < currentActive && projectStatus == "Vertraagd") {
        circle.classList.add("active_delayed");
        progress.style.background = "var(--line-border-delayed-lighter)";
      } else if (i < currentActive && projectStatus == "Afgelast") {
        circle.classList.add("active_cancelled");
        progress.style.background = "var(--line-border-cancelled-lighter)";
      } else {
        circle.classList.remove("active");
      }
    });

    const activeCircles = document.querySelectorAll(".active_delayed, .active_cancelled, .active_on_track");
    progress.style.width =
      ((activeCircles.length - 1) / (stepCircles.length - 1)) * 100 + "%";
  }

  if (rvb == "1") {
    document.getElementById("rvb").style.display = "block";
  } else {
    document.getElementById("rvb").style.display = "none";
  }
</script>

@endsection