<?php 
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php')); 
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php'));
    require_once 'DistrictsController.php'; 
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
            var navLink = document.querySelector("#page-district");
            navLink.classList.add("active");
        </script>

        <div class="container-lg">
            <div class="p-5 row justify-content-center">
                <form action="districtsController.php" method="POST" ">
                    <div class="mb-3">
                        <label  class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Enter District Name" name='name'>
                    </div>
                    <div class="mb-3">
                        <button type="submit"  class="btn btn-primary" name="submit">Save</button>
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