
<?php
  require_once 'Taluka.php';
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
  session_start();
  $db = new  Database();
  $conn = $db->connect();
?>
<?php

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $district_id = $_POST['district'];
        if(Taluka::save($name,$district_id)){
            $_SESSION['message'] = "Record has been saved";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $serialized_model = $_POST['model'];
        $model = unserialize($serialized_model);
        $model->name = $name;
        if(Taluka::update($model)){
            $_SESSION['message'] = "Record has been updated";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went ";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        if(Taluka::delete($id)){
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong! can not be deleted";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

?>