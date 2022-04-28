<?php
use Api\Models\Discagem As MDiscagem;


class Discagem extends MDiscagem{
    //mostra todas as discagem
    public function get(int $idDiscagem=0){
       return $this->Origem($idDiscagem);
    }

    //mostra as discagem relacionadas aos discagem do origem
    public function getDestino(int $idDestino=0){
        return $this->Destino($idDestino);
    }
}