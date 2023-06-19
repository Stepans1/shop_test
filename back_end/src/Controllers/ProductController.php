<?php



namespace App\Controllers;



use App\core\AbstractController;
use App\Functions;


class ProductController extends AbstractController
{

   public function getAllProduct()
   {

       $AllProd=new Functions();
       echo json_encode($AllProd->getAllProducts());
   }
   public function getAllSku()
   {
       $getSku=new Functions();
       echo json_encode($getSku->getAllSkuList());
   }
   public function addProduct()
   {
       $data= $this->reqest();

       $addProduct=new Functions();
       $addProduct->addProduct($data);
   }
   public function deleteProd()
   {
        $data = $this->reqest();
//       $request_body = file_get_contents('php://input');
//       $data = json_decode($request_body, true);
       $delProduct=new Functions();
       $delProduct->deleteProducts($data);
   }

}