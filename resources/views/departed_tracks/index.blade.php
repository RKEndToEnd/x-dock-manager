@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 30px">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h5>Trasy przeładowane</h5>


                    </div>
                    <div class="card-body">
                        <table style="width: 100%" class="table table-sm table-hover table-bordered compact"
                               id="tracks-departed">
                            <thead>
                            <th>#</th>
                            <th>Pojazd</th>
                            <th>Trasa</th>
                            <th>Typ trasy</th>
                            <th>MP</th>
                            <th>Godz. przyjazdu / wyjazdu</th>
                            <th>Podstawienie plan</th>
                            <th>Plac</th>
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
                            @hasrole('super-admin|admin|moderator')
                            <div class="btn-group">
                                <a href="{{ route('departed.tracks.export') }}">
                                    <button class="btn btn-sm btn-outline-primary" id="exportTrackBtn"><i
                                            class="far fa-file-excel"></i> Export tras do pliku
                                    </button>
                                </a>
                            </div>
                            @endhasrole
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <form action="{{ route('eta.filter') }}" method="get">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center"><h5>Filtry</h5></div>
                        <div class="card-body">
                            <div class="col-md">
                                <div class="text-center">
                                    <div class="header"><h6>Planowana data przyjazdu /
                                            wyjazdu</h6></div>
                                    <div class="input-group-sm">
                                        <input type="text" name="eta_date_start" id="eta_date_start"
                                               class="form-control text-center" placeholder="Data od:">
                                    </div>
                                    <div class="input-group-sm" style="margin-top: 5px">
                                        <input type="text" name="eta_date_end" id="eta_date_end"
                                               class="form-control text-center" placeholder="Data do:">
                                    </div>
                                    <div class="d-inline-block" style="margin-top: 10px">
                                        <button class="btn btn-sm btn-outline-success" type="submit" id="filter">
                                            Filtruj
                                        </button>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                    </div>
                </form>
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
