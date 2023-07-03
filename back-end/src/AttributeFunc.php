<?php

namespace App;



use App\config\DB;
use App\modeles\Attribute;


class AttributeFunc
{
    private array $attributes = [];

    public function __construct()
    {
        $sql = "SELECT * FROM eav_attribute";

        $db = new db();
        $result = $db->mysqli()->query($sql)->fetch_all(MYSQLI_ASSOC);

        foreach ($result as $row) {
            $attribute = new Attribute($row['id'], $row['type'], $row['prefix'], $row['postfix'], $row['fields'],$row['unit']);
            $this->attributes[$row['id']] = $attribute;
        }
    }

    public function getAllType(): array
    {
        $result = [];
        foreach ($this->attributes as $attribute) {
            $result[] = $attribute->getType();

        }

        return $result;
    }

    public function getAllAttributes(): array
    {
        $result = [];

        foreach ($this->attributes as $attribute) {
            $result[] = $attribute->getAttribute();
        }

        return $result;
    }

    public function findByName($type)
    {


        $attributes = $this->getAllAttributes();

        foreach($attributes as $attribute) {
            if(strtolower($attribute['type']) === strtolower($type)) {
//              print_r($attribute);
                return $attribute;
            }

        }
    }
}