@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 30px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Uprawnienia użytkowników</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createRoleBtn" data-bs-toggle="modal" data-bs-target=".assignRole">Dodaj uprawnienia użytkownikowi</button>
                    </div>
                        <div class="card-body">
                            <table class=" table table-hover table-bordered table-condensed" id="assigned-roles-all">
                                <thead>
                                    <th>#</th>
                                    <th>Użytkownik</th>
                                    <th>Poziom uprawnień</th>
                                    <th>Akcje</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    @include('users.assignRole-modal')
    @include('users.editRole-modal')
@endsection

@section('javascript')
    const getAsRolesUrl = "{{ route('get.as.roles') }}";
    const getUserRoleUrl = "{{ route('get.user.role')}}"


    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


@endsection
@section('js-files')
    <script src="{{ asset('js/assignedRoles.js') }}"></script>
@endsection
