<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once 'Districts.php';

            $models = Districts::get();
            $response = array();
            $result = array();
            
            foreach($models as $model){
                array_push($result, $model->name);
            }
            $response['data'] = $result;
            echo json_encode($response);
            
?>