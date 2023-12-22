@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="content">
    <h1>Project {{ $project->name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('projects.update', ['project' => $project->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="item">
            <span class="required">*</span>
            <span class="label">Project naam:</span>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" required>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Project code:</span>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $project->code) }}" required>
            <span class="label" id="projectCode_help"></span>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Beschrijving:</span>
            <textarea class="form-control auto-resize" id="description" name="description" style="height: 200px; width: 100%;" required>{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="item">
            <div id="form-container">
                <div id="small-container">
                    <span class="label">Afdeling:</span>
                    <select class="form-control" id="department" name="departments[]" value="{{ old('department') }}">
                        <option value="">Kies een afdeling</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <span class="label">Mens uren:</span>
                    <input type="number" class="form-control" id="man_hours" name="man_hours[]" placeholder="75" value="{{ old('man_hours') }}">
                </div>
            </div>

            <button type="button" id="add-department-btn" class="grey-button">Extra afdeling toevoegen</button>
        </div>

        <script>
            <?php if(isset($departments)) { ?>
                let departments = <?php echo json_encode($departments); ?>;
            <?php } ?>

            let editPage = true;

            <?php if(isset($project)) { ?>
                let manHoursString = <?php echo json_encode($project->department_man_hours); ?>;
            <?php } ?>
        </script>
        <script src="\js\manHoursMenu.js"></script>

        <div class="item">
            <span class="label">Budget:</span>
            <input type="number" class="form-control" id="budget" name="budget" value="{{ old('budget', $project->budget) }}">
        </div>

        <div class="item">
            <span class="label">Gemaakte kosten:</span>
            <input type="number" class="form-control" id="spent_costs" name="spent_costs" value="{{ old('spent_costs', $project->spent_costs) }}">
        </div>

        <div class="item">
            <span class="label">Verwachtte looptijd:</span>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date) }}">
            tot
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date) }}">
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Projectleider:</span>
            <select class="form-control" id="projectleader" name="projectleader" value="{{ old('projectleader') }}" required>
                <option value="">Projectleider</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('projectleader', $project->projectleader) == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">2e projectleider:</span>
            <select class="form-control" id="second_projectleader" name="second_projectleader" value="{{ old('second_projectleader') }}">
                <option value="">Kies een 2e Projectleider</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('second_projectleader', $project->second_projectleader) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Initiator:</span>
            <select class="form-control" id="initiator" name="initiator" value="{{ old('initiator') }}">
                <option value="">Kies een Initiator</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('initiator', $project->initiator) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Actor:</span>
            <select class="form-control" id="actor" name="actor" value="{{ old('actor') }}">
                <option value="">Kies een Actor</option>
                @foreach ($users as $user)
                <option value="{{ $user->name }}" {{ old('actor', $project->actor) == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Beredenering project:</span>
            <textarea class="form-control auto-resize" id="reasoning" name="reasoning" style="height: 200px; width: 100%;" required>{{ old('reasoning', $project->reasoning) }}</textarea>
        </div>

        <div class="item">
            <span class="label">Documenten:</span>
            <input type="file" class="form-control" id="uploaded_document_start" name="uploaded_document_start">
            <input type="file" class="form-control" id="uploaded_document_planning" name="uploaded_document_planning">
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Programma:</span>

            <select class="form-control" id="program" name="program" required>
                <option value="">Kies een programma</option>
                @foreach ($programs as $program)
                <option value="{{ $program->name }}" {{ old('program', $program->name) == $program->name ? 'selected' : '' }}>
                    {{ $program->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="item">
            <span class="label">Community link:</span>
            <input type="url" class="form-control" id="community_link" name="community_link" value="{{ old('community_link', $project->community_link) }}">
        </div>

        <div class="item">
            <span class="label">Status:</span>
            <select class="form-control" id="project_status" name="project_status" value="{{ old('project_status', $project->project_status) }}">
                <option value="Op schema" {{ old('project_status', $project->project_status) == 'Op schema' ? 'selected' : '' }}>Op schema</option>
                <option value="Vertraagd" {{ old('project_status', $project->project_status) == 'Vertraagd' ? 'selected' : '' }}>Vertraagd</option>
                <option value="Afgewezen" {{ old('project_status', $project->project_status) == 'Afgewezen' ? 'selected' : '' }}>Afgewezen</option>
            </select>
        </div>

        <div class="item">
            <span class="required">*</span>
            <span class="label">Voortgang:</span>
            <input type="number" class="form-control" id="progress" name="progress" value="{{ old('progress', $project->progress) }}" min="1" max="5" required>
            <span class="label" id="progress_help"></span>
        </div>

        <div class="item">
            <span class="label">Check discussie RvB:</span>
            <input type="hidden" name="check_discussion_RvB" value="0">
            <input type="checkbox" class="form-control" id="check_discussion_RvB" name="check_discussion_RvB" value="1" {{ old('check_discussion_RvB', $project->check_discussion_RvB) ? 'checked' : '' }}>
            <span class="label" id="rvb_help"></span>
        </div>

        <div class="form-actions">
            <button type="submit" class="light-blue-button">Aanpassen</button>
            <a href="{{ route('projects.index') }}" class="light-blue-button">Annuleren</a>
        </div>
    </form>
</div>

<script>
function showTooltip(nummer) {
    let tooltip = document.getElementById('tooltip' + nummer);
    tooltip.style.display = 'block';
}

// Function to hide tooltip when not hovering
function hideTooltip(nummer) {
    let tooltip = document.getElementById('tooltip' + nummer);
    tooltip.style.display = 'none';
}

document.getElementById("progress_help").innerHTML = "<div class='tooltip-container'>" +
    "<span class='question-mark' onmouseover='showTooltip(1)' onmouseout='hideTooltip(1)'> &#128712;</span>" +
    "<div class='tooltip-content' id='tooltip1' style='display: none;'><p class='tooltip-text'>Voortgang uitleg:<br>" + "1: Aanvraag<br> 2: Lopend<br> 3: Halverwege<br> 4: Afronding<br> 5: Evaluatie" + "</p></div></div>";

document.getElementById("rvb_help").innerHTML = "<div class='tooltip-container'>" +
    "<span class='question-mark' onmouseover='showTooltip(2)' onmouseout='hideTooltip(2)'> &#128712;</span>" +
    "<div class='tooltip-content' id='tooltip2' style='display: none;'><p class='tooltip-text'>RvB uitleg:<br>" + "Is er gesprek geweest met het Raad van Bestuur (RvB)?" + "</p></div></div>";

document.getElementById("projectCode_help").innerHTML = "<div class='tooltip-container'>" +
    "<span class='question-mark' onmouseover='showTooltip(3)' onmouseout='hideTooltip(3)'> &#128712;</span>" +
    "<div class='tooltip-content' id='tooltip3' style='display: none;'><p class='tooltip-text'>Projectcode uitleg:<br>" + "Deze komt overeen met de projectcode van het project bij Emergis" + "</p></div></div>";
</script>

@endsection