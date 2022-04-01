<?php
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    class Users{
        public static $table_name = "users";
        public static $is_logged_in = 0;
        public static $current_user_username = '';
        public $username;
        private $password;

        public static function login($username, $password){
            if($currentUser = Users::getUser($username)){
                $verify = password_verify($password, $currentUser->password);
                if($verify){
                    return 1;
                } 
                else return 0;
            }else{
                return 0;
            }
        }
        
        private static function getUser($username){
            $table = Users::$table_name;
            $query = "select * from $table where username='$username'";
            $db = new Database();
            $conn = $db->connect();

            try{
                $result = $conn->query($query);
                if(count($rows = $result->fetchAll())){
                    return Users::load($rows[0]);
                }else{
                    return 0;
                }

            }catch(PDOException $e){
                return 0;
            }
        }

        private static function load($row){
            $model = new users();
            $model->username = $row['username'];
            $model->password = $row['password'];
            return $model;
        }
    }


?>