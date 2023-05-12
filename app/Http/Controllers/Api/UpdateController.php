<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Response;
use App\Models\Product;
use Exception;

class UpdateController extends Controller
{
    /**
     * Ищет продукт по ID, валидирует данные(обратите внимание,
     * что валидация самописанная './requests/'), в случае успеха обновляет.
     * Если продукта нет - ответ '404'.
     * При проблеме с данными выдаёт сообщение
     * о небходимости исправления отправляемых данных.
    */
    public function __invoke(ProductUpdateRequest $request, $id)
    {
        try{
            Product::findOrFail($id)->update($request->validated());
            $product = Product::findOrFail($id);
            return new ProductResource($product);
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
