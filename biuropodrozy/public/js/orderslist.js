var Url = "http://127.0.0.1:8000/ordersModerator/update-order-status";
$(document).ready(function () {
    $('#myTable').dataTable({
        "responsive": true,
        "order": [
            [0, "asc"]
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [-1] }
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

    $('select[name="order_status"]').on('change', function(){
        var status = $(this).val();
        var orderId = $(this).data('order-id');
        var Data = '&status=' + status + '&order_id=' + orderId;
        // console.log(Data);
        $.ajax({
            url: Url,
            type: 'POST',
            data: Data,
            success: function(data) {
                console.log(data.success);
            }
        });
    });

});