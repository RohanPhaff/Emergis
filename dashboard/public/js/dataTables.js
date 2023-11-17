$(document).ready(function () {
    $('.table').DataTable({
        "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
        language: {
            url: "/translation/nl.json",
        }
    });
});