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
//Get all ramps
$('#ramps-all').DataTable({
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
    ajax: rampAllUrl,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'status', name: 'stat.status'},
        {data: 'power', name: 'power'},
        {data: 'actions', name: 'actions'},
    ]
});
//Create new ramp
$('#create-ramp-form').on('submit', function (e) {
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
                $('#ramps-all').DataTable().ajax.reload(null, false);
                $('.createRamp').modal('hide');
                $('.createRamp').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Delete ramp
$(document).on('click', '#deleteRampBtn', function () {
    var ramp_id = $(this).data('id');
    var url = rampDeleteUrl;
    Swal.fire({
        title: 'Czy na pewno chcesz ususnąć rampę z bazy danych?',
        showDenyButton: true,
        icon: 'question',
        confirmButtonText: 'Tak, usuń',
        confirmButtonColor: 'green',
        denyButtonText: `Anuluj`,
        allowOutsideClick: false,
    }).then(function (result) {
        if (result.value) {
            $.post(url, {ramp_id: ramp_id}, function (data) {
                if (data.code == 1) {
                    $('#ramps-all').DataTable().ajax.reload(null, false);
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
//Get ramp details
$(document).on('click', '#statusRampBtn', function () {
    var statusRamp_id = $(this).data('id');
    $('.editRampStatus').find('form')[0].reset();
    $('.editRampStatus').find('span.error-text').text('');
    $.post(rampDetailUrl, {statusRamp_id: statusRamp_id}, function (data) {
        $('.editRampStatus').find('input[name="cid_edit_ramp"]').val(data.details.id);
        $('.editRampStatus').find('input[name="name"]').val(data.details.name);
        $('.editRampStatus').find('select[name="status"]').val(data.details.status);
        $('.editRampStatus').find('select[name="power"]').val(data.details.power);
        $('.editRampStatus').modal('show');
    }, 'json');
});
//Update ramp details
$('#edit-ramp-status-form').on('submit', function (e) {
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
                $('#ramps-all').DataTable().ajax.reload(null, false);
                $('.editRampStatus').modal('hide');
                $('.editRampStatus').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    })
});
