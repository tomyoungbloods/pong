@extends('layouts.app')

@push('header-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')

<div class="container-fluid">
    <div class="row">
    <div class="col-8 standing-box">
        <div class="row selection-pick">
                <div class="col-md-6">
                    <select id="week-changer" class="form-control selectpicker" title="Selecteer een week..." data-style="btn-dark">
                        @foreach ($week_selectors as $week)
                            <option value="{{ $week['url'] }}" @if ($weeks == $week['week_nr'])
                                selected
                            @endif>{{ $week['name'] }}</option>
                        @endforeach
                    </select>
                </div>
        </div>
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
                                        {{$player['name']}}<span> Vorm:</span> {{$player['last_four_games']}} 
                                    </div>
                                        <div class="punten-ranking">
                                            <span class="pts-wrap">
                                            {{$player['points_in_period']}}<span class="pts">PTS</span>
                                        </span>
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
                                        {{$player['name']}}<span> Vorm:</span> {{$player['last_four_games']}} 
                                    </div>
                                        <div class="punten-ranking">
                                            <span class="pts-wrap">
                                            {{$player['points_in_period']}}<span class="pts">PTS</span>
                                            </span>
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
                        <a href="/check-in">
                            Klik hier om in te checken
                        </a>
                    </div>
                </div>
            </div>  
    </div>
    <div class="col-4">
    @include('templates.sideranking')
    </div>
</div>
</div>


@endsection


@push('footer-scripts')
<script>
    $(function(){
        // bind change event to select
        $('#week-changer').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
@endpush