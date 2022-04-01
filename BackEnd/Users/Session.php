<?php
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    class Session{
        public $id;
        public $sid;
        public $user_name;
        public $is_logged_in;
        public $expiry;
        public static $table_name = 'session';

        public static function save($username,$sid,$expiry){
            $db = new Database();
            $conn = $db->connect();
            $table = Session::$table_name ;
            $query = "insert into $table values(default,$sid, '$username', 1, '$expiry')";
            try{
               $conn->query($query);
               return 1;
            }catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
        }

        public static function isLoggedIn(){
            Session::deleteExpire();
            if(isset($_COOKIE['sid'])){
                $sid = $_COOKIE['sid'];
                $db = new Database();
                $conn = $db->connect();
                $table = Session::$table_name ;
                $query = "select * from $table where s_id = $sid";
    
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
            }else{
                return 0;
            }
           
        }

        public static function delete(){
            if(isset($_COOKIE['sid'])){
                $db = new Database();
                $conn = $db->connect();
                $table = Session::$table_name ;
                $sid = $_COOKIE['sid'];
                $query = "delete from $table where s_id = $sid";
    
                try{
                    $conn->query($query);
                    setcookie("sid","",time()-3600);
                    return 1;
                }catch(PDOException $e){
                    return 0;
                }
            }else{
                return 0;
            }
          
        }

        public static function deleteExpire(){
            $db = new Database();
            $conn = $db->connect();
            $table = Session::$table_name ;
            $query = "delete from $table where expiry < NOW()";

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