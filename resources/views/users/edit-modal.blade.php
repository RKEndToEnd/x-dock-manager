<div class="modal fade editUser" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edycja użytkownika</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('update.user.details') ?>" method="post" id="update-user-form">
                    @csrf
                    <input type="hidden" name="cid">
                    <div class="form-group">
                        <label for="">Imię</label>
                        <input type="text" class="form-control" name="name"placeholder="Wpisz imię">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email"placeholder="Wpisz email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Depot</label>
                        <select class="form-control" name="depot_id">
                            <option>Brak</option>
                            @foreach($depots as $depot)
                                <option value="{{ $depot->id }}" @if(!is_null($depot->depot_id) && $depot->depot_id->id == $depot->id))selected @endif>{{ $depot->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text depot_id_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
