<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Получает продукты из БД с пагинацией по 5.
    */
    public function __invoke()
    {
        return new ProductCollection(Product::paginate(5));

    }
}