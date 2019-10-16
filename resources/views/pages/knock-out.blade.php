@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')
@php ($i = 0)
<div class="container">
    <div class="row">
        @php ($i = 0)
        @foreach($checkedin as $player)
        @if($i < 5)
            <div class="col-3">
                <div class="widget-holder">
                        <div class="checkin-plaats">
                                <a href="#" data-id="{{$player->id}}" data-points="{{ $points - $player->start_position }}" data-name="{{$player->name}}"  data-toggle="modal" data-target=".bs-modal-md" class="exit-btn">
                                <div class="checkin-image-4col">
                                    <img src="{{ $player['avatar_url'] }}">
                                </div>
                                <div class="checkin-plaats">
                                    <div class="checkin-naam">
                                        <div class="naambox" id="opstelling-{{ $loop->iteration }}">
                                            {{$player->name}}{{$points}}
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
                        <form id="exit-form" action=""  value="{{$points}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" id="exit-points-val" name="points">
                            <button type="submit" class="btn btn-danger ripple text-left">Ja, afmelden</button>
                        </form>
                        <button type="button" class="btn btn-outline-secondary ripple text-left" data-dismiss="modal"><input name="points" type="hidden" value="{{$points}}">Annuleren</button>
                        <li>
                            
                        </li>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
    </div>
        <div class="row">
        Aantal spelers vooraf: 
        Aantal spelers nu: 
        </div>
</div>
</div>



@endsection
@push('footer-scripts')
<script>
        jQuery(document).ready(function($) {
            $('.exit-btn').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var points = $(this).data('points');
                $('.exit-player').empty().text(name);
                $('.exit-points').empty().text(points);
                $('#exit-form').attr('action', '/knock-out/' + id);
                $('#exit-points-val').val(points);
            });
        });
    </script>
@endpush