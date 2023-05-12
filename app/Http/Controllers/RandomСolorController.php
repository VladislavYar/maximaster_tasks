<?php

namespace App\Http\Controllers;

class RandomСolorController extends Controller
{
    /**
     * Вся логика реализована в JS.
    */
    public function __invoke() 
    {
        $title = 'Случайный цвет';
        return view('random_color', compact('title'));
    }
}
