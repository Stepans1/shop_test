<?php
namespace App\modeles;



use App\config\DB;
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

    public function setProduct($data): void
    {

        $db = new DB();
        $connection = $db->mysqli();

        $sql = "select id, fields from eav_attribute where type='$this->productType'";
        $res = $connection->query($sql)->fetch_assoc();

        $attribute_id = $res['id'];
        $fields = json_decode($res['fields']);

        $value = null;

        foreach ($fields as $field) {

            if (isset($data[$field])) {

                $value .= $data[$field] . 'x';

            } else {
                echo 'Please,submit required data';
                return;

            }
            if (!is_numeric($data[$field])){
                echo 'Please, provide the data of indicated type';
                return;
            }
        }
        $value = substr($value, 0, -1);
        $sql = "insert into eav_product(sku,name,price,producType)values ('$this->sku','$this->name','$this->price','$this->productType')";
        $connection->query($sql);
        $product_id = $connection->insert_id;
        $sql1 = "insert into eav_entity  (id, value,attribute_id,product_id)values(null,'$value','$attribute_id','$product_id')";
        $connection->query($sql1);
        echo "ok";
    }

    public function deleteProduct(): void
    {
        $sql = "DELETE FROM eav_product WHERE id = '$this->id'";

        $this->db->mysqli()->query($sql);
    }
}