<div class="modal fade editDepot" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja danych depotu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('update.depot.details') ?>" method="post" id="update-depot-form">
                    @csrf
                    <input type="hidden" name="cid_depot">
                    <div class="form-group">
                        <label for="">Kod depotu</label>
                        <input type="text" class="form-control" name="name"placeholder="Kod depotu">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Miasto</label>
                        <input type="text" class="form-control" name="city"placeholder="Wpisz miasto">
                        <span class="text-danger error-text city_error"></span>
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
