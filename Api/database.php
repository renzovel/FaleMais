<?php
namespace Api\DB;
class Conection {
    public function Connect(){
        try {
            $conn=new  \PDO("mysql:host=".DBHOST.";dbname=".DBDATABASE, DBUSER, DBPASSWORD);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOExection $e) {
            throw "Error ".$e->getMessage().PHP_EOL;
        }

        return $conn;
    }
}