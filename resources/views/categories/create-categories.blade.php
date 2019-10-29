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
        <div class="row widget-bg widget-body">
            <form method="POST" action="{{ route('categories.new') }}" enctype="multipart/form-data">
            @csrf
                <div>
                    <input type="text" class="form-control mb-3" name="name" placeholder="Categorie naam">
                </div>
                <div>
                    <button class="btn btn-ping-pong" type="submit">Voeg categorie toe</button>
                </div>
            </form>
        </div>
</div>


@endsection
@push('footer-scripts')
@endpush