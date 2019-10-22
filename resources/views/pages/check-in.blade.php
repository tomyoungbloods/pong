@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')

<div id="players-loaded" class="container-fluid">
    
</div>
{{-- <div class="row">
        <div class="col-md-12 center">
        <button type="button" class="btn btn-ping-pong">
        <a href="{{route ("sessionBuilder")}}">
                Klik hier om de game te starten
            </a>
        </div>
    </div>
</div>   --}}
@endsection
@push('footer-scripts')
<script src="{{ asset('js/check-in.js') }}"></script>
@endpush