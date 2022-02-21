const Toast = Swal.mixin({
    icon:'success',
    showCloseButton:true,
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
//Get all depots
$('#depots-all').DataTable({
    processing:true,
    info:true,
    ajax: depotAllUrl,
    columns:[
        {data:'id', name:'id'},
        {data:'name', name:'name'},
        {data:'city', name:'city'},
        /*{data:'map_link', name:'map_link'},*/
        /*{data:'traffic', name:'traffic'},*/
        {data:'actions', name:'actions'},
    ]
});
//Create new depot
$('#create-depot-form').on('submit', function (e){
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
                $('#depots-all').DataTable().ajax.reload(null,false);
                $('.createDepot').modal('hide');
                $('.createDepot').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    });
});
//Edit depot - get details
$(document).on('click', '#editDepotBtn', function (){
    var depot_id = $(this).data('id');
    /*$('.editDepot').find('form')[0].reset();
    $('.editDepot').find('span.error-text').text('');*/
    $.post(depotGetUrl,{depot_id:depot_id}, function(data){
        $('.editDepot').find('input[name="cid_depot"]').val(data.details.id);
        $('.editDepot').find('input[name="name"]').val(data.details.name);
        $('.editDepot').find('input[name="city"]').val(data.details.city);
        $('.editDepot').modal('show');
    },'json');
});
//Update depot details
$('#update-depot-form').on('submit', function (e){
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
                $('#depots-all').DataTable().ajax.reload(null,false);
                $('.editDepot').modal('hide');
                $('.editDepot').find('form')[0].reset();
                Toast.fire(data.msg);
            }
        }
    })
});
//Delete depot
$(document).on('click','#deleteDepotBtn', function (){
    var depot_id = $(this).data('id');
    var url = depotDeleteUrl;
    Swal.fire({
        title: 'Czy na pewno chcesz ususnąć depot z bazy danych?',
        showDenyButton: true,
        icon:'question',
        confirmButtonText: 'Tak, usuń',
        confirmButtonColor:'green',
        denyButtonText: `Anuluj`,
        allowOutsideClick:false,
    }).then(function (result){
        if(result.value){
            $.post(url,{depot_id:depot_id}, function(data){
                if(data.code == 1){
                    $('#depots-all').DataTable().ajax.reload(null, false);
                    const Toast = Swal.mixin({
                        icon:'error',
                        showCloseButton:true,
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
                }else{
                    Toast.fire(data.msg);
                }
            },'json');
        }
    });
});
