<?php

namespace App\repository;

use App\DatabaseConnection;
use App\models\Product;

class productRepository
{
    private $products = [];

    public function __construct()
    {
        $sql = "SELECT id, sku, name,price ,productType, specialAtribut FROM products";

      $db=new DatabaseConnection();
        $result = $db->mysqli()->query($sql);
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product($row['id'], $row['sku'], $row['name'], $row['price'], $row['productType'], $row['specialAtribut']);
                $this->products[$row['id']] = $product;
            }
        }
    }

    public function getAllSku(): array
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
        $specialAtribut = $data['specialAtribut'];

        $product = new Product(null, $sku, $name, $price, $productType, $specialAtribut);
        $product->setProduct();
        $this->products[] = $product->getProduct();
    }

    public function deleteProducts($arr)
    {
        foreach($arr as $id)
        {
            $this->products[$id]->deleteProduct();
            unset($this->products[$id]);
        }
    }


}