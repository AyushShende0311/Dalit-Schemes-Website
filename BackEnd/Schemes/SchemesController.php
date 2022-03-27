
<?php
  require_once 'Schemes.php';
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
  session_start();
  $db = new  Database();
  $conn = $db->connect();
?>

<?php
   
    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $model = new Schemes();
        $model->constructer($name);
        $query = "
            insert into $model->table_name values(
            default, 
            '$model->name', 
            '$model->created_datetime', 
            '$model->updated_datetime', 
            '$model->created_by',
            '$model->updated_by'
            )";

        $_SESSION['message'] = "Record has been saved";
        $_SESSION['msg_type'] = "success";
        try{
            $conn->query($query);
        }catch(PDOException $e){
            $_SESSION['message'] = "Something went wrong";
            $_SESSION['msg_type'] = "danger";
        }    

        header("location:index.php");
      
    }

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $id = $_POST['id'];
        $updated_by = "admin";
        $updated_datetime = date("y/m/d H:i:s");
        $model = new Schemes();
        $query = " update $model->table_name 
            set 
            name='$name', 
            updated_by='$updated_by', 
            updated_datetime='$updated_datetime' 
            where id=$id ";
        try{
            $conn->query($query);
            $_SESSION['message'] = "Record has been updated";
            $_SESSION['msg_type'] = "success";

        }catch(PDOException $e){
            $_SESSION['message'] = "Something went wrong";
            $_SESSION['msg_type'] = "danger";
        }   

        header("location:index.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $model = new Schemes();
        $query = "delete from $model->table_name where id=$id";
        try{
            $conn->query($query);
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }
        catch(PDOException $e){
            $_SESSION['message'] = "Something went wrong can not be deleted!";
            $_SESSION['msg_type'] = "danger";

        }
           
        header("location:index.php");
    }

?>