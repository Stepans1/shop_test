<?php

namespace App\core;
use App\config\DB;

abstract class Model
{


    protected DB $db;
    public function __construct()
    {
        $this->db = new DB;
    }
}