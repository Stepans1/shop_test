<?php

namespace App;

class SetDB extends DatabaseConnection
{
    // Inserting into database
    public function addProduct($data)
    {
        $sku=$data['sku'];
        $name=$data['name'];
        $price=$data['price'];
        $productType=$data['productType'];

        $sql = "INSERT INTO `products` (`sku`, `name`, `price`, `productType`)
                VALUES ('$sku', '$name', '$price', '$productType')";

        $mysqli =$this->mysqli();
        $mysqli->query($sql);
        $last_id=$mysqli->insert_id;

        switch ($productType){
            case "DVD" :
                 $this->addDvd($last_id,$data['size']);
                break;
            case "Book":
                $this->addBook($last_id,$data['weight']);
                break;
            case "Furniture":
                $this->addFurniture($last_id,$data['height'],$data['width'],$data['length']);
        }
    }

    private function addBook($id, $weight)
    {
        $sql = "INSERT INTO books (id, weight)
                VALUES ('$id', '$weight')";
        $this->mysqli()->query($sql);
    }

    private function addDvd($id, $size)
    {
        $sql = "INSERT INTO dvd (id, size)
                VALUES ('$id', '$size')";
        $this->mysqli()->query($sql);
    }

    private function addFurniture($id, $height, $width, $length)
    {
        $sql = "INSERT INTO furnitures (id, height, width, length)
                VALUES ('$id', '$height', '$width', '$length')";
        $this->mysqli()->query($sql);
    }

    // Deleting from database
    public function deleteProduct(array $array)
    {
        foreach($array as $id)
        {
            $sql = "DELETE FROM products WHERE id = '$id'";
            $this->mysqli()->query($sql);
        }
    }

}