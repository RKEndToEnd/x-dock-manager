//Docking track get data
$(document).on('click','#dockTrackBtn', function (){
   var track_id = $(this).data('id');
        $.post(dockDataUrl,{track_id:track_id}, function (data){
            $('.dockTrack').find('input[name="cid_dock_track"]').val(data.details.id);
            $('.dockTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
            $('.dockTrack').find('input[name="track_id"]').val(data.details.track_id);
            $('.dockTrack').find('input[name="ramp"]').val(data.details.ramp);
            $('.dockTrack').modal('show');
        },'json');
});
//Docking track update data
$('#dock-track-form').on('submit', function (e){
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
        success: function(data){
            if(data.code == 0){
                $.each(data.error, function(prefix, val){
                    $(form).find('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                $('#tracks-all').DataTable().ajax.reload(null, false);
                $('.dockTrack').modal('hide');
                $('.dockTrack').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    });
});
//Load start get data
$(document).on('click','#startTrackBtn',function (){
    var track_id = $(this).data('id');
        $.post(loadStartUrl,{track_id:track_id}, function (data){
            $('.loadStartTrack').find('input[name="cid_l_start_track"]').val(data.details.id);
            $('.loadStartTrack').find('input[name="vehicle_id"]').val(data.details.vehicle_id);
            $('.loadStartTrack').find('input[name="track_id"]').val(data.details.track_id);
            $('.loadStartTrack').find('input[name="ramp"]').val(data.details.ramp);
            $('.loadStartTrack').find('input[name="worker_id"]').val(data.details.worker_id);
            $('.loadStartTrack').modal('show');
        },'json');
});
