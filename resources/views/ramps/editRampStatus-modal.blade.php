<div class="modal fade editRampStatus" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja statusu rampy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('update.ramp.status') ?>" method="post" id="edit-ramp-status-form">
                    @csrf
                    <input type="hidden" name="cid_edit_ramp">
                    <div class="form-group">
                        <label for="">Oznaczenie rampy</label>
                        <input type="text" class="form-control" name="name"placeholder="Oznaczenie rampy">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select id="status" class="form-control" name="status">
                            <option value="null">Wybierz status z listy</option>
                            @foreach($ramp_statuses as $status)
                                <option name="status" value="{{ $status->id }}" >{{ $status->status }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text status_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="power">Zasilanie przy rampie</label>
                        <select id="power" class="form-control" name="power">
                            <option value="null">Wybierz z listy</option>
                            <option value="Tak">Tak</option>
                            <option value="Nie">Nie</option>
                            <option value="Awaria">Awaria</option>
                        </select>
                        <span class="text-danger error-text power_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-outline-primary">Zapisz zmiany</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
