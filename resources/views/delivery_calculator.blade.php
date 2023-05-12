@extends('layouts.main')
@section('content')
    <div class='row gy-4'>
        <form id='form-delivery' method='post'>
            @csrf
            <p>
            <select class='form-select' name='city'>
                @foreach ($cites as $id=>$city)
                    <option value='{{ $id }}' @if ($city === 'Москва') selected @endif>{{ $city }}</option>
                @endforeach
            </select>
            </p>
            <p><input type='number' min='0' class='form-control' name='weight' placeholder='Вес, кг' required></p>
            <input type='submit' class='btn btn-primary d-grid mx-auto w-50' value='Расчитать'>
        </form>
    </div>
@endsection