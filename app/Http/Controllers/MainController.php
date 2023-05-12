<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * Просто заглушка, для простоты навигации.
    */
    public function __invoke() 
    {
        $title = 'Главная страница';
        return view('layouts/main', compact('title'));
    }
}
