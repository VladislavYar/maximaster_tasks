<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class StoreController extends Controller
{
    /**
     * Файл 'city.json' сохранен в директории '/storage/app/'.
     * Логин, пароль предоставленный Вами в mail.
     * Получает POST запрос(AJAX от JS), валидирует данные на наличие только чисел,
     * берёт данные из файла, из полученных данных получает город(по индексу),
     * приводит вес к числовому типу и делает запрос на сервер.
     * Возвращает полученный ответ.
    */
    public function __invoke()
    {
        $url='http://exercise.develop.maximaster.ru/service/delivery/';
        $login = env('LOGIN_MAXIMASTER');
        $passsword = env('PASSWORD_MAXIMASTER');
        $data = request()->validate([
            'city'=>'integer',
            'weight'=>'integer'
            ]
        );
        $cites = Storage::disk('local')->get('city.json');
        $cites = json_decode($cites, true);
        $city = $cites[$data['city']];
        $weight = intval($data['weight']);
        $param = ['city'=> $city, 'weight'=> $weight];
        $response = Http::withBasicAuth($login, $passsword)->get($url, $param);

        return $response;
    }
}