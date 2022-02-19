//Get asigned roles
$('#assigned-roles-all').DataTable({
    processing:true,
    info:true,
    ajax:getAsRolesUrl,
    columns:[
        {data:'DT_RowIndex', name:'DT_RowIndex'},
        {data:'user', name:'ruser.name'},
        {data:'role', name:'rrole.name'},
        {data:'actions', name:'actions'},
    ]
});
//Assign role to user
$('#assign-role-form').on('submit', function (e){
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
                $('#assigned-roles-all').DataTable().ajax.reload(null,false);
                $('.assignRole').modal('hide');
                $('.assignRole').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    });
});
