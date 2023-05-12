<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class IndexController extends Controller
{
    public function __invoke()
    {
    /**
     * Получает все сообщения из БД и выводит.
    */  
        $title = 'Гостевая книга';

        $messages = Message::all();
        return view('guest_book', compact('title', 'messages'));

    }
}