<?php



namespace App\Controllers;



use App\AttributeFunc;
use App\config\DB;
use App\core\AbstractController;
use App\Functions;


class ProductController extends AbstractController
{

    public function getAllProduct()
    {

        $AllProd = new Functions();
        echo json_encode($AllProd->getAllProducts());
    }

    public function getAllSku()
    {
        $getSku = new Functions();
        $getSku->getAllSkuList();
    }
    public function getType(){
        $getType=new AttributeFunc();
       echo json_encode($getType->getAllAttributes());
    }

    public function findBySku()
    {

        $url = $_SERVER['REQUEST_URI'];

        $url = explode('?', $url);

        $query = explode('=', $url[1]);
        if ($query[0] === "sku") {
            $sku = $query[1];
            $find = new Functions();
            $find->findBySku($sku);
        } else {
            echo 'undefined field';
        }
    }

    public function addProduct()
    {
        $data = $this->request();



        $addProduct = new Functions();
        $addProduct->addProduct($data);
}

   public function deleteProd()
   {
        $data = $this->request();

       $delProduct=new Functions();
       $delProduct->deleteProducts($data);
   }

}