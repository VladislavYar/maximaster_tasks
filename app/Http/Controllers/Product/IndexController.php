<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke() 
    {
    /**
     * Вся логика реализована в JS.
    */
        $title = 'Таблица товаров';
        return view('table_product', compact('title'));
    }
}
