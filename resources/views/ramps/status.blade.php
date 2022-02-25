@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 30px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Statusy ramp</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createStatusBtn" data-bs-toggle="modal" data-bs-target=".createStatus">Dodaj status</button>
                    </div>
                        <div class="card-body">
                            <table class=" table table-hover  table-bordered" id="ramp-status-all">
                                <thead>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Akcje</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

    @include('ramps.createStatus-modal')
    @include('ramps.editStatus-modal')
@endsection

@section('javascript')
    const statusAllUrl = "{{ route('get.statuses.list') }}";
    const statusDeleteUrl = "{{ route('delete.status') }}";
    const statusDetailUrl = "{{ route('get.status.details')}}";


    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

@endsection

@section('js-files')
    <script src="{{ asset('js/rampStatus.js') }}"></script>
@endsection
