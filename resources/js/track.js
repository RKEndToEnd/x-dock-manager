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
       {data:'actions',name:'actions',orderable:false, searchable:false},
   ]
}).on('draw',function (){
    $('input[name="track-checkbox"]').each(function (){
        this.checked = false;
    });
    $('input[name="tracks-checkbox"]').prop('checked', false);
    $('button#deleteAllMarkedBtn').addClass('d-none');

});
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
//Update depot details
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
