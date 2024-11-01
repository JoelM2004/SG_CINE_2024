<?php

namespace app\core\model\base;

class Validation{

    protected $conn;
    protected $table;

    public function __construct($conn, $table){
        $this->conn = $conn;
        $this->table = $table;
    }

}