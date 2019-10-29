@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Aanmaken')
@section('description', '')
@section('content')

<div class="container">
    <div class="row">
        <h1>Voeg een categorie toe</h1>
    </div>
        <div class="row">
            <form method="POST" action="{{ route('categories.new') }}" enctype="multipart/form-data">
            @csrf
                <div>
                    <input type="text" name="name" placeholder="Categorie naam">
                </div>
                <div>
                    <button class="btn btn-ping-pong" type="submit">Maak een speler aan</button>
                </div>
            </form>
        </div>
        <div class="row">
            <form method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-ping-pong-alternatief">Delete</button>
            </form>
        </div>
</div>


@endsection
@push('footer-scripts')
@endpush