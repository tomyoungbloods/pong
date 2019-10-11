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
        <div class="container">
            <div class="row">
                <ul>
                    @foreach ($players as $player)
                <li><a href ="players/edit/{{$player->id}}">{{$player->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
</div>


@endsection
@push('footer-scripts')
@endpush