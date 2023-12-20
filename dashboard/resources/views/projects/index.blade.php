@extends('layouts.dashboard')

@section('dashboard-content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<!-- Table sorting -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> <!-- Select2 css -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> <!-- Select2 js -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/jquery.dataTables.js') }}"></script> <!-- DataTables js -->
<link href="{{ asset('vendor/DataTables-1.13.8/css/dataTables.bootstrap4.css') }}" rel="stylesheet"> <!-- DataTables bootstrap css -->
<script src="{{ asset('vendor/DataTables-1.13.8/js/dataTables.bootstrap4.js') }}"></script> <!-- DataTables bootstrap js -->
<script src="{{ asset('js/dataTables.js') }}"></script> <!-- DataTables custom js -->

<div class="content1">
    @if ($newProject = Session::get('newProject'))
    <div class="alert alert-success">
        <p class="successAdd">Project: "{{ $newProject->name }}" has successfully been created!</p>
    </div>
    @endif 

    <div class="header">
        <h1>Lijst van Projecten</h1>
        <a href="{{ route('projects.create') }}" class="light-blue-button">Nieuw project</a>
    </div>

    <div class="dropdown">
            <button id="programFilterBtn" class="dropbtn">
                Filter Programs
            </button>
            <div id="programFilterOptions" class="dropdown-content">
                <div class="selectAllOption">
                    <input
                        type="checkbox"
                        id="selectAllPrograms"
                        class="selectAllCheckbox"
                        checked
                    />
                    <label for="selectAllPrograms">Select All</label>
                </div>

                @php
                    // Collect unique programs from $projects to eliminate duplicates
                    $uniquePrograms = $projects->unique('program');
                @endphp
                @foreach ($uniquePrograms as $project)
                    <label
                        ><input
                            type="checkbox"
                            class="programCheckbox"
                            value="{{ $project->program }}"
                            checked
                        />
                        {{ $project->program }}</label
                    >
                @endforeach
            </div>
        </div>

        <div class="dropdown">
            <button id="statusFilterBtn" class="dropbtn">Filter Status</button>
            <div id="statusFilterOptions" class="dropdown-content">
                <div class="selectAllOption">
                    <input
                        type="checkbox"
                        id="selectAllStatus"
                        class="selectAllCheckbox"
                        checked
                    />
                    <label for="selectAllStatus">Select All</label>
                </div>
                    <label
                        ><input
                            type="checkbox"
                            class="statusCheckbox"
                            value="Op schema"
                            checked
                        />
                        Op schema</label
                    >
                    <label
                        ><input
                            type="checkbox"
                            class="statusCheckbox"
                            value="Vertraagd"
                            checked
                        />
                        Vertraagd</label
                    >
                    <label
                        ><input
                            type="checkbox"
                            class="statusCheckbox"
                            value="Afgewezen"
                            checked
                        />
                        Afgewezen</label
                    >
            </div>
        </div>

        <button id="clearFiltersBtn">Clear Filters</button>

        <table id="projectsTable">
            <thead>
                <tr>
                <th>Programma</th>
                <th>Project Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
            <tr data-href="{{ route('projects.show', $project) }}" onclick="window.location.href = this.getAttribute('data-href');">
                <td>{{ $project->program }}</td>
                <td>{{ $project->project_status }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    
    <!-- <table class="table" id="projectsTable">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Programma</th>
                <th>Verwachte Start Datum</th>
                <th>Verwachte Eind Datum</th>
                <th>Voortgang</th>
                <th>Project Status</th>
                <th>Projectleider</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr data-href="{{ route('projects.show', $project) }}" onclick="window.location.href = this.getAttribute('data-href');">
                <td>{{ $project->name }}</a></td>
                <td>{{ $project->program }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>{{ $project->progress }}%</td>
                <td>{{ $project->project_status }}</td>
                <td>{{ $project->projectleader }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> -->
</div>

<script>
    $(document).ready(function () {
        var table = $('.table').DataTable();

        $('#programFilter, #statusFilter').on('change', function () {
            var programFilter = $('#programFilter').val() || [];
            var statusFilter = $('#statusFilter').val() || [];

            table.columns(1).search(programFilter.join('|'), true, false).columns(5).search(statusFilter.join('|'), true, false).draw();
        });

        $('#programFilter, #statusFilter').select2();
    });

    // Convert PHP $projects variable to JSON
    var projects = @json($projects);

    function renderProjectsAsTable(filteredProjects) {
                const projectsTable = document
                    .getElementById("projectsTable")
                    .getElementsByTagName("tbody")[0];
                projectsTable.innerHTML = ""; // Clear previous content

                filteredProjects.forEach((project) => {
                    const row = projectsTable.insertRow(-1);
                    const cellProgram = row.insertCell(0);
                    const cellStatus = row.insertCell(1);

                    cellProgram.textContent = project.program;
                    cellStatus.textContent = project.project_status;
                });
            }

            function toggleSelectAll(selectAllCheckbox, checkboxes) {
                selectAllCheckbox.addEventListener("change", function () {
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                    selectAllCheckbox.nextElementSibling.textContent =
                        selectAllCheckbox.checked
                            ? "Deselect All"
                            : "Select All";
                    applyFilters();
                });
            }

            // Select All/Deselect All functionality for brands
            const programCheckboxes =
                document.querySelectorAll(".programCheckbox");
            const selectAllProgramsCheckbox =
                document.getElementById("selectAllPrograms");
            toggleSelectAll(selectAllProgramsCheckbox, programCheckboxes);

            // Select All/Deselect All functionality for statuses
            const statusCheckboxes =
                document.querySelectorAll(".statusCheckbox");
            const selectAllStatusCheckbox =
                document.getElementById("selectAllStatus");
            toggleSelectAll(selectAllStatusCheckbox, statusCheckboxes);

            function applyFilters() {
                const selectedPrograms = Array.from(
                    document.querySelectorAll(".programCheckbox:checked")
                ).map((checkbox) => checkbox.value);
                const selectedStatuses = Array.from(
                    document.querySelectorAll(".statusCheckbox:checked")
                ).map((checkbox) => checkbox.value);

                let filteredProjects = projects;

                if (selectedPrograms.length > 0) {
                    filteredProjects = filteredProjects.filter((project) =>
                        selectedPrograms.includes(project.program)
                    );
                }

                if (selectedStatuses.length > 0) {
                    filteredProjects = filteredProjects.filter((project) =>
                        selectedStatuses.includes(project.project_status)
                    );
                }

                renderProjectsAsTable(filteredProjects);
            }

            function clearAllFilters() {
                document
                    .querySelectorAll(
                        ".programCheckbox:checked, .statusCheckbox:checked, .selectAllCheckbox:checked"
                    )
                    .forEach((checkbox) => {
                        checkbox.checked = false;
                    });

                applyFilters(); // Apply filters after resetting checkboxes

                // Update "Deselect All" / "Select All" text
                const selectAllProgramsCheckbox =
                    document.getElementById("selectAllPrograms");
                const selectAllStatusCheckbox =
                    document.getElementById("selectAllStatus");

                if (selectAllProgramsCheckbox && selectAllStatusCheckbox) {
                    selectAllProgramsCheckbox.nextElementSibling.textContent =
                        "Select All";
                    selectAllStatusCheckbox.nextElementSibling.textContent =
                        "Select All";
                }
            }

            // Event listeners for filter checkboxes change
            document
                .querySelectorAll(".programCheckbox")
                .forEach((checkbox) => {
                    checkbox.addEventListener("change", applyFilters);
                });

            document.querySelectorAll(".statusCheckbox").forEach((checkbox) => {
                checkbox.addEventListener("change", applyFilters);
            });

            // Initial render with all projects
            renderProjectsAsTable(projects);

            // Check all checkboxes by default and apply filters
            function checkAllCheckboxes() {
                document
                    .querySelectorAll(
                        ".programCheckbox, .statusCheckbox, .selectAllCheckbox"
                    )
                    .forEach((checkbox) => {
                        checkbox.checked = false;
                    });
                applyFilters();
            }

            // Event listener for the Clear Filters button
            document
                .getElementById("clearFiltersBtn")
                .addEventListener("click", clearAllFilters);

            // Call the function to uncheck all checkboxes by default and apply filters
            checkAllCheckboxes();
</script>

@endsection