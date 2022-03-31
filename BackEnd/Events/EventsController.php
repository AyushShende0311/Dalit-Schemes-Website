
<?php
  require_once 'Event.php';
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
  session_start();
  $db = new  Database();
  $conn = $db->connect();
?>
<?php

    if(isset($_POST['submit'])){
        $event_title = $_POST['event_title'];
        $event_details = $_POST['event_details'];
        $district_id = $_POST['district'];
        if(Event::save($name,$district_id,$event_title,$event_details)){
            $_SESSION['message'] = "Record has been saved";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    if(isset($_POST['update'])){
        $event_title = $_POST['event_title'];
        $event_details = $_POST['event_details'];
        $district_id = $_POST['district_id'];
        $serialized_model = $_POST['model'];
        $model = unserialize($serialized_model);
        $model->name = $name;
        $model->district_id = $district_id;
        $model->event_title = $event_title;
        $model->event_details = $event_details;
        if(Event::update($model)){
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

        if(Event::delete($id)){
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong! can not be deleted";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

?>