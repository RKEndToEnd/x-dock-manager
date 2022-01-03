<div class="modal fade createDepot" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dodawanie nowego Depotu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('create.depot') ?>" method="post" id="create-depot-form">
                    @csrf
                    <input type="hidden" name="cid_create_depot">
                    <div class="form-group">
                        <label for="">Kod depotu</label>
                        <input type="text" class="form-control" name="name"placeholder="Wpisz kod depotu">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Miejscowość</label>
                        <input type="text" class="form-control" name="city"placeholder="Wpisz miejscowość">
                        <span class="text-danger error-text city_error"></span>
                    </div>
                    {{--<div class="form-group">
                        <label for="">Mapa</label>
                        <input type="text" class="form-control" name="map_link"placeholder="Wstaw link do mapy">
                        <span class="text-danger error-text map_link_error"></span>
                    </div>--}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Dodaj depot</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
