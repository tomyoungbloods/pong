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
                                        {{$player['points_in_period']}}PTS
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                                        {{$player['points_in_period']}}<span class="pts">PTS</span>
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
    <div class="row">
            <form method="POST" action="/filter/{weeks?}" enctype="multipart/form-data">
                @csrf
                <select>
                        <option value="0">Deze week</option>
                        <option value="1">Vorige Week</option>
                        <option value="2">Twee weken geleden</option>
                        <option value="3">Drie weken geleden</option>
                      </select>
                      <button class="btn btn-ping-pong" type="submit">Maak een speler aan</button>
            </form>
    </div>
</div>

@endsection
@push('footer-scripts')
@endpush