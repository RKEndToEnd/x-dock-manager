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
//Get all ramp statuses
$('#ramp-status-all').DataTable({
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
    ajax: statusAllUrl,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'status', name: 'status'},
        {data: 'actions', name: 'actions'},
    ]
});
//Create new ramp status
$('#create-status-form').on('submit', function (e) {
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
                $('#ramp-status-all').DataTable().ajax.reload(null, false);
                $('.createStatus').modal('hide');
                $('.createStatus').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Delete ramp status
$(document).on('click', '#deleteStatusBtn', function () {
    var status_id = $(this).data('id');
    var url = statusDeleteUrl;
    Swal.fire({
        title: 'Czy na pewno chcesz ususnąć status z bazy danych?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Tak, usuń',
        confirmButtonColor: 'green',
        denyButtonText: `Anuluj`,
        allowOutsideClick: false,
    }).then(function (result) {
        if (result.value) {
            $.post(url, {status_id: status_id}, function (data) {
                if (data.code == 1) {
                    $('#ramp-status-all').DataTable().ajax.reload(null, false);
                    const Toast = Swal.mixin({
                        icon: 'error',
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
                    Toast.fire(data.msg);
                } else {
                    Toast.fire(data.msg);
                }
            }, 'json');
        }
    });
});
//Get status details
$(document).on('click', '#editStatusBtn', function () {
    var status_id = $(this).data('id');
    $('.editStatus').find('form')[0].reset();
    $('.editStatus').find('span.error-text').text('');
    $.post(statusDetailUrl, {status_id: status_id}, function (data) {
        $('.editStatus').find('input[name="cid_edit_status"]').val(data.details.id);
        $('.editStatus').find('input[name="status"]').val(data.details.status);
        $('.editStatus').modal('show');
    }, 'json');
});
//Update status details
$('#edit-status-form').on('submit', function (e) {
    e.preventDefault();
    var form = this;
    $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
            $(form).find('span.error-text').text('');
        },
        success: function (data) {
            if (data.code == 0) {
                $.each(data.error, function (prefix, val) {
                    $(form).find('span.' + prefix + '_error').text(val[0]);
                });
            } else {
                $('#ramp-status-all').DataTable().ajax.reload(null, false);
                $('.editStatus').modal('hide');
                $('.editStatus').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    })
});
