<?php
namespace Api\Models;
use Api\DB\Conection as DB;
class  Discagem{

    protected $table='Discagem';

    public function Origem(int $idDiscagem=0){
        try {
            $conn=DB::Connect();
            $query="CALL getDiscagemOrigem(:idDiscagem);";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(":idDiscagem", $idDiscagem); 
            $stmt->execute();       
            if($stmt->rowCount()>0){
                return $stmt->fetchAll();
            }
            unset($conn);              
        } catch (\Exception $e) {
            throw $e;
        }       
    }

    public function Destino(int $idOrigem=0){
        try {
            $conn=DB::Connect();
            $query="CALL getDiscagemDestino(:idOrigem);";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(":idOrigem", $idOrigem); 
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