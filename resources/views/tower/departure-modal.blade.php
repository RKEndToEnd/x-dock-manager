<div class="modal fade departureTrack" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Odjazd trasy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('track.departed') ?>" method="post" id="departure-form">
                    @csrf
                    <input type="hidden" name="cid_departure">
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
                        <select id="ramp" class="form-control" name="ramp" disabled>
                            @foreach($ramps as $ramp)
                                <option name="ramp" value="{{ $ramp->id }}">{{ $ramp->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text ramp_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">ID pracownika</label>
                        <select id="worker_id" class="form-control" name="worker_id" disabled>
                            @foreach($users as $user)
                                <option name="worker_id" value="{{ $user->id }}">{{ $user->worker_id }}</option>
                            @endforeach
                        </select>
                            <span class="text-danger error-text worker_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Zaplanowana godzina przyjazdu / wyjazdu</label>
                        <input type="text" class="form-control" name="eta" disabled>
                        <span class="text-danger error-text eta_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Zaplanowana godzina zakończenia przeładunku (dokumenty gotowe)</label>
                        <input type="text" class="form-control" name="doc_ready" disabled>
                        <span class="text-danger error-text doc_ready_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Rzewczywista godzina zakończenia operacji</label>
                        <input type="text" class="form-control" name="task_end" disabled>
                        <span class="text-danger error-text task_end_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Dokumenty gotowe do odbioru</label>
                        <input type="text" class="form-control" name="doc_ready" disabled>
                        <span class="text-danger error-text doc_ready_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Komentarz. UWAGA - w przypadku opóźnienia trasy komentarz jest wymagany.</label>
                        <input type="text" class="form-control" name="comment" disabled>
                        <span class="text-danger error-text comment_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-outline-primary" id="openDelay">Odjazd</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
