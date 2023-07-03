<?php

namespace App;

use App\Controllers\AttributeController;
use App\core\Router;
use App\Controllers\ProductController;
class Application
{

    public function run(): void
    {
        $router = new Router();

        $router
            ->get('/product/get', [ProductController::class, 'findBySku'])
            ->get('/', [ProductController::class, 'getAllProduct'])
            ->get('/sku', [ProductController::class, 'getAllSku'])
            ->get('/type', [AttributeController::class, 'getType'])
            ->get('/attribute', [AttributeController::class, 'getAttribute'])
            ->post('/product/saveApi', [ProductController::class, 'addProduct'])
            ->post('/delete', [ProductController::class, 'deleteProd'])
        ;

        $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));


    }

}