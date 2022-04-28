<?php
namespace Api\DB;
//clase para conexões do banco de dados method Connect
class Conection {
    public function Connect(){
        try {
            //instanciamos a classe PDO para a conexão com o banco de dados
            $conn=new  \PDO("mysql:host=".DBHOST.";dbname=".DBDATABASE.";charset=utf8", DBUSER, DBPASSWORD);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOExection $e) {
            throw "Error ".$e->getMessage().PHP_EOL;
        }

        return $conn;
    }
}