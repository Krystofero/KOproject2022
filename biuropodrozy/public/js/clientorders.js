$(document).ready(function () {
    $('#myTable').dataTable({
        "responsive": true,
        "order": [
            [0, "asc"]
        ],
        "columns": [
            null,
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            null,
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            { "sType": "polish-string" }
        ],
        "language": {
            "processing": "Przetwarzanie...",
            "search": "Szukaj:",
            "lengthMenu": "Pokaż _MENU_ pozycji",
            "info": "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
            "infoEmpty": "Pozycji 0 z 0 dostępnych",
            "infoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
            "loadingRecords": "Wczytywanie...",
            "zeroRecords": "Nie znaleziono pasujących pozycji",
            "paginate": {
                "first": "Pierwsza",
                "previous": "Poprzednia",
                "next": "Następna",
                "last": "Ostatnia"
            }
        }
    });
});