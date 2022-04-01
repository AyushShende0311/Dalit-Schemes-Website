<?php require_once 'Session.php';
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
    <?php 
        if(Session::isLoggedIn()){
            header("location:./index.php");
        }
    ?>
        <div class='bg-secondary container-fluid mb-4'>
            <div class='container-sm'>
                <nav class='navbar navbar-expand-lg navbar-dark  '>
                <div class='container-fluid'>
                <a class='navbar-brand' href='../index.php'>Backend</a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav'>        
                    </ul>
                </div>
                </div>
            </nav>
        </div>
      </div>
    <?php 
        session_start();
        if(isset($_SESSION['message'])):
     ?>
        <div class="alert alert-<?= $_SESSION['msg_type'];?>" >
        
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']); 
            ?>
        </div>
    
    <?php endif ?>
    <div class="conatiner-fluid">
        <div class="container-sm">
            <form action="UsersController.php" method="POST" style="width:50%">
                <h1 class="mb-4 mt-4"> Login </h1>
                <div class="mb-3" style="width:300px">
                    <input type="text" max="20" required class="form-control" placeholder="Enter Username" name='username'>
                </div>
                <div class="mb-3" style="width:300px">
                    <input type="password" required  class="form-control" placeholder="Enter Password" name='password'>
                </div>
                <div class="mb-3" >
                    <button type="submit"  class="btn btn-primary" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="../../bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</html>