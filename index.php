<?php
//configuracoes gerais
include(__DIR__."/Api/config.php");
//usado para as urls amigaveis para criar uma API
$arrayUrl=[];
//verificamos temos alguma url alem do index caso contrario mostramos o home
if($_GET['url']!=null){
    //separamos a urls amigaveis em partes em array
    $arrayUrl=explode('/', $_GET['url']);
    //vemos se temos mais de uma section nas url amigaveis
    if(count($arrayUrl)>0){
        //colocamos a primeira letra maiúscula de cada parte da url amigável
        foreach ($arrayUrl as $key => $value) {
            $arrayUrl[$key]= ucfirst(strtolower($value));
        }
    }
    //para entrar na api, a primeira parte da url tem que ser Api
    if($arrayUrl[0]==="Api"){
        //carregamos o modelo e o controllador segundo a url Ex:  [Api]/[nome da clase]/[:id]
        include __DIR__.'/'.$arrayUrl[0].'/Models/'.$arrayUrl[1].'_model.php' ;
        include __DIR__.'/'.$arrayUrl[0].'/Controllers/'.$arrayUrl[1].'_controller.php' ;
        //salvamos o nome da clase 
        $newClass=$arrayUrl[1];
        try {
            //caso o terceiro parâmetro  [:id] esteja vazio, enviamos um array vazio como parâmetro 
            $param=$arrayUrl[2]==null?[]:[$arrayUrl[2]];
            $route="";
            //verificamos se essa clase tem um route
            if (array_key_exists($newClass, ROUTE)) {
                //verificamos se o terceiro parâmetro está dentro do nosso array de route
                if(in_array($arrayUrl[2],ROUTE[$newClass])===true){
                    //então o terceiro parâmetro se tornará um método da classe que está sendo chamada
                    $route=$arrayUrl[2];
                    //então a quarta posição do nosso URL amigável será o parâmetro EX: [Api]/[nome da clase]/[method]/[:id]
                    $param=$arrayUrl[3]==null?[]:[$arrayUrl[3]];
                }
            }            
            //chamamos a classe class e o método de acordo com a url, e nós lhe enviaremos o parâmetro
            $response=call_user_func_array(array(new $newClass, $_SERVER['REQUEST_METHOD'].$route), $param);
            //a resposta do metodo da clase vai se tornar em string JSON
            echo json_encode(array('status'=>'success', 'data'=>$response));
        } catch (\Exception $e) {
            //caso ocorra um erro, enviamos o erro através de um array json
            echo json_encode(array('status'=>'error', 'data'=>$e)); 
        }
    }
}else{
    //se não recebermos parâmetros na API mostramos as visualizações
    include __DIR__.'/Views/Home.php';
}



 

 