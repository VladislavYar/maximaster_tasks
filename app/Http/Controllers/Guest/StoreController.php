<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class StoreController extends Controller
{
    /**
     * Получает POST запрос, валидирует данные,
     * в случае отсутвия поля 'username' задаёт как 'анонимно',
     * сохраняет сегодняшнюю дату и делает запись в БД.
    */
    public function __invoke()
    {
        $data = request()->validate(
            [
            'username'=>'max:25',
            'message'=>'string'
            ]
        );

        if (!$data['username']) $data['username']='анонимно';

        $new_message =  [
                'username'=>$data['username'],
                'message'=>$data['message'],
                'date'=>now(),
            ];
        Message::create($new_message);
        return redirect()->route('guest.index');

    }
}