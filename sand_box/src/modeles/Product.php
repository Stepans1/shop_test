<?php
namespace App\modeles;



use App\core\Model;

class Product extends Model
{
    private $id;
    private $sku;
    private $name;
    private $price;
    private $productType;
    private $specialField;

    public function __construct($id, $sku, $name, $price, $productType, $specialField)
    {
        parent::__construct();
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
        $this->specialField = $specialField;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getProduct(): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'productType' => $this->productType,
            'specialField' => $this->specialField
        ];
    }

    public function setProduct(): void
    {
        $sql = "INSERT INTO products (`sku`, `name`, `price`, `productType`, `specialField`)
                VALUES('$this->sku', '$this->name', '$this->price', '$this->productType', '$this->specialField')";


        $this->db->mysqli()->query($sql);
    }

    public function deleteProduct(): void
    {
        $sql = "DELETE FROM products WHERE id = '$this->id'";

        $this->db->mysqli()->query($sql);
    }
}