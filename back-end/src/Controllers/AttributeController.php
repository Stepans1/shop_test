<?php

namespace App\Controllers;

use App\AttributeFunc;

class AttributeController
{
    public function getType(){
        $getType=new AttributeFunc();
        echo json_encode($getType->getAllType());
    }

    public function getAttribute()
    {
        $route = parse_url($_SERVER['REQUEST_URI']);

        if(!isset($route['query'])) {
            return;
        }
        parse_str($route['query'], $query);

        if(!isset($query['type']) || $query['type'] === "") {
            return null;
        }

        $attribute=new AttributeFunc();

        echo json_encode( $attribute ->findByName($query['type']));

    }
}