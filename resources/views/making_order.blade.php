@extends('layouts.main')
@section('content')
<form id='making-order' method='post'>
    <div class='row gy-3 text-center'>
        <input type='text' class='form-control' name='fio' placeholder='ФИО' required>
        <input type='tel' class='form-control' name='phone' placeholder='Телефон' required>
        <input type='email' class='form-control' name='email' placeholder='Email'>
        <div id='map' name='map' class='mx-auto'></div>
        <textarea class='form-control' name='message' maxlength='500' placeholder='Комментарий к заказу (макс. 500 символов)'></textarea>
        <input type='submit' id='submit-order' class='btn btn-primary d-grid gap-2 mx-auto w-50' value='Отправить'>
    </div>
</form>

@endsection