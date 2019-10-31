@extends('layouts.app')

@push('header-css')
@endpush

@section('title', 'Aanmaken')
@section('description', '')
@section('content')

<div class="container">
    <div class="row">
        <h1>Bekijk categorie</h1>
    </div>
        <div class="container">
            <div class="row widget-bg widget-body">
                <ul>
                    @foreach ($categories as $category)
                <li class="list-name"><a href ="{{route("categories.edit", ["id"=>$category->id])}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
</div>


@endsection
@push('footer-scripts')
@endpush