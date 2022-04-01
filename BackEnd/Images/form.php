<?php 
        require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../header.php'));
        require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php'));
        require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Schemes/Schemes.php'));
        require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../DistrictWiseSchemes/DistrictWiseSchemes.php'));
        require_once 'ImagesController.php'; 
        require_once 'Images.php';
        require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
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
            var navLink = document.querySelector("#page-images");
            navLink.classList.add("active");
        </script>
        <?php
            $implementedSchemes = DistrictWiseSchemes::get_with_join();
        ?>
    <!-- Form -->
        <div class="container-lg">
            <div class="p-5 row justify-content-center">
                <form id="form" action="ImagesController.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <!-- District  -->
                        <label  class="form-label">Add to </label>
                        <select id="main_id" name='main_id' class="form-control mb-3" >
                            <option disable="true" value="0" disabled selected> -- Select --</option>
                            <?php foreach($implementedSchemes as $implementedScheme): ?>
                            <option value="<?= $implementedScheme->id?>" >
                                <?= 
                                $implementedScheme->district_name.
                                "->".$implementedScheme->taluka_name.
                                "->".$implementedScheme->localarea_name.
                                "->".$implementedScheme->scheme_name 
                                ?> 
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Upload Images</label><br>
                        <input type="file" name="files"  enctype="multipart/form-data">
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