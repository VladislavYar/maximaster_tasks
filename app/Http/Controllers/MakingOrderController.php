<?php

namespace App\Http\Controllers;

class MakingOrderController extends Controller
{
    /**
     * Вся логика реализована в JS.
    */
    public function __invoke() 
    {
        $title = 'Оформление заказа';
        return view('making_order', compact('title'));
    }
}

