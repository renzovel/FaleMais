<?php
use Api\Models\Discagem As MDiscagem;

class Discagem extends MDiscagem{
    public function get(int $idDiscagem=0){
       return $this->Origem($idDiscagem);
    }

    public function getDestino(int $idDestino=0){
        return $this->Destino($idDestino);
    }
}