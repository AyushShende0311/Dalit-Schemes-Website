<?php
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Taluka/Taluka.php')));

    class LocalAreas{
        public static $table_name = "localarea";
        public $id;
        public $name;
        public $taluka_id;
        public $taluka_name;
        public $created_datetime;
        public $updated_datetime;
        public $created_by;
        public $updated_by;

        public static function save($name, $taluka_id){
            $table = LocalAreas::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $curent_username = Session::getUserName();
            $created_datetime = date("y/m/d H:i:s");
            $updated_datetime = date("y/m/d H:i:s");
            $updated_by = $curent_username;
            $created_by = $curent_username;

            $query = "
            insert into $table values(
            default, 
            '$name',
             $taluka_id,
            '$created_datetime', 
            '$updated_datetime', 
            '$created_by',
            '$updated_by'
            )";

            try{
                $conn->query($query);
                return 1;
            }catch(PDOException $e){
                return 0;
            }
           
            return 0;
        }

        public static function update($model){
            $table = LocalAreas::$table_name;
            $model->updated_by = Session::getUserName();
            $model->updated_datetime = date("y/m/d H:i:s");
            $query = " update $table
            set 
            name='$model->name', 
            taluka_id = $model->taluka_id,
            updated_by='$model->updated_by', 
            updated_datetime='$model->updated_datetime' 
            where id=$model->id ";

            $db = new Database();
            $conn = $db->connect();

            try{
                $conn->query($query);
                return 1;
            }
            catch(PDOException $e){
                return 0;
            }
        }

        public static function get(){
            $table = LocalAreas::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select * from $table";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = LocalAreas::load($row);
                    array_push($result, $model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
           
            return $result;
        }

        public static function get_with_join(){
            $table = LocalAreas::$table_name;
            $table_taluka = Taluka::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select 
            $table.id, 
            $table.name,
            $table_taluka.name as 'taluka_name',
            $table.taluka_id , 
            $table.created_by, 
            $table.updated_by, 
            $table.created_datetime, 
            $table.updated_datetime
            from $table 
            inner join $table_taluka 
            where $table.taluka_id=$table_taluka.id
            order by $table.id";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = LocalAreas::load_with_join($row);
                    array_push($result, $model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
           
            return $result;
        }

        
        public static function get_with_id($id){
            $table = LocalAreas::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where id=$id";
            try{
                $ans = $conn->query($query);
                if(count($rows = $ans->fetchAll())){
                    return LocalAreas::load($rows[0]);
                }
                else{
                    return 0;
                }
                
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function get_with_taluka_id($id){
            $table = LocalAreas::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where taluka_id = $id";
            $result = array();
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = LocalAreas::load($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        
            return $result;
        }

        public static function delete($id){
            $table = LocalAreas::$table_name;
            $db = new Database();
            $conn = $db->connect();

            $query = "delete from $table where id=$id";
            
            try{
                $conn->query($query);
                return 1;
            }
            catch(PDOException $e){
                return 0;
            }
        }

        public static function load($row){
            $object = new LocalAreas();
            $object->id = $row['id'];
            $object->name = $row['name'];
            $object->taluka_id = $row['taluka_id'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }

        public static function load_with_join($row){
            $object = new LocalAreas();
            $object->id = $row['id'];
            $object->name = $row['name'];
            $object->taluka_id = $row['taluka_id'];
            $object->taluka_name = $row['taluka_name'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }
    }

?>