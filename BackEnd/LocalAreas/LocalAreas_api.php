<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once 'LocalAreas.php';

            if(isset($_GET['taluka_id']))
            {
                $models = LocalAreas::get_with_taluka_id($_GET['taluka_id']);
                $response = array();
                $result = array();
                foreach($models as $model){
                    $result["$model->id"] = $model->name;
                }
                $response['data'] = $result;
                echo json_encode($response);
            }
            
?>