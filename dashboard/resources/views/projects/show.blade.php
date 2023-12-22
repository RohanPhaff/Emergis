@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@if ($updatedProject = Session::get('updatedProject'))
<div class="alert alert-success">
  <p class="successUpdate">Project: "{{ $updatedProject->name }}" is succesvol aangepast!</p>
</div>
@endif

<div class="project-container">
  <div class="left-box">
    <h1 class="showName">{{ $project->name }}</h1>
    <p class="showLeader"><strong>Projectleider:</strong> {{ $project->projectleader }}</p>
    <p class="showDescription">{{ $project->description }}</p>
    <p class="showDescription">{{ $project->reasoning }}</p>
    <p class="showCode"><strong>Projectcode:</strong> {{ $project->code }}</p>
    <p class="showLink"><strong>Community Link:</strong> {{ $project->community_link }}</p>
  </div>
  <div class="right-box">
    <p class="showRoles"><strong>Projectleider:</strong> {{ $project->projectleader }}</p>
    <p class="showRoles"><strong>2e projectleider:</strong> {{ $project->second_projectleader }}</p>
    <p class="showRoles"><strong>Initiator:</strong> {{ $project->initiator }}</p>
    <p class="showRoles"><strong>Actor:</strong> {{ $project->actor }}</p>
  </div>
  <div class="right-box">
    <p class="showRoles"><strong>Programma:</strong> {{ $program->name }}</p>
    <p class="showRoles"><strong>Portefeuillehouder:</strong> {{ $program->portfolio_holder }}</p>
  </div>
</div>

<div class="showDetails">
  <div class="showManHours">
    <h1 id="man_hours_help">Mens uren</h1>
    <p id="man_hours">{{ $project->department_man_hours }}</p>
  </div>
  <div class="showBudget">
    <h1>Budget</h1>
    <p id="budget">€{{ $project->budget }}</p>
  </div>
  <div class="showExpectedCosts">
    <h1>Gemaakte kosten</h1>
    <p id="spend_costs">€{{ $project->spent_costs }}</p>
  </div>
  <div class="showDuration">
    <h1>Verwachte looptijd</h1>
    <p id="duration">{{ $project->start_date }} tot {{ $project->end_date }}</p>
  </div>
</div>
<h1>Voortgang</h1>
<h1 id="progressValue">{{ $project->progress }}</h1>
<div class="container">
  <div class="progress-container">
    <div class="progress" id="progress"> </div>
    <div class="container" style="margin-top: 3.5em;">
      <div class="circle">1</div>
      <p>Aanvraag</p>
    </div>
    <div class="container" style="margin-top: 3.5em;">
      <div class="circle">2</div>
      <p>Lopend</p>
    </div>
    <div class="container" style="margin-top: 3.5em;">
      <div class="circle">3</div>
      <p>Halverwege</p>
    </div>
    <div class="container" style="margin-top: 3.5em;">
      <div class="circle">4</div>
      <p>Afronding</p>
    </div>
    <div class="container" style="margin-top: 3.5em;">
      <div class="circle">5</div>
      <p>Evaluatie</p>
    </div>
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
  <span class="label">Geüpdatet op:</span>
  <span class="value">{{ $project->updated_at }}</span>
</div>

<div class="actions-container">
  <div class="edit">
    <a href="{{ route('projects.edit', ['project' => $project->id]) }}">
      <p class="edit-text">Project Wijzigen</p>
    </a>
  </div>

  <div class="delete">
    <form action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="post">
      @csrf
      @method('DELETE')

      <button type="submit" class="action-button">
        <p class="delete-text">Project Verwijderen</p>
      </button>
    </form>
  </div>
</div>

<script>
  const progress = document.getElementById("progress");
  const stepCircles = document.querySelectorAll(".circle");

  const progressValue = document.getElementById('progressValue').innerHTML;
  const projectStatus = document.getElementById('projectStatus').innerHTML;
  const rvb = document.getElementById('RvBValue').innerHTML;

  let currentActive = 1;

  update(progressValue);

  function update(currentActive) {
    stepCircles.forEach((circle, i) => {
      if (i < currentActive && projectStatus == "Op schema") {
        circle.classList.add("active_on_track");
        progress.style.background = "var(--line-border-on-track-lighter)";
      } else if (i < currentActive && projectStatus == "Vertraagd") {
        circle.classList.add("active_delayed");
        progress.style.background = "var(--line-border-delayed-lighter)";
      } else if (i < currentActive && projectStatus == "Afgewezen") {
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

<?php if (isset($project)) { ?> // If project is set, then encode the data
  <script>
    let manHours = <?php echo json_encode($project->department_man_hours); ?>;
    let totalManHours = <?php echo json_encode($project->total_man_hours); ?>;
    let categoryManHours = <?php echo json_encode($project->category_man_hours); ?>;
    let budget = <?php echo json_encode($project->budget); ?>;
    let categoryBudget = <?php echo json_encode($project->category_budget); ?>;
    let spendCosts = <?php echo json_encode($project->spent_costs); ?>;
    let startDate = <?php echo json_encode($project->start_date); ?>;
    let endDate = <?php echo json_encode($project->end_date); ?>;
  </script>
  <script src="\js\categoryHoursBudget.js"></script>
<?php } ?>

@endsection