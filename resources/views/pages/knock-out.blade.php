@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')
@php ($i = 0)
<div class="container-fluid bg-knock-out">
    <div class="row full-height">
        @php ($i = 0)
        @foreach($checkedin as $player)
        @if($i < 3)
            <div class="col-3 knock-out-place{{ $loop->iteration }}">
                <div id="switch-{{ $loop->iteration }}" class="widget-holder knock-out-position">
                        <div class="checkin-plaats">
                                <a href="#" id="position-{{ $i }}" data-id="{{$player->id}}" data-points="{{ $player->point_count }}" data-name="{{$player->name}}"  data-toggle="modal" data-pos="{{ $i }}" data-target=".bs-modal-md" class="exit-btn">
                                <div class="checkin-image-4col">
                                    <img src="{{ $player['avatar_url'] }}">
                                </div>
                                <div class="knock-out-naam-wrapper">
                                    <div class="knock-out-naam">
                                        <div class="naambox" id="opstelling-{{ $loop->iteration }}">
                                            {{$player->name}} {{ $player->point_count }}
                                        </div> 
                                    </div> 
                                </div>
                            </a>
                        </div>
                </div>
            </div>   
            @endif   
            @php ($i++)  
        @endforeach        
    </div>
    <div id="playor-count" class="row">
        <div class="col-md-12 widget-body">
            Aantal spelers nu: {{$active_players_count}}
        </div>
    </div>
    
    
    </div>
    <div class="modal modal-danger fade bs-modal-md" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header text-inverse">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="exitModalLabel">Weet je zeker dat <span class="exit-player">Naam</span> af is?</h5>
                    </div>
                    <div class="modal-body">
                        <p>Je staat op het punt om <span class="exit-player">Naam</span> af te melden. <span class="exit-player">Naam</span> krijgt er <span class="exit-points">0</span> punten bij.</p>
                        <p>Klopt dit?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="exit-form" action=""  value="{{$player->point_count}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" id="exit-points-val" name="points">
                            <button type="submit" id="submit-loser" class="btn btn-danger ripple text-left">Ja, afmelden</button>
                        </form>
                        <button id="cancel-loser" type="button" class="btn btn-outline-secondary ripple text-left" data-dismiss="modal"><input name="points" type="hidden" value="{{$player->point_count}}">Annuleren</button>
                        <li>
                            
                        </li>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
</div>
</div>



@endsection
@push('footer-scripts')
<script>
        jQuery(document).ready(function($) {
            var check = false;
            var position;
            $(document).on('keypress',function(e) {

                console.log(check, position)

                if(!check){

                    if(e.keyCode == 114) {
                        $('#position-1').click();
                        position = 'right';
                    }
                    else if(e.keyCode == 108) {
                        $('#position-0').click();
                        position = 'left';
                    }

                    check = true;

                } else {

                    if((e.keyCode == 114 && position == 'right') || (e.keyCode == 108 && position == 'left')) {
                        $('#submit-loser').click();
                    } else {
                        $('#cancel-loser').click();
                    }

                    check = false;
                }

            });

            $('.exit-btn').click(function() {
                
                var id = $(this).data('id');
                var name = $(this).data('name');
                var points = $(this).data('points');
                var pos = $(this).data('pos');

                $('.exit-player').empty().text(name);
                $('.exit-points').empty().text(points);
                $('#exit-form').attr('action', '/knock-out/' + id + '/' + pos);
                $('#exit-points-val').val(points);
            });

        });
    </script>
@endpush