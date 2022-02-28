<div class="modal fade createStatus" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dodawanie statusu rampy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('create.status') ?>" method="post" id="create-status-form">
                    @csrf
                    <input type="hidden" name="cid_create_status">
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" class="form-control" name="status" placeholder="Wpisz status">
                        <span class="text-danger error-text status_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-outline-primary">Dodaj status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
