@extends('layouts.app')

@section('title', 'Cassottis - Transformação de Planilhas em Sistemas')

@section('content')
    @include('partials.hero')
    @include('partials.stats')
    @include('partials.transformacao')
    <!-- @include('partials.cases') -->
    @include('partials.cta')
    <!--@include('partials.contact')-->
@endsection
