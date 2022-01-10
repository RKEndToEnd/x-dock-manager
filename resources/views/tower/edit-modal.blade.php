<div class="modal fade editTrack" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja trasy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('update.track.details') ?>" method="post" id="update-track-form">
                    @csrf
                    <input type="hidden" name="cid_track">
                    <div class="form-group">
                        <label for="">Środek transportu</label>
                        <input type="text" class="form-control" name="vehicle_id"placeholder="Numer rejestracyjny pojazdu">
                        <span class="text-danger error-text vehicle_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Numer trasy</label>
                        <input type="text" class="form-control" name="track_id" disabled>
                        <span class="text-danger error-text track_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Typ trasy</label>
                        <input type="text" class="form-control" name="track_type"placeholder="Typ trasy">
                        <span class="text-danger error-text track_type_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ilość miejsc paletowych</label>
                        <input type="text" class="form-control" name="freight"placeholder="Wpisz ilość miejsc paletowych">
                        <span class="text-danger error-text freight_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Zaplanowana godzina przyjazdu/wyjazdu</label>
                        <input type="text" class="form-control" name="eta"placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text eta_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz wprowadzone zmiany</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
