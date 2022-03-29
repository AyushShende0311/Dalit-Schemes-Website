<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once 'Taluka.php';

            $response = array();
            if(isset($_GET['district_id']))
            {
                $models = Taluka::get_with_district_id($_GET['district_id']);
                
                $result = array();
                foreach($models as $model){
                    $result["$model->id"] = $model->name;
                }
                $response['data'] = $result;
            }
            echo json_encode($response);
?>