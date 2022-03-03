<div class="modal fade editRole" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja uprawnień użytkownika</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('assign.role') ?>" method="post" id="edit-assigned-role-form">
                    @csrf
                    {{--<input type="hidden" name="cid_create_role">--}}
                    <div class="form-group">
                        <label for="">Użytkownik</label>
                        <input type="text" class="form-control" name="model_id" placeholder="Użytkownik">
                        <span class="text-danger error-text model_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Poziom uprawnień</label>
                        <select id="role_id" class="form-control" name="role_id">
                            <option value="null">Wybierz poziom uprawnień z listy</option>
                            @foreach($roles as $role)
                                <option name="role_id" value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text role_id_error"></span>
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
