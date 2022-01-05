//Docking track
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
