//Get all tracks
$('#tracks-all').DataTable({
   processing:true,
   info:true,
   ajax: trackAllUrl,
   columns:[
       {data:'checkbox', name:'checkbox',orderable:false, searchable:false},
       {data:'DT_RowIndex', name:'DT_RowIndex'},
       {data:'vehicle_id', name:'vehicle_id'},
       {data:'track_id', name:'track_id'},
       {data:'track_type', name:'track_type'},
       {data:'freight', name:'freight'},
       {data:'eta', name:'eta'},
       {data:'docking_plan', name:'docking_plan'},
       {data:'docked_at', name:'docked_at'},
       {data:'ramp', name:'ramp'},
       {data:'worker_id', name:'worker_id'},
       {data:'task_start', name:'task_start'},
       {data:'task_end_exp', name:'task_end_exp'},
       {data:'doc_return_exp', name:'doc_return_exp'},
       {data:'task_end', name:'task_end'},
       {data:'doc_ready', name:'doc_ready'},
       {data:'comment', name:'comment'},
       {data:'departure',name:'departure',orderable:false, searchable:false},
       {data:'actions',name:'actions',orderable:false, searchable:false},
   ]
}).on('draw',function (){
    $('input[name="track-checkbox"]').each(function (){
        this.checked = false;
    });
    $('input[name="tracks-checkbox"]').prop('checked', false);
    $('button#deleteAllMarkedBtn').addClass('d-none');
});
//testing
/*$(document).on('click','tr',function(){
    var worker_id = $(this).data('id')
    alert(worker_id);
})*/
//Create new track
$('#create-track-form').on('submit', function (e){
    e.preventDefault()
    var form = this;
    $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:new FormData(form),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function (){
            $(form).find('span.error-text').text('')
        },
        success:function (data){
            if(data.code == 0){
                $.each(data.error, function (prefix, val){
                    $(form).find('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                $('#tracks-all').DataTable().ajax.reload(null,false);
                $('.createTrack').modal('hide');
                $('.createTrack').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    });
});
//Edit track - get details
$(document).on('click', '#editTrackBtn', function (){
    var track_id = $(this).data('id');
    $('.editTrack').find('form')[0].reset();
    $('.editTrack').find('span.error-text').text('');
    $.post(trackGetUrl,{track_id:track_id}, function(data){
        $('.editTrack').find('input[name="cid_track"]').val(data.details.id);
        $('.editTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
        $('.editTrack').find('input[name="track_id"]').val(data.details.track_id);
        $('.editTrack').find('input[name="track_type"]').val(data.details.track_type);
        $('.editTrack').find('input[name="freight"]').val(data.details.freight);
        $('.editTrack').find('input[name="eta"]').val(data.details.eta);
        $('.editTrack').modal('show');
    },'json');
});
//Update track details
$('#update-track-form').on('submit', function (e){
    e.preventDefault();
    var form = this;
    $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:new FormData(form),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend: function (){
            $(form).find('span.error-text').text('');
        },
        success: function (data){
            if (data.code == 0){
                $.each(data.error, function (prefix, val){
                    $(form).find('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                $('#tracks-all').DataTable().ajax.reload(null,false);
                $('.editTrack').modal('hide');
                $('.editTrack').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    })
});
//Delete track
$(document).on('click','#deleteTrackBtn', function (){
    var track_id = $(this).data('id');
    var url = trackDeleteUrl;
    Swal.fire({
        title: 'Czy na pewno chcesz ususnąć trasę z bazy danych?',
        showDenyButton: true,
        confirmButtonText: 'Tak, usuń',
        denyButtonText: `Anuluj`,
        allowOutsideClick:false,
    }).then(function (result){
        if(result.value){
            $.post(url,{track_id:track_id}, function(data){
                if(data.code == 1){
                    $('#tracks-all').DataTable().ajax.reload(null, false);
                    Swal.fire(data.msg);
                }else{
                    Swal.fire(data.msg);
                }
            },'json');
        }
    });
});
//Checkbox marking
$(document).on('click','input[name="tracks-checkbox"]', function (){
   if (this.checked){
       $('input[name="track-checkbox"]').each(function (){
           this.checked=true;
       });
   }else{
       $('input[name="track-checkbox"]').each(function (){
           this.checked=false;
       })
   }
    toggledeleteAllMarkedBtn();
});
$(document).on('change','input[name="track-checkbox"]',function (){
   if ($('input[name="track-checkbox"]').length == $('input[name="track-checkbox"]:checked').length){
       $('input[name="tracks-checkbox"]').prop('checked',true);
   }else{
       $('input[name="tracks-checkbox"]').prop('checked',false);
   }
    toggledeleteAllMarkedBtn();
});
//deleteAllMarkedBtn hiding
function toggledeleteAllMarkedBtn(){
    if ($('input[name="track-checkbox"]:checked').length > 0){
        $('button#deleteAllMarkedBtn').text('Usuń ('+$('input[name="track-checkbox"]:checked').length+')').removeClass('d-none');
    }else{
        $('button#deleteAllMarkedBtn').addClass('d-none');
    }
}
//Deleting marked tracks
$(document).on('click', 'button#deleteAllMarkedBtn', function (){
    var checkedTracks = [];
    $('input[name="track-checkbox"]:checked').each(function (){
       checkedTracks.push($(this).data('id'));
    })
    var url = trackBulkDeleteUrl;
    if (checkedTracks.length > 0){
        Swal.fire({
            title: 'Potwierdź!',
            html:'Czy na pewno usunąć zaznaczone <b>('+checkedTracks.length+')</b> trasy?',
            showDenyButton: true,
            confirmButtonText: 'Tak, usuń',
            denyButtonText: `Anuluj`,
            allowOutsideClick:false,
        }).then(function (result){
            if (result.value){
                $.post(url,{tracks_ids:checkedTracks},function (data) {
                    if (data.code == 1) {
                        $('#tracks-all').DataTable().ajax.reload(null, true);
                        Swal.fire(data.msg);
                    }
                },'json');
            }
        })
    }
});
//Super Admin edit data
$(document).on('click','#saEditTrackBtn', function (){
    var track_id = $(this).data('id');
    /*$('.saEditTrack').find('form')[0].reset();
    $('.saEditTrack').find('span.error-text').text('');*/
    $.post(saEditUrl,{track_id:track_id}, function (data){
         $('.saEditTrack').find('input[name="cid_sa_track"]').val(data.details.id);
         $('.saEditTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
         $('.saEditTrack').find('input[name="track_id"]').val(data.details.track_id);
         $('.saEditTrack').find('input[name="track_type"]').val(data.details.track_type);
         $('.saEditTrack').find('input[name="freight"]').val(data.details.freight);
         $('.saEditTrack').find('input[name="eta"]').val(data.details.eta);
         $('.saEditTrack').find('input[name="docking_plan"]').val(data.details.docking_plan);
         $('.saEditTrack').find('input[name="docked_at"]').val(data.details.docked_at);
         $('.saEditTrack').find('input[name="worker_id"]').val(data.details.worker_id);
         $('.saEditTrack').find('input[name="ramp"]').val(data.details.ramp);
         $('.saEditTrack').find('input[name="task_start"]').val(data.details.task_start);
         $('.saEditTrack').find('input[name="task_end_exp"]').val(data.details.task_end_exp);
         $('.saEditTrack').find('input[name="doc_return_exp"]').val(data.details.doc_return_exp);
         $('.saEditTrack').find('input[name="task_end"]').val(data.details.task_end);
         $('.saEditTrack').find('input[name="doc_ready"]').val(data.details.doc_ready);
         $('.saEditTrack').find('input[name="comment"]').val(data.details.comment);
         $('.saEditTrack').modal('show');
    },'json');
});
//Super Admin update track data
$('#sa-update-track-form').on('submit', function (e){
    e.preventDefault();
    var form = this;
    $.ajax({
        url:$(form).attr('action'),
        method:$(form).attr('method'),
        data:new FormData(form),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend: function (){
            $(form).find('span.error-text').text('');
        },
        success: function (data){
            if (data.code == 0){
                $.each(data.error, function (prefix, val){
                    $(form).find('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                $('#tracks-all').DataTable().ajax.reload(null,false);
                $('.saEditTrack').modal('hide');
                $('.saEditTrack').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    })
});
