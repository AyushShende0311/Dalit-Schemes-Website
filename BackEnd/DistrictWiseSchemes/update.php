<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Schemes/Schemes.php')));
    require_once 'DistrictWiseSchemes.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.1.3-dist\css\bootstrap.min.css" >
    <script src="DistrictWiseSchemesJs.js"></script>
    <title>Document</title>
</head>
<body>
    <?= nav() ?>
    <script>
        var navLink = document.querySelector("#page-main");
        navLink.classList.add("active");
    </script>
    
    <?php
 		
        $id =  $_GET['edit'];
        if($model = DistrictWiseSchemes::get_with_id($id)){
            
        }else{
            $_SESSION['message'] = "Record Not Found";
            $_SESSION['msg_type'] = "warning";
            header("location:index.php");
        }
        if($districts = Districts::get()){
            
        }else{
            $_SESSION['message'] = "District Not Found";
            $_SESSION['msg_type'] = "warning";
            header("location:index.php");
        }
        if($schemes = Schemes::get()){
            
        }else{
            $_SESSION['message'] = "Scheme Not Found";
            $_SESSION['msg_type'] = "warning";
            header("location:index.php");
        }
    ?>

    <div class="container-lg">
            <div class="p-5 row justify-content-center">
                <form action="DistrictWiseSchemesController.php" method="POST">
                    <input type="hidden" value="<?=htmlspecialchars(serialize($model),ENT_QUOTES)?>" name="model">
                    <div class="mb-3">
                        <!-- District  -->
                        <label  class="form-label">District</label>
                        <select id="district" name='district' class="form-control mb-3" onchange="getTalukas()">
                            <option disable="true" value="0" disabled selected> -- Select --</option>
                            <?php foreach($districts as $district): ?>
                            <option value="<?= $district->id?>" <?php if($model->district_id == $district->id) echo 'selected' ?> ><?= $district->name ?> </option>
                            <?php endforeach ?>
                            <script> getTalukas_update(<?= $model->taluka_id ?>) </script>
                        </select>
                        <!-- taluka  -->
                        <label  class="form-label">Taluka</label>
                        <select id="taluka" name='taluka' class="form-control mb-3" onchange="getLocalAreas()" >
                            <option disable="true" value="0" disabled selected> -- Select --</option>
                            <script> getLocalAreas_update(<?= $model->localarea_id ?>,<?= $model->taluka_id ?>) </script>
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
                            <option value="<?= $scheme->id?>" <?php if($model->scheme_id == $scheme->id) echo 'selected' ?> ><?= $scheme->name ?> </option>
                            <?php endforeach ?>
                        </select>
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
