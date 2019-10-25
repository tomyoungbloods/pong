<div class="siderank">
    <div class="row">
            <div class="col-12">
                    <h2 class="side-title">ALL TIME RANKING</h2>
            </div>
    </div>
       
    <div class="row">
        @foreach ($players_all_time as $player)
        <div class="col-md-12 side-wrapper" id="side-mainrank{{ $loop->iteration }}" >
                <div class="widget-holder">
                    <div class="side-ranking-box">
                        <div class="side-ranking">
                            <div class="side-naam-ranking"> 
                                <div class="side-rank-thumb">
                                    <img src="{{ $player['avatar_url'] }}">
                                </div>
                                <div class="side-place">{{ $loop->iteration }} {{$player['name']}}</div>
                            </div>
                                <div class="side-punten-ranking">
                                    <span class="pts-wrap">
                                        {{$player['total_points']}}<span class="pts">PTS</span>
                                    </span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
