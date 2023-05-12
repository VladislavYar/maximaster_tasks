<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    /**
     * Файл 'city.json' сохраняется в директории '/storage/app/'.
     * Логин, пароль предоставленный Вами в mail.
     * Проверяет на наличие файла, приводит сегодняшнюю дату
     * в нужный формат для сравнения.
     * Если файла нет или последнее измененение файла вчерашнее,
     * делает запрос к серверу и сохраняет данные в файл.
     * Берёт данные из файла и выводит.
    */
    public function __invoke()
    {
        $title = 'Калькулятор стоимости доставки';
        $url = 'http://exercise.develop.maximaster.ru/service/city/';
        $login = env('LOGIN_MAXIMASTER');
        $passsword = env('PASSWORD_MAXIMASTER');
        $format = 'd.m.Y';

        $is_file = Storage::disk('local')->exists('city.json');
        $now_time = date($format);
        if (!$is_file 
            || ($now_time != gmdate($format, Storage::lastModified('city.json'))))
        {
            $response = Http::withBasicAuth($login, $passsword)->get($url);
            $cites = json_encode($response->json());
            Storage::disk('local')->put('city.json', $cites);
        }
        $cites = Storage::disk('local')->get('city.json');
        $cites = json_decode($cites, true);

        return view('delivery_calculator', compact('title', 'cites'));
    }
}