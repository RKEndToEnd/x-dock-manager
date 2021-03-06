const Toast = Swal.mixin({
    icon: 'success',
    showCloseButton: true,
    toast: true,
    position: 'center',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
//Get all roles
$('#roles-all').DataTable({
    processing: true,
    info: true,
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
    },
    ajax: getRolesUrl,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'guard_name', name: 'guard_name'},
    ]
});
//Create new role
$('#create-role-form').on('submit', function (e) {
    e.preventDefault()
    var form = this;
    $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
            $(form).find('span.error-text').text('')
        },
        success: function (data) {
            if (data.code == 0) {
                $.each(data.error, function (prefix, val) {
                    $(form).find('span.' + prefix + '_error').text(val[0]);
                });
            } else {
                $('#roles-all').DataTable().ajax.reload(null, false);
                $('.createRole').modal('hide');
                $('.createRole').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
