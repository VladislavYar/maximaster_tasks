@extends('layouts.main')
@section('content')
    <canvas id='line-cpu'>Ваш браузер не поддерживает canvas</canvas>
    <div class='row row-cols-auto justify-content-center'>
        <div class='col' id='count-request'>
            Количество запросов: 0
        </div>
        <div class='col' id='count-error'>
            Процент ошибок: 0.00%
        </div>
    </div>
@endsection