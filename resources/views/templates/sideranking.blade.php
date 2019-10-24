<div class="siderank">
    <div class="row">
        <div class="col-12">
            <h2>All Time Ranking</h2>
        </div>
        @foreach ($topOfTable_all_time as $player)
        <div class="col-md-12" id="top{{ $loop->iteration }}">
            <div class="widget-holder">
                <div class="side-ranking-box">
                    <div class="side-ranking">
                        <div class="side-place">{{ $loop->iteration }}</div>
                            <div class="side-name-ranking"> 
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
        @foreach ($players_all_time as $player)
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
</div>
</div>
