<?php
namespace Api\Models;
use Api\DB\Conection as DB;
class  Planos{

    protected $table='Discagem';

    public function Planos(int $idPlano=0){
        try {
            $conn=DB::Connect();
            $query="CALL getPlanos(:idPlano);";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(":idPlano", $idPlano); 
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