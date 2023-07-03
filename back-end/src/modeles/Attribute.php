<?php

namespace App\modeles;

use App\config\DB;
use App\core\Model;

class Attribute extends Model
{
    private $id;
    private $type;
    private $prefix;
    private $postfix;
    private $fields;
    private $unit;


    public function __construct($id, $type, $prefix, $postfix, $fields,$unit)
    {
        parent::__construct();

        $this->id = $id;
        $this->type = $type;
        $this->prefix = $prefix;
        $this->postfix = $postfix;
        $this->unit=$unit;
        $this->fields = json_decode($fields);


    }

    public function getId()
    {
        return $this->id;
    }

    public function getType(): array
    {

        return [

            'type' => $this->type,



        ];
    }

    public function getFields(): array
    {
        return [


            'fields'=>$this->fields,


        ];
    }

    public function getAttribute(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'prefix' => $this->prefix,
            'postfix' => $this->postfix,
            'fields' => $this->fields,
            '$unit'=>$this->unit,

        ];
    }
}