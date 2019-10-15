<div class="row">
    @foreach ($players as $player)
        <div class="col-sm-2">
            <div class="widget-holder">
                <div class="checkin-plaats">
                    <div class="checkin-naam">
                        <a data-id="{{ $player->id }}" class="player-btn" href="#">
                                <div class="checkin-image">
                                        <img src="{{ $player['avatar_url'] }}">
                                </div>
                            <div class="naambox @if($player->checked)checked-in @endif">
                            {{$player->name}}
                            </div>
                        </a>
                    </div> 
                </div>
            </div>
        </div>
    @endforeach 
</div>