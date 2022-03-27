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
    <?php require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php'))); ?>
    <?= nav() ?>
    <?php
 		require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
        require_once 'LocalAreas.php';
        $db = new Database();
        $conn = $db->connect();
        $model = new LocalAreas();
        $id =  $_GET['edit'];
        $result = $conn->query("select * from $model->table_name where id=$id");
        $row = $result->fetch();
        $name = $row['name'];
  
    ?>

    <div class="container-lg">
            <div class="p-5 row justify-content-center">
                <form action="LocalAreasController.php" method="POST">
                    <input type="hidden" value="<?=$id?>" name="id">
                    <div class="mb-3">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?= $name?>" placeholder="Enter Local Area Name" name='name'>
                    </div>
                    <div class="mb-3">
                        <button type="submit"  class="btn btn-primary" name="update">Update</button>
                    </div>
                </form>
            </div>
    </div>
</body>
<script src="../../../bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</html>
