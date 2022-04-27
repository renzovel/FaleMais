<?php
namespace Api\Models;
use Api\DB\Conection as DB;
class  Tarifas{

    protected $table='Tarifas';

    public function Calcular(int $idOrigem=0, int $idDestino=0, int $idPlano=0, int $minutos=0){
        try {
            $conn=DB::Connect();
            $query="CALL getTarifasCalcular(:idOrigem, :idDestino, :idPlano, :minutos);";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(":idOrigem", $idOrigem); 
            $stmt->bindParam(":idDestino", $idDestino); 
            $stmt->bindParam(":idPlano", $idPlano); 
            $stmt->bindParam(":minutos", $minutos); 
            $stmt->execute();       
            if($stmt->rowCount()>0){
                return $stmt->fetchAll();
            }
            unset($conn);              
        } catch (\Exception $e) {
            throw $e;
        }       
    }
}