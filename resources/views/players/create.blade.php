@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Aanmaken')
@section('description', '')
@section('content')

<div class="container">
    <div class="row">
        <h1>Voeg een speler toe</h1>
    </div>
        <div class="row">
            <form method="POST" action="{{ route('players.new') }}" enctype="multipart/form-data">
            @csrf
                <div>
                    <input type="text" name="name" placeholder="Naam Speler">
                </div>
                    {{-- <div class="form-group">
                        <input type="file" name="avatar">
                    </div> --}}
                        <div>
                            <button type="submit">Maak een speler aan</button>
                    </div>
            </form>
        </div>
</div>


@endsection
@push('footer-scripts')
@endpush