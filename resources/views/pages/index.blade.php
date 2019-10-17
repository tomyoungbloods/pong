@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach ($topOfTable as $player)
        <div class="col-md-12" id="top{{ $loop->iteration }}">
            <div class="widget-holder">
                <div class="ranking-box">
                    <div class="ranking">
                        <div class="place">{{ $loop->iteration }}</div>
                            <div class="naam-ranking"> 
                                <div class="rank-thumb">
                                    <img src="{{ $player['avatar_url'] }}">
                                </div>
                                {{$player['name']}}
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
        @foreach ($players as $player)
        <div class="col-md-12" id="mainrank{{ $loop->iteration }}" >
                <div class="widget-holder">
                    <div class="ranking-box">
                        <div class="ranking">
                            <div class="place">{{ $loop->iteration }}</div>
                                <div class="naam-ranking"> 
                                    <div class="rank-thumb">
                                        <img src="{{ $player['avatar_url'] }}">
                                    </div>
                                    {{$player['name']}}
                                </div>
                                    <div class="punten-ranking">
                                    {{$player['total_points']}}<span class="pts">PTS</span>
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
</div>

@endsection
@push('footer-scripts')
@endpush