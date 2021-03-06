@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 30px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Użytkownicy</h4></div>
                    <div class="card-body">
                        <table class=" table table-hover table-bordered table-striped" id="users-all">
                            <thead>
                            <th>#</th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Depot</th>
                            <th>Akcje</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            @hasrole('super-admin|admin')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Dodawanie uzytkownika</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add.user') }}" id="create-user">
                            @csrf
                            <div class="form-group mb-3">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       autocomplete="name" autofocus placeholder="Imię">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input id="surname" type="text" class="form-control" name="surname"
                                       value="{{ old('surname') }}" autocomplete="surname" autofocus
                                       placeholder="Nazwisko">
                                <span class="text-danger error-text surname_error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" autocomplete="email" placeholder="Email">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <select id="depot_id" class="form-control" name="depot_id">
                                    <option value="">Depot - wybierz z listy</option>
                                    @foreach($depots as $depot)
                                        <option id="depot_id" name="depot_id"
                                                value="{{ $depot->id }}">{{ $depot->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text depot_id_error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input id="password" type="password" class="form-control" name="password"
                                       autocomplete="new-password" placeholder="Haslo">
                                <span class="text-danger error-text password_error"></span>
                            </div>
                            <div class="form-group mb-3">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password"
                                       placeholder="Powtórz hasło">
                                <span class="text-danger error-text password_confirmation_error"></span>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Dodaj użytkownika
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endhasrole
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
