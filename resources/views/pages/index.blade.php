@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')
<div class="container">
    <div class="row podium"> 
        @foreach ($topOfTable as $player)
            <div id="podium-{{ $loop->iteration }}" class="col-sm-4 podium">
                <div class="widget-holder">
                    <div class="podium-image">
                    <img src="{{ $player['avatar_url'] }}">
                    </div>
                        <div class="podium-plaats">
                            <div class="naam">
                            {{$player['name']}}
                            </div>
                                <div class="punten">
                                {{$player['total_points']}}PTS
                                </div>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
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
        <div class="row">
                <div class="col-md-12 center">
                <button type="button" class="btn btn-ping-pong">
                    <a href="check-in">
                        Klik hier om in te checken
                    </a>
                </div>
            </div>
        </div>  
</div>

@endsection
@push('footer-scripts')
@endpush