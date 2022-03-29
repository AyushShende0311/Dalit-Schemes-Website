<?php 
    // require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    // require_once 'Districts.php';
    // // class API{
    // //     function select(){
            
    //         //$models = Districts::get();
    //         $response = array();
    //         $result = array();

    //         $table = Districts::$table_name;
    //         $db = new Database();
    //         $conn = $db->connect();
            
    //         $query = 'select taluka.id, taluka.name , district.name , taluka.created_datetime, taluka.updated_datetime, taluka.created_by, taluka.updated_by
    //         from taluka inner join district on taluka.id=district.id';
    //         try{
    //             $ans = $conn->query($query);
    //             while($row = $ans->fetch()){
    //                 $model = Districts::load($row);
    //                 array_push($result, $model);
    //             }
    //         }catch(PDOException $e){
    //             echo $e->getMessage();
    //         }
    //         foreach($models as $model){
    //             array_push($result, $model->name);
    //         }
    //         $response['data'] = $result;
    //         echo json_encode($response);
            
            
    // //     }
    // // }

        require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
        require_once 'Districts.php';
        require_once '../Taluka/Taluka.php';
        require_once '../LocalAreas/LocalAreas.php';
        // class API{
        //     function select(){
                
                $models = Taluka::get();
                $response = array();
                $result = array();
                $models1 = LocalAreas::get();
                // $result1 = array();
            
                foreach($models as $model){
                    array_push($result, $model->name);
                    foreach($models1 as $model)
                    {
                        array_push($result, $model->name);
                    }
                }
                $response['data'] = $result;
                echo json_encode($response);

                
                
        //     }
        // }



   
?>