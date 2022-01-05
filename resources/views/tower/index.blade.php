@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md container-fluid">
                <div class="card">
                    <div class="card-header"><h4>Trasy - Tablica przyjazdów i wyjazdów</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createTrackBtn" data-bs-toggle="modal" data-bs-target=".createTrack">Dodaj trasę</button>
                    </div>
                    <div class="card-body">
                        <table class=" table table-hover table-bordered table-striped table-responsive" id="tracks-all">
                            <thead>
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
                            <th>Akcje</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('tower.create-modal')
@include('tower.edit-modal')
@include('tower.dock-modal')
@endsection

@section('javascript')
    const trackAllUrl = "{{ route('get.track.list') }}/";
    const trackGetUrl ="{{ route('get.track.details') }}";
    const trackDeleteUrl ="{{ route('delete.track') }}";
    const dockDataUrl = "{{ route('get.dock.data.track') }}";

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
