<?php 

    require_once("./Session.php");
    if(Session::delete()){
        header("location:../index.php");
    }else{
        header("location:./index.php");
    }


?>