<div class="modal fade importTrack" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Import trasy z pliku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('track.import') }}" method="post" enctype="multipart/form-data" id="import-track-form">
                    @csrf
                    <div class="form-group">
                        <label for="file">Wybierz plik .csv lub .xlms</label>
                        <input type="file" name="file" class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-outline-primary">Import tras</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


