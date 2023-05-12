@extends('layouts.main')
@section('content')

    <div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='staticBackdropLabel'>Поля не пустые</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Закрыть' id='close-cross'></button>
                </div>
                <div class='modal-body'>
                    Вы согласны на удаление?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' id='close'>Закрыть</button>
                    <button type='button' class='btn btn-primary' id='del'>Принять</button>
                </div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-11'>
            <table class='table-block border'>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class='col-1'>
            <div class='row'>
                <div class='col'>
                    <input type='button' id='plus-line' class='btn btn-secondary size-button-plus' value='+'>
                </div>
                <div class='w-100'></div>
                <div class='col'>
                    <input type='button' id='minus-line' class='btn btn-secondary top-1rem size-button-minus' value='-'>
                </div>
            </div>
        </div>
    </div>
    <div class='row row-cols-auto justify-content-center'>
        <input type='button' id='plus-column' class='btn btn-secondary top-1rem size-button-plus' value='+'>
        <input type='button' id='minus-column' class='btn btn-secondary left-1rem top-1rem size-button-minus' value='-'>
    </div>
@endsection