@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 30px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Role użytkowników</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createRoleBtn" data-bs-toggle="modal" data-bs-target=".createRole">Dodaj rolę</button>
                    </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-condensed" id="roles-all">
                                <thead>
                                    <th>#</th>
                                    <th>Rola</th>
                                    <th>Guard Name</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    @include('users.createRole-modal')
@endsection

@section('javascript')
    const getRolesUrl = "{{ route('get.roles') }}";


    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });


@endsection
@section('js-files')
    <script src="{{ asset('js/roles.js') }}"></script>
@endsection
