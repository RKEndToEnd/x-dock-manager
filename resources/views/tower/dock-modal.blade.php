<div class="modal fade dockTrack" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Podstawienie pod rampę</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('dock.track') ?>" method="post" id="dock-track-form">
                    @csrf
                    <input type="hidden" name="cid_dock_track">
                    <div class="form-group">
                        <label for="">Środek transportu</label>
                        <input type="text" class="form-control" name="vehicle_id" disabled>
                        <span class="text-danger error-text vehicle_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Numer trasy</label>
                        <input type="text" class="form-control" name="track_id"disabled>
                        <span class="text-danger error-text track_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="ramp">Rampa</label>
                        <select id="ramp" class="form-control" name="ramp">
                            <option value="">Wybierz rampę z listy</option>
                            @foreach($ramps as $ramp)
                                <option name="ramp" value="{{ $ramp->id }}" >{{ $ramp->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text ramp_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-outline-primary">Podstaw samochód pod rampę</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
