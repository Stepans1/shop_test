<?php

namespace App;

class DatabaseConnection
{
    private string $servername = 'localhost';
    private string $username = 'root';
    private string $password = '';
    private string $dbname = 'shop_sw';

    public function mysqli(): false|\mysqli
    {
        return new \mysqli($this->servername,$this->username,$this->password,$this->dbname);
       // return mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }
}
