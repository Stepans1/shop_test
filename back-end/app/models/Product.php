<?php

namespace App\models;

use App\DatabaseConnection;

class Product extends DatabaseConnection
{
     private $id;
     private  $sku;
     private  $name;
     private  $price;
     private  $productType;
     private  $specialAtribut;


function __construct($id,$sku,$name,$price,$productType,$specialAtribut) {
    $this->id=$id;
    $this->sku=$sku;
    $this->name=$name;
    $this->price=$price;
    $this->productType=$productType;
    $this->specialAtribut=$specialAtribut;
}
public function getProduct(){

    return [
        "id"=>$this->id,
        "sku"=>$this->sku,
        "name"=>$this->name,
        "price"=>$this->price,
        "productType"=>$this->productType,
        "specialAtribut"=>$this->specialAtribut


    ];

}
public function getSku(){
    return $this->sku;
}

    public function setProduct(): void
    {
        $sql = "INSERT INTO products (`sku`, `name`, `price`, `productType`, `specialAtribut`)
                VALUES('$this->sku', '$this->name', '$this->price', '$this->productType', '$this->specialAtribut')";

        $db = new DatabaseConnection();
        $db->mysqli()->query($sql);
    }


}