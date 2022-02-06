<div class="modal fade createRamp" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dodawanie nowej Rampy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('create.ramp') ?>" method="post" id="create-ramp-form">
                    @csrf
                    <input type="hidden" name="cid_create_ramp">
                    <div class="form-group">
                        <label for="">Oznaczenie rampyu</label>
                        <input type="text" class="form-control" name="name"placeholder="Wpisz oznaczenie rampy">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" class="form-control" name="status"placeholder="Wpisz status">
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
                        <span class="text-danger error-text depot_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Dodaj rampę</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
