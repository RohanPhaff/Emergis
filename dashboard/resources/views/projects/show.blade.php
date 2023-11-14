@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="dashboard-content">
<div class="project-container">
<div class="left-box">
        <h1 class="showName">{{ $project->name }}</h1>
        <p class="showLeader"><strong>Projectleider:</strong> {{ $project->projectleader }}</p>
        <p class="showLeader"><strong>Programma:</strong> {{ $project->program }}</p>
        <p class="showDescription">{{ $project->description }}</p>
        <p class="showDescription">{{ $project->reasoning }}</p>
        <p class="showCode"><strong>Projectcode:</strong> {{ $project->code }}</p>
        <p class="showLink"><strong>Community Link:</strong> {{ $project->community_link }}</p>
    </div>
    <div class="right-box">
        <p class="showRoles"><strong>Projectleider:</strong> {{ $project->projectleader }}</p>
        <p class="showRoles"><strong>Alt. projectleider:</strong> {{ $project->alt_projectleader }}</p>
        <p class="showRoles"><strong>Initiator:</strong> {{ $project->initiator }}</p>
        <p class="showRoles"><strong>Actor:</strong> {{ $project->actor }}</p>
        <p class="showRoles"><strong>Portefeuillehouder:</strong> {{ $project->portfolio_holder }}</p>
    </div>
</div>


    <div class="showDetails">
        <div class="showManHours">
            <h1>Man uren</h1>
            <p>{{ $project->man_hours }}</p>
        </div>
        <div class="showBudget">
            <h1>Budget</h1>
            <p>{{ $project->budget }}</p>
        </div>
        <div class="showExpectedCosts">
            <h1>Verwachte kosten</h1>
            <p>{{ $project->expected_costs }}</p>
        </div>
        <div class="showDuration">
            <h1>Duratie</h1>
            <p>{{ $project->start_date }} tot {{ $project->end_date }}</p>
        </div>
    </div>
    <h1>Voortgang</h1>
    <h1 id="progressValue">{{ $project->progress }}</h1>
  <div class="progress-container">
    <div class="progress-bar"></div>
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
</div>

<script>
    // JavaScript to update the progress bar and its color based on the h1 element value
    const progressValue = document.getElementById('progressValue');
    const progressBar = document.querySelector('.progress-bar');

    const projectStatus = document.getElementById('projectStatus').innerHTML;
    const animationDuration = 1; // Fixed animation duration in seconds

    const rvb = document.getElementById('RvBValue').innerHTML;

    function updateProgressBar() {
      const value = parseInt(progressValue.innerText, 10);
      const width = value + '%';
      progressBar.style.animation = 'none'; // Disable the animation
      progressBar.style.width = width;
      progressBar.innerText = value + '%';

      // Determine the color class based on the value
      let colorClass = 'blue'; // Default to green
      if (projectStatus == "Afgelast") {
        colorClass = 'red';
      } else if (projectStatus == "Vertraagd") {
        colorClass = 'orange';
      } else if (projectStatus == "Op schema") {
        colorClass = 'green';
      }

      progressBar.className = `progress-bar ${colorClass}`; // Apply the appropriate color class

      // Re-enable the animation with a fixed duration
      setTimeout(() => {
        progressBar.style.animation = `slide ${animationDuration}s ease-in-out forwards`;
      }, 0);
    }

    updateProgressBar(); // Initial update

    console.log(rvb)

    if (rvb == "1") {
        document.getElementById("rvb").style.display = "block";
    } else {
        document.getElementById("rvb").style.display = "none";
    }
  </script>

@endsection