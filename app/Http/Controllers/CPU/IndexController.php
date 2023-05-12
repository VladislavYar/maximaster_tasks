<?php

namespace App\Http\Controllers\CPU;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Вся логика реализована в JS.
    */
    public function __invoke()
    {
        $title = 'График загруженности процессора';
        return view('cpu_usage', compact('title'));
    }
}

