<?php

namespace App;

abstract class DatabaseConnection
{
    private string $servername = '127.0.0.1';
    private string $username = 'user';
    private string $password = '123456789';
    private string $dbname = 'shop_sw';

    protected function mysqli(): false|\mysqli
    {
        return new \mysqli($this->servername,$this->username,$this->password,$this->dbname);
       // return mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }
}
