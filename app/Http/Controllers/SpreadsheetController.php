<?php

namespace App\Http\Controllers;

class SpreadsheetController extends Controller
{
    /**
     * Вся логика реализована в JS.
    */
    public function __invoke() 
    {
        $title = 'Электронная таблица';
        return view('spreadsheet', compact('title'));
    }
}
