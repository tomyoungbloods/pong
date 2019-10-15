@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')

<h1>Hier komt de stand</h1>
<div class="row">
    @foreach ($players as $player)
    <div class="col-md-12">
        <div class="widget-holder">
            <div class="ranking-box">
                <div class="ranking">
                    <div class="naam-ranking">
                        <div class="rank-thumb">
                            <img src="{{ $player['avatar_url'] }}">
                        </div>
                        {{ $loop->iteration }}. {{$player['name']}}
                    </div>
                        <div class="punten-ranking">
                        {{$player['total_points']}}PTS
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
@push('footer-scripts')
@endpush