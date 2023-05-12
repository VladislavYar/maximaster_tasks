@extends('layouts.main')
@section('content')
    <div class='row gy-2'>
        @foreach ($messages as $message)
            <div class='p-3 border'>
                <div class='row gy-3'>
                    <div class='col-6 text-start'>{{ date('d.m.Y h:i', strtotime($message->date)) }}</div>
                    <div class='col-6 text-end'>{{ $message->username }}</div>
                    <div class='col text-break'>{{ $message->message }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <hr>
    <form action='{{ route('guest.store') }}' method='post'>
        @csrf
        <p><input type='text' class='form-control w-50' name='username' placeholder='Имя' maxlength='25'></p>
        <p><textarea class='form-control' name='message' placeholder='Ваше сообщение'></textarea></p>
        <input type='submit' class='btn btn-primary d-grid gap-2 mx-auto w-50' value='Отправить'>
    </form>
@endsection