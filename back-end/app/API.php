<?php

namespace App;

use App\models\Product;
use App\repository\productRepository;

class API
{
    private string $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function start()
    {
        switch ($this->method)
        {
            case "GET":
                $productRepository = new productRepository();

                if(isset($_GET['q']) && $_GET['q'] === "sku") {
                    $skuList = $productRepository->getAllSku();
                    echo json_encode($skuList);
                } else {
                    $products = $productRepository->getAllProducts();
                    echo json_encode($products);
                }
                break;
//            case "POST":
//                $request_body=file_get_contents('php://input');
//                $data=json_decode($request_body,true);
//                 break;
            case "POST":
                $request_body = file_get_contents('php://input');

                $productRepository = new productRepository();
                if($_GET['q'] === "save") {
                    $data = json_decode($request_body, true);

                    $skuList = $productRepository->getAllSku();
                    if(in_array($data['sku'], $skuList)) {
                        echo "sku exists";
                    } else {
                        $productRepository->addProduct($data);
                        echo "success";
                    }
                } else if ($_GET['q'] === "delete") {
                    $data = $request_body;

                    $arr = explode(',', $data);
                    $productRepository->deleteProducts($arr);
                    break;
                }
                break;

            case "DELETE":
                $del = $_GET['q'];
                $array = explode(',',$del);
        }
    }

}
