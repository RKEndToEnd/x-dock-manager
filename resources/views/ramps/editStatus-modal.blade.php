<div class="modal fade editStatus" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja statusu rampy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('update.status.details') ?>" method="post" id="edit-status-form">
                    @csrf
                    <input type="hidden" name="cid_edit_status">
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" class="form-control" name="status"placeholder="Status rampy">
                        <span class="text-danger error-text status_error"></span>
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
