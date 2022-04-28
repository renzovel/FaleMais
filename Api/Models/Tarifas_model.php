<?php
namespace Api\Models;
use Api\DB\Conection as DB; //instanciamos a clase para o banco de dados
//classe para manipular o objeto de banco de dados chamado Tarifas
class  Tarifas{
    //atributo para armazenar o nome da tabela da bd
    protected $table='Tarifas';

    //recebe os parâmetros necessários para calcular a tarifa de acordo com origem, destino, etc...
    public function Calcular(int $idOrigem=0, int $idDestino=0, int $idPlano=0, int $minutos=0){
        try {
            //conectamos con a base de dados 
            $conn=DB::Connect();
            //Chamamos o procedimento armazenado para
            $query="CALL getTarifasCalcular(:idOrigem, :idDestino, :idPlano, :minutos);";
            //metodo para carregar o script na base de dados
            $stmt=$conn->prepare($query);
            //passamos os nossos parametros
            $stmt->bindParam(":idOrigem", $idOrigem); 
            $stmt->bindParam(":idDestino", $idDestino); 
            $stmt->bindParam(":idPlano", $idPlano); 
            $stmt->bindParam(":minutos", $minutos); 
            //executamos o scrypt
            $stmt->execute();       
            //verificamos se a execução retorna algum valor
            if($stmt->rowCount()>0){
                //retornamos os valores
                return $stmt->fetchAll();
            }
            //apagamos a conexao
            unset($conn);              
        } catch (\Exception $e) {
            throw $e;
        }       
    }
}