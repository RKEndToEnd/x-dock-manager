<div class="modal fade createRole" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dodawanie nowej Roli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('create.role') ?>" method="post" id="create-role-form">
                    @csrf
                    {{--<input type="hidden" name="cid_create_role">--}}
                    <div class="form-group">
                        <label for="">Nazwa roli</label>
                        <input type="text" class="form-control" name="name"placeholder="Wpisz nazwę roli np: user">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Guard name</label>
                        <input type="text" class="form-control" name="guard_name"placeholder="Domyślnie: web">
                        <span class="text-danger error-text guard_name_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-outline-primary">Dodaj rolę</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
