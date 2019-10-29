@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Aanmaken')
@section('description', '')
@section('content')

<div class="container">
    <div class="row">
        <h2>Voeg een speler toe</h2>
    </div>
        <div class="row widget-bg widget-body">
            <form method="POST" action="{{ route('players.new') }}" enctype="multipart/form-data">
            @csrf
                <div>
                    <input type="text" name="name" placeholder="Naam Speler" class="form-control mb-3">
                </div>
                    <div class="form-group">
                        <input type="file" name="avatar" class="form-control mb-3">
                    </div>
                        <div>
                            <button type="submit" class="btn btn-ping-pong">Maak een speler aan</button>
                    </div>
            </form>
        </div>
</div>


@endsection
@push('footer-scripts')
@endpush