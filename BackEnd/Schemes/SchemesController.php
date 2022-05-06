<?php
  require_once 'Schemes.php';
  require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
  session_start();
  $db = new  Database();
  $conn = $db->connect();
?>

<?php
   
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $name_mr = $_POST['name_mr'];
        if(Schemes::save($name,$name_mr)){
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
        $name_mr = $_POST['name_mr'];
        $serailized_model = $_POST['model'];
        $model = unserialize($serailized_model);
        $model->name = $name;
        $model->name_mr = $name_mr;
        if(Schemes::update($model)){
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
       
        if(Schemes::delete($id)){
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong! can not be deleted";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

?>