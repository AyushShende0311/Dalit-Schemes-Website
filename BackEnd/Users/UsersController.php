<?php

    require_once 'Users.php';
    require_once 'Session.php';
    session_start();
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(Users::login($username,$password)){
            if(Session::save($username)){
                header("location:./index.php");
            }else{
                $_SESSION['message'] = "Login Failed! Session Error";
                $_SESSION['msg_type'] = "danger";
                header("location:./login.php");
            }
            
        }else{
            $_SESSION['message'] = "Login Failed! Incorrect Credentials";
            $_SESSION['msg_type'] = "danger";
            header("location:./login.php");
        }
    }

?>