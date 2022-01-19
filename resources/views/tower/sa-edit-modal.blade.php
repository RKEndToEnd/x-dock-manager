<div class="modal fade saEditTrack" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja trasy w trybie Super Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('update.track.details') ?>" method="post" id="update-track-form">
                    @csrf
                    <input type="hidden" name="cid_sa_track">
                    <div class="form-group">
                        <label for="">Środek transportu</label>
                        <input type="text" class="form-control" name="vehicle_id" placeholder="Numer rejestracyjny pojazdu">
                        <span class="text-danger error-text vehicle_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Numer trasy</label>
                        <input type="text" class="form-control" name="track_id" disabled>
                        <span class="text-danger error-text track_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Typ trasy</label>
                        <input type="text" class="form-control" name="track_type" placeholder="Typ trasy">
                        <span class="text-danger error-text track_type_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ilość miejsc paletowych</label>
                        <input type="text" class="form-control" name="freight" placeholder="Wpisz ilość miejsc paletowych">
                        <span class="text-danger error-text freight_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Zaplanowana godzina przyjazdu/wyjazdu</label>
                        <input type="text" class="form-control" name="eta" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text eta_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Zaplanowana godzina podstawienia</label>
                        <input type="text" class="form-control" name="docking_plan" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text docking_plan_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Rzeczywista godzina podstawienia</label>
                        <input type="text" class="form-control" name="docked_at" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text docked_at_plan_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">ID pracownika</label>
                        <input type="text" class="form-control" name="worker_id" placeholder="Wpisz ID pracownika">
                        <span class="text-danger error-text worker_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Rampa</label>
                        <input type="text" class="form-control" name="ramp" placeholder="Wpisz numer rampy">
                        <span class="text-danger error-text ramp_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Godzina rozpoczęcia operacji</label>
                        <input type="text" class="form-control" name="task_start" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text task_start_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Przewidywana godzina zakończenia operacji</label>
                        <input type="text" class="form-control" name="task_end_exp" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text task_end_exp_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Przewidywana godzina oddania dokumentów z magazynu</label>
                        <input type="text" class="form-control" name="doc_return_exp" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text doc_return_exp_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Rzewczywsita godzina zakończenia operacji</label>
                        <input type="text" class="form-control" name="task_end" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text task_end_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Dokumenty gotowe do odbioru</label>
                        <input type="text" class="form-control" name="doc_ready" placeholder="Wpisz w formacie: RRRR-DD-MM GG:MM">
                        <span class="text-danger error-text doc_ready_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Komentarz. UWAGA - w przypadku opóźnienia trasy komentarz jest wymagany.</label>
                        <input type="text" class="form-control" name="comment" placeholder="Wpisz wymagany komentarz do trasy">
                        <span class="text-danger error-text comment_error"></span>
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
