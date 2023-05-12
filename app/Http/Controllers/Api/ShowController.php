<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Response;
use App\Models\Product;
use Exception;

class ShowController extends Controller
{
    /**
     * Ищет продукт по ID, в случае успеха возвращает.
     * Если продукта нет - ответ '404'.
    */
    public function __invoke($id)
    {
        try{
            return new ProductResource(Product::findOrFail($id));
        }
        catch(Exception $e){
            return response()->json(
                [
                'message' => 'The product does not exist.'
                ], Response::HTTP_NOT_FOUND
            );
        }

    }
}
