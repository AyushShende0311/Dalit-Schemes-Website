<?php
    require_once 'Users.php';
    require_once 'Session.php';
    session_start();
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(Users::login($username,$password)){
            $sid = rand(100,999) + time();
            $cookie_name = "sid";
            $cookie_value = $sid;
            $expiry = date("y/m/d H:i:s", strtotime("+1 day"));
            if(Session::save($username,$sid,$expiry)){
                setcookie($cookie_name,$cookie_value,time()+(86400*1),"/");
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