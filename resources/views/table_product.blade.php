@extends('layouts.main')
@section('content')
<form id='filter-price' method='post'>
    <div class='row row-cols-auto justify-content-center'>
        <div class='col-2 col-form-label text-end'>
            <label for='price-from'>Цена от:</label>
        </div>
        <div class='col-2'>
            <input type='number' min='0' class='form-control' name='pricefrom' id='pricefrom'>
        </div>
        <div class='col-1 col-form-label text-end'>
            <label for='price-up'>До:</label>
        </div>
        <div class='col-2'>
            <input type='number' min='0' class='form-control' name='priceup' id='priceup'>
        </div>
        <div class='col'>
            <input type='submit' class='btn btn-primary'  value='Обновить'>
        </div>
    </div>
</form>
<div class='row row-cols-auto justify-content-center'>
    <table class='table table-responsive'>
        <thead>
        <tr>
            <th scope='col'>ID</th>
            <th scope='col'>Название</th>
            <th scope='col'>Количество</th>
            <th scope='col'>Цена за единицу</th>
            <th scope='col'>Сумма</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection