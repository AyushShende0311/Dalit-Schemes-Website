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
    <?php require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php'))); ?>
    <?php if(Session::isLoggedIn()): ?>
        <?= nav() ?>
        <script>
            var navLink = document.querySelector("#page-Events");
            navLink.classList.add("active");
        </script>

        <?php 
            require_once 'EventsController.php';
            require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
            $db = new Database();
            $conn= $db->connect();
            $query = "select * from district";
            $district = $conn->query($query);
        ?>
    
        <div class="container-lg">
            <div class="p-5 row justify-content-center">
                <form action="EventsController.php" method="POST">
                    <div class="mb-3">
                        <label  class="form-label">District</label>
                        <select name="district" class="form-control mb-3">
                            <option disable="true" value="0" disabled selected> --select District--</option>
                            <?php while($row = $district->fetch()): ?>
                                    <option value="<?= $row['id']?>" ><?= $row['name'] ?> </option>
                            <?php endwhile ?>
                        </select>
                            <label  class="form-label">Event Title</label>
                            <input type="text" class="form-control" placeholder="Enter Event Title" name='event_title'>

                            <label  class="form-label">Event Deatils</label>
                            <input type="text" class="form-control" placeholder="Enter Event Details" name='event_details'> 
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