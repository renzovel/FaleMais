<?php
namespace Api\Models;
use Api\DB\Conection as DB; //instanciar a clase para o banco de dados
//classe para manipular o objeto de banco de dados chamado Discagem
class  Discagem{
    //atributo para armazenar o nome da tabela da bd
    protected $table='Discagem';
    
    //metodo para receber os discagem retirna as discagems
    public function Origem(int $idDiscagem=0){
        try {
            //conectar na bd
            $conn=DB::Connect();
            //Chamamos o procedimento armazenado para receber as Discagems
            $query="CALL getDiscagemOrigem(:idDiscagem);";
            //metodo para executar o scrypt na base de dados
            $stmt=$conn->prepare($query);
            //enviamos os parametros
            $stmt->bindParam(":idDiscagem", $idDiscagem); 
            $stmt->execute();       
            //verificamos se ele retorna rows 
            if($stmt->rowCount()>0){
                return $stmt->fetchAll();
            }
            //apagamos a conexao
            unset($conn);              
        } catch (\Exception $e) {
            throw $e;
        }       
    }

    //retorna as discagem depende do destino
    public function Destino(int $idOrigem=0){
        try {
            //conecta na base de dados
            $conn=DB::Connect();
            //Chamamos o procedimento armazenado para receber os destinos a partir do origem
            $query="CALL getDiscagemDestino(:idOrigem);";
            //metodo para executar o scrypt na base de dados
            $stmt=$conn->prepare($query);
            //enviamos os parametros por esse metodo
            $stmt->bindParam(":idOrigem", $idOrigem); 
            //executamos 
            $stmt->execute();       
            //recebemos as rows da consulta
            if($stmt->rowCount()>0){
                return $stmt->fetchAll();
            }
            //apagamos a conexao
            unset($conn);              
        } catch (\Exception $e) {
            throw $e;
        }       
    }
}