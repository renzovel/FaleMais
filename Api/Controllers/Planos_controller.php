<?php
use Api\Models\Planos As MPlanos;

class Planos extends MPlanos{
    //recebemos os planos
    public function get(int $idPlano=0){
       return $this->Planos($idPlano);
    }
}