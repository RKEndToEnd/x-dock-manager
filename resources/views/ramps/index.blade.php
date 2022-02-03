@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md container-fluid">
                <div class="card">
                    <div class="card-header"><h4>Rampy</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createRampBtn" data-bs-toggle="modal" data-bs-target=".createRamp">Dodaj rampę</button>
                    </div>
                        <div class="card-body">
                            <table class=" table table-hover table-bordered table-striped table-responsive" id="ramps-all">
                                <thead>
                                    <th>#</th>
                                    <th>Oznaczenie rampy</th>
                                    <th>Status</th>
                                    <th>Zasilanie</th>
                                    <th>Akcje</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

    @include('ramps.create-modal')
@endsection

@section('javascript')
    const rampAllUrl = "{{ route('get.ramps.list') }}";
    const rampDeleteUrl = "{{ route('delete.ramp') }}";

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

@endsection

@section('js-files')
    <script src="{{ asset('js/ramp.js') }}"></script>
@endsection
