<?php
include(__DIR__."/Api/config.php");
$arrayUrl=[];
if($_GET['url']!=null){
    $arrayUrl=explode('/', $_GET['url']);
    if(count($arrayUrl)>0){
        foreach ($arrayUrl as $key => $value) {
            $arrayUrl[$key]= ucfirst(strtolower($value));
        }
    }
    if($arrayUrl[0]==="Api"){
        include __DIR__.'/'.$arrayUrl[0].'/Models/'.$arrayUrl[1].'_model.php' ;
        include __DIR__.'/'.$arrayUrl[0].'/Controllers/'.$arrayUrl[1].'_controlle.php' ;
        $newClass=$arrayUrl[1];
        try { 
            $param=$arrayUrl[2]==null?[]:[$arrayUrl[2]];
            $response=call_user_func_array(array(new $newClass, $_SERVER['REQUEST_METHOD']), $param);
            echo json_encode(array('status'=>'success', 'data'=>$response));
        } catch (\Exception $e) {
            echo json_encode(array('status'=>'error', 'data'=>$e)); 
        }
    }
}else{
    include __DIR__.'/Views/Home.php';
}



 

 