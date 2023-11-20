$(document).ready(function () {
    $('.table').DataTable({
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        language: {
            url: "/translation/nl.json",
        }
    });
});