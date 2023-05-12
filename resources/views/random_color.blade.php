@extends('layouts.main')
@section('content')
        <div class='row'>
            <div class='col-4 col-form-label text-end'>
                <label for='width'>Ширина:</label>
            </div>
            <div class='col-4'>
                <input type='number' class='form-control' id='width' value='100' min='0'>
            </div>
        </div>
        <div class='row'>
            <div class='col-4 col-form-label text-end gy-3'>
                <label for='height'>Высота:</label>
            </div>
            <div class='col-4 gy-3'>
                <input type='number' class='form-control' id='height' value='100' min='0'>
            </div>
        </div>
        <div class='row row-cols-auto justify-content-center'>
            <div class='d-grid gap-2 col-4 mx-auto gy-3'>
                <input type='button' id='button-random-color' class='btn btn-primary'  value='Случайный цвет'>
            </div>
        </div>
        <hr>
        <canvas id='canvas-color' class='d-grid gap-2 mx-auto' width='100' height='100'>Ваш браузер не поддерживает canvas</canvas>
@endsection