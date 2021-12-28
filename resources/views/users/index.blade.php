@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md container-fluid">
                <div class="card">
                    <div class="card-header"><h4>Użytkownicy</h4></div>
                        <div class="card-body">
                            <table class=" table table-hover table-bordered table-striped table-responsive" id="users-all">
                                <thead>
                                    <th>#</th>
                                    <th>Imię</th>
                                    <th>Email</th>
                                    <th>Depot</th>
                                    <th>Akcje</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dodawanie uzytkowników</div>
                    <div class="card-body">
                        <form action="{{ route('add.user') }}" method="post" id="add-user-form">
                            @csrf
                            <div class="form-group">
                                <label for="">Imię</label>
                                <input type="text" class="form-control" name="name" placeholder="Imię użytkownika">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="form-group>">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email użytkownika">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success">Dodaj użytkownika</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('users.edit-modal')
@endsection

@section('javascript')

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    //Get all users
    $('#users-all').DataTable({
        processing:true,
        info:true,
        ajax:"{{ route('get.users.list') }}",
        columns:[
            {data:'id', name:'id'},
            {data:'name', name:'name'},
            {data:'email', name: 'email'},
            {data:'depot_id', name:'depot_id'},
            {data:'actions', name:'actions'},
        ]
    });

    //Add new user
    $('#add-user-form').on('submit', function (e){
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
                        $(form)[0].reset();
                        alert(data.msg);
                    }
            }
        });
    });

    //Edit user
    $(document).on('click', '#editUserBtn', function (){
        var user_id = $(this).data('id');
        $('.editUser').find('form')[0].reset();
        $('.editUser').find('span.error-text').text('');
        $.post('<?= route("get.user.details") ?>',{user_id:user_id}, function(data){
            $('.editUser').find('input[name="cid"]').val(data.details.id);
            $('.editUser').find('input[name="name"]').val(data.details.name);
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
        var url = '<?= route("delete.user") ?>';
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
@endsection
