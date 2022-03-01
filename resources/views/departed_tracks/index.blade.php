@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 30px">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header"><h4>Trasy przeładowane</h4>
                        @hasrole('super-admin|admin|moderator')
                        <div>
                            <a href="{{ route('departed.tracks.export') }}">
                                <button  class="btn btn-sm btn-outline-primary" id="exportTrackBtn"><i class="far fa-file-excel"></i> Export tras do pliku</button>
                            </a>
                        </div>
                        @endhasrole
                    </div>
                    <div class="card-body">
                        <table style="width: 100%" class="table table-sm table-hover table-bordered compact"  id="tracks-departed">
                            <thead >
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
    const departedTrackGetUrl = "{{ route('get.departed.track.list') }}";

    $.ajaxSetup({
    headers:{
    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

@endsection

@section('js-files')
    <script src="{{ asset('js/departedTracks.js') }}"></script>
@endsection
