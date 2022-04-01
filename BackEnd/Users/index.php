<?php 
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php'));
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php')); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.1.3-dist\css\bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
    <?php if(Session::isLoggedIn()): ?>
        <?= nav() ?>
        <script>
            
        </script>
        <div class="container-fluid">
            <div class="container-sm">
                <div class="row justify-content-center mt-5">
                    <h1 style="font-size:60px;text-align:center;"> Welcome </h1>
                <div>
            </div>
        </div>
    <?php else : ?>
        <?php header("location:../Users/login.php"); ?>
    <?php endif ?>
</body>
<script src="../../bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</html>