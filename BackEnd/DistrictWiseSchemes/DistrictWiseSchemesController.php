
<?php
  require_once 'DistrictWiseSchemes.php';
  
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
  session_start();
?>

<?php
   
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $district_id = $_POST['district'];
        $taluka_id = $_POST['taluka'];
        $localarea_id = $_POST['localarea'];
        $scheme_id = $_POST['schemes'];
        if(DistrictWiseSchemes::save($name,$district_id,$taluka_id,$localarea_id,$scheme_id)){
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
        $district_id = $_POST['district'];
        $taluka_id = $_POST['taluka'];
        $localarea_id = $_POST['localarea'];
        $scheme_id = $_POST['schemes'];
        $serialized_model = $_POST["model"];
        $model = unserialize($serialized_model);
        $model->name = $name;
        if(DistrictWiseSchemes::update($model)){
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
        if(DistrictWiseSchemes::delete($id)){
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