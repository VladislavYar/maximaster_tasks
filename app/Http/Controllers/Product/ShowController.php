<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ShowController extends Controller
{
    public function __invoke() 
    {
    /**
     * Логин, пароль предоставленный Вами в mail.
     * Обрабатывает POST запрос (AJAX от JS) и возвращает продукты.
    */
        $url='http://exercise.develop.maximaster.ru/service/products/';
        $login = env('LOGIN_MAXIMASTER');
        $passsword = env('PASSWORD_MAXIMASTER');
        $products = Http::withBasicAuth($login, $passsword)->get($url)->json();
        return $products;
    }
}
