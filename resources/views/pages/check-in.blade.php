@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Standing')
@section('description', '')
@section('content')

<div id="players-loaded" class="container">
    
</div>
@endsection
@push('footer-scripts')
<script src="{{ asset('js/check-in.js') }}"></script>
@endpush