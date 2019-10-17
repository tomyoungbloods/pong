@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Aanmaken')
@section('description', '')
@section('content')

<div class="container">
    <div class="row">
        <h1>Bewerk Speler</h1>
    </div>
        <div class="row">
            <form method="POST" action="{{ route('players.edit', ['id' => $player->id]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                    <div>
                        <input type="text" name="name" placeholder="Naam Speler" value="{{ $player->name }}">
                    </div>
                        <div class="form-group">
                            <input type="file" name="avatar">
                        </div>
                            <div>
                                <button class="btn btn-ping-pong" type="submit">Maak een speler aan</button>
                            </div>
            </form>
        </div>
        <div class="row">
            <form method="POST" action="{{ route('players.destroy', ['id' => $player->id]) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-ping-pong-alternatief" >Delete</button>
            </form>
</div>

</div>


@endsection
@push('footer-scripts')
@endpush