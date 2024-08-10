<?php
namespace app\libs\connection;
//Lo creo para gestionar la conexión de a la base de datos con PDO
final class Connection{

        public static function get()

        { 
        return new \PDO(DB_DSN,
        
        DB_USER,DB_PASS,
        
        [\PDO::ATTR_DEFAULT_FETCH_MODE=> \PDO::FETCH_OBJ]);

        }
    }