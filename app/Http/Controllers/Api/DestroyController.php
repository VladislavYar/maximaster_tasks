<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Product;
use Exception;

class DestroyController extends Controller
{
    /**
     * Ищет продукт по ID, в случае успеха удаляет и возвращает null и ответ '204'.
     * Если продукта нет - ответ '404'.
    */
    public function __invoke($id)
    {   
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        }
        catch(Exception $e){
            return response()->json(['message' => 'The product does not exist.'], Response::HTTP_NOT_FOUND);
        }

    }
}
