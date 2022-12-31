$(document).ready(function () {
    $('#myTable').dataTable({
        "responsive": true,
        "order": [
            [0, "asc"]
        ],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [-1] },
            { "width": "5%", "aTargets": [2, 3, 5, 6] }
        ],
        "columns": [
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            null,
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            { "sType": "polish-string" },
            null
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

    $(function () { 
        $('.delete').click(function () {
          var _this = this;
      
          Swal.fire({
            title: "Czy na pewno chcesz usunąć ofertę?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
          }).then(function (result) {
            if (result.value) {
              $.ajax({
                method: "DELETE",
                url: deleteUrl + $(_this).data("id")
              }).done(function (data) {
                window.location.reload();
              }).fail(function (data) {
                Swal.fire('Coś poszło nie tak...spróbuj ponownie później', data.responseJSON.message, data.responseJSON.status);
              });
            }
          });
			  });
	  	});
});