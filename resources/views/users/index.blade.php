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
                                    <th>Nazwisko</th>
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
    const getUsersUrl = "{{ route('get.users.list') }}";
    const getUserUrl = "{{ route('get.user.details') }}";
    const deleteUserUrl = "{{ route('delete.user') }}";

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    //Add new user - testing, will be replaced with modal
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

@endsection
@section('js-files')
    <script src="{{ asset('js/users.js') }}"></script>
@endsection
