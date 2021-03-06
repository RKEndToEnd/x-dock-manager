@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 30px">
            <div class="col-md-6">
                <div class="card">
                    @hasrole('super-admin|admin')
                    <div class="card-header"><h4>Depoty</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createDepotBtn" data-bs-toggle="modal" data-bs-target=".createDepot">Dodaj depot</button>
                    </div>
                    @endhasrole
                    @hasrole('moderator')
                    <div class="card-header"><h4>Depoty</h4>
                        <button class="btn btn-sm btn-outline-primary" id="createDepotBtn" data-bs-toggle="modal" data-bs-target=".createDepot" disabled>Dodaj depot</button>
                    </div>
                    @endhasrole
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-condensed" id="depots-all">
                                <thead>
                                    <th>#</th>
                                    <th>Kod depotu</th>
                                    <th>Miejscowość</th>
                                    {{--<th>Mapa</th>--}}
                                    {{--<th>Nawigacja</th>--}}
                                    <th>Akcje</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

@include('depots.create-modal')
@include('depots.edit-modal')
@endsection

@section('javascript')
    const depotAllUrl = "{{ route('get.depots.list') }}/";
    const depotGetUrl ="{{ route('get.depot.details') }}";
    const depotDeleteUrl = "{{ route('delete.depot') }}";

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    //Map show - ONLY FOR TESTING
    {{--$(document).on('click','#trafficBtn', function (){
       var depot_map = $(this).data('id');
       $.get('<?= route("get.map") ?>',{depot_map:depot_map}, function(data){
           // alert(data.details.map_link);
            $('.traffic-map').find('input[name="cid_map"]').val(data.details.id);
            $('.traffic-map').find('div[name="map_link"]').val(data.details.map_link);
            $('.traffic-map').modal('show');
        },'json');
    });--}}

@endsection

@section('js-files')
    <script src="{{ asset('js/depot.js') }}"></script>
@endsection
