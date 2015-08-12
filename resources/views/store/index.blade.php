@extends('store.store')

@section('categories')
    @include('store.categories')
@stop

@section('content')
    @if(isset($products))
        @include('store.products')
    @else
        @include('store.destRec')
    @endif
@stop