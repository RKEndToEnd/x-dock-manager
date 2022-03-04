@if (session('status'))
    <div class="row">
        <div class="alert alert-success" id="al">
            {{ session('status') }}
        </div>
    </div>
@endif
