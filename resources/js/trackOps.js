const Toast = Swal.mixin({
    icon: 'info',
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
//Docking track get data
$(document).on('click', '#dockTrackBtn', function () {
    var track_id = $(this).data('id');
    $.post(dockDataUrl, {track_id: track_id}, function (data) {
        $('.dockTrack').find('input[name="cid_dock_track"]').val(data.details.id);
        $('.dockTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
        $('.dockTrack').find('input[name="track_id"]').val(data.details.track_id);
        $('.dockTrack').find('input[name="ramp"]').val(data.details.ramp);
        $('.dockTrack').modal('show');
    }, 'json');
});
//Docking track update data
$('#dock-track-form').on('submit', function (e) {
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
                $('#ramp-schema').DataTable().ajax.reload(null, false);
                $('#tracks-all').DataTable().ajax.reload(null, false);

                $('.dockTrack').modal('hide');
                $('.dockTrack').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Load start track get data
$(document).on('click', '#startTrackBtn', function () {
    var track_id = $(this).data('id');
    $.post(loadStartUrl, {track_id: track_id}, function (data) {
        $('.loadStartTrack').find('input[name="cid_l_start_track"]').val(data.details.id);
        $('.loadStartTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
        $('.loadStartTrack').find('input[name="track_id"]').val(data.details.track_id);
        $('.loadStartTrack').find('select[name="ramp"]').val(data.details.ramp);
        $('.loadStartTrack').find('input[name="worker_id"]').val(data.details.worker_id);
        $('.loadStartTrack').modal('show');
    }, 'json');
});
//Load start track update data
$('#load-start-track-form').on('submit', function (e) {
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
                $('#tracks-all').DataTable().ajax.reload(null, false);
                $('.loadStartTrack').modal('hide');
                $('.loadStartTrack').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Load stop track get data
$(document).on('click', '#stopTrackBtn', function () {
    var track_id = $(this).data('id');
    $.post(loadStopUrl, {track_id: track_id}, function (data) {
        $('.loadStopTrack').find('input[name="cid_l_stop_track"]').val(data.details.id);
        $('.loadStopTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
        $('.loadStopTrack').find('input[name="track_id"]').val(data.details.track_id);
        $('.loadStopTrack').find('select[name="ramp"]').val(data.details.ramp);
        $('.loadStopTrack').find('select[name="worker_id"]').val(data.details.worker_id);
        $('.loadStopTrack').find('input[name="task_end_exp"]').val(data.details.task_end_exp);
        $('.loadStopTrack').modal('show');
    }, 'json');
});
//Load stop track update data
$('#load-stop-track-form').on('submit', function (e) {
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
                $('#tracks-all').DataTable().ajax.reload(null, false);
                $('.loadStopTrack').modal('hide');
                $('.loadStopTrack').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Documents ready data
$(document).on('click', '#docReadyBtn', function () {
    var track_id = $(this).data('id');
    $.post(docReadyUrl, {track_id: track_id}, function (data) {
        $('.docReady').find('input[name="cid_doc_ready"]').val(data.details.id);
        $('.docReady').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
        $('.docReady').find('input[name="track_id"]').val(data.details.track_id);
        $('.docReady').find('select[name="ramp"]').val(data.details.ramp);
        $('.docReady').find('select[name="worker_id"]').val(data.details.worker_id);
        $('.docReady').find('input[name="eta"]').val(data.details.eta);
        $('.docReady').find('input[name="doc_return_exp"]').val(data.details.doc_return_exp);
        $('.docReady').find('input[name="comment"]').val(data.details.comment);
        $('.docReady').modal('show');
    }, 'json');
});
//Documents ready update data
$('#doc-ready-form').on('submit', function (e) {
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
                /*}else if(data.code == 2){
                    $('#tracks-all').DataTable().ajax.reload(null, false);
                    $('.docReady').modal('hide');
                    $('.docReady').find('form')[0].reset();*/
            } else {
                $('#tracks-all').DataTable().ajax.reload(null, false);
                $('.docReady').modal('hide');
                $('.docReady').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Departure track data
$(document).on('click', '#departureTrackBtn', function () {
    var track_id = $(this).data('id');
    $.post(departureUrl, {track_id: track_id}, function (data) {
        $('.departureTrack').find('input[name="cid_departure"]').val(data.details.id);
        $('.departureTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
        $('.departureTrack').find('input[name="track_id"]').val(data.details.track_id);
        $('.departureTrack').find('select[name="ramp"]').val(data.details.ramp);
        $('.departureTrack').find('select[name="worker_id"]').val(data.details.worker_id);
        $('.departureTrack').find('input[name="eta"]').val(data.details.eta);
        $('.departureTrack').find('input[name="doc_ready"]').val(data.details.doc_ready);
        $('.departureTrack').find('input[name="task_end"]').val(data.details.task_end);
        $('.departureTrack').find('input[name="comment"]').val(data.details.comment);
        $('.departureTrack').modal('show');
    }, 'json');
});
//Departure track update data
$('#departure-form').on('submit', function (e) {
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
                $('#tracks-all').DataTable().ajax.reload(null, false);
                $('#ramp-schema').DataTable().ajax.reload(null, false);
                $('.departureTrack').modal('hide');
                $('.departureTrack').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Vehicle waiting in the area status
$(document).on('change', '.areaSwitch', function () {
    var area = $(this).prop('checked') == true ? 1 : 0;
    var track_id = $(this).data('id');
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: areaUrl,
        data: {
            'area': area,
            'track_id': track_id,
        }, success: function (data) {
            Toast.fire(data.msg);
        }
    });
});
