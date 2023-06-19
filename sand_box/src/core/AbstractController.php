<?php
namespace App\core;

abstract class AbstractController
{
    public function reqest(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        return $data;
    }



}