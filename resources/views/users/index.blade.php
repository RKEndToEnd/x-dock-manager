@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header container-fluid">Użytkownicy</div>
                        <div class="card-body">
                            <table class=" table table-hover table-bordered table-striped table-responsive-xl" id="users-all">
                                <thead>
                                    <th>#</th>
                                    <th>Imię</th>
                                    <th>Email</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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

    //Get all users
    $('#users-all').DataTable({
        processing:true,
        info:true,
        ajax:"{{ route('get.users.list') }}",
        columns:[
            {data:'id', name:'id'},
            {data:'name', name:'name'},
            {data:'email', name: 'email'},
        ]
    });

@endsection
