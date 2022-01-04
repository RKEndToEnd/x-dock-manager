//Get all users
$('#users-all').DataTable({
    processing:true,
    info:true,
    ajax:getUsersUrl,
    columns:[
        {data:'id', name:'id'},
        {data:'name', name:'name'},
        {data:'surname', name:'surname'},
        {data:'email', name: 'email'},
        {data:'depot_id', name:'depot_id'},
        {data:'actions', name:'actions'},
    ]
});
//Edit user
$(document).on('click', '#editUserBtn', function (){
    var user_id = $(this).data('id');
    $('.editUser').find('form')[0].reset();
    $('.editUser').find('span.error-text').text('');
    $.post(getUserUrl,{user_id:user_id}, function(data){
        $('.editUser').find('input[name="cid"]').val(data.details.id);
        $('.editUser').find('input[name="name"]').val(data.details.name);
        $('.editUser').find('input[name="surname"]').val(data.details.surname);
        $('.editUser').find('input[name="email"]').val(data.details.email);
        $('.editUser').find('input[name="depot_id"]').val(data.details.depot_id);
        $('.editUser').modal('show');
    },'json');
});
//Update user details
$('#update-user-form').on('submit', function (e){
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
                $('#users-all').DataTable().ajax.reload(null,false);
                $('.editUser').modal('hide');
                $('.editUser').find('form')[0].reset();
                Swal.fire(data.msg);
            }
        }
    })
});
//Delete user
$(document).on('click','#deleteUserBtn', function (){
    var user_id = $(this).data('id');
    var url = deleteUserUrl;
    Swal.fire({
        title: 'Czy na pewno chcesz ususnąć użytkownika z bazy danych?',
        showDenyButton: true,
        confirmButtonText: 'Tak, usuń',
        denyButtonText: `Anuluj`,
        allowOutsideClick:false,
    }).then(function (result){
        if(result.value){
            $.post(url,{user_id:user_id}, function(data){
                if(data.code == 1){
                    $('#users-all').DataTable().ajax.reload(null, false);
                    Swal.fire(data.msg);
                }else{
                    Swal.fire(data.msg);
                }
            },'json');
        }
    });
});