<div class="modal fade loadStartTrack" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Rozpoczęcie operacji przeładunku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('load.start') ?>" method="post" id="load-start-track-form">
                    @csrf
                    <input type="hidden" name="cid_l_start_track">
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
                        <label for="">Rampa</label>
                        <input type="text" class="form-control" name="ramp"disabled>
                        <span class="text-danger error-text ramp_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="worker_id">ID pracownika</label>
                        <select id="worker_id" class="form-control" name="worker_id">
                            <option value="">Wybierz kod pracownika z listy</option>
                            @foreach($users as $user)
                                <option name="worker_id" value="{{ $user->id }}" >{{ $user->worker_id }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text worker_id_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Rozpocznij przeładunek</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
