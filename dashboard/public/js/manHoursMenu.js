document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('department').addEventListener('change', function(event) {
        updateFunction(event, true);
    });

    function updateFunction(event, isChanged) {
        let allSelects = document.querySelectorAll('#department');
        let otherSelects = [];
        let currentIndex = null;

        if (isChanged) {
            currentIndex = Array.from(allSelects).indexOf(event.target);
        }

        otherSelects = Array.from(allSelects).filter(function (select, index) {
            return index !== currentIndex;
        });

        otherSelects.forEach(function (select) {
            currentSelectedValue = select.value;
            let options = select.querySelectorAll('option');
            options.forEach(function (option) {
                select.removeChild(option);
            });

            let defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Kies een afdeling';
            select.appendChild(defaultOption);

            let remainingDepartments = departments.filter(function (department) {
                return !document.querySelector('#department option[value="' + department.name + '"]:checked');
            });
            remainingDepartments.forEach(function (department) {
                let option = document.createElement('option');
                option.value = department.name;
                option.textContent = department.name;
                select.appendChild(option);

                if (department.name === currentSelectedValue) {
                    option.selected = true;
                }
            });
        });
    }

    function createForm() {
        let allSelects = document.querySelectorAll('#department');

        // Error check: before creating new form, all current forms must have a department selected.
        let areAllSelected = Array.from(allSelects).every(function (select) {
            return select.value !== '';
        });
        if (!areAllSelected) {
            alert('Selecteer een afdeling in elk bestaand formulier.');
            return;
        }

        // Error check: before creating new form, there must be a department left to choose.
        let remainingDepartments = departments.filter(function (department) {
            return !document.querySelector('#department option[value="' + department.name + '"]:checked');
        });
        if (remainingDepartments.length === 0) {
            alert('Geen afdelingen meer beschikbaar.');
            return;
        }

        let firstItem = document.querySelector('#small-container');
        if (!firstItem) {
            console.error('No item found.');
            return;
        }

        let newForm = firstItem.cloneNode(true);
        let departmentSelect = newForm.querySelector('#department');
        let manHoursInput = newForm.querySelector('#man_hours');

        if (!departmentSelect || !manHoursInput) {
            console.error('Required elements not found.');
            return;
        }

        departmentSelect.innerHTML = '';

        // Add a default option similar to "Kies een afdeling"
        let defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Kies een afdeling';
        departmentSelect.appendChild(defaultOption);

        remainingDepartments.forEach(function (department) {
            let option = document.createElement('option');
            option.value = department.name;
            option.textContent = department.name;
            departmentSelect.appendChild(option);
        });

        manHoursInput.value = '';

        let removeButton = document.createElement('button');
        removeButton.classList.add('remove-department-btn');
        removeButton.textContent = 'Verwijderen';
        removeButton.addEventListener('click', function () {
            newForm.remove();
            updateFunction(null, false);
        });
        newForm.appendChild(removeButton);
        

        // Voeg een event listener toe voor het change-evenement van de nieuwe select
        departmentSelect.addEventListener('change', function(event) {
            updateFunction(event, true);
        });

        document.getElementById('form-container').appendChild(newForm);
    }

    document.getElementById('add-department-btn').addEventListener('click', createForm);

    // Uncomment the line below if you want to create the initial form when the page loads
    // createForm();
});