<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;

class StoreController extends Controller
{
    /**
     * Получает данные, валидирует их(обратите внимание,
     * что валидация самописанная './requests/').
     * В случае успеха, сохраняет, иначе выдаёт сообщение
     * о небходимости исправления отправляемых данных.
    */
    public function __invoke(ProductStoreRequest $request)
    {
        $created_product = Product::create($request->validated());

        return new ProductResource($created_product);

    }
}
