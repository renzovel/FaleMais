<?php
use Api\Models\Tarifas As MTarifas;

class Tarifas extends MTarifas{
    public function getCalcular(){


       $idOrigem=(int)$_GET['idorigem'];
       $idDestino=(int)$_GET['iddestino'];
       $idPlano=(int)$_GET['idplano'];
       $minutos=(int)$_GET['minutos'];

       
       return $this->Calcular($idOrigem, $idDestino, $idPlano, $minutos);
    }
}