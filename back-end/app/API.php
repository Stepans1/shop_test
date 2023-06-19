<?php

namespace App;

use App\repository\productRepository;

class API
{
    private string $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function start(): void
    {
        switch ($this->method)
        {
            case "GET":
                $productRepository = new productRepository();

                if(isset($_GET['q']) && $_GET['q'] === "sku") {
                    $skuList = $productRepository->getAllSkuList();
                    echo json_encode($skuList);
                } else {
                    $products = $productRepository->getAllProducts();
                    echo json_encode($products);
                }
                break;
            case "POST":
                $request_body = file_get_contents('php://input');
                $data = json_decode($request_body, true);

                $productRepository = new ProductRepository();
                if($_GET['q'] === "add") {
                    $skuList = $productRepository->getAllSkuList();
                    if(in_array($data['sku'], $skuList)) {

                        echo "sku exists";
                    } else {
                        $productRepository->addProduct($data);
                        echo "success";
                    }
                } else if ($_GET['q'] === "delete") {

                    $productRepository->deleteProducts($data);
                    break;
                }
                break;
        }
    }

}
