<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php'))); 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php'))); 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Taluka/Taluka.php')));
    require_once 'LocalAreas.php';
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
        <?= nav() ?>
        <script>
            var navLink = document.querySelector("#page-localarea");
            navLink.classList.add("active");
        </script>
        
        <?php
            $id =  $_GET['edit'];
            if($model = LocalAreas::get_with_id($id)){   
            }else{
                $_SESSION['message'] = "Record Not Found";
                $_SESSION['msg_type'] = "warning";
                header("location:index.php");
            }
            if($talukas = Taluka::get()){        
            }else{
                $_SESSION['message'] = "Record Not Found";
                $_SESSION['msg_type'] = "warning";
                header("location:index.php");
            }
        ?>
        <div class="container-lg">
                <div class="p-5 row justify-content-center">
                    <form action="LocalAreasController.php" method="POST">
                        <input type="hidden" value="<?=htmlspecialchars(serialize($model),ENT_QUOTES)?>" name="model">
                        <label  class="form-label">Taluka</label>
                        <select name='taluka_id' class="form-control mb-3" >
                            <?php foreach($talukas as $taluka): ?>
                                <option  value="<?=$taluka->id;?>" <?php if($model->taluka_id === $taluka->id) echo 'selected';?> > <?=$taluka->name ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="mb-3">
                            <label  class="form-label">Local Area Name</label>
                            <input type="text" class="form-control" value="<?=$model->name?>" placeholder="Enter Local Area Name" name='name'>
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
