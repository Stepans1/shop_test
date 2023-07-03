<?php
namespace App;
use App\config\DB;
use App\modeles\Product;

class Functions extends DB
{
    private $products = [];
    public function __construct()
    {
        $sql = "SELECT p.id, p.sku, p.name, p.price, p.producType, v.value, a.prefix, a.postfix, a.fields
        FROM eav_product AS p
        INNER JOIN eav_entity AS v
        ON p.id = v.product_id
        INNER JOIN eav_attribute AS a 
        ON v.attribute_id = a.id
        ORDER BY p.producType";


        $result = $this->mysqli()->query($sql)->fetch_all(MYSQLI_ASSOC);

        foreach ($result as $row) {
            $product = new Product($row['id'], $row['sku'], $row['name'], $row['price'], $row['producType'], $row['prefix'] . $row['value'] . $row['postfix']);
            $this->products[$row['id']] = $product;

        }
    }


    public function findBySku($sku){

        $allProducts= $this->getAllProducts();

        foreach ($allProducts as $product)
        {
            if ($product['sku']===$sku)
            {
                var_dump( $product);
                return ;
            }
        }
        echo "undefined sku";
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
        $data['specialField']='';
        $db = new DB();
        $connection = $db->mysqli();
        $skuList = $this->getAllSkuList();


        if (empty($sku && $name && $price && $productType)) {
            echo 'Please,submit required data';
            return;
        }
        if (!is_numeric($price)) {
            echo 'Please, provide the data of indicated type';
            return;
        }

        if (in_array($sku, $skuList)) {
            echo 'sku already exist';
            return;

        } else {

;

        $product = new Product(null, $data['sku'], $data['name'], $data['price'], $data['productType'], $data['specialField']);
        $product->setProduct($data);



    }
    }
    public function deleteProducts($arr): void
    {

        foreach($arr as $id)
        {
            $this->products[$id]->deleteProduct();
            unset($this->products[$id]);
        }
    }
}