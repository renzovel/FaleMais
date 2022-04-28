<?php
namespace Api\Models;
use Api\DB\Conection as DB; //instanciamos a clase para o banco de dados
//classe para manipular o objeto de banco de dados chamado Planos
class  Planos{
    //atributo para armazenar o nome da tabela da bd
    protected $table='Planos';

    //recebe o id do planos mais nao e obligatorio retorna os planos
    public function Planos(int $idPlano=0){
        try {
            //conectamos na base de dados
            $conn=DB::Connect();
            //Chamamos o procedimento armazenado para receber os planos
            $query="CALL getPlanos(:idPlano);";
            //metodos para preparar a consulta 
            $stmt=$conn->prepare($query);
            //enviamos o id por parameters
            $stmt->bindParam(":idPlano", $idPlano); 
            //executamos o script na base de dados
            $stmt->execute();  
            //verificamos se estamos recebendo resultados      
            if($stmt->rowCount()>0){
                //retona os valores
                return $stmt->fetchAll();
            }
            //apagamos a conexao
            unset($conn);              
        } catch (\Exception $e) {
            throw $e;
        }       
    }
}