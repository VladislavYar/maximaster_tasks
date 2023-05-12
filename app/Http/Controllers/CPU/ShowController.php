<?php

namespace App\Http\Controllers\CPU;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ShowController extends Controller
{
    /**
     * Логин, пароль предоставленный Вами в mail.
     * Получает POST запрос(AJAX от JS), делает запрос на сервер
     * и возвращет его ответ.
    */
    public function __invoke()
    {
        $url='http://exercise.develop.maximaster.ru/service/cpu/';
        $login = env('LOGIN_MAXIMASTER');
        $passsword = env('PASSWORD_MAXIMASTER');
        $cpu = Http::withBasicAuth($login, $passsword)->get($url);
        return $cpu;
    }
}
