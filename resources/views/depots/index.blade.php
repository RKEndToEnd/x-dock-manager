@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md container-fluid">
                <div class="card">
                    <div class="card-header"><h4>Depoty</h4></div>
                        <div class="card-body">
                            <table class=" table table-hover table-bordered table-striped table-responsive" id="depots-all">
                                <thead>
                                    <th>#</th>
                                    <th>Oznaczenie</th>
                                    <th>Miejscowość</th>
                                    <th>Mapa</th>
                                    <th>Akcje</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    //Get all depots
    $('#depots-all').DataTable({
        processing:true,
        info:true,
        ajax:"{{ route('get.depots.list') }}",
        columns:[
            {data:'id', name:'id'},
            {data:'name', name:'name'},
            {data:'city', name:'city'},
            {data:'map_link', name: 'map_link'},
            {data:'actions', name:'actions'},
        ]
    });

    {{--//Add new user
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
    });--}}
@endsection
