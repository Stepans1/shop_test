<?php

namespace App;

class GetDB extends DatabaseConnection
{
    public function getAllProducts(): array
    {
        $sql = "SELECT p.id, p.sku, p.name, CONCAT(p.price,' $') as price, p.productType, CONCAT('Dimension: ', f.height, 'x', f.width, 'x', f.length) AS dimension, CONCAT('Size: ', d.size, ' MB') AS size, CONCAT('Weight: ', b.weight, 'KG') AS weight FROM products AS p
        LEFT JOIN furnitures AS f
        ON p.id = f.id
        LEFT JOIN dvd AS d
        ON p.id = d.id
        LEFT JOIN books AS b
        ON p.id = b.id";
        $result = $this->mysqli()->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);

    }

	public function getSku()
	{
		$sql = "select sku from products";
		$res =  $this->mysqli()->query($sql);
		$arr = [];
		while($r = mysqli_fetch_assoc($res)) {
			$arr[] = $r['sku'];
		}
		return $arr;
	}     

}
