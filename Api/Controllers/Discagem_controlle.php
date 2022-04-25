<?php
use Api\Models\Discagem As MDiscagem;

class Discagem extends MDiscagem{
    public function get(int $id=0){
       return $this->getDiscagem($id);
    }

    public function post(){
        
    }
}