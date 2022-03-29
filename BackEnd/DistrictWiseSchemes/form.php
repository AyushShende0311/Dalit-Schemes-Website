<?php 
        require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php')));
        require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php')));
        require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Schemes/Schemes.php')));
        require_once 'DistrictWiseSchemesController.php'; 
        require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
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
    <?= nav() ?>
    <script>
        var navLink = document.querySelector("#page-main");
        navLink.classList.add("active");
    </script>

    <?php 
        $districts = Districts::get();
        $schemes = Schemes::get();
    ?>

   <!-- Form -->
    <div class="container-lg">
        <div class="p-5 row justify-content-center">
            <form action="DistrictWiseSchemesController.php" method="POST">
                <div class="mb-3">

                    <!-- District  -->
                    <label  class="form-label">District</label>
                    <select id="district" name='district' class="form-control mb-3" onchange="getTalukas()">
                        <option disable="true" value="0" disabled selected> -- Select --</option>
                        <?php foreach($districts as $district): ?>
                          <option value="<?= $district->id?>" ><?= $district->name ?> </option>
                        <?php endforeach ?>
                    </select>

                    <!-- taluka  -->
                    <label  class="form-label">Taluka</label>
                    <select id="taluka" name='taluka' class="form-control mb-3" onchange="getLocalAreas()">
                        <option disable="true" value="0" disabled selected> -- Select --</option>
                    </select>

                    <!-- Area  -->
                    <label  class="form-label">Area</label>
                    <select id="area" name='area' class="form-control mb-3">
                        <option disable="true" value="0" disabled selected> -- Select --</option>
                    </select>
                    
                    <!-- Schemes -->
                    <label  class="form-label">Schemes</label>
                    <select id="scheme" name='scheme' class="form-control mb-3" >
                        <option disable="true" value="0" disabled selected> -- Select --</option>
                        <?php foreach($schemes as $scheme): ?>
                          <option value="<?= $scheme->id?>" ><?= $scheme->name ?> </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit"  class="btn btn-primary" name="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
<script src="../../../bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
<script src="DistrictWiseSchemesJs.js"></script>
</html>