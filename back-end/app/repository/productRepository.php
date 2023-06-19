<?php

namespace App\repository;

use App\DatabaseConnection;
use App\models\Product;

class productRepository
{
    private $products = [];

    public function __construct()
    {
        $sql = "SELECT id, sku, name, CONCAT(price, ' $') AS price, productType, specialField FROM products";

        $db = new DatabaseConnection();
        $result = $db->mysqli()->query($sql);
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product($row['id'], $row['sku'], $row['name'], $row['price'], $row['productType'], $row['specialField']);
                $this->products[$row['id']] = $product;
            }
        }
    }

    public function getAllSkuList(): array
    {
        $result = [];
        foreach ($this->products as $product) {
            $result[] = $product->getSku();
        }
        return $result;
    }

    public function getAllProducts(): array
    {
        $result = [];
        foreach ($this->products as $product) {
            $result[] = $product->getProduct();
        }
        return $result;
    }

    public function addProduct($data)
    {
        $sku = $data['sku'];
        $name = $data['name'];
        $price = $data['price'];
        $productType = $data['productType'];
        $specialField = $data['specialField'];

        $product = new Product(null, $sku, $name, $price, $productType, $specialField);
        $product->setProduct();
        $this->products[] = $product->getProduct();
    }

    public function deleteProducts($arr): void
    {

        foreach($arr as $id)
        {

//             $product = new Product();
            $this->products[$id]->deleteProduct1();
            unset($this->products[$id]);
        }
    }
}