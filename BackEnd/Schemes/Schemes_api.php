<?php

    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    require_once 'Schemes.php';

    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
        if($lang === 'mr'){
            $models = Schemes::get();
            $response = array();
            $result = array();
            foreach($models as $model){
                array_push($result, $model->name_mr);
            }
            $response['data'] = $result;
            echo json_encode($response);
        }else{
            $models = Schemes::get();
            $response = array();
            $result = array();
            foreach($models as $model){
                array_push($result, $model->name);
            }
            $response['data'] = $result;
            echo json_encode($response);
        }
    }else{
        $models = Schemes::get();
        $response = array();
        $result = array();
        foreach($models as $model){
            array_push($result, $model->name);
        }
        $response['data'] = $result;
        echo json_encode($response);
    }
   
    
?>