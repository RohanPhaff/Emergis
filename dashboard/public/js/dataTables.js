$(document).ready(function () {
    var table = $('.table').DataTable({
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        language: {
            url: "/translation/nl.json",
            searchPlaceholder: "Zoeken..."
        }
    });

    $('.filter-section input, .filter-section select').on('change', function () {
    });
});
