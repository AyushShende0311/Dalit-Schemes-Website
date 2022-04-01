<?php
    require_once 'Districts.php';
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    
    session_start();
    $db = new  Database();
    $conn = $db->connect();

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        if(Districts::save($name)){
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
        $serailized_model = $_POST['model'];
        $model = unserialize($serailized_model);
        $model->name = $name;
        if(Districts::update($model)){
            $_SESSION['message'] = "Record has been updated";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete']; 
        if(Districts::delete($id)){
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong! can not be deleted";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }
?>