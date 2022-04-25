<?php
namespace Api\Models;
use Api\DB\Conection as DB;
class  Discagem{

    protected $table='Discagem';

    public function getDiscagem(int $id=0){
        try {
            $conn=DB::Connect();
            $query="CALL getDiscagem(:id);";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(":id", $id); 
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