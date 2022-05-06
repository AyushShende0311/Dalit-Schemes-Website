<?php 
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php')); 
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php'));
    require_once 'Schemes.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.1.3-dist\css\bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
    
    <?php if(Session::isLoggedIn()): ?>
        <?php 
        session_start(); ?>
       
        <?= nav() ?>
        <script>
            var navLink = document.querySelector("#page-scheme");
            navLink.classList.add("active");
        </script>
        <?php  
            $id =  $_GET['edit'];
            if($model = Schemes::get_with_id($id)){
            }else{
                $_SESSION['message'] = "Record Not Found";
                $_SESSION['msg_type'] = "warning";
                header("location:index.php");
            }
        ?>

        <div class="container-lg">
                <div class="p-5 row justify-content-center">
                    <form action="schemesController.php" method="POST">
                        <input type="hidden" value="<?= htmlspecialchars(serialize($model), ENT_QUOTES) ?>" name="model">
                        <div class="mb-3">
                            <label  class="form-label">Scheme Name</label>
                            <input type="text" class="form-control" value="<?= $model->name?>" placeholder="Enter Scheme Name" name='name'>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Name In Marathi</label>
                            <input type="text" class="form-control" value="<?= $model->name_mr?>" placeholder="Enter Scheme Name in Marathi" name='name_mr'>
                        </div>
                        <div class="mb-3">
                            <button type="submit"  class="btn btn-primary" name="update">Update</button>
                        </div>
                    </form>
                </div>
        </div>
    <?php else : ?>
        <?php header("location:../Users/login.php"); ?>
    <?php endif ?>
</body>
<script src="../../../bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</html>
