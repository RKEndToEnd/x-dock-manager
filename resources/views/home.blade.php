@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin: 30px;">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header text-center">{{ config('app.name') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        Jesteś zalogowany jako: {{ Auth::user()->name }} {{Auth::user()->surname}}, e-mail:{{Auth::user()->email}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
