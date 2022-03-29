<?php
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    class Session{
        public $id;
        public $user_name;
        public $is_logged_in;
        public static $table_name = 'session';

        public static function save($username){
            $db = new Database();
            $conn = $db->connect();
            $table = Session::$table_name ;
            $query = "insert into $table values(default, '$username', 1)";

            try{
               $conn->query($query);
               return 1;
            }catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
        }

        public static function isLoggedIn(){
            $db = new Database();
            $conn = $db->connect();
            $table = Session::$table_name ;
            $query = "select * from $table";

            try{
                $result = $conn->query($query);
                if(count($result->fetchAll())){
                    return 1;
                }else{
                    return 0;
                }
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function delete(){
            $db = new Database();
            $conn = $db->connect();
            $table = Session::$table_name ;
            $query = "delete from $table";

            try{
                $conn->query($query);
                return 1;
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function getUserName(){
            $db = new Database();
            $conn = $db->connect();
            $table = Session::$table_name ;
            $query = "select * from $table";

            try{
                $result = $conn->query($query);
                if(count($rows=$result->fetchAll())){
                    return $rows[0]['user_name'];
                }else{
                    return '';
                }
            }catch(PDOException $e){
                return '';
            }
        }


    }
?>