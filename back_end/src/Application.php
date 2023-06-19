<?php

namespace App;

use App\core\Router;
use App\Controllers\ProductController;
class Application
{

    public function run(): void
    {
        $router = new Router();

        $router
            ->get('/', [ProductController::class, 'getAllProduct'])
            ->get('/sku', [ProductController::class, 'getAllSku'])
            ->post('/add', [ProductController::class, 'addProduct'])
            ->post('/delete', [ProductController::class, 'deleteProd'])
        ;

        $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));


    }

}