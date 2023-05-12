<?php

namespace App\Http\Controllers;

use App\Models\Hit;

class HitCounterController extends Controller
{
    /**
     * Получает значение из БД(создаёт в случае отсутсвия),
     * увеличивает на 1(добавляет одно посещение), сохраняет обратно в БД и выводит.
    */
    public function __invoke() 
    {
        $hit = Hit::firstOrCreate(['id' => 1]);
        $hit->hit = $hit->hit + 1;
        $hit->save();
        $title = 'Счетчик хитов';
        return view('hits', compact('hit', 'title'));
    }
}