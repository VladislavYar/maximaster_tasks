@extends('layouts.main')
@section('content')
    <h1 class='text-center'>Число посещений сайта: {{ $hit->hit }}</h1>
@endsection