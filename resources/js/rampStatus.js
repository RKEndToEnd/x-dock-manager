//Get all ramp statuses
$('#ramp-status-all').DataTable({
    processing:true,
    info:true,
    ajax: statusAllUrl,
    columns:[
        {data:'DT_RowIndex', name:'DT_RowIndex'},
        {data:'status', name:'status'},
        {data:'actions', name:'actions'},
    ]
});
//Create new ramp status
$('#create-status-form').on('submit', function (e){
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
                $('#ramp-status-all').DataTable().ajax.reload(null,false);
                $('.createStatus').modal('hide');
                $('.createStatus').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    });
});
//Delete ramp status
$(document).on('click','#deleteStatusBtn', function (){
    var status_id = $(this).data('id');
    var url = statusDeleteUrl;
    Swal.fire({
        title: 'Czy na pewno chcesz ususnąć status z bazy danych?',
        showDenyButton: true,
        confirmButtonText: 'Tak, usuń',
        denyButtonText: `Anuluj`,
        allowOutsideClick:false,
    }).then(function (result){
        if(result.value){
            $.post(url,{status_id:status_id}, function(data){
                if(data.code == 1){
                    $('#ramp-status-all').DataTable().ajax.reload(null, false);
                    Swal.fire(data.msg);
                }else{
                    Swal.fire(data.msg);
                }
            },'json');
        }
    });
});
