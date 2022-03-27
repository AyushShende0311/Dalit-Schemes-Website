<?php

    require $_SERVER['DOCUMENT_ROOT']."/BackEnd/models/taluka.php";
    require $_SERVER['DOCUMENT_ROOT']."/BackEnd/util/database.php";
    

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $district_id = $_POST['district_id'];
        $model = new Taluka($name,$district_id);
        $db = new Database();
        $conn = $db->connect();
        $query = "
            insert into $model->table_name values(
            default, 
            '$model->name',
            $model->district_id, 
            '$model->created_datetime', 
            '$model->updated_datetime', 
            '$model->created_by',
            '$model->updated_by'
            )";
        $conn->query($query);
    }

?>