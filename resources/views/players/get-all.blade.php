@php
    $row_counter = 1;
@endphp
<div class="row">
    <table id="myTable">                
        @foreach ($players as $player)
            @php
                $open_row = false;
                $close_row = false;
                
                if($loop->iteration % 9 == 1) {
                    $open_row = true;
                }
                if($loop->iteration % 9 == 0) {
                    $close_row = true;
                }
                $active_class = " ";
                if($loop->first) {
                    $active_class = "active";
                }
            @endphp
            @if ($open_row)
                <tr id="l0{{ $row_counter }}">                    
                @php
                    $row_counter++;
                    $column_counter = 1;
                @endphp
            @endif
                <td id="l0{{ $row_counter - 1 }}_{{ $column_counter }}" class="{{ $active_class }}">
                        <div class="checkin-plaats move" tabindex="0">
                            <div class="checkin-naam">
                                <a data-id="{{ $player->id }}" class="player-btn player-{{ $loop->iteration }}" href="#">
                                        <div class="checkin-image">
                                                <img src="{{ $player['avatar_url'] }}">
                                        </div>
                                    <div class="naambox @if($player->checked)checked-in @endif">
                                    {{$player->name}}
                                    </div>
                                </a>
                            </div> 
                        </div>
                </td>
                @php($column_counter++)
            @if ($close_row)
                </tr>
            @endif
        @endforeach 
    </table>
</div>