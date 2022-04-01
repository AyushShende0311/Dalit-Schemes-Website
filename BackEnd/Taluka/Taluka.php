<?php
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php'));
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php'));
    require_once "../DistrictWiseSchemes/DistrictWiseSchemes.php";

    class Taluka{
        public static $table_name = "taluka";
        public $id;
        public $name;
        public $district_id;
        public $district_name;
        public $created_datetime;
        public $updated_datetime;
        public $created_by;
        public $updated_by;

        public static function save($name, $district_id){
            $table = Taluka::$table_name;
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
            $district_id,
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
            $table = Taluka::$table_name;
            $model->updated_by = Session::getUserName();;
            $model->updated_datetime = date("y/m/d H:i:s");
            $query = " update $table
            set 
            name='$model->name', 
            district_id = $model->district_id,
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
            $table = Taluka::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select * from $table";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Taluka::load($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }        
            return $result;
        }

        public static function get_with_id($id){
            $table = Taluka::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where id=$id";
            try{
                $ans = $conn->query($query);
                if(count($rows = $ans->fetchAll())){
                    return Taluka::load($rows[0]);
                }
                else{
                    return 0;
                }              
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function get_with_district_id($id){
            $table = Taluka::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where district_id = $id";
            $result = array();
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Taluka::load($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }       
            return $result;
        }

        public static function get_with_scheme_id($id){
            $table = DistrictWiseSchemes::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where schemes_id = $id";
            $result = array();
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = DistrictWiseSchemes::load($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }       
            return $result;
        }

        public static function get_with_join(){
            $table = Taluka::$table_name;
            $table_district = Districts::$table_name;

            $db = new Database();
            $conn = $db->connect();

            $result = array();
            $query = "select 
            $table.id, 
            $table.name , 
            $table_district.name as 'district_name',
            $table.district_id , 
            $table.created_by, 
            $table.updated_by, 
            $table.created_datetime, 
            $table.updated_datetime
            from $table inner join $table_district 
            where $table.district_id=$table_district.id
            order by $table.id";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Taluka::load_with_join($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }

        public static function delete($id){
            $table = Taluka::$table_name;
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
            $object = new Taluka();
            $object->id = $row['id'];
            $object->name = $row['name'];
            $object->district_id = $row['district_id'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }

        public static function load_with_join($row){
            $object = new Taluka();
            $object->id = $row['id'];
            $object->name = $row['name'];
            $object->district_id = $row['district_id'];
            $object->district_name = $row['district_name'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }

    }
?>
