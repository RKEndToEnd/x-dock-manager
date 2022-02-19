@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md container-fluid">
                <div class="card">
                    <div class="card-header"><h4>Przeładunki - tablica operacyjna</h4>
                        <div>
                        <button class="btn btn-sm btn-outline-primary" id="createTrackBtn" data-bs-toggle="modal" data-bs-target=".createTrack"><i class="fas fa-plus"></i> Dodaj trasę</button>
                        <button class="btn btn-sm btn-outline-primary" id="importTrackBtn" data-bs-toggle="modal" data-bs-target=".importTrack"><i class="far fa-file-excel"></i> Import trasy z pliku</button>
                        <button class="btn btn-sm btn-outline-primary" id="refreshTrackBtn" ><i class="fas fa-sync-alt"></i> Odśwież</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered compact" id="tracks-all">
                            <thead>
                            <th><input type="checkbox" name="tracks-checkbox"><label></label></th>
                            <th>#</th>
                            <th>Pojazd</th>
                            <th>Trasa</th>
                            <th>Typ trasy</th>
                            <th>MP</th>
                            <th>Godz. przyjazdu / wyjazdu</th>
                            <th>Podstawienie plan</th>
                            <th>Podstawiono</th>
                            <th>Rampa</th>
                            <th>ID</th>
                            <th>Operacja START</th>
                            <th>STOP PLAN</th>
                            <th>Dokumenty PLAN</th>
                            <th>Operacja STOP</th>
                            <th>Dokumenty gotowe</th>
                            <th>Komentarz</th>
                            <th>Wyjazd</th>
                            <th>Akcje<button class="btn btn-sm btn-danger d-none" id="deleteAllMarkedBtn">Usuń zaznaczone<i class="fas fa-trash-alt"></i></button></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="col-md-1">
                        <table class="table table-sm table-borderless" id="ramp-schema">
                            <thead class="">
                            <th class=""></th>
                            </thead>
                            <tbody class=""></tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('tower.create-modal')
    @include('tower.import-track-modal')
    @include('tower.sa-edit-modal')
    @include('tower.edit-modal')
    @include('tower.dock-modal')
    @include('tower.load-start-modal')
    @include('tower.load-stop-modal')
    @include('tower.doc-ready-modal')
    @include('tower.departure-modal')
@endsection

@section('javascript')
    const trackAllUrl = "{{ route('get.track.list') }}/";
    const trackGetUrl ="{{ route('get.track.details') }}";
    const trackDeleteUrl ="{{ route('delete.track') }}";
    const dockDataUrl = "{{ route('get.dock.data.track') }}";
    const loadStartUrl = "{{ route('get.load.start.data') }}";
    const trackBulkDeleteUrl = "{{ route('bulk.delete.track') }}";
    const loadStopUrl = "{{ route('get.load.stop.data') }}";
    const docReadyUrl = "{{ route('get.doc.ready.data') }}";
    const saEditUrl = "{{ route('get.sa.edit.data') }}";
    const departureUrl = "{{ route('get.departure.data') }}"
    const importUpdtUrl = "{{ route('import.update') }}"
    const rampAllUrl = "{{ route('get.ramps.list') }}";

    $.ajaxSetup({
    headers:{
    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

@endsection

@section('js-files')
    <script src="{{ asset('js/track.js') }}"></script>
    <script src="{{ asset('js/trackOps.js') }}"></script>
@endsection
