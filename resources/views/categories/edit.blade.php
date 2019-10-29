@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Aanmaken')
@section('description', '')
@section('content')

<div class="container">
    <div class="row">
        <h1>Bewerk Categorie</h1>
    </div>
        <div class="row widget-bg widget-body">
            <form method="POST" action="{{ route('categories.edit', ['id' => $category->id]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                    <div>
                        <input class="form-control mb-3" type="text" name="name" placeholder="Naam categorie" value="{{ $category->name }}">
                    </div>
                    <div>
                        <button class="btn btn-ping-pong" type="submit">Bewerk categorie</button>
                    </div>
            </form>
        </div>
        <div class="row widget-bg widget-body">
            <form method="POST" action="{{ route('categories.destroy', ['id' => $category->id]) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-ping-pong-alternatief" >Delete</button>
            </form>
        </div>
            
            
            
        
</div>


@endsection
@push('footer-scripts')
@endpush