<?php
  require_once 'Images.php';
  
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
  session_start();
?>

<?php
    if(isset($_POST['submit'])){
        $district_id = $_POST['district'];
        $taluka_id = $_POST['taluka'];
        $localarea_id = $_POST['area'];
        $scheme_id = $_POST['scheme'];
        if(Images::save($district_id,$taluka_id,$localarea_id,$scheme_id)){
            $_SESSION['message'] = "Record has been saved";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    // if(isset($_POST['update'])){
    //     $district_id = $_POST['district'];
    //     $taluka_id = $_POST['taluka'];
    //     $localarea_id = $_POST['area'];
    //     $scheme_id = $_POST['scheme'];
    //     $serialized_model = $_POST["model"];
    //     $model = unserialize($serialized_model);
    //     $model->district_id = $district_id;
    //     $model->taluka_id = $taluka_id;
    //     $model->localarea_id = $localarea_id;
    //     $model->scheme_id = $scheme_id;
    //     if(DistrictWiseSchemes::update($model)){
    //         $_SESSION['message'] = "Record has been updated";
    //         $_SESSION['msg_type'] = "success";
    //     }else{
    //         $_SESSION['message'] = "Something went wrong!";
    //         $_SESSION['msg_type'] = "danger";
    //     }
    //     header("location:index.php");
    // }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        if(Images::delete($id)){
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }
        else {
            $_SESSION['message'] = "Something went wrong can not be deleted!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }
?>