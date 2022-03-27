<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../bootstrap-5.1.3-dist\css\bootstrap.min.css" >
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php'))); ?>
    <?= nav() ?>
    <script>
        var navLink = document.querySelector("#page-scheme");
        navLink.classList.add("active");
    </script>
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
        require_once 'Schemes.php';

        session_start();
        $db = new Database();
        $conn = $db->connect();
        $model = new Schemes();
        $result = $conn->query("select * from $model->table_name");
     ?>

    <?php 
        if(isset($_SESSION['message'])):
     ?>
        
        <div class="alert alert-<?= $_SESSION['msg_type'];?>" >
        
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']); 
            ?>
        </div>
    
    <?php endif ?>


    <div class="container-sm p-0">
        
        <a href="form.php" class="mb-3 btn btn-primary">Add Scheme</a>
        <div class="ph-5  row justify-content-center">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>id</th>
                        <th>name</th>
                        <th>created_by</th>
                        <th>updated_by</th>
                        <th>created_datetime</th>
                        <th>updated_datetime</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <?php $count = 1 ?> 
                <?php while($row = $result->fetch()):?>
                    <tr>
                        <td> <?=$count?></td>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['created_by']; ?></td>
                        <td><?= $row['updated_by']; ?></td>
                        <td><?= $row['created_datetime']; ?></td>
                        <td><?= $row['updated_datetime']; ?></td>
                        <td>
                            <a href="update.php?edit=<?= $row['id'];?>" class="btn btn-success">Edit</a>
                            <a href="SchemesController.php?delete=<?= $row['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php $count += 1?>
                <?php endwhile; ?>
            </table>
            
        </div>
    </div>
</body>
<script src="../../../bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</html>