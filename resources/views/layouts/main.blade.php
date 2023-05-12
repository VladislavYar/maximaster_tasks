<!DOCTYPE html>
<html lang='ru'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv="X-UA-Compatible" content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link href={{ asset('css/bootstrap.min.css') }} rel='stylesheet'>
        <link href={{ asset('css/app.css') }} rel='stylesheet'>
        <title>{{ $title }}</title>
    </head>
    <body>
        <header>
            <div class='container w-50 mt-2'>
                <ul class='nav nav-pills nav-fill'>
                    <li class='nav-item'>
                    <a class='nav-link @if(url()->current()===route('main.index')) active @endif' href='{{ route('main.index') }}'>Главная</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link @if(url()->current()===route('hit.index')) active @endif' href='{{ route('hit.index') }}'>Счётчик хитов</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link @if(url()->current()===route('guest.index')) active @endif' href='{{ route('guest.index') }}'>Гостевая книга</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link @if(url()->current()===route('delivery.index')) active @endif' href='{{ route('delivery.index') }}'>Калькулятор доcтавки</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link @if(url()->current()===route('color.index')) active @endif' href='{{ route('color.index') }}'>Случайный цвет</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link @if(url()->current()===route('order.index')) active @endif' href='{{ route('order.index') }}'>Оформление заказа</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link @if(url()->current()===route('table.index')) active @endif' href='{{ route('table.index') }}'>Таблица товаров</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link @if(url()->current()===route('cpu.index')) active @endif' href='{{ route('cpu.index') }}'>График загруженности процессора</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link @if(url()->current()===route('spreadsheet.index')) active @endif' href='{{ route('spreadsheet.index') }}'>Электронная таблица</a>
                    </li>
                </ul>
                <hr>
            </div>
        </header>
        <main>
            <div class='container w-50'>
                <noscript><h1 class='text-center text-red'>Для корректной работы страницы, включите JavaScript</h1></noscript>
                @yield('content')
            </div>
        </main>
        <footer>
            <div class='container w-50 text-center p-3 mb-2'>
                <hr>
                © {{ date('Y') }} Copyright 
                <p>Vladislav<span class='text-red'>Yar</span></p> 
            </footer>
        </div>
        <script src={{ asset('js/jquery-3.6.4.min.js') }}></script>
        <script src={{ asset('js/jquery.validate.min.js') }}></script>
        <script src={{ asset('js/yamap.js') }}>
        </script>
        <script src={{ asset('js/bootstrap.min.js') }}></script>
        <script src={{ asset('js/chart.js') }}></script>
        <script src={{ asset('js/app.js') }}></script>
    </body>
</html>